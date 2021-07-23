import React, { useState, useEffect, forwardRef, useImperativeHandle }  from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import { 
  Button,
  FormControl,
  TextField,
 } from '@material-ui/core'; //Buttonをインポート
import IconButton from '@material-ui/core/IconButton';
import DeleteIcon from '@material-ui/icons/Delete';
import axios from 'axios'
import CircularProgress from '@material-ui/core/CircularProgress';
import { green } from '@material-ui/core/colors';
import clsx from 'clsx';
import Box from '@material-ui/core/Box';
import blueImg from "../assets/img/blue.png";
import blackImg from "../assets/img/black.png";
import greenImg from "../assets/img/green.png";
import redImg from "../assets/img/red.png";
import orangeImg from "../assets/img/orange.png";

const TAX_RATE = 0.10;

const useStyles = makeStyles((theme) => ({
  margin: {
    margin: theme.spacing(1),
  },
  table: {
    minWidth: 700,
  },
  root: {
    display: 'flex',
    alignItems: 'center',
  },
  wrapper: {
    margin: theme.spacing(1),
    position: 'relative',
    display: 'inline-block',
  },
  buttonSuccess: {
    backgroundColor: green[500],
    '&:hover': {
      backgroundColor: green[700],
    },
  },
  fabProgress: {
    color: green[500],
    position: 'absolute',
    top: -6,
    left: -6,
    zIndex: 1,
  },
  buttonProgress: {
    color: green[500],
    position: 'absolute',
    top: '50%',
    left: '50%',
    marginTop: -12,
    marginLeft: -12,
  },
  button: {
    margin: theme.spacing(1),
  },
  img: {
    width: "140px"
  },
  imgSp: {
    width: "30%"
  }
}));

function ccyFormat(num:number) {
  return `${num.toFixed(0)}`;
}

function priceRow(qty:number, unit:number) : number {
  return qty * unit;
}

type Item = {
  id:number
  , desc:string
  , qty:number
  , unit:number
  , colorId:number
  , price:number
  , priceTotal:number
  , priceTaxIn:number
  , prictTotalTaxIn:number
}

function createRow(id:number, desc:string, qty:number, colorId:number, unit:number
  , priceTotal:number, priceTaxIn:number, prictTotalTaxIn:number) : Item {
  const price:number = priceRow(qty, unit);
  return { id, desc, qty, unit, colorId, price, priceTotal, priceTaxIn, prictTotalTaxIn};
}

function subtotal(items:Item[]) {
  return items.map(({ price }) => price).reduce((sum, i) => sum + i, 0);
}

type Props = {[key: string] : any}

const CartTable = forwardRef((props:Props, ref) => {
  const classes = useStyles();
  const [cartItems, setItems] = useState<Array<Item>>(new Array<Item>())
  const [loading, setLoading] = useState(false);
  const [success, setSuccess] = React.useState(false);
  const [readonly, setReadOnly] = React.useState(void 0 !== props.readOnly ? true : false);
  const [invoiceSubtotal, setInvoiceSubtotal] = useState(0);
  const [invoiceTaxes, setInvoiceTaxes] = useState(0);
  const [invoiceTotal, setInvoiceTotal] = useState(0);
  const buttonClassname = clsx({
    [classes.buttonSuccess]: success,
  });
  useImperativeHandle(ref, () => ({
    updateCart(cart:any) {
      updateItems(cart)
    }
  }));

  useEffect(() => {
    if ("" == props.cart) {
      return
    }
    updateItems(JSON.parse(props.cart))
    console.log(props)
  }, [])

  function updateItems(cart:any) {
    var newItems:Array<Item> = new Array<Item>()
    if (null == cart) {
      setItems(newItems)
      setInvoiceSubtotal(0)
      setInvoiceTaxes(0)
      setInvoiceTotal(0)
      return
    }
    for(var idx in cart.items) {
      var propsItem = cart.items[idx]
      newItems.push(createRow(
        propsItem.product.productId.value
        , propsItem.product.productName.value
        , propsItem.quantity.value
        , propsItem.product.color.colorId.value
        , propsItem.product.price.value
        , propsItem.priceTotal.value
        , propsItem.product.priceTaxIn.value
        , propsItem.priceTotalTaxin.value
      ))
    }
    setItems(newItems)
    if (null != cart.total.value) {
      setInvoiceSubtotal(cart.total.value)
      if (null != cart.totalTaxin.value) {
        setInvoiceTaxes(cart.totalTaxin.value - cart.total.value)
        setInvoiceTotal(cart.totalTaxin.value)
      }
    }
  }

  //const invoiceSubtotal = subtotal(cartItems);
  //const invoiceTaxes = TAX_RATE * invoiceSubtotal;
  //const invoiceTotal = invoiceTaxes + invoiceSubtotal;
  
  async function postCartAdd(productId:number, quantity:number, isRemove:boolean, isAllRemove:boolean) {
    setLoading(true)
    setSuccess(false)
    var params = new URLSearchParams();
    if (isAllRemove) {
      params.append('isAllRemove', true.toString()) 
    } else {
      params.append('productId', productId.toString())
      if (isRemove) {
        params.append('isRemove', true.toString()) 
      } else {
        params.append('quantity', quantity.toString()) 
      }
    }
    try {
      let cartAddUrl = "/api/cart/add"
      if ("" != props.url_prefix) {
        cartAddUrl = "/api/" + props.url_prefix + "/cart/add"
      }
      const res = await axios.post(cartAddUrl, params);
      console.log(res)
      updateItems(res.data.viewModel.cart)
    } catch (error) {
      console.log(error)
    }
    setLoading(false)
    setSuccess(true)
  }
  async function plusQty(item:Item) {
    postCartAdd(item.id, 1, false, false)
    console.log("plusQty")
    console.log(item)
  }
  function minusQty(item:Item) {
    postCartAdd(item.id, -1, false, false)
    console.log("minusQty")
    console.log(item)
  }
  function removeItem(item:Item) {
    postCartAdd(item.id, 0, true, false)
    console.log("removeItem")
    console.log(item)
  }
  function allRemoveItem() {
    postCartAdd(0, 0, false, true)
    console.log("allRemoveItem")
  }
  function orderForm() {
    setLoading(true)
    let orderUrl = "/order/form"
    if ("" != props.url_prefix) {
      orderUrl = "/" + props.url_prefix + "/order/form"
    }
    window.location.href = orderUrl
    console.log("orderForm")
  }
  const getCartError = () => {
    if (0 >= cartItems.length) {
      return (
        <FormControl margin="normal" fullWidth>
          <TextField id="cart" type="text" label="カートが空です"
          　error={0 >= cartItems.length}
          　helperText=""
          　InputProps={{readOnly: true,}} />
        </FormControl>
      )
    }
  }
  function getColor(colorId:number) {
    switch(colorId) {
      case 1: return redImg
      case 2: return blackImg
      case 3: return greenImg
      case 4: return blueImg
      case 5: return orangeImg
    }
  }
  const isPcLayout = () => {
    let width = document.documentElement.clientWidth
    if (960 < width) {
      return true
    }
    return false
  }
  const pcLayout =
  (
    <TableContainer component={Paper}>
      {getCartError()}
      <Table className={classes.table} aria-label="spanning table">
        <TableHead>
          <TableRow>
            <TableCell align="center">
              <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                <Button
                  onClick={allRemoveItem}
                  variant="contained"
                  color="secondary"
                  className={classes.button}
                  startIcon={<DeleteIcon />}
                  disabled={loading || 0 >= cartItems.length}>
                  全商品削除
                </Button>
                {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
              </Box>
            </TableCell>
            <TableCell align="center" colSpan={2}>
              カート
            </TableCell>
            <TableCell align="right">価格</TableCell>
          </TableRow>
          <TableRow>
            <TableCell></TableCell>
            <TableCell>商品名</TableCell>
            <TableCell align="right">数量</TableCell>
            <TableCell align="right">単価</TableCell>
            <TableCell align="right">計</TableCell>
            <TableCell align="right"></TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {cartItems.map((item) => (
            <TableRow key={item.desc}>
              <TableCell><img src={getColor(item.colorId)} className={classes.img}></img></TableCell>
              <TableCell>{item.desc}</TableCell>
              <TableCell align="center">
                <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                  <Button
                  onClick={() => minusQty(item)}
                  variant="contained"
                  color="primary"
                  className={buttonClassname}
                  disabled={loading || 1 >= item.qty}>
                  ー
                  </Button>
                  {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
                </Box>
                &nbsp;&nbsp;{item.qty}&nbsp;&nbsp;
                <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                  <Button
                  onClick={() => plusQty(item)}
                  variant="contained"
                  color="primary"
                  className={buttonClassname}
                  disabled={loading}>
                  ＋
                  </Button>
                  {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
                </Box>
              </TableCell>
              <TableCell align="right">{item.unit}</TableCell>
              <TableCell align="right">{ccyFormat(item.price)}</TableCell>
              <TableCell align="center">
              <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                <IconButton onClick={() => removeItem(item)} aria-label="delete" className={classes.margin} disabled={loading}>
                  <DeleteIcon fontSize="large" />
                </IconButton>
                {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
              </Box>
              </TableCell>
            </TableRow>
          ))}

          <TableRow>
            <TableCell rowSpan={4} />
            <TableCell colSpan={2}>合計（税抜）</TableCell>
            <TableCell align="right">{ccyFormat(invoiceSubtotal)}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell>消費税</TableCell>
            <TableCell align="right">{`${(TAX_RATE * 100).toFixed(0)} %`}</TableCell>
            <TableCell align="right">{ccyFormat(invoiceTaxes)}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell colSpan={2}>合計（税込）</TableCell>
            <TableCell align="right">{ccyFormat(invoiceTotal)}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell colSpan={2} />
            <TableCell align="center">
              <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                <Button
                  onClick={() => orderForm()}
                  variant="contained"
                  color="primary"
                  className={buttonClassname}
                  disabled={loading || 0 >= cartItems.length}>
                  注文へ進む
                </Button>
                {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
              </Box>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </TableContainer>
  )
  const spLayout = 
  (
    <TableContainer component={Paper}>
      {getCartError()}
      <Table aria-label="spanning table">
        <TableHead>
          <TableRow>
            <TableCell align="center">
              カート
            </TableCell>
            <TableCell align="center">
              <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                <Button
                  onClick={allRemoveItem}
                  variant="contained"
                  color="secondary"
                  className={classes.button}
                  startIcon={<DeleteIcon />}
                  disabled={loading || 0 >= cartItems.length}>
                  全商品削除
                </Button>
                {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
              </Box>
            </TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          <TableRow><TableCell colSpan={2}>
          {cartItems.map((item) => (
            <Table key={item.desc} aria-label="spanning table"><TableBody>
              <TableRow>
                <TableCell colSpan={2} align="center"><img src={getColor(item.colorId)} className={classes.imgSp}></img></TableCell>
              </TableRow>
              <TableRow >
                <TableCell>商品名</TableCell>
                <TableCell align="right">{item.desc}</TableCell>
              </TableRow>
              <TableRow >
                <TableCell colSpan={2} align="center">
                  <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                    <Button
                    onClick={() => minusQty(item)}
                    variant="contained"
                    color="primary"
                    className={buttonClassname}
                    disabled={loading || 1 >= item.qty}>
                    ー
                    </Button>
                    {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
                  </Box>
                  &nbsp;&nbsp;{item.qty}&nbsp;&nbsp;
                  <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                    <Button
                    onClick={() => plusQty(item)}
                    variant="contained"
                    color="primary"
                    className={buttonClassname}
                    disabled={loading}>
                    ＋
                    </Button>
                    {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
                  </Box>
                </TableCell>
              </TableRow>
              <TableRow>
                <TableCell>数量</TableCell>
                <TableCell align="right">{item.unit}</TableCell>
              </TableRow>
              <TableRow >
                <TableCell>単価</TableCell>
                <TableCell align="right">{ccyFormat(item.price)}</TableCell>
              </TableRow>
              <TableRow >
                <TableCell colSpan={2} align="center">
                  <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                    <IconButton onClick={() => removeItem(item)} aria-label="delete"
                     className={classes.margin} disabled={loading}>
                      <DeleteIcon fontSize="large" />
                    </IconButton>
                    {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
                  </Box>
                </TableCell>
              </TableRow>
            </TableBody></Table>
          ))}
          </TableCell></TableRow>

          <TableRow>
            <TableCell>合計（税抜）</TableCell>
            <TableCell align="right">{ccyFormat(invoiceSubtotal)}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell>消費税（{`${(TAX_RATE * 100).toFixed(0)} %`}）</TableCell>
            <TableCell align="right">{ccyFormat(invoiceTaxes)}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell>合計（税込）</TableCell>
            <TableCell align="right">{ccyFormat(invoiceTotal)}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell colSpan={2} align="center">
              <Box component="div" className={classes.wrapper} visibility={readonly ? "hidden" : "visible"}>
                <Button
                  onClick={() => orderForm()}
                  variant="contained"
                  color="primary"
                  className={buttonClassname}
                  disabled={loading || 0 >= cartItems.length}>
                  注文へ進む
                </Button>
                {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
              </Box>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </TableContainer>
  )
  return (
    <div>
      {isPcLayout() ? pcLayout : spLayout}
    </div>
  )
});

export default CartTable;
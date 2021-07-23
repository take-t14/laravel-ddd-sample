import React, {useState, useRef, useEffect } from "react";
import { makeStyles } from '@material-ui/core/styles';
import {
  FormControl,
  InputLabel,
  Input,
  TextField,
  Button,
  Grid,
} from "@material-ui/core";
import CartTable from './CartTable'
import axios from 'axios'
import CircularProgress from '@material-ui/core/CircularProgress';
import { green } from '@material-ui/core/colors';
import clsx from 'clsx';
import AlertDialog from "./AlertDialog"

const useStyles = makeStyles((theme) => ({
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
  buttonProgress: {
    color: green[500],
    position: 'absolute',
    top: '50%',
    left: '50%',
    marginTop: -12,
    marginLeft: -12,
  },
  fontSp: {
    marginTop: "40px"
    , fontSize: "50px",
  },
  fontSp2: {
    fontSize: "50px",
  },
  fontSp3: {
    fontSize: "35px",
  },
}));

type Props = {[key: string] : any}

type Errors = {
    first_name:Array<string>
  , last_name:Array<string>
  , mail:Array<string>
  , tel:Array<string>
  , zip:Array<string>
  , address1:Array<string>
  , cart:Array<string>
}

export default function OrderForm(props:Props) {
  const classes = useStyles();
  const [loading, setLoading] = useState(false);
  const [success, setSuccess] = React.useState(false);
  const buttonClassname = clsx({
    [classes.buttonSuccess]: success,
  });
  const [lastName, setLastName] = useState("");
  const [firstName, setFirstName] = useState("");
  const [mail, setmail] = useState("");
  const [tel, setTel] = useState("");
  const [zip, setZip] = useState("");
  const [address, setAddress] = useState("");
  const [isInput, setIsInput] = useState(true);
  const [isConfirm, setIsConfirm] = useState(false);
  const [isComplete, setIsComplete] = useState(false);
  const [errors, setErrors] = useState<Errors>({first_name:[], last_name:[], mail:[], tel:[], zip:[], address1:[], cart:[]});
  const childRef:any = useRef();
  const dialogRef:any = useRef();
  const [cartItems, setCartItems] = useState<Array<any>>([])

  useEffect(() => {
    let cart = JSON.parse(props.cart)
    if (null == cart) {
      setCartItems([])
    } else {
      setCartItems(cart.items)
    }
  }, [])

  const changeLastName = (event:any) => {
    setLastName(event.target.value)
    console.log("changeLastName:" + lastName)
  };
  const changeFirstName = (event:any) => {
    setFirstName(event.target.value)
    console.log("changeFirstName:" + firstName)
  };
  const changeMail = (event:any) => {
    setmail(event.target.value)
    console.log("changeMail:" + mail)
  };
  const changeTel = (event:any) => {
    var res = event.target.value.replace(/[^0-9¥-]/g, '');
    res = res.substr(0, 13)
    setTel(res)
    console.log("changeTel:" + tel)
  };
  const changeZip = (event:any) => {
    var res = event.target.value.replace(/[^0-9¥-]/g, '');
    res = res.substr(0, 8)
    setZip(res)
    console.log("changeZip:" + zip)
  };
  const changeAddress = (event:any) => {
    setAddress(event.target.value)
    console.log("changeAddress:" + address)
  };
  const updateErrors = (errors:any) => {
    var newErrors = {first_name:[], last_name:[], mail:[], tel:[], zip:[], address1:[], cart:[]}
    if (void 0 != errors.last_name) {
      newErrors.last_name = errors.last_name
    }
    if (void 0 != errors.first_name) {
      newErrors.first_name = errors.first_name
    }
    if (void 0 != errors.mail) {
      newErrors.mail = errors.mail
    }
    if (void 0 != errors.tel) {
      newErrors.tel = errors.tel
    }
    if (void 0 != errors.zip) {
      newErrors.zip = errors.zip
    }
    if (void 0 != errors.address1) {
      newErrors.address1 = errors.address1
    }
    if (void 0 != errors.cart) {
      newErrors.cart = errors.cart
    }
    setErrors(newErrors)
  }
  const toInput = (event:any) => {
    console.log("toInput")
    setIsInput(true)
    setIsConfirm(false)
    setIsComplete(false)
  };
  const toConfirm = async (event:any) => {
    console.log("toConfirm")
    setLoading(true)
    setSuccess(false)
    var isSuccess:boolean = false
    try {
      var params = new URLSearchParams();
      params.append('last_name', lastName)
      params.append('first_name', firstName)
      params.append('mail', mail)
      params.append('tel', tel)
      params.append('zip', zip)
      params.append('address1', address)
      let orderCheckUrl = "/api/order/check"
      if ("" != props.url_prefix) {
        orderCheckUrl = "/api/" + props.url_prefix + "/order/check"
      }
      const res = await axios.post(orderCheckUrl, params);
      console.log(res)
      childRef.current.updateCart(res.data.cart);
      if(void 0 != res.data.validationViewData
      && void 0 != res.data.validationViewData.errors
      && typeof res.data.validationViewData.errors === 'object'
      && 0 < Object.keys(res.data.validationViewData.errors).length) {
        // エラー
        updateErrors(res.data.validationViewData.errors)
      } else {
        isSuccess = true
      }
    } catch (error) {
      // エラー
      if (void 0 != error.response.data.errors
        && typeof error.response.data.errors === 'object'
        && 0 < Object.keys(error.response.data.errors).length) {
        updateErrors(error.response.data.errors)
      } else {
        let errMsg:string = "ご注文内容の確認に失敗しました"
        if (void 0 != error.response.data
        && void 0 != error.response.data.message) {
          errMsg = error.response.data.message
        }
        dialogRef.current.open("エラー", errMsg)
      }
      console.log(error)
    }
    if (isSuccess) {
      updateErrors({})
      setSuccess(true)
      setIsInput(false)
      setIsConfirm(true)
      setIsComplete(false)
  } else {
      setSuccess(false)
    }
    setLoading(false)
  };
  const toComplete = async (event:any) => {
    console.log("toComplete")
    setLoading(true)
    setSuccess(false)
    var isSuccess:boolean = false
    try {
      var params = new URLSearchParams();
      params.append('last_name', lastName)
      params.append('first_name', firstName)
      params.append('mail', mail)
      params.append('tel', tel)
      params.append('zip', zip)
      params.append('address1', address)
      let orderSaveUrl = "/api/order/save"
      if ("" != props.url_prefix) {
        orderSaveUrl = "/api/" + props.url_prefix + "/order/save"
      }  
      const res = await axios.post(orderSaveUrl, params);
      console.log(res)
      childRef.current.updateCart(res.data.cart);
      if(void 0 != res.data.validationViewData
      && void 0 != res.data.validationViewData.errors
      && typeof res.data.validationViewData.errors === 'object'
      && 0 < Object.keys(res.data.validationViewData.errors).length) {
        // エラー
        updateErrors(res.data.validationViewData.errors)
        setIsInput(true)
        setIsConfirm(false)
        setIsComplete(false)
      } else {
        isSuccess = true
      }
    } catch (error) {
      // エラー
      if (void 0 != error.response.data.errors
        && typeof error.response.data.errors === 'object'
        && 0 < Object.keys(error.response.data.errors).length) {
        updateErrors(error.response.data.errors)
      } else {
        let errMsg:string = "注文処理に失敗しました"
        if (void 0 != error.response.data
        && void 0 != error.response.data.message) {
          errMsg = error.response.data.message
        }
        dialogRef.current.open("エラー", errMsg)
      }
      setIsInput(true)
      setIsConfirm(false)
      setIsComplete(false)
      console.log(error)
    }
    if (isSuccess) {
      updateErrors({})
      setSuccess(true)
      setIsInput(false)
      setIsConfirm(false)
      setIsComplete(true)
    } else {
      setSuccess(false)
    }
    setLoading(false)
  };
  const getTitle = () => {
    if (isInput) {
      return <h1 className={!isPcLayout() ? classes.fontSp2 : ""}>注文情報の入力</h1>
    } else if (isConfirm) {
      return <h1 className={!isPcLayout() ? classes.fontSp2 : ""}>注文情報の確認</h1>
    } else {
      return <h1 className={!isPcLayout() ? classes.fontSp2 : ""}>注文完了</h1>
    }
  }
  const isPcLayout = () => {
    let width = window.outerWidth
    if (window.innerWidth < width) {
      width = window.innerWidth
    } 
    if (960 < width) {
      return true
    }
    return false
  }
  const getInput = () => {
    if (!isInput && !isConfirm) {
      return
    }
    return (
      <div>
        <Grid container spacing={isPcLayout() ? 2 : 1}>
          <Grid item xs={12} sm={isPcLayout() ? 6 : 12}>
            <FormControl margin="normal" fullWidth>
              <TextField id="last_name" type="text" label="氏名"
               error={0 < errors!.last_name.length} 
               helperText={errors!.last_name.join("、")}
               value={lastName} onChange={changeLastName}
               InputLabelProps={{classes: {root: !isPcLayout() ? classes.fontSp2 : "",}}}
               FormHelperTextProps={{classes: {root: !isPcLayout() ? classes.fontSp3 : "",}}}
               InputProps={{readOnly: !isInput, classes: {input: !isPcLayout() ? classes.fontSp : "",}}}/>
            </FormControl>
          </Grid>
          <Grid item xs={12} sm={isPcLayout() ? 6 : 12}>
            <FormControl margin="normal" fullWidth>
              <TextField id="first_name" type="text" label="名前"
              　error={0 < errors!.first_name.length}
              　helperText={errors!.first_name.join("、")}
              　value={firstName} onChange={changeFirstName}
                InputLabelProps={{classes: {root: !isPcLayout() ? classes.fontSp2 : "",}}}
                FormHelperTextProps={{classes: {root: !isPcLayout() ? classes.fontSp3 : "",}}}
                InputProps={{readOnly: !isInput, classes: {input: !isPcLayout() ? classes.fontSp : "",}}}/>
          </FormControl>
          </Grid>
          <Grid item xs={12} sm={isPcLayout() ? 6 : 12}>
            <FormControl margin="normal" fullWidth>
              <TextField id="mail" type="text" label="メールアドレス"
              　error={0 < errors!.mail.length}
              　helperText={errors!.mail.join("、")}
              　value={mail} onChange={changeMail}
                InputLabelProps={{classes: {root: !isPcLayout() ? classes.fontSp2 : "",}}}
                FormHelperTextProps={{classes: {root: !isPcLayout() ? classes.fontSp3 : "",}}}
                InputProps={{readOnly: !isInput, classes: {input: !isPcLayout() ? classes.fontSp : "",}}}/>
          </FormControl>
          </Grid>
          <Grid item xs={12} sm={isPcLayout() ? 6 : 12}>
            <FormControl margin="normal" fullWidth>
              <TextField id="tel" type="tel" label="電話番号"
              　error={0 < errors!.tel.length}
              　helperText={errors!.tel.join("、")}
              　value={tel} onChange={changeTel}
                InputLabelProps={{classes: {root: !isPcLayout() ? classes.fontSp2 : "",}}}
                FormHelperTextProps={{classes: {root: !isPcLayout() ? classes.fontSp3 : "",}}}
                InputProps={{readOnly: !isInput, classes: {input: !isPcLayout() ? classes.fontSp : "",}}}/>
          </FormControl>
          </Grid>
          <Grid item xs={12} sm={isPcLayout() ? 6 : 12}>
            <FormControl margin="normal" fullWidth>
              <TextField id="zip" type="text" label="郵便番号"
              　error={0 < errors!.zip.length}
              　helperText={errors!.zip.join("、")}
              　value={zip} onChange={changeZip}
                InputLabelProps={{classes: {root: !isPcLayout() ? classes.fontSp2 : "",}}}
                FormHelperTextProps={{classes: {root: !isPcLayout() ? classes.fontSp3 : "",}}}
                InputProps={{readOnly: !isInput, classes: {input: !isPcLayout() ? classes.fontSp : "",}}}/>
          </FormControl>
          </Grid>
          <Grid item xs={12} sm={12}>
            <FormControl margin="normal" fullWidth>
              <TextField id="address1" type="text" label="住所"
              　error={0 < errors!.address1.length}
              　helperText={errors!.address1.join("、")}
              　value={address} onChange={changeAddress}
                InputLabelProps={{classes: {root: !isPcLayout() ? classes.fontSp2 : "",}}}
                FormHelperTextProps={{classes: {root: !isPcLayout() ? classes.fontSp3 : "",}}}
                InputProps={{readOnly: !isInput, classes: {input: !isPcLayout() ? classes.fontSp : "",}}}/>
          </FormControl>
          </Grid>
        </Grid>
      </div>
    )
  }
  const getButtons = () => {
    if (isInput) {
      return (
        <div className={classes.wrapper}>
          <Button variant="contained" color="primary" size="medium"
           className={buttonClassname + (!isPcLayout() ? " " + classes.fontSp2 : "")} onClick={toConfirm}
           disabled={loading || 0 < errors!.cart.length || 0 >= cartItems.length}>
            確認画面へ進む
          </Button>
        {loading && <CircularProgress size={isPcLayout() ? 24 : 36} className={classes.buttonProgress} />}
        </div>
      )
    } else if (isConfirm) {
      return (
        <div>
          <div className={classes.wrapper}>
            <Button variant="contained" color="primary" size="medium"
             className={buttonClassname + (!isPcLayout() ? " " + classes.fontSp2 : "")} onClick={toInput}
             disabled={loading}>
              入力画面へ戻る
            </Button>
            {loading && <CircularProgress size={isPcLayout() ? 24 : 36} className={classes.buttonProgress} />}
          </div>
          <div className={classes.wrapper}>
            <Button variant="contained" color="primary" size="medium"
             className={buttonClassname + (!isPcLayout() ? " " + classes.fontSp2 : "")} onClick={toComplete}
             disabled={loading || 0 < errors!.cart.length || 0 >= cartItems.length}>
              注文確定
            </Button>
            {loading && <CircularProgress size={isPcLayout() ? 24 : 36} className={classes.buttonProgress} />}
          </div>
        </div>
      )
    }
  }
  return (
    <div>
      <div
        style={{
          display: "flex",
          justifyContent: "center",
          margin: 20,
          padding: 20
        }}
      >
        <form style={isPcLayout() ? {width: "50%"} : {}}>
          {getTitle()}
          {getInput()}
          {getButtons()}
        </form>
      </div>
      <div
        style={{
          display: "flex",
          justifyContent: "center",
          margin: 20,
          padding: 20
        }}
      >
        <CartTable cart={props.cart} ref={childRef} readOnly="1"></CartTable>
      </div>
      <AlertDialog ref={dialogRef}></AlertDialog>
    </div>
  );
}
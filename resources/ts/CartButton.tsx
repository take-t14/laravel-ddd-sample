import React, { useState } from 'react'
import { makeStyles } from '@material-ui/core/styles';
import axios from 'axios'
import { Button } from '@material-ui/core'; //Buttonをインポート
import CircularProgress from '@material-ui/core/CircularProgress';
import { green } from '@material-ui/core/colors';
import clsx from 'clsx';

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
}));

type Props = {[key: string] : any}

const CartButton = (props:Props) => {
  const classes = useStyles();
  const [loading, setLoading] = useState(false);
  const [success, setSuccess] = React.useState(false);
  const buttonClassname = clsx({
    [classes.buttonSuccess]: success,
  });

  const addCart = async () => {
    if (loading) {
      return
    }
    setLoading(true)
    setSuccess(false)
    var params = new URLSearchParams();
    params.append('productId', props.productid);
    params.append('quantity', "1");
    try {
      let cartAddUrl = "/api/cart/add"
      let cartShowUrl = "/cart/show"
      if ("" != props.url_prefix) {
        cartAddUrl = "/api/" + props.url_prefix + "/cart/add"
        cartShowUrl = "/" + props.url_prefix + "/cart/show"
      }
      const data = await axios.post(cartAddUrl, params);
      window.location.href = cartShowUrl
      console.log(data)
    } catch (error) {
      console.log(error)
      setLoading(false)
      setSuccess(true)
    }
  }
  return (
    <div>
      <div className={classes.wrapper}>
        <Button onClick={addCart} variant="contained" color="primary" className={buttonClassname} disabled={loading}>
          カートに追加
        </Button>
        {loading && <CircularProgress size={24} className={classes.buttonProgress} />}
      </div>
    </div>
  )
}

export default CartButton
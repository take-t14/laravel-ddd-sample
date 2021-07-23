import React, { useState, useEffect, useRef } from "react";
import CartButton from './CartButton'
import { makeStyles } from '@material-ui/core/styles';

type Props = {[key: string] : any}

const useStyles = makeStyles((theme) => ({
  spanDisable: {
    pointerEvents: "none",
  },
}))

const Info = (props:Props) => {
  const classes = useStyles();
  const [activeColorName, setActiveColorName] = useState("");
  const [activeSizeName, setActiveSizseName] = useState("");
  const [sizes, setSizes] = useState<Array<any>>(Array<any>());
  const [loading, setLoading] = useState(false);
  const initSelectColor = useRef<HTMLDivElement>(null)
  useEffect(() => {
    setActiveColorName(props.colors[0].colorName.value)
    setActiveSizseName(props.sizes[0].sizeName.value)
    setSizesFunc(props.colors[0].colorName.value)
    setTimeout(() => {
      initSelectColor.current!.click()
    }, 0);

  }, [])
  function setSizesFunc(colorName:string) {
    let newSize = Array<any>()
    for (let pkey in props.products[colorName]) {
      for (let skey in props.sizes) {
        if (pkey == props.sizes[skey].sizeName.value) {
          newSize.push(props.sizes[skey])
          break
        }
      }
    }
    setSizes(newSize)
    setActiveSizseName(newSize[0].sizeName.value)

  }

  const shoeName = (
    <div className="shoeName">
      <div>
        <h1 className="big">{getProductName()}</h1>
        <span className="new">new</span>
      </div>
      {/* <h3 className="small">Men's running shoes</h3> */}
    </div>
  );

  /*
  const description = (
    <div className="description">
      <h3 className="title">Product Info</h3>
      <p className="text">
        Ensure a comfortable running session by wearing this pair of cool
        running shoes from Nike.
      </p>
    </div>
  );*/

  function getColorDataPrimary(colorId:number) {
    switch(colorId) {
      case 1: return "#f84848"
      case 2: return "#444"
      case 3: return "#29b864"
      case 4: return "#2175f5"
      case 5: return "#ff5521"
    }
  }
  function getColorActive(colorName:string) {
    if (activeColorName == colorName) {
      return " active"
    }
    return ""
  }
  function setColor(colorName:string) {
    setLoading(true)
    setActiveColorName(colorName)
    setSizesFunc(colorName)
    setTimeout(() => {
      setLoading(false)
    }, 1000);
  }
  const ColorContainer = (
    <div className="color-container">
      <h3 className="title">Color</h3>
      <div className="colors">
        {props.colors.map((color:any, index:number) => (
          <span
           key={index}
           ref={0 == index ? initSelectColor : null}
           className={"color" + getColorActive(color.colorName.value) + (loading ? " " + classes.spanDisable : "")}
           data-primary={getColorDataPrimary(color.colorId.value)}
           onClick={(event) => setColor(color.colorName.value)}
           color={color.colorName.value}></span>
        ))}
      </div>
    </div>
  );

  function getSizeActive(sizeName:string) {
    if (activeSizeName == sizeName) {
      return " active"
    }
    return ""
  }
  function setSize(sizeName:string) {
    setLoading(true)
    setActiveSizseName(sizeName)
    setTimeout(() => {
      setLoading(false)
    }, 1000);
  }

  const SizeContainer = (
    <div className="size-container">
      <h3 className="title">size</h3>
      <div className="sizes">
        {sizes.map((size:any, index:number) => (
          <span key={index} className={"size" + getSizeActive(size.sizeName.value) + (loading ? " " + classes.spanDisable : "")}
           onClick={(event) => setSize(size.sizeName.value)}>{size.sizeName.value}</span>
        ))}
      </div>
    </div>
  );

  function getProduct() {
    if ("" == activeColorName || "" == activeSizeName) {
      return null
    }
    if (!props.products[activeColorName] || !props.products[activeColorName][activeSizeName]) {
      return null
    }
    return props.products[activeColorName][activeSizeName]
  }
  function getProductId() {
    let product = getProduct()
    if (null == product) {
      return ""
    }
    return props.products[activeColorName][activeSizeName].productId.value
  }
  function getProductName() {
    let product = getProduct()
    if (null == product) {
      return ""
    }
    return props.products[activeColorName][activeSizeName].productName.value
  }
  function getPrice() {
    let product = getProduct()
    if (null == product) {
      return ""
    }
    return props.products[activeColorName][activeSizeName].priceTaxIn.value
  }
  const BuySection = (
    <div className="buy-price">
      <CartButton productid={getProductId()} productname={getProductName()} price={getPrice()} url_prefix={props.url_prefix}></CartButton>
      <div className="price">
        {/* <i className="fas fa-dollar-sign"></i> */}
        <h1>¥{getPrice().toLocaleString()}</h1>
        <span>（税込）</span>
      </div>
    </div>
  );

  return (
    <div className="info">
      {shoeName}
      {ColorContainer}
      {SizeContainer}
      {BuySection}
    </div>
  );
  /*
  return (
    <div className="info">
      {shoeName}
      {description}
      {ColorContainer}
      {SizeContainer}
      {BuySection}
    </div>
  );*/
};

export default Info;

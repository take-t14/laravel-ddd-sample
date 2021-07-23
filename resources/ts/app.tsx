import React from 'react'
import ReactDOM from 'react-dom'
import CartButton from './CartButton'
import CartTable from './CartTable'
import ProductList from './ProductList'
import ProductDetail from './ProductDetail'
import Comments from "./Comments";
import OrderForm from "./OrderForm";

function getProps(elementName:string) : {[key: string] : any} {
  const element:HTMLElement = document.getElementById(elementName)!
  var attrs = element.attributes;
  var props : {[key: string] : any} = {} 
  for (var i = 0, len = attrs.length; i < len; i++) {
    props[attrs[i].name] = attrs[i].value
  }
  return props
}

if (document.getElementById('cart-button')) {
  const element:HTMLElement = document.getElementById('cart-button')!
  ReactDOM.render(<CartButton {...getProps('cart-button')}/>, element)
}
if (document.getElementById('cart-table')) {
  const element:HTMLElement = document.getElementById('cart-table')!
  ReactDOM.render(<CartTable {...getProps('cart-table')}/>, element)
}
if (document.getElementById('product-list')) {
  const element:HTMLElement = document.getElementById('product-list')!
  ReactDOM.render(<ProductList {...getProps('product-list')}/>, element)
}
if (document.getElementById('product-detail')) {
  const element:HTMLElement = document.getElementById('product-detail')!
  ReactDOM.render(<ProductDetail {...getProps('product-detail')}/>, element)
}
if (document.getElementById('comments')) {
  const element:HTMLElement = document.getElementById('comments')!
  ReactDOM.render(<Comments {...getProps('comments')}/>, element)
}
if (document.getElementById('order-form')) {
  const element:HTMLElement = document.getElementById('order-form')!
  ReactDOM.render(<OrderForm {...getProps('order-form')}/>, element)
}

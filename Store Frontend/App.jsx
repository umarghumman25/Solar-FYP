import React from 'react';

import Home from './components/Home';
import Features from './components/features';
import Feature1 from './components/feature1';
import Feature2 from './components/feature2';
import About from './components/About';
import Feature3 from './components/feature3';
import Login from './components/login';
import Login1 from './components/login1';
import Signin from './components/signin';


import Feature4 from './components/feature4';
import {Route,Routes } from 'react-router-dom';

import React, { useState } from "react"
import "./App.css"
// import { BrowserRouter as Router, Switch, Route } from "react-router-dom"
// import Header from "./common/header/Header"
import Pages from "./pages/Pages"
import Data from "./components/Data"
import Cart from "./common/Cart/Cart"
// import Footer from "./common/footer/Footer"
import Sdata from "./components/shops/Sdata"



const App=()=>{
    const { productItems } = Data
  const { shopItems } = Sdata

  //Step 2 :
  const [CartItem, setCartItem] = useState([])

  //Step 4 :
  const addToCart = (product) => {
    // if hamro product alredy cart xa bhane  find garna help garxa
    const productExit = CartItem.find((item) => item.id === product.id)
    
    if (productExit) {
      setCartItem(CartItem.map((item) => (item.id === product.id ? { ...productExit, qty: productExit.qty + 1 } : item)))
    } else {
      
      setCartItem([...CartItem, { ...product, qty: 1 }])
    }
  }

  // Stpe: 6
  const decreaseQty = (product) => {
    // if hamro product alredy cart xa bhane  find garna help garxa
    const productExit = CartItem.find((item) => item.id === product.id)

   
    if (productExit.qty === 1) {
      setCartItem(CartItem.filter((item) => item.id !== product.id))
    } else {
      
      setCartItem(CartItem.map((item) => (item.id === product.id ? { ...productExit, qty: productExit.qty - 1 } : item)))
    }
  }
    return(
        <>
        
        
        
        
        
       
        <Routes>
        <Route  exact path="/" element={<Login/>}/>
        <Route  path="/Home" element={<Home/>}/>
        <Route  path="/CreateAccount" element={<Signin/>}/>
        <Route  exact path="/Login1" element={<Login1/>}/>
        <Route  path="/Services" element={<Features/>}/>
        <Route  path="/Feature1" element={<Feature1/>}/>
        <Route  path="/Feature2" element={<Feature2/>}/>
        <Route  path="/Feature3" element={<Feature3/>}/>
        <Route  path="/Feature4" element={<Feature4/>}/>
        <Route  path="/About" element={<About/>}/>
        <Route path='/' exact>
            <Pages productItems={productItems} addToCart={addToCart} shopItems={shopItems} />
          </Route>
          <Route path='/cart' exact>
            <Cart CartItem={CartItem} addToCart={addToCart} decreaseQty={decreaseQty} />
          </Route>
        </Routes>
        
        
        
        </>
    )

}
export default App;
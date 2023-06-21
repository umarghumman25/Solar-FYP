<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        cart::create([
            'quantity' => $request->quantity,
            'user_id' => $request->userid,
            'product_id' => $id,
        ]);

        return response()->json([
            'status' => 200,           
            'message' => 'Cart created In successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        $data = cart::get();
        //return view('Carts/cart',compact('data'));
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function increase_Quantity($id)
    {
        $data = cart::find($id);
        $cartdata['carts_user_id'] = 2;
        $cartdata['carts_product_id'] = $data->carts_product_id;
        $cartdata['product_name'] = $data->product_name;
        $cartdata['product_price'] = $data->product_price;
        if ($data->product_quantity == 50) {
            return redirect(url('cart-index'));
        } else {
            $cartdata['product_quantity'] = $data->product_quantity + 1;
        }
        $cartdata['image'] = $data->image;
        $cartdata = cart::where('id', $id)->update($cartdata);
        return redirect(url('cart-index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function decrease_Quantity($id)
    {
        $data = cart::find($id);
        $cartdata['carts_user_id'] = 2;
        $cartdata['carts_product_id'] = $data->carts_product_id;
        $cartdata['product_name'] = $data->product_name;
        $cartdata['product_price'] = $data->product_price;
        if ($data->product_quantity == 1) {
            return redirect(url('delteitem', compact('id')));
        } else {
            $cartdata['product_quantity'] = $data->product_quantity - 1;
        }
        $cartdata['image'] = $data->image;
        $cartdata = cart::where('id', $id)->update($cartdata);
        return redirect(url('cart-index'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartitem = cart::find($id);
        $cartitem->delete();
        return redirect(url('cart-index'))->with('message', 'product deleted');
    }
    public function clear()
    {
        $cartitem = cart::truncate();
        return redirect(url('cart-index'))->with('message', 'product deleted');
    }
}

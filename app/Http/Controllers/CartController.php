<?php

namespace App\Http\Controllers;

use Cart;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('cart.index');  
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      
        $duplicate = Cart::search(function($cartItem, $rowId) use ($request){
             return $cartItem->id == $request->product_id;
        }); 
        
        if($duplicate->isNotEmpty())
        {
            return response()->json('duplicated');
        }

        $product = Product::find($request->product_id);
        
        $cartItem = Cart::add($product->id, $product->title, $request->qty, $product->price);
        $cartItem->associate('App\Product');
             
        return response()->json('added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
         $order = new Order();
         $order->amount = Cart::total();
         $order->user_id = Auth::id();

         $products = [];
         $i = 0;

         foreach (Cart::content() as $product)
         {
            $products['product_' . $i][] = $product->model->title;
            $products['product_' . $i][] = $product->model->price;
            $products['product_' . $i][] = $product->qty;
            $i++;

            Product::where('title',$product->model->title)->decrement('stock',$product->qty); 
         }

         $order->products = serialize($products);
         $order->save();

         Cart::destroy();

         return redirect()->back()->with('success','Votre commande a été validée avec succès');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        
        return response()->json('deleted');
    }


    /**
     * Destroy cart.
     * 
     * 
     */
    public function emptyCart()
    {
        Cart::destroy();
        dd(1);
    }
}

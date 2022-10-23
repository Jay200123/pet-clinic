<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Pet;
use Session;
use DB;
use App\Cart;
use App\Models\Order;
use App\Models\Customer;

class CartController extends Controller
{
    public function index(){

        $serv = Service::all();
        return view('shop.index', compact('serv'));

    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $pet = Pet::pluck('pet_name', 'id');

        // dd($oldCart);
        return view('shop.shopping-cart', compact('pet'),['service' => $cart->service, 'totalPrice' => $cart->totalPrice]);
    }

    public function getAddToCart(Request $request , $id){
        
        $service = Service::find($id);
        $oldCart = Session::has('cart') ? $request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($service, $service->id);
        Session::put('cart', $cart);
        Session::save();
        return redirect()->route('shops.index');

    }

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->service) > 0) {
            Session::put('cart',$cart);
            Session::save();
        }else{
            Session::forget('cart');
        }        
        return redirect()->route('shop.shoppingCart');
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->service) > 0) {
            Session::put('cart',$cart);
            Session::save();
        }else{
            Session::forget('cart');
        }
         return redirect()->route('shop.shoppingCart');
    }

    public function postCheckout(Request $request){

        if (!Session::has('cart')) {
        return redirect()->route('shop.shoppingCart');
         }
                    
         $oldCart = Session::get('cart');
         $cart = new Cart($oldCart);

         try{
            DB::beginTransaction();
            
            $order = new Order;
            $customer = Customer::where('user_id', Auth::id())->first();

            $order->customer_id = $customer->id;
            $order->pet_id = $request->pet_id;
            $order->date_placed = now();
            $order->status = 'Processing';

            $order->save();

            foreach($cart->service as $service){
                
                $id  = $service['service']['service_id'];
                
                DB::table('orderline')->insert(
                     ['service_id' => $id, 
                     'orderinfo_id' => $order->id,
                    ]);
            }

         }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('shop.shopping-cart')->with('error', $e->getMessage());
    }
         DB::commit();
         Session::forget('cart');
         return redirect()->route('shops.index')->with('success','Services Successfully Avail!!!');
}

}

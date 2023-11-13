<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(3);
        return view('home.userpage', compact('products'));
    }
    public function redirect()
    {

        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {

            return view('admin.home');
        } else {
            $products = Product::paginate(3);
            return view('home.userpage', compact('products'));
        }
    }
    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }
    public function add_cart(Request $request, $id)
    {

        if (Auth::id()) {

            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart();

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;

            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if (Auth::id()) {

            $carts = Cart::where('user_id', Auth::user()->id)->get();
            $totalprice = 0;
            foreach ($carts as $cart) {
                $totalprice += $cart->price;
            }
            return view('home.showcart', compact('carts', 'totalprice'));
        } else {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        $userid = Auth::user()->id;
        $data = Cart::where('user_id', $userid)->get();
        foreach ($data as $data) {

            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'cash on delevery';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back();
    }
    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * $totalprice,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        $userid = Auth::user()->id;
        $data = Cart::where('user_id', $userid)->get();
        foreach ($data as $data) {

            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'payed';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }


        Session::flash('success', 'Payment successful!');
        return back();




    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Stripe;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::paginate(6);

        return view('home.userpage', compact('products'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            return view('admin.home');
        } else {
            return view('home.userpage');
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
            // dd(Auth::id());
            // return redirect()->back();
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->Product_title = $product->title;

            if ($product->discount_price != null) {
                $cart->price = $product->price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->Product_id = $product->id;
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
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();

            return view('home.showcart', compact('cart'));
        } else {
            return view('login');
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

        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', '=', $user_id)->get();
        foreach ($data as  $data) {
            $Order = new Order();
            $Order->name = $data->name;
            $Order->email = $data->email;
            $Order->phone = $data->phone;
            $Order->address = $data->address;
            $Order->user_id = $data->user_id;
            $Order->product_title = $data->product_title;
            $Order->price = $data->price;
            $Order->quantity = $data->quantity;
            $Order->image = $data->image;
            $Order->product_id = $data->product_id;
            $Order->payment_status = 'cash on delievery';
            $Order->delivery_status = 'processing';
            $Order->save();
            //after saving it to orders table we need to delete it from Cart table.
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We have received your Order.We will contact
         with you soon');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }
    public function stripePost(Request $request,$totalprice)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(

            "address" => [

                "line1" => "Waleed Saddique",

                "postal_code" => "11100",

                "city" => "Kotli",

                "state" => "AJK",

                "country" => "PAK",

            ],

            "email" => "engr.waleed.saddique.developer@gmail.com",

            "name" => "Waleed Saddique",

            "source" => $request->stripeToken

        ));



        Stripe\Charge::create([

            "amount" => $totalprice * 100,

            "currency" => "usd",

            "customer" => $customer->id,

            "description" => "Thank you for payment. This is for test payment.",

            "shipping" => [

                "name" => "Waleed Saddique",

                "address" => [

                    "line1" => "Palhather Kotli Azad Kashmir",

                    "postal_code" => "11100",

                    "city" => "Kotli Azad Kashmir",

                    "state" => "Kashmir",

                    "country" => "PAK",

                ],

            ]

        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', '=', $user_id)->get();
        foreach ($data as  $data) {
            $Order = new Order();
            $Order->name = $data->name;
            $Order->email = $data->email;
            $Order->phone = $data->phone;
            $Order->address = $data->address;
            $Order->user_id = $data->user_id;
            $Order->product_title = $data->product_title;
            $Order->price = $data->price;
            $Order->quantity = $data->quantity;
            $Order->image = $data->image;
            $Order->product_id = $data->product_id;
            $Order->payment_status = 'Paid';
            $Order->delivery_status = 'processing';
            $Order->save();
            //after saving it to orders table we need to delete it from Cart table.
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();

        }
        Session::flash('success', 'Payment successful!');

        return back();
    }
}

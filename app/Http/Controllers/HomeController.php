<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;

use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(6);
        return view('home.userpage',compact('product'));
    }
    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if($usertype==1)
        {
            $total_product=Product::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();
            $order=order::all();
            $total_revenue=0;

            foreach($order as $order)
            {
                 $total_revenue=$total_revenue + $order->price;
            }

            $total_delivered=order::where('delivery_status','=','delivered')->get()->count();

            $total_progressing=order::where('delivery_status','=','progressing')->get()->count();
          
            



            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_progressing'));
        }
        else
        {
            $product=Product::paginate(6);
            return view('home.userpage',compact('product'));
        }
    }
    public function product_details($id)
    {
        $product=Product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function products()
    {
        $product=Product::paginate(6);
        $category=Category::all();
        return view('home.products',compact('product','category'));
    }
    public function add_to_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $product=Product::find($id);
            $cart=new Cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->adress=$user->address;
            $cart->user_id=$user->id;
            $cart->product_title=$product->title;
            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price * $request->quentity;
            }
            else
            {
                $cart->price=$product->price * $request->quentity;
            }
            
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            $cart->quentity=$request->quentity;

            $cart->save();

            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=Cart::where('user_id','=',$id)->get();
            return view('home.show_cart',compact('cart'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function remove_card($id)
    {
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('delete','delete successfully');

    }
    public function cash_order()
    {
        $user=Auth::user();

        $userid=$user->id;
        
        $cartdata=Cart::where('user_id','=',$userid)->get();

        
        foreach($cartdata as $data)
        {
            // dd($data->name);
            $order=new Order;

            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->adress=$data->adress;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->quentity=$data->quentity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_id=$data->product_id;

            $order->payment_status='cash on delivery';

            $order->delivery_status='progressing';

            $order->save();

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back();
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "thanks for payment" 
        ]);

        $user=Auth::user();

        $userid=$user->id;
        
        $data=Cart::where('user_id','=',$userid)->get();

        
        foreach($data as $data)
        {
            // dd($data->name);
            $order=new Order;

            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->adress=$data->adress;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->quentity=$data->quentity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_id=$data->product_id;

            $order->payment_status='Paid';

            $order->delivery_status='progressing';

            $order->save();

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }
    
        Session::flash('success', 'Payment successful!');
            
        return redirect()->back();
    }
    public function contact()
    {
        return view('home.contact');
    }

    public function categorys()
    {
        $product=Product::paginate(6);
        $category=Category::all();
        return view('home.categories',compact('product','category'));
    }

    public function products_category($name)
    {
        $product=Product::where('category','=',$name)->paginate(6);
        $category=Category::all();
        return view('home.categories',compact('product','category'));
    }
}

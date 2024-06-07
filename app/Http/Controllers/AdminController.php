<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;

class AdminController extends Controller
{

    public function view_category()
    {
        $data=Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request)
    {
        $data = new category;

        $data->category_name=$request->category;

        $data->save();

        return redirect()->back()->with('message','category add successfully');
    }
    public function delete_category($id)
    {
        $data=Category::find($id);

        $data->delete();

        return redirect()->back()->with('delete','delete successfully');

    }





    public function view_product()
    {
        $Category=Category::all();
        return view('admin.product',compact('Category'));
    }
    

    public function add_product(Request $request)
    {
        $product = new Product;

        $product->title=$request->title;
        $product->description=$request->descreption;
        $product->price=$request->price;
        $product->discount_price=$request->dis_price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;

        // image
        $image=$request->image;
        // $request->file('image')->getClientOriginalExtension();
        $imagename=time().'.'.$image->getClientOriginalExtension();
        // $imagename=time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->image->move('product',$imagename);

        $product->image=$imagename;

        // end image
        $product->save();
        return redirect()->back()->with('message','Product add successfully');
    }




    public function show_product()
    {
        $product=product::all();
        return view('admin.show_product',compact('product'));
    }

    


    public function delete_product($id)
    {
        $data=Product::find($id);

        $data->delete();

        return redirect()->back()->with('delete','delete successfully');

    }
    


    public function updat_product($id)
    {
        $product=Product::find($id);
        $category=category::all();
        return view('admin.updat_product',compact('product','category'));
    }

    
    




    public function update_product_confirm(Request $request,$id)
    {
        $product=product::find($id);

        $product->title=$request->title;
        $product->description=$request->descreption;
        $product->price=$request->price;
        $product->discount_price=$request->dis_price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;



        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }

        




        $product->save();
        return redirect()->back()->with('message','Product Edit successfully');
        
    }
    


    public function order()
    {
        $order=order::all();
        return view('admin.order',compact('order'));
    }

    
    public function delete_order($id)
    {
        $data=Order::find($id);

        $data->delete();

        return redirect()->back()->with('delete','delete successfully');

    }

    public function delivered($id)
    { 
        $order=order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status='Paid';
        $order->save();
        return redirect()->back();
    }
    public function print_pdf($id)
    {
        $order=order::find($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }
    

}

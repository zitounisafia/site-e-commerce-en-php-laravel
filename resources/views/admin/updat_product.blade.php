<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('admin.css')
    <style>
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }
        .font_size
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color
        {
            color: black;
            padding-bottom: 10px;
        }
        label
        {
            display:inline-block;
            width: 200px;
        }
        .div_design
        {
            padding-bottom: 15px;
        }
        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

        img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>
</head>
<body>
    <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial --> <!-- partial:partials/_navbar.html -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="div_center">

                @if (session()->has('message'))

            <div class="alert alert-success">
                <div type="button" class="close" data-dismiss="alert" aria-hidden="true">x</div>
                {{session()->get('message')}}
            </div>

            @endif


                <h1 class="font_size">Update Product</h1>

                <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}


                <div class="div_design">
                    <label for="">Product Title : </label>
                <input class="text_color" type="text" name="title" placeholder="Write a title" required value="{{$product->title}}">
                </div>
                <div class="div_design">
                    <label for="">Product Description : </label>
                <input class="text_color" type="text" name="descreption" placeholder="Write a description" required value="{{$product->description}}">
                </div>
                <div class="div_design">
                    <label for="">Product Price : </label>
                <input class="text_color" type="number" name="price" placeholder="Write a Price" required value="{{$product->price}}">
                </div>
                <div class="div_design">
                    <label for="">Discount Price : </label>
                <input class="text_color" type="number" name="dis_price" placeholder="Write a discount price is applay " value="{{$product->discount_price}}">
                </div>
                <div class="div_design">
                    <label for="">Product Quantity : </label>
                <input class="text_color" type="number" name="quantity" min="0" placeholder="Write a Quantity"  value="{{$product->quantity}}">
                </div>




                <div class="div_design">
                    <label for="">Product Category : </label>
                <select class="text_color" name="category" required> 
                    <option value="{{$product->category}}" selected>{{$product->category}}</option>

                    @foreach ($category as $category)
                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                    @endforeach
                    
                </select>
                </div>
                <div class="div_design">
                    <label for="">Current Product Image Here : </label>
                    <a href="">
                        <img src="/product/{{$product->image}}" alt="">
                    </a>
                    
                </div>




                <div class="div_design">
                    <label for="">Change Product Image Here : </label>
                <input type="file" name="image">
                </div>



                <div class="div_design">
                <input type="submit" name="submit"  value="Updat Product" class="btn btn-primary">
                </div>
            </form>





            </div>

        </div>
    </div>



    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>
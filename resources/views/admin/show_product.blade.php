<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        .center
        {
            /* margin: auto;
            width: 50%;
            border: 2px solid white;
            text-align: center; */
            margin-top: 40px;
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        .center td, .center th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .center tr:hover {background-color: #343a40;}

        .center th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #01161e;
            color: white;
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

        .font_size
        {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
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
            @if (session()->has('delete'))

            <div class="alert alert-success">
                <div type="button" class="close" data-dismiss="alert" aria-hidden="true">x</div>
                {{session()->get('delete')}}
            </div>
            @endif
            <h2 class="font_size">All Products</h2>
            <table class="center">
                <tr>
                    <th>Product Title</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Product Image</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                @foreach ($product as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount_price}}</td>
                    <td>
                        <a>
                            <img src="/product/{{$product->image}}" >
                        </a>
                        {{-- <img src="/product/{{$product->image}}" > --}}
                    </td>
                    <td>
                        <a onclick="return confirm('are you sure to delete this product ')" class="btn btn-danger" 
                        href="{{url('delete_product',$product->id)}}">Delete</a>
                    </td>
                    <td>
                        <a class="btn btn-success" 
                        href="{{url('updat_product',$product->id)}}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>












        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>
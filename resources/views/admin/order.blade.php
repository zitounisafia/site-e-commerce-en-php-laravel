<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style type="text/css">

        h2{
            text-align: center;
        }
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
            <div class="div_center">
                <h2 class="title_deg">All Orders</h2>
                

                <table  class="center">

                    <tr class="th_deg">

                        <th style="padding: 10px;">Name</th>
                        <th style="padding: 10px;">Email</th>
                        <th style="padding: 10px;">Address</th>
                        <th style="padding: 10px;">Phone</th>
                        <th style="padding: 10px;">Product Title</th>
                        <th style="padding: 10px;">Quantity</th>
                        <th style="padding: 10px;">Price</th>
                        <th style="padding: 10px;">Payment Status</th>
                        <th style="padding: 10px;">Delivery Status</th>
                        <th style="padding: 10px;">Image</th>
                        <th style="padding: 10px;">Delivered</th>
                        <th style="padding: 10px;">Print PDF</th>
                        <th style="padding: 10px;">Delete</th>
                        
                        
                    </tr>

                    @foreach ($order as $order)
                        
                    

                    <tr>

                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->adress}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quentity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$order->image}}" alt="">
                        </td>

                        <td>
                            
                            @if ($order->delivery_status=='progressing')
                                
                                
                            


                            <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure this product is delivered !!!')" class="btn btn-primary">Delivered</a>

                            @else

                            <p style="color: green;">Delivered</p>
                        
                            @endif

                        </td>

                        <td>
                            <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print PDF</a>
                        </td>
                        <td>
                            <a onclick="return confirm('are you sure to delete this order ')" class="btn btn-danger" 
                            href="{{url('delete_order',$order->id)}}">Delete</a>
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
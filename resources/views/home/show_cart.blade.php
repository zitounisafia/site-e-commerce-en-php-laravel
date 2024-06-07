<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut Icon" type="image/png" href="Home/images/logooo.png">
      <title>kolchistore</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="Home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="Home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="Home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="Home/css/responsive.css" rel="stylesheet" />
      
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

      .im {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 100px;
      }

      .im:hover {
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
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header');
         <!-- end header section -->
         <div class="container">
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
                  <th>Product Image</th>
                  <th>Product Title</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Action</th>
               </tr>
               <?php $totalprice=0; ?>
               @foreach ($cart as $cart)
                  <tr>
                     <td>
                        <a>
                           <img class="im" src="product/{{$cart->image}}" >
                        </a>
                     </td>
                     <td>{{$cart->product_title}}</td>
                     <td>{{$cart->quentity}}</td>
                     <td>{{$cart->price}}</td>
                     {{-- <td>
                           <a onclick="return confirm('are you sure to delete this')" class="btn btn-danger" 
                           href="{{ url('/remove_card',$cart->id) }}">Delete</a>
                     </td> --}}
                     <td>
                        {{-- <form action="{{url('/remove_card',$cart->id)}}" method="post">
                           {{ csrf_field() }}
                        <input type="button" onclick="return confirm('are you sure to delete this product ')" 
                        class="btn btn-danger" value="Delete">
                     </form> --}}
                        <a onclick="return confirm('are you sure to delete this product ')" class="btn btn-danger"
                        href="{{url('remove_card',$cart->id)}}">Delete</a>
                     </td>
                  </tr>
                  <?php $totalprice=$totalprice + $cart->price ?>
               @endforeach
            </table>
            <div class="total">
               <h1>Total Price : {{ $totalprice }}$</h1>
            </div>
            <div class="total">
               <h2>Payment method</h2>
               <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash on delevry </a>
               <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">pay using card</a>
            </div>
      </div>
   </div>
   </div>
</div>







      <!-- footer start -->
      @include('home.footer');
      <!-- footer end -->
      
      <!-- jQery -->
      <script src="Home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="Home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="Home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="Home/js/custom.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>
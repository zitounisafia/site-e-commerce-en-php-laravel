<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }
        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input_color
        {
            color: black;
        }
        .center
        {
            
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
            @if (session()->has('message'))

            <div class="alert alert-success">
                <div type="button" class="close" data-dismiss="alert" aria-hidden="true">x</div>
                {{session()->get('message')}}
            </div>

            @endif
            @if (session()->has('delete'))

            <div class="alert alert-success">
                <div type="button" class="close" data-dismiss="alert" aria-hidden="true">x</div>
                {{session()->get('delete')}}
            </div>

            @endif

            <div class="div_center">
                <h2 class="h2_font">Add category</h2>
                <form action="{{url('/add_category')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="text" class="input_color" name="category" placeholder="category name">
                    <input type="submit" name="submit" class="btn btn-primary" placeholder="Add category">
                </form>
            </div>
            <br>
            <table class="center">
                <tr>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                @foreach ($data as $data)
                    <tr>
                        <td>{{ $data->category_name }}</td>
                        <td>
                            <a onclick="return confirm('are you sure to delete this category ')" class="btn btn-danger" href="{{ url('delete_category',$data->id) }}">Delete</a>
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
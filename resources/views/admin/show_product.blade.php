<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.style');
    <style>


        .font_size {
            font-size: 40px;
            padding-top: 20px;
            text-align: center;
        }



        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 40px;
            border: 2px solid white;
        }
        .img_size{
            width: 100px;
            height: 100px;
        }
        .th_color{
            background: skyblue;
        }
        .th_deg{
           padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar');
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header');
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <h2 class="font_size">All Product</h2>
                 <table class="center">
                    <tr class="th_color">
                        <th class="th_deg"> Title</th>
                        <th class="th_deg">Describtion</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Category</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">DisPrice</th>
                        <th class="th_deg"> Image</th>
                        <th class="th_deg"> Delete</th>
                        <th class="th_deg"> Edit</th>
                    </tr>
                    @foreach ($products as $product)


                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->price }}</th>
                        <td>{{ $product->discount_price }}</td>
                        <td>
                            <img class="img_size" src="/product/{{ $product->image }}" alt="">
                        </td>
                        <td>
                            <a href="{{ url('/delete_product' , $product->id ) }}" class="btn btn-danger">Delete</a>
                        </td>
                        <td>
                            <a href="{{ url('/update_product' , $product->id ) }}" class="btn btn-success">Edit</a>
                        </td>

                    </tr>
                    @endforeach
                 </table>

                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
</body>

</html>

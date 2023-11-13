<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.style');
    <style>
        .font_size {
            font-size: 25px;
            font-weight: bold;
            padding-top: 20px;
            text-align: center;
        }



        .center {
            margin: auto;
            width: 100%;
            text-align: center;
            margin-top: 40px;
            border: 2px solid white;
        }

        .img_size {
            width: 100px;
            height: 100px;
        }

        .th_color {
            background: skyblue;
        }

        .th_deg {
            padding: 2px;
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
                    <h2 class="font_size">All Order</h2>
                    <table class="center">
                        <tr class="th_color">
                            <th class="th_deg"> Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Address</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">Product Title</th>
                            <th class="th_deg">Quantity</th>
                            <th class="th_deg"> Price</th>
                            <th class="th_deg">Payment Status</th>
                            <th class="th_deg"> Delivary Status</th>
                            <th class="th_deg"> Image</th>
                            <th class="th_deg"> Delivared</th>
                            <th class="th_deg"> Print PDF</th>

                        </tr>
                        @foreach ($orderes as $order)
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_title }}</th>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td>
                                    <img class="img_size" src="/product/{{ $order->image }}" alt="">
                                </td>
                                <td>
                                    @if ($order->delivery_status == 'processing')
                                        <a href="{{ url('/delivared', $order->id) }}"
                                            class="btn btn-primary">Delivered</a>
                                    @else
                                        <p>Delivard</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/print_pdf', $order->id) }}" class="btn btn-secondary">Print PDF</a>
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

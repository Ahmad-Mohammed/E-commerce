<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="/public">
    @include('admin.style');
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color {
            color: black;
            padding-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 15px;
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
                    <div class="div_center">
                        <h1 class="font_size">Update Product</h1>
                        <form action="{{ url('/update_product_confirm' , $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label for="">Prodact Title </label>
                                <input type="text" required class="text_color" name="title"
                                    placeholder="Write a title" value="{{ $product->title }}">
                            </div>
                            <div class="div_design">
                                <label for="">Prodact Describtion </label>
                                <input type="text" required class="text_color" name="describtion"
                                    placeholder="Write a Describtion" value="{{ $product->description }}">
                            </div>
                            <div class="div_design">
                                <label for="">Prodact Price </label>
                                <input type="number" required class="text_color" name="price"
                                    placeholder="Write a Price" value="{{ $product->price }}">
                            </div>
                            <div class="div_design">
                                <label for="">Discount Price </label>
                                <input type="number" required class="text_color" name="dis_price"
                                    placeholder="Write a Discount" value="{{ $product->discount_price }}">
                            </div>
                            <div class="div_design">
                                <label for="">Prodact Quantity </label>
                                <input type="number" required class="text_color" min="0" name="quantity"
                                    placeholder="Write a Quantity" value="{{ $product->quantity }}">
                            </div>
                            <div class="div_design">
                                <label for="">Prodact Category </label>
                                <select name="category" class="text_color" required>
                                    <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="div_design">
                                <label for="">Current Prodact Image </label>
                                <img src="/product/{{ $product->image }}" height="100" width="100" style="margin: auto">
                            </div>
                            <div class="div_design">
                                <label for="">Prodact Image </label>
                                <input type="file"  name="image">
                            </div>
                            <div class="div_design">

                                <input type="submit" value="Update Product" class="btn btn-primary">
                            </div>
                        </form>
                    </div>

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

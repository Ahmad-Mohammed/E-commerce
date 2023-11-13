<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }
    public function add_category(Request $request)
    {

        Category::create([
            'category_name'=> $request->category
        ]);
        return redirect()->back()->with('message', 'Category Added Successfuly ');
    }
    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfuly ');
    }
    public function view_product()
    {
        $categories = Category::all();
        return view('admin.product', ['categories' => $categories]);
    }
    public function add_product(Request $request)
    {

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->describtion;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;

        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);

        $product->image = $imagename;

        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfuly ');
    }
    public function show_product()
    {
        $products = Product::all();
        return view('admin.show_product', compact('products'));
    }
    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfuly ');
    }
    public function update_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.update_product', compact('product', 'categories'));
    }
    public function update_product_confirm(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->describtion;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);

            $product->image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfuly ');
    }
    public function order()
    {
        $orderes = Order::all();
        return view('admin.order', compact('orderes'));
    }
    public function delivared($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'Delivared';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back();
    }
    public function print_pdf($id)
    {
        $order = Order::find($id);
        // $pdf = PDF::loadview('admin.pdf', compact('order'));
        // return $pdf->download('order_detals.pdf');
    }
}

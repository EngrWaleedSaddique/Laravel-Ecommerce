<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();

        return view('admin.category', compact('categories'));
    }
    public function add_category(Request $request)
    {

        $this->validate($request, array(
            'category' => 'required'
        ));

        $data = new Category();
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
    public function view_product()
    {
    }
    public function add_product()
    {
        $categories = Category::all();
        return view('admin.product', compact('categories'));
    }
    public function save_product(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;

        //code to save the image from form
        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        //code ends here to save the image in the form
        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
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
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }
    public function update_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.update_product', compact('product', 'categories'));
    }
    public function update_product_save(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }
}

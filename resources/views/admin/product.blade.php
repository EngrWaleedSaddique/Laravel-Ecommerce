@extends('admin-main')
@section('stylesheet')
<style type="text/css">
    .div_center{
        text-align:center;
        padding-top:40px;
    }
    .h2_font{
        font-size:40px;
        padding-top:40px;
    }
    .input_color
    {
        color:black;
    }
    .center{
      margin: auto;
      width: 50%;
      text-align: center;
      color:white;
      margin-top: 20px;
      border:3px solid white;
    }
    label{
        display: inline-block;
        width:200px;
    }
    select{
        display: inline-block;
        width:200px;
    }
    .div-design{
        padding-bottom: 15px;
    }
</style>
@endsection

@section('body')
<div class="main-panel">
    <div class="content-wrapper">
      @if(session()->has('message'))

      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="ture">X</button>

        {{ session()->get('message') }}

      </div>
      @endif
        <div class="div_center">
            <h2 class="h2_font">Add Product</h2>
            <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="div-design">
                    <label for="product">Product Title</label>
                    <input type="text" class="input_color" name="title" placeholder="Write a Title" required="">
                </div>
                <div class="div-design">
                    <label for="product">Product Description</label>
                    <input type="text" class="input_color" name="description" placeholder="Write a Description" required="">
                </div>
                <div class="div-design">
                    <label for="product">Product Price</label>
                    <input type="number" min="0" class="input_color" name="price" placeholder="Write a Price" required="">
                </div>
                <div class="div-design">
                    <label for="product">Discount Price</label>
                    <input type="text" class="input_color" name="discount_price" placeholder="Write a Discount Price" required="">
                </div>
                <div class="div-design">
                    <label for="product">Product Quantity</label>
                    <input type="text" class="input_color" name="quantity" placeholder="Write Quantity" required="">
                </div>
                <div class="div-design">
                    <label for="product">Product Category</label>
                    <select class="input_color" name="category" id="" required="">
                        <option value="" selected>Select Category</option>
                        @foreach($categories as $category)
                            <option>{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="div-design">
                    <label for="product">Product Image</label>
                    <input type="file" name="image" required="">
                </div>
                <div>
                <input type="submit" class="btn btn-primary" name="submit" value="Add product">
            </form>
        </div>
    </div>
</div>
@endsection

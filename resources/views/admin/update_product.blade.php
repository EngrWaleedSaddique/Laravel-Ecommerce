<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('partials._css')
    
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


  </head>
  <body>
    <div class="container-scroller">
      {{-- side bar codes start from here --}}
        @include('partials._sidebar')
      {{-- side bar codes ends here --}}

      {{-- header nav codes start from here --}}
       @include('partials._header')
      {{-- header nav code ends here --}}

      {{-- body codes start from here --}}
      
      <div class="main-panel">
            <div class="content-wrapper">
              @if(session()->has('message'))

              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="ture">X</button>

                {{ session()->get('message') }}

              </div>
              @endif
                <div class="div_center">
                    <h2 class="h2_font">Update Product</h2>
                    <form action="{{url('update_product/'.$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="div-design">
                            <label for="product">Product Title</label>
                            <input type="text" class="input_color" name="title" value="{{$product->title}}" placeholder="Write a Title" required="">
                        </div>
                        <div class="div-design">
                            <label for="product">Product Description</label>
                            <input type="text" class="input_color" name="description" value="{{$product->description}}" placeholder="Write a Description" required="">
                        </div>
                        <div class="div-design">
                            <label for="product">Product Price</label>
                            <input type="number" min="0" class="input_color" name="price" value="{{$product->price}}" placeholder="Write a Price" required="">
                        </div>
                        <div class="div-design">
                            <label for="product">Discount Price</label>
                            <input type="text" class="input_color" name="discount_price" value="{{$product->discount_price}}" placeholder="Write a Discount Price" required="">
                        </div>
                        <div class="div-design">
                            <label for="product">Product Quantity</label>
                            <input type="text" class="input_color" name="quantity" value="{{$product->quantity}}" placeholder="Write Quantity" required="">
                        </div>
                        <div class="div-design">
                            <label for="product">Product Category</label>
                            <select class="input_color" name="category" id="" required="">
                                <option value="{{$product->id}}" selected>{{$product->category}}</option>
                                    @foreach($categories as $category)
                                    <option>{{$category->category_name}}</option>
                                    @endforeach
                                
                            </select>
                        </div>

                        <div class="div-design">
                            <label for="product">Current Product Image</label>
                            <img style="margin:auto;" src="/product/{{$product->image}}" height="100" width="100" alt="">
                        </div>

                        <div class="div-design">
                            <label for="product">Change Product Image</label>
                            <input type="file" name="image">
                        </div>
                        <div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Update Product">
                    </form>
                </div>
            </div>
        </div>

        
        
      {{-- body codes ends here --}}
        
          <!-- partial:partials/_footer.html -->
          {{-- @include('admin.footer') --}}
          <!-- partial -->
    <!-- container-scroller -->
    @include('partials._script')
    
  </body>
</html>
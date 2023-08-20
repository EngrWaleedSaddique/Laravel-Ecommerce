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
                    <h2 class="h2_font">Add Category</h2>
                    <form action="{{url('/add_category')}}" method="post">
                        @csrf
                        <input type="text" class="input_color" name="category" placeholder="Write Category Name">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                    </form>
                </div>
                <table class="center"> 
                  <tr>
                    <td>Category Name</td>
                    <td>Action</td>
                  </tr>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->category_name}}</td>
                    <td><a class="btn btn-danger" onclick="return confirm('Are you sure to delete this record.')" href="{{url('delete_category',$category->id)}}">Delete</a></td>

                  </tr>
                  @endforeach
                  
                </table>
            </div>
        </div>
@endsection
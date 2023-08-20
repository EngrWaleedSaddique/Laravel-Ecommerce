@extends('admin-main')
@section('stylesheet')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-top: 40px;
        }

        .input_color {
            color: black;
        }

        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            color: white;
            margin-top: 20px;
            border: 3px solid white;
        }

        .img-size {
            width: 70px;
            height: 70px;
        }
    </style>
@endsection
@section('body')
    <div class="main-panel">
        <div class="content-wrapper">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="ture">X</button>

                    {{ session()->get('message') }}

                </div>
            @endif
            <table class="center">
                <tr>
                    <td>Product Title</td>
                    <td>Description</td>
                    <td>Quantity</td>
                    <td>Category</td>
                    <td>Price</td>
                    <td>Discount Price</td>
                    <td>Product Image</td>
                    <td>Delete</td>
                    <td>Edit</td>

                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td><img class="img-size" src="/product/{{ $product->image }}" alt=""></td>
                        <td><a class="btn btn-danger" onclick="return confirm('Are you sure to delete a product.')"
                                href="{{ url('delete_product', $product->id) }}">Delete</a></td>
                        <td><a class="btn btn-success" href="{{ url('update_product', $product->id) }}">Edit</a></td>

                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection

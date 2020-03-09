@extends('layouts.layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">


          <form action="{{ route('admin-filter-products') }}"method="POST" enctype="multipart/form-data" class="col-lg-6" class="pb-5">
            <label for="category">Filter</label>
            <select id="category" name="category">

                @foreach ($categories as $category )
                    <option name="category" value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                @endforeach

            </select>
            @method("POST")
            @csrf
            <div class="input-group ">
                <button type="submit" class="btn btn-outline-primary btn-xs">Filter</button>
            </div>
        </form>

        <div class="box-header" data-original-title>
            <h2 class="text-center"><i class="halflings-icon user"></i><span class="break"></span>All Products</h2>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Available QYY</th>
                    <th>Status</th>
                    <th>SubCategory Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>View Details</th>
                    <th>Approval</th>
                    <th>Delete</th>
                  </tr>
              </thead>
              <?php $i=1;?>
                @foreach($products as $product)
                  <tbody>
                    <tr>
                        <td ><?php echo $i; $i=$i+1;?></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->available_quantity }}</td>
                        <td >{{$product->status}}</td>


                        @foreach ($categories as $category)
                            @if($product->subcategory->category_id == $category->id )
                                <td >{{$category->category_name}}</td>
                            @endif
                        @endforeach


                        <td >
                            @if(empty($product->category_image))
                            <img src="{{url('images/products/defualt.png')}}"class="make_bigger" width="100px" height="100px">
                        @else
                            <img src="{{ url('images/products/'.$product->image) }}"width="100px" height="100px">
                        @endif
                        </td>
                        <td >{{$product->price}}</td>
                        <td>
                            <a href ="{{route('admin-view-product_details',$product->product_id)}}"><i class="fa fa-eye fa-5x" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <form action="#" method="POST">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm">Approve</button>
                            </form>
                            @if($errors->any())
                            <h4>{{$errors->first()}}</h4>
                            @endif
                        </td>
                        <td>
                            <form action="#" method="POST">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                            @if($errors->any())
                            <h4>{{$errors->first()}}</h4>
                            @endif
                        </td>
                    </tr>
                  </tbody>
                @endforeach
          </table>
        </div>
    </div>
</div>

@endsection

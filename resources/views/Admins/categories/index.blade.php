@extends('layouts.layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2 class="text-center"><i class="halflings-icon user"></i><span class="break"></span>All Categories</h2>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                    <th> Category ID</th>
                    <th> Name</th>
                    <th> Image</th>
                  </tr>
              </thead>
              <?php $i=1;?>
                @foreach($categories as $category)
                  <tbody>
                    <tr>
                        <td ><?php echo $i; $i=$i+1;?></td>
                        <td ><a href="{{route('admin-show-category',$category->id)}}">{{$category->category_name}}</a></td>
                        <td >
                            @if(empty($category->category_image))
                                <img src="{{url('images/categories/cats.png')}}" width="100px" height="100px">
                            @else
                                <img src="{{ url('images/categories/'.$category->category_image) }}"width="100px" height="100px">
                            @endif
                        </td>
                        <td>
                            <form action="{{route('admin-destroy-category',$category->id)}}" method="POST">
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

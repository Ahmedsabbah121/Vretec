@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1>Details for {{ $category->category_name }} Category</h1>
    </div>
    <div class="row col-lg-12">


    </div>

</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">{{ $category->category_name }} Sub Categories</h3>
                <div class="box-tools float-right">
                    <a class="btn btn-outline-success btn-xs-2" href="{{route('admin-edit-category',$category->id)}}">Edit</a>
                </div>
            </div>

            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> Sub Category Name</th>
                        <th> Sub Category Image</th>
                    </tr>
                </thead>
                <?php $i=1;?>
                    @foreach($sub_cats as $sub_cat)
                    <tbody>
                        <tr>
                            <td ><?php echo $i; $i=$i+1;?></td>
                            <td >{{$sub_cat->subcategory_name}}</td>
                            <td >
                                @if(empty($sub_cat->subcategory_image))
                                    <img src="{{url('images/categories/cats.png')}}" width="100px" height="100px">
                                @else
                                    <img src="{{ url('images/categories/'.$sub_cat->subcategory_image) }}"width="100px" height="100px">
                                @endif
                            </td>
                            <td>
                                <form action="{{route('admin-destroy-category',$sub_cat->id)}}" method="POST">
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
</div>
@endsection

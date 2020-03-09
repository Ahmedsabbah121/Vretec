@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1>Details for {{ $country->country_name }} </h1>
    </div>
    <div class="row col-lg-12">


    </div>

</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title"> Cities are included in {{ $country->country_name }}</h3>
                <div class="box-tools float-right">
                    <a class="btn btn-outline-success btn-xs-2" href="{{route('admin-edit-country',$country->id)}}">Edit</a>
                </div>
                <div class="box-tools float-right"style="padding-right:50px;">
                    <a class="btn btn-outline-primary btn-xs-2" href="{{route('admin-create-city',$country->id)}}">New Sub Category </a>
                </div>
            </div>

            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> City Name</th>
                        <th> Delete</th>
                    </tr>
                </thead>
                <?php $i=1;?>
                @foreach($cities as $city)
                <tbody>
                    <tr>
                        <td ><?php echo $i; $i=$i+1;?></td>
                        <td >{{$city->city_name}}</td>

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
</div>
@endsection

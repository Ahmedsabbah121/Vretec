@extends('layouts.layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2 class="text-center"><i class="halflings-icon user"></i><span class="break"></span>All Countries</h2>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th>#</th>
                    <th> Country Code</th>
                    <th> Name</th>
                  </tr>
              </thead>
              <?php $i=1;?>
                @foreach($countries as $country)
                  <tbody>
                    <tr>
                        <td ><?php echo $i; $i=$i+1;?></td>
                        <td>{{ $country->country_code }}</td>
                        <td ><a href="{{route('admin-show-country',$country->id)}}">{{$country->country_name}}</a></td>

                        <td>
                            <form action="{{route('admin-destroy-category',$country->id)}}" method="POST">
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

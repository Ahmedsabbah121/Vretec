@extends('layouts.layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2 class="text-center"><i class="halflings-icon user"></i><span class="break"></span>All Users</h2>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                    <th>User ID</th>
                    <th> Name</th>
                    <th> Email</th>
                    <th> Phone</th>
                    <th> Address</th>
                    <th> status</th>
                    <th> Image</th>
                  </tr>
              </thead>
                @foreach($users as $user)
                  <tbody>
                    <tr>
                        <td >{{$user->id}}</td>
                        <td >{{$user->name}}</td>
                        <td >{{$user->email}}</td>
                        <td >{{$user->mobile}}</td>
                        <td >{{ $user->city->city_name}}, {{ $user->country->country_name}}</td>
                        <td >{{$user->status}}</td>
                        <td >
                            @if(empty($user->image))
                                <img src="{{url('images/users/user.png')}}" width="100px" height="100px">
                            @else
                                <img src="{{url('images/users/'.$user->image)}}" width="100px" height="100px">
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

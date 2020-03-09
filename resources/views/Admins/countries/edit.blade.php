@extends('layouts.layout')
@section('content')
<div class="container">
    <form action="{{ route('admin-update-country',$country->id) }}"method="POST" enctype="multipart/form-data" class="col-lg-6" class="pb-5">
        @method("PATCH")
        @csrf
        @include('Admins.countries.form')
        <div class="input-group ">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

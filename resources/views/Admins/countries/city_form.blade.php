<div class="form-group">
    <label for="country_name">Country Name : {{$country->country_name}}</label>
</div>
<div class="form-group">
    <label for="city_name">City Name</label>
    <input type="text" class="form-control" id="city_name" value="" name ="city_name" aria-describedby="city_name" placeholder="Enter City name">
    <div>{{ $errors->first('city_name') }}</div>
</div>
@csrf

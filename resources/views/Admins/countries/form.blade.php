<div class="form-group">
    <label for="country_code">country Code</label>
    <input type="text" class="form-control" id="country_code" value="{{ old('country_code')?? $country->country_code}}" name ="country_code" aria-describedby="country_code" placeholder="Enter country code">
    <div>{{ $errors->first('country_code') }}</div>
</div>
<div class="form-group">
    <label for="country_name">country Name</label>
    <input type="text" class="form-control" id="country_name" value="{{ old('country_name')?? $country->country_name}}" name ="country_name" aria-describedby="country_name" placeholder="Enter country name">
    <div>{{ $errors->first('country_name') }}</div>
</div>
@csrf

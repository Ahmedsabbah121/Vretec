

<div class="form-group">
    <label for="subcategory_name">Category Name : {{$category->category_name}}</label>
</div>

<div class="form-group">
    <label for="subcategory_name">Sub Category Name</label>
    <input type="text" class="form-control" id="subcategory_name" value="" name ="subcategory_name" aria-describedby="subcategory_name" placeholder="Enter Sub category name">
    <div>{{ $errors->first('Subcategory_name') }}</div>
</div>

<div class="form-group">
    <label for="image">Select Image</label>
    <input type="file" name="image" value = "" id="image">
</div>
@csrf

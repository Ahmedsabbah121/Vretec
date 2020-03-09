<div class="form-group">
    <label for="category_name">Category Name</label>
    <input type="text" class="form-control" id="name" value="{{ old('category_name')?? $category->category_name}}" name ="category_name" aria-describedby="category_name" placeholder="Enter category name">
    <div>{{ $errors->first('category_name') }}</div>
</div>
<div class="form-group">
    <label for="image">Select Image</label>
    <input type="file" name="image" value = "" id="image">
</div>
@csrf

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name"
        value="{{ isset($product->name) ? $product->name : ''}}">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    @isset($product)
    @if($product->image)
    <img style="width:20%" src={{ asset($product->image) }}>
    @endif
    @endisset
    <input class="form-control" name="image" type="file" id="image"
        value="{{ isset($product->image) ? $product->image : ''}}">
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group mt-3">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
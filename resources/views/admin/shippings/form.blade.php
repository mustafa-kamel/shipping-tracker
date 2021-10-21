<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description"
        required>{{ isset($shipping->description) ? $shipping->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('shipment_number') ? 'has-error' : ''}}">
    <label for="shipment_number" class="control-label">{{ 'Shipment Number' }}</label>
    <input class="form-control" name="shipment_number" type="text" id="shipment_number"
        value="{{ isset($shipping->shipment_number) ? $shipping->shipment_number : ''}}">
    {!! $errors->first('shipment_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <input class="form-control" name="address" type="text" id="address"
        value="{{ isset($shipping->address) ? $shipping->address : ''}}" required>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('courier_id') ? 'has-error' : ''}}">
    <label for="courier_id" class="control-label">{{ 'Courier Id' }}</label>
    <select name="courier_id" class="form-control" id="status">
        @foreach ($couriers as $option)
        <option value="{{ $option->id }}" {{ (isset($shipping->courier_id) && $shipping->courier_id == $option->id) ?
            'selected' :
            ''}}>{{ $option->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('courier_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select name="status" class="form-control" id="status">
        @foreach (config('enums.ship_status_enum') as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($shipping->status) && $shipping->status == $optionKey) ? 'selected' :
            ''}}>{{ $optionValue }}</option>
        @endforeach
    </select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('products') ? 'has-error' : ''}}">
    <label for="products" class="control-label">{{ 'Products' }}</label>
    <select name="products[]" class="form-control" id="products" multiple>
        @foreach ($products as $option)
        <option value="{{ $option->id }}" {{ (isset($shipping->products) && $shipping->products->contains($option)) ?
            'selected'
            :
            ''}}>{{ $option->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('products', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group mt-3">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
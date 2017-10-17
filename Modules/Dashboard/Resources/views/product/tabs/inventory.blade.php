<p>
	<div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="sku" class="control-label col-sm-2">
                    SKU
                </label>
                <div class="col-sm-6">
                    <input type="text" id="sku" class="form-control" name="sku" value="{{ isset($product->meta) ? $product->meta->getValue('sku') : old('sku') }}">
                </div>
            </div>
        </div>
    </div>
</p>
<p>
	<div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="stock" class="control-label col-sm-2">
                    Stock quantity
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="stock" value="{{ isset($product->stock) && $product->stock > 0 ? $product->stock : old('stock') }}" name="stock" placeholder="0" />
                </div>
            </div>
        </div>
    </div>
</p>
<p>
	<div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="stock_status" class="control-label col-sm-2">
                    Stock status
                </label>
                <div class="col-sm-6">
                    <select name="stock_status" class="form-control" id="stock_status">
                    	<option value="in_stock" {{ isset($product->meta) && $product->meta->getValue('stockStatus') == 'in_stock' ? 'selected="selected"' : '' }}>In stock</option>
                    	<option value="out_stock" {{ isset($product->meta) && $product->meta->getValue('stockStatus') == 'out_stock' ? 'selected="selected"' : '' }}>Out of stock</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</p>

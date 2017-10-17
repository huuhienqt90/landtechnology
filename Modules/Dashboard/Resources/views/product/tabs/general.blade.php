<p>
    <div class="row">
        <div class="col-md-10">
            <div class="form-group {{ $errors->has('original_price') ? ' has-error' : '' }}">
                <label for="original_price" class="control-label col-sm-2">
                    Regular price
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="original_price" value="{{ isset($product->original_price) ? $product->original_price : old('original_price') }}" name="original_price" placeholder="0">
                </div>
                @include('dashboard::partials.error', ['field' => 'original_price'])
            </div>
        </div>
    </div>
</p>
<p>
    <div class="row">
        <div class="col-md-10">
            <div class="form-group {{ $errors->has('sale_price') ? ' has-error' : '' }}">
                <label for="sale_price" class="control-label col-sm-2">
                    Sale price
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ isset($product->sale_price) ? $product->sale_price : old('sale_price') }}" placeholder="0">
                </div>
                @include('dashboard::partials.error', ['field' => 'sale_price'])
            </div>
        </div>
    </div>
</p>

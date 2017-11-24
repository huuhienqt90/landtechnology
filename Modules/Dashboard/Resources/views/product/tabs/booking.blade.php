<div class="booking-item form-horizontal" style="margin: 40px 0;">
    <div class="form-group {{ $errors->has('price_booking') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">Original Price</label>
        <div class="col-md-4">
            <input type="text" name="price_booking" value="{{ isset($product->product_type) && $product->product_type == 'booking' ? $product->booking->price : old('price_booking') }}" class="form-control" placeholder="0" />
        </div>
        @include('dashboard::partials.error', ['field' => 'price_booking'])
    </div>
    <div class="form-group {{ $errors->has('sale_price_booking') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">Sale Price</label>
        <div class="col-md-4">
            <input type="text" name="sale_price_booking" value="{{ isset($product->product_type) && $product->product_type == 'booking' ? $product->booking->sale_price : old('sale_price_booking') }}" class="form-control" placeholder="0" />
        </div>
        @include('dashboard::partials.error', ['field' => 'sale_price_booking'])
    </div>
</div>
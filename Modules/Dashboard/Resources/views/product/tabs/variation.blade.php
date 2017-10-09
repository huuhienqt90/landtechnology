<p>&nbsp;</p>
<div class="row">
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <select id="field_in_edit" class="form-control">
                <option value="">Add variation</option>
            </select>
            <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" id="add-new-variation">Add new</button>
            </span>
        </div>
    </div>
</div>
@if( isset( $product->variations ) && $product->variations->count() )
<!-- Start old items -->
<p>&nbsp;</p>
<div class="box-group" id="old-item">
    <div class="panel box box-default">
        <div class="box-header with-border">
            <div class="box-title pull-left">
                <div class="form-inline">
                    <label>Attributes</label>
                    <div class="form-group">
                        <select class="form-control">
                            <option>Any Color</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option>Any Color</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <a data-toggle="collapse" data-parent="#attr" href="#collapseOne" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></a>
                <a href="javascript:void(0)" class="btn btn-info btn-sm" id="rmAttr"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('variation_image') ? ' has-error' : '' }}">
                            <div class="col-sm-2">
                                @if (Form::getValueAttribute('variation_image'))
                                    <img class="variation-image-prev" style="width: 100px; height: 100px; border: 1px solid #cdcdcd; border-radius: 3px; margin-bottom: 10px;" src="{{ asset('storage/'.Form::getValueAttribute('variation_image')) }}"/>
                                @else
                                    <img id="variation_image-prev" style="max-height:80px" />
                                @endif
                                {!! Form::file('variation_image',['class'=>'variation_image form-control']) !!}
                                @include('dashboard::partials.error', ['field' => 'variation_image'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SKU</label>
                            <input type="text" class="form-control" name="variation_sku" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Regular Price</label>
                            <input type="text" class="form-control" name="variation_original_price" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sale Price</label>
                            <input type="text" class="form-control" name="variation_sale_price" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End old item box -->
@endif
<div class="hidden" id="clone">
    <div class="box-item">
        <div class="panel box box-danger product-variation-item" id="product-variation-item-!#name#!">
            <div class="box-header with-border">
                <div class="box-title pull-left">
                    <div class="form-inline">
                        <label>Attributes</label>
                        !#attrs#!
                    </div>
                </div>
                <div class="pull-right">
                    <a data-toggle="collapse" data-parent="#new-item" href="#collapse-!#name#!" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></a>
                    <a href="#" class="btn btn-info btn-sm remove-product-variation-item" data-id="!#name#!"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div id="collapse-!#name#!" class="panel-collapse collapse">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('variation_image') ? ' has-error' : '' }}">
                                <img class="variation-image-prev" style="width: 100px; height: 100px; border: 1px solid #cdcdcd; border-radius: 3px; margin-bottom: 10px;" />
                                <input type="file" name="variation[!#name#!][image]" class="form-control variation_image form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" class="form-control" name="variation[!#name#!][sku]" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Regular Price</label>
                                <input type="text" class="form-control" name="variation[!#name#!][original_price]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sale Price</label>
                                <input type="text" class="form-control" name="variation[!#name#!][sale_price]" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Start new item box -->
<p>&nbsp;</p>
<div class="box-group" id="new-item">
</div>

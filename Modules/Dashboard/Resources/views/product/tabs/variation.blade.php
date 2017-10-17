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
<?php $count = 0; ?>
@if( isset( $product->variations ) && $product->variations->count() )
<!-- Start old items -->
<p>&nbsp;</p>
<div class="box-group" id="old-item">
    @foreach($product->variations as $variation)
    <div class="panel box box-danger product-variation-item" id="product-variation-item-{{ $variation->id }}">
        <div class="panel box box-default">
            <div class="box-header with-border">
                <div class="box-title pull-left">
                    <div class="form-inline" data-id="{{ $variation->id }}" data-type="edit">
                        <label>Attributes</label>
                        @foreach($variation->variations as $item)
                            <div class="form-group">
                                <select class="form-control attr-item" name="variation[{{ $variation->id }}][attr][{{$item->attribute->id}}]">
                                    <option>Any {{ $item->attribute->name }}</option>
                                    @foreach($product->productAttributes as $value)
                                        @if( $value->attribute_id == $item->attribute_id )
                                            <option value="{{ $value->value }}" {{ selected($item->value, $value->value) }}>{{ $value->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="pull-right">
                    <a data-toggle="collapse" data-parent="#attr" href="#collapseOne-{{ $variation->id }}" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></a>
                    <a href="javascript:void(0)" class="btn btn-info btn-sm btn-click-minisize" data-id="{{ $variation->id }}" id="rmAttr{{ $variation->id }}"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div id="collapseOne-{{ $variation->id }}" class="panel-collapse collapse">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('variation.'.$variation->id.'.image') ? ' has-error' : '' }}">
                                @if($variation->feature_image != null)
                                    <img class="variation-image-prev" style="width: 100px; height: 100px; border: 1px solid #cdcdcd; border-radius: 3px; margin-bottom: 10px;" src="{{ asset('storage/'.$variation->feature_image) }}"/>
                                @else
                                    <img id="variation-prev" style="max-height:80px" />
                                @endif
                                <input class="variation_image form-control" value="{{ asset('storage/'.$variation->feature_image) }}" name="variation[{{ $variation->id }}][image]" type="file">
                                @include('dashboard::partials.error', ['field' => 'variation.'.$variation->id.'.image'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('variation.'.$variation->id.'.sku') ? ' has-error' : '' }}">
                                <label>SKU</label>
                                <input type="text" class="form-control" value="{{ $variation->sku }}" name="variation[{{ $variation->id }}][sku]" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('variation.'.$variation->id.'.original_price') ? ' has-error' : '' }}">
                                <label>Regular Price</label>
                                <input type="text" class="form-control" value="{{ $variation->price }}" name="variation[{{ $variation->id }}][original_price]" />
                                @include('dashboard::partials.error', ['field' => 'variation.'.$variation->id.'.original_price'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('variation.'.$variation->id.'.sale_price') ? ' has-error' : '' }}">
                                <label>Sale Price</label>
                                <input type="text" class="form-control" value="{{ $variation->sale_price }}" name="variation[{{ $variation->id }}][sale_price]" />
                                @include('dashboard::partials.error', ['field' => 'variation.'.$variation->id.'.sale_price'])
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="variation[{{ $variation->id }}][variation_id]" value="{{ $variation->id }}">
                </div>
            </div>
        </div>
    </div>
    <?php $count++; ?>
    @endforeach
</div>
<!-- End old item box -->
@endif
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".btn-click-minisize").on('click',function() {
            var kq = confirm("Are you sure remove attribute?");
            var id = $(this).data("id");
            if(kq) {
                $.ajax({
                    url: "{{ route('dashboard.delAttributeVariation') }}",
                    type: "GET",
                    data: {id:id},
                    success: function(result) {
                        console.log(result);
                    }
                });
                $(this).parent().parent().parent().parent().remove();
                return false;
            }
        });
    });
</script>
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
                                <input type="file" name="variationNew[!#name#!][image]" class="variation_image form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" class="form-control" name="variationNew[!#name#!][sku]" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Regular Price</label>
                                <input type="text" class="form-control" name="variationNew[!#name#!][original_price]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sale Price</label>
                                <input type="text" class="form-control" name="variationNew[!#name#!][sale_price]" />
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
    @if(old('variationNew') !== null && count(old('variationNew')))
        @foreach(old('variationNew') as $id => $variationNew)
            @if ( !is_numeric($id))
                @continue
            @endif
            <div class="panel box box-danger product-variation-item" id="product-variation-item-{{ $id }}">
                <script>
                    count++;
                </script>
                <div class="box-header with-border">
                    <div class="box-title pull-left">
                        <div class="form-inline">
                            <label>Attributes</label>
                            @foreach($variationNew['attr'] as $subID => $attr)
                                <div class="form-group">
                                    <select class="form-control attr-item" name="variationNew[{{ $id }}][attr][{{ $subID }}]">
                                        <option value="0">Any {{ getAttrName($subID) }}</option>
                                        @foreach(old('arrAttributes')[$subID] as $subDT)
                                            <option{{ selected($subDT, old('variationNew.'.$id.'.attr.'.$subID)) }} value="{{ $subDT }}">{{ $subDT }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pull-right">
                        <a data-toggle="collapse" data-parent="#new-item" href="#collapse-{{ $id }}" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-info btn-sm remove-product-variation-item" data-id="{{ $id }}"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div id="collapse-{{ $id }}" class="panel-collapse collapse">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('variationNew.'.$id.'.image') ? ' has-error' : '' }}">
                                    <img class="variation-image-prev" style="width: 100px; height: 100px; border: 1px solid #cdcdcd; border-radius: 3px; margin-bottom: 10px;" />
                                    <input type="file" name="variationNew[{{ $id }}][image]" class="variation_image form-control" />
                                    @include('dashboard::partials.error', ['field' => 'variationNew.'.$id.'.image'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('variationNew.'.$id.'.sku') ? ' has-error' : '' }}">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" name="variationNew[{{ $id }}][sku]" />
                                    @include('dashboard::partials.error', ['field' => 'variationNew.'.$id.'.sku'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('variationNew.'.$id.'.sale_price') ? ' has-error' : '' }}">
                                    <label>Regular Price</label>
                                    <input type="text" class="form-control" name="variationNew[{{ $id }}][original_price]" />
                                    @include('dashboard::partials.error', ['field' => 'variationNew.'.$id.'.original_price'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('variationNew.'.$id.'.sale_price') ? ' has-error' : '' }}">
                                    <label>Sale Price</label>
                                    <input type="text" class="form-control" name="variationNew[{{ $id }}][sale_price]" />
                                    @include('dashboard::partials.error', ['field' => 'variationNew.'.$id.'.sale_price'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<p>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group input-group-sm">
                <select id="field_in_edit" class="form-control">
                    <option value="">Add variation</option>
                </select>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat">GO</button>
                </span>
            </div>
        </div>
    </div>
</p>

<p>
    <div class="box-group" id="attr">
        <div class="panel box box-default">
            <div class="box-header with-border">
                <h4 class="box-title pull-left">
                    <a data-toggle="collapse" data-parent="#attr" href="#collapseOne">#ID111</a>
                </h4>
                <div class="col-md-2">
                    <select name="aa" id="aa" class="form-control">
                        <option value="aa">aa</option>
                    </select>
                </div>
                <a href="javascript:void(0)" class="pull-right text-danger" id="rmAttr">Remove</a>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('variation_image') ? ' has-error' : '' }}">
                                <div class="col-sm-2">
                                    @if (Form::getValueAttribute('variation_image'))
                                        <img id="variation_image-prev" style="max-height:80px; border: 1px solid #cdcdcd; border-radius: 3px; overflow: hidden; margin-right: 10px; margin-bottom: 10px; padding: 2px;" src="{{ asset('storage/'.Form::getValueAttribute('variation_image')) }}"/>
                                    @else
                                        <img id="variation_image-prev" style="max-height:80px" />
                                    @endif
                                    {!! Form::file('variation_image',['id'=>'variation_image']) !!}
                                    @include('dashboard::partials.error', ['field' => 'variation_image'])
                                </div>
                            </div>
                            <script>
                                jQuery(document).ready(function ($){
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#variation_image-prev').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }

                                    $("#variation_image").change(function(){
                                        readURL(this);
                                    });
                                });
                            </script>
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
</p>
<p>
    <div class="row hidden show-if-variable">
        <div class="col-sm-6">
            <a href="#" class="btn btn-primary">Save Attributes</a>
        </div>
    </div>
</p>
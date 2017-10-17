<p>
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <div class="col-sm-6">
                    {{ Form::select('attributes', $attrArr, null, ['placeholder' => 'Custom product attribute', 'class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    <a href="javascript:void(0)" class="btn btn-default" id="addEventAttr">Add</a>
                </div>
            </div>
        </div>
    </div>
</p>

<p>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-body" id="appendAttr">
                    <?php $oldAttrs = []; ?>
                    @if(isset($product->attribute))
                        @foreach($product->attribute as $id => $name)
                            <?php $oldAttrs[] = $id; ?>
                            <script type="text/javascript">
                                productAttrs[<?php echo $id; ?>] = {name: '<?php echo $name; ?>', attrs: <?php echo json_encode( array_values(getArrayValueById($id, $product->id)) ); ?>};
                            </script>
                            <div class="box-group" id="attr{{ $id }}">
                                <div class="panel box box-default">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#attr{{ $id }}" href="#collapseOne{{ $id }}">{{ $name }}</a>
                                        </h4>
                                        <a href="javascript:void(0)" class="pull-right text-danger rmAttr" data-id="{{$id}}" id="rmAttr{{ $id }}">Remove</a>
                                    </div>
                                    <div id="collapseOne{{ $id }}" class="panel-collapse collapse in">
                                        <div class="box-body">
                                            <div class="col-md-4">
                                                <p>Name:</p><span>{{ $name }}</span>
                                            </div>
                                            <div class="col-md-8">
                                                <p>Values:</p>
                                                <select class="form-control select2" multiple="multiple" name="arrAttributes[{{ $id }}][]" data-name="{{ $name }}" id="arrAttributes{{ $id }}" data-placeholder="Select values..." style="width: 100%;">
                                                    @if( \App\Models\Attribute::getValuesById($id) != null)
                                                        @foreach(\App\Models\Attribute::getValuesById($id) as $attr)
                                                            <option value="{{ $attr }}" {{ selected(in_array($attr, array_values($attributesArr)), true) }}>{{ $attr }}</option>

                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="set-value">
                                                    <a href="javascript:void(0)" class="btn btn-default" id="selectAll{{ $id }}">Select all</a>
                                                    <a href="javascript:void(0)" class="btn btn-default" id="selectNone{{ $id }}">Select none</a>
                                                    <a href="javascript:void(0)" class="btn btn-default pull-right" id="addNewAttr{{ $id }}">Add new</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function($) {
                                    $('#addNewAttr{{$id}}').on('click',function(e){
                                        e.preventDefault();
                                        $("#textAttr").html('');
                                        $("#textAttr").append('<input type="text" class="form-control" placeholder="Enter value of attribute" id="otherVal{{$id}}"/>');
                                        $('#modal-default').modal('show');
                                    });

                                    $("#arrAttributes{{$id}}").on('change', function(){
                                        productAttrs[{{$id}}].attrs = $(this).val();
                                        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                                            var dis = $(e.target);
                                            var id = $("#old-item .product-variation-item").find('.form-inline').data('id');
                                            var type = $("#old-item .product-variation-item").find('.form-inline').data('type');
                                            if( dis.attr('href') == '#variation' ){
                                                $('#old-item .product-variation-item').each(function(){
                                                    var attr = '<label>Attributes </label>';
                                                    $.each(productAttrs, function(index, value){
                                                        if( typeof value != "undefined" && typeof value.name != "undefined" ){
                                                            if( type == "edit" ) {
                                                                attr += '<div class="form-group"><select class="form-control attr-item" name="variation['+id+'][attr]['+index+']">';
                                                                attr += '<option value="0">Any '+value.name+' ...</option>';
                                                                $.each(value.attrs, function(subIndex, subValue){
                                                                    attr += '<option value="'+subValue+'">'+subValue+'</option>';
                                                                });
                                                                attr += '</select></div>';
                                                            }else{
                                                                attr += '<div class="form-group"><select class="form-control attr-item" name="variation['+count+'][attr]['+index+']">';
                                                                attr += '<option value="0">Any '+value.name+' ...</option>';
                                                                $.each(value.attrs, function(subIndex, subValue){
                                                                    attr += '<option value="'+subValue+'">'+subValue+'</option>';
                                                                });
                                                                attr += '</select></div>';
                                                            }
                                                        }
                                                    });
                                                    $(this).find('.form-inline').html(attr);
                                                    count++;
                                                });
                                            }
                                        });
                                    });

                                    $("#selectAll{{$id}}").on('click', function() {
                                        $("#arrAttributes{{$id}} option").prop('selected', true);
                                        $("#arrAttributes{{$id}}").trigger("change");
                                    });
                                    $("#selectNone{{$id}}").on('click', function() {
                                        $("#arrAttributes{{$id}} option").prop('selected', false);
                                        $("#arrAttributes{{$id}}").trigger("change");
                                    });
                                });
                            </script>
                        @endforeach
                    @endif
                </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</p>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".rmAttr").on('click', function() {
            var id = $(this).data("id");
            productAttrs.splice(id, 1);
            $("#attr"+id).remove();
            $('#old-item .product-variation-item').each(function(){
                var attr = '<label>Attributes </label>';
                var id = $("#old-item .product-variation-item").find('.form-inline').data('id');
                var type = $("#old-item .product-variation-item").find('.form-inline').data('type');
                $.each(productAttrs, function(index, value){
                    if( typeof value != "undefined" && typeof value.name != "undefined" ){
                        if( type == "edit" ) {
                            attr += '<div class="form-group"><select class="form-control attr-item" name="variation['+id+'][attr]['+index+']">';
                            attr += '<option value="0">Any '+value.name+' ...</option>';
                            $.each(value.attrs, function(subIndex, subValue){
                                attr += '<option value="'+subValue+'">'+subValue+'</option>';
                            });
                            attr += '</select></div>';
                        }else{
                            attr += '<div class="form-group"><select class="form-control attr-item" name="variation['+count+'][attr]['+index+']">';
                            attr += '<option value="0">Any '+value.name+' ...</option>';
                            $.each(value.attrs, function(subIndex, subValue){
                                attr += '<option value="'+subValue+'">'+subValue+'</option>';
                            });
                            attr += '</select></div>';
                        }
                    }
                });
                $(this).find('.form-inline').html(attr);
                count++;
            });
            $('#new-item .product-variation-item').each(function(){
                var attr = '<label>Attributes </label>';
                $.each(productAttrs, function(index, value){
                    if( typeof value != "undefined" && typeof value.name != "undefined" ){
                        attr += '<div class="form-group"><select class="form-control attr-item" name="variation['+count+'][attr]['+index+']">';
                        attr += '<option value="0">Any '+value.name+' ...</option>';
                        $.each(value.attrs, function(subIndex, subValue){
                            attr += '<option value="'+subValue+'">'+subValue+'</option>';
                        });
                        attr += '</select></div>';
                    }
                });
                $(this).find('.form-inline').html(attr);
                count++;
            });
        });
    });
</script>

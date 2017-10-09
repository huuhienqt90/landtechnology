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
                    @if(isset($product->attribute))
                        @foreach($product->attribute as $id => $name)
                            <div class="box-group" id="attr{{ $id }}">
                                <div class="panel box box-default">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#attr{{ $id }}" href="#collapseOne{{ $id }}">{{ $name }}</a>
                                        </h4>
                                        <a href="javascript:void(0)" class="pull-right text-danger" id="rmAttr{{ $id }}">Remove</a>
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
                                    <script type="text/javascript">
                                        jQuery(document).ready(function($){
                                            $("#addNewAttr{{ $id }}").click(function(){
                                                $("#textAttr").html('');
                                                $("#textAttr").append('<input type="text" class="form-control" placeholder="Enter value of attribute" id="otherVal{{$id}}"/>');
                                                $('#modal-default').modal('show');
                                                $("#saveAttr").on('click',function(e){
                                                    e.preventDefault();
                                                    $('#modal-default').modal('hide');
                                                    if( $('#otherVal{{$id}}').length > 0 ){
                                                        var val = $('#otherVal{{$id}}').val();
                                                        $('select[name="arrAttributes[{{$id}}][]"]').append('<option value="'+val+'">'+val+'</option>');
                                                    }
                                                    $.ajax({
                                                        url: "{{ route('dashboard.addfast') }}",
                                                        type: "POST",
                                                        data: {id: {{$id}},val: val},
                                                        success: function(rs) {
                                                            console.log(rs);
                                                        }
                                                    });
                                                });
                                            })

                                            $("#selectAll{{ $id }}").on('click', function() {
                                                $("#arrAttributes{{ $id }}"+" option").attr('selected','selected');
                                                $("#arrAttributes{{ $id }}").trigger("change");
                                                console.log("asdasd");
                                            });
                                            $("#selectNone{{ $id }}").on('click', function() {
                                                $("#arrAttributes{{ $id }}"+" option").removeAttr('selected');
                                                $("#arrAttributes{{ $id }}").trigger("change");
                                            });
                                            $("#rmAttr{{ $id }}").on('click', function() {
                                                $("#attr{{ $id }}").remove();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            <!-- /.box-body -->
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

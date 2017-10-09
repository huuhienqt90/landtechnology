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
                            <script type="text/javascript">productAttrs[<?php echo $id; ?>] = {name: '<?php echo $name; ?>', attrs: <?php echo json_encode( array_values($attributesArr) ); ?>}; </script>
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
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if( is_array(old('arrAttributes')) && count(old('arrAttributes')) )
                        @foreach(old('arrAttributes') as $id => $data)
                            <?php if(in_array($id, $oldAttrs)) continue; ?>
                            <script type="text/javascript">productAttrs[<?php echo $id; ?>] = {name: '<?php echo getAttrName($id); ?>', attrs: <?php echo json_encode( $data ); ?>}; </script>
                            <div class="box-group" id="attr{{ $id }}">
                                <div class="panel box box-default">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#attr{{ $id }}" href="#collapseOne{{ $id }}">{{ getAttrName($id) }}</a>
                                        </h4>
                                        <a href="javascript:void(0)" class="pull-right text-danger" id="rmAttr{{ $id }}">Remove</a>
                                    </div>
                                    <div id="collapseOne{{ $id }}" class="panel-collapse collapse in">
                                        <div class="box-body">
                                            <div class="col-md-4">
                                                <p>Name:</p><span>{{ getAttrName($id) }}</span>
                                            </div>
                                            <div class="col-md-8">
                                                <p>Values:</p>
                                                <select class="form-control select2" multiple="multiple" name="arrAttributes[{{ $id }}][]" data-name="{{ getAttrName($id) }}" id="arrAttributes{{ $id }}" data-placeholder="Select values..." style="width: 100%;">
                                                    @if( \App\Models\Attribute::getValuesById($id) != null)
                                                        @foreach(\App\Models\Attribute::getValuesById($id) as $attr)
                                                            <option value="{{ $attr }}" {{ selected(in_array($attr, $data), true) }}>{{ $attr }}</option>
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
                        @endforeach
                    @endif
                </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</p>

<div class="form-group {{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-4">
        @if (Form::getValueAttribute($field))
            <img id="{{ $field }}-prev" style="max-height:150px; border: 1px solid #cdcdcd; border-radius: 3px; overflow: hidden; margin-right: 10px; margin-bottom: 10px; padding: 2px;" src="{{ asset('storage/'.Form::getValueAttribute($field)) }}"/>
        @else
            <img id="{{ $field }}-prev" style="max-height:150px" />
        @endif
        {!! Form::file($field,['id'=>$field]) !!}
        @include('dashboard::partials.error', ['field' => $field])
    </div>
</div>
<script>
    jQuery(document).ready(function ($){
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#{{ $field }}-prev').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#{{ $field }}").change(function(){
            readURL(this);
        });
    });
</script>

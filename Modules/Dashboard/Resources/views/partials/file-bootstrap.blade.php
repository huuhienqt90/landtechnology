<style type="text/css">
    .kv-file-upload{
        display: none;
    }
</style>
<div class="form-group {{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-10">
        {!! Form::file($field,['id'=>$field, 'class' => 'file', 'data-upload-url' => $url, 'name' => $field]) !!}
        @include('dashboard::partials.error', ['field' => $field])
    </div>
</div>
<script type="text/javascript">
    <?php if (Form::getValueAttribute($field)): ?>
        $("#{{$field}}").fileinput({
            uploadUrl: '#',
            uploadAsync: false,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
            showUpload: false,
            
            initialPreviewAsData: true,
            initialPreview: [
                "{{ asset('storage/'.Form::getValueAttribute($field)) }}"
            ],
            initialPreviewConfig: [
                {caption: "{{ Form::getValueAttribute($field) }}", size: 329892, width: "120px", url: "{{ route('dashboard.delimg', $product->id) }}", key: "{{ Form::getValueAttribute($field) }}"},
            ]
        });
    <?php else: ?>
        $("#{{$field}}").fileinput({
        uploadUrl: '#',
        uploadAsync: false,
        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpge'],
        showUpload: false,
    });
    <?php endif ?>
    
</script>
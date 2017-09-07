<div class="form-group {{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-10">
        {!! Form::file($field,['id'=>$field, 'class' => 'file', 'data-upload-url' => $url, 'multiple' => 'true', 'name' => $field.'[]']) !!}
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
            overwriteInitial: false,
            initialPreviewAsData: true,
            initialPreview: [
            	@foreach ($productImages as $image)
                	"{{ asset('storage/'.$image->image_path) }}",
                @endforeach
            ],
            initialPreviewConfig: [
            	@foreach ($productImages as $image)
                	{caption: "{{ $image->image_name }}", size: 329892, width: "120px", url: "{{ route('dashboard.delProductImg', $image->id) }}", key: "{{ $image->id }}"},
                @endforeach
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
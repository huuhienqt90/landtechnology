<div class="form-group {{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-10">
        <textarea class="textarea" id="{{ $field }}" name="{{ $field }}" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ Form::getValueAttribute($field) }}</textarea>
        @include('dashboard::partials.error', ['field' => $field])
    </div>
</div>

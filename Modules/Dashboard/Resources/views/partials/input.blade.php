<div class="form-group {{ $errors->has($field) ? ' has-error' : '' }}">
  <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
  <div class="col-sm-4">
    {!! Form::text($field, old($field), $options) !!}
    @include('dashboard::partials.error', ['field' => $field])
  </div>
</div>

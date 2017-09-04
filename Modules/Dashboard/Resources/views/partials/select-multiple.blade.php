<div class="form-group {{ $errors->has($field) ? ' has-error' : ''}}">
   <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
   <div class="col-sm-4">
        {!! Form::select($field.'[]', $options, Form::getValueAttribute($field), ['class' => 'form-control select2', 'multiple' => true, 'data-placeholder' => $placeholder]) !!}
        @include('dashboard::partials.error', ['field' => $field])
    </div>
</div>

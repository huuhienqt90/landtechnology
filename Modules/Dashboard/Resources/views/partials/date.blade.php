<div class="form-group {{ $errors->has($field) ? ' has-error' : ''}}">
   <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
   <div class="col-sm-4">
        {!! Form::date($field, old($field), \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @include('dashboard::partials.error', ['field' => $field])
    </div>
</div>

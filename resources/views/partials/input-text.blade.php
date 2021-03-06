<div class="form-group{{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="label-control">{{ $label }}</label>
    {!! Form::text($field, Form::getValueAttribute($field), ['class' =>'form-control']) !!}
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>

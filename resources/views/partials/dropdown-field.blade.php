<div class="form-group{{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="label-control">{{ $label }}</label>
    {!! Form::select($field, $options, Form::getValueAttribute($field), ['class' => 'form-control', 'placeholder' => 'Select '.$label, 'id' => $field]) !!}
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>

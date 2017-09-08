<div class="form-group{{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="shipping-name" class="label-control">{{ $label }}</label>
    <input type="text" class="form-control" name="{{ $field }}" value="{{ old($field) }}" />
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>

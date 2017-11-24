<div class="form-group {{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="control-label">{{ $label }} <span class="required">*</span></label>
    <textarea name="{{ $field }}" class="form-control"></textarea>
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>

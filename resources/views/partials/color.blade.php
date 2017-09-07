<div class="form-group {{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="control-label">{{ $label }} <span class="required">*</span></label>
    @foreach($options as $option)
        <label class="color-attr-item">
            <input type="radio" name="{{ $field }}" value="{{ $option['value'] }}">
            <span class="color-item" style="background: {{ $option['value'] }};"></span>
        </label>
    @endforeach
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>
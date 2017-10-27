<div class="form-group {{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="control-label">{{ $label }} <span class="required">*</span></label>
    @foreach($options as $option)
        <label class="checkbox-attr-item">
            <input type="checkbox" name="{{ $field }}" class="attr-item" value="{{ $option['value'] }}">
            <span class="checkbox-item">{{ $option['value'] }}</span>
        </label>
    @endforeach
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>

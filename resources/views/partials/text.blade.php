<div class="form-group {{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="control-label">{{ $label }} <span class="required">*</span></label>
    @foreach($options as $option)
        <label class="text-attr-item">
            <input type="radio" name="{{ $field }}" value="{{ $option['value'] }}">
            <span class="text-item">{{ $option['value'] }}</span>
        </label>
    @endforeach
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>
<div class="form-group {{ $errors->has(str_replace(['[', ']'],['.'], $field)) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="control-label">{{ $label }} <span class="required">*</span></label>
    <select name="{{ $field }}" id="{{ $field }}" class="attr-item" required>
    @foreach($options as $option)
        <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
    @endforeach
    </select>
    @include('partials.error', ['field' => str_replace(['[', ']'],['.'], $field)])
</div>

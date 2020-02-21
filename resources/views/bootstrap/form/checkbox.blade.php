<div class="form-group form-check">
    <label class="gender">{{ $label}}</label>
    <label>
        <input class="form-check-input" type="checkbox" name="{{$name}}"
               id="remember" {{ old($name) ? 'checked' : '' }}>
        <span class="label-text"></span>
    </label>
</div>

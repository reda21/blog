<div class="form-group form-check">
    <label class="gender">{{ $label}}</label>
    <label>
        {!! Form::checkbox($name, 1, !empty($checked) && $checked ? true : false) !!}
        <span class="label-text"></span>
    </label>
</div>

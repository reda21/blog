<div class=" form-group">
    {!! Form::label($name, $label, ["class" => "control-label"]) !!}
    <div class="input-group">
        {!! Form::text($name, $value, ["class" => 'form-control'.($class ?? ""), "placeholder" => $placeholder ?? "", "disabled" => $disabled ?? false, "v-date" => true ]) !!}
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend2"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    @error($name)
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

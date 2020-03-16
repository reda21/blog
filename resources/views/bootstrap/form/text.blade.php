<div class=" form-group">
    @include("bootstrap.element.label", ["label" => $label])
    {!! Form::text($name, $value, ["class" => 'form-control'.($class ?? ""), "placeholder" => $placeholder ?? "", "disabled" => $disabled ?? false ]) !!}
    @error($name)
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

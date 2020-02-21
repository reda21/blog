<div class=" form-group">
    @include("bootstrap.element.label", ["label" => $label])
    @include("bootstrap.element.input",['placeholder' => $placeholder, "name" => $name , "value" => $value ?? ''])
    @error($name)
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

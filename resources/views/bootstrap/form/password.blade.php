<div class=" form-group">
    @include("bootstrap.element.label", ["label" => $label])
    @include("bootstrap.element.input",['type' => "password",'placeholder' => $placeholder, "name" => $name ])

    @error($name)
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

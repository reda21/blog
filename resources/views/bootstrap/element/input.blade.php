<input placeholder="{{$placeholder}}" name="{{$name}}" type="{{$type ?? 'text'}}" value="{{$value ?? old($name)}}"
       id="$name" class="form-control @error($name) is-invalid @enderror">

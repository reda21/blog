<div class=" form-group">
    {!! Form::label($name,$label, array("class"=>"control-label")) !!}
    {!! Form::select($name, $list, $value, ['class'=>'form-control','placeholder'=>$placeholder ?? '']) !!}
</div>

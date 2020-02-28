@if(\App\Services\Helper::activeUrl($url))
    <a class="{{$className}} {{$texteActive ?? "active"}}" href="{{$url}}">{!!$titre!!}</a>
@else
    <a class="{{$className}}" href="{{$url}}">{!!$titre!!}</a>
@endif

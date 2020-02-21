@if (session('status'))
    <div class="alert {{$status ?? 'alert-success'}}" role="alert">
        {{ session('status') }}
    </div>
@endif

@component("user.layout.template-user", ["user" => $user])
    <div class="card mt-3">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
           <following user="{{$user->username}}"/>
        </div>
    </div>
@endcomponent

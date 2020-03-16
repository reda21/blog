@php
$profile = json_encode($user->showProfile());
@endphp
@component("user.layout.template-user", ["user" => $user])
    <div class="row mt-3">
        <div class="col-md-6">
            <edit-account :user="{username:'{{$user->username}}',email:'{{$user->email}}', 'first_name':'{{$user->first_name}}', 'last_name': '{{$user->last_name}}'}"></edit-account>
            <edit-profile :user='{!! $profile !!}'></edit-profile>
        </div>
        <div class="col-md-6">
            <edit-avatar></edit-avatar>
        </div>
    </div>
@endcomponent

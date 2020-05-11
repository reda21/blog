@component("user.layout.template-user", ["user" => $user])
    <chat-list></chat-list>

    @slot('script')
        var BaseRouterUrl = "chat";
        var isRouter = "chat";
    @endslot
@endcomponent



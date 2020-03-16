<div class="box-menu">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex flex-row">
                    @include("bootstrap.element.url", ["url" =>route("user",['user'=> $user->username]),
                    "className" =>"p-2", "titre" => "<i class=\"fa fa-home\"></i>Profil"])
                    @include("bootstrap.element.url", ["url" =>route("user.edit"),
                    "className" =>"p-2", "titre" => "<i class=\"fa fa-user\"></i>Editer"])
                    <a href="http://webmx2018.me/user/redmax/friends" class="p-2">
                        <i class="fa fa-user"></i>Ses Amis
                    </a>
                    <a href="http://webmx2018.me/user/redmax/tutoriels" class="p-2">
                        <i class="fa fa-user"></i>Ses Titoriels
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="card profile mb-3">
    <img src="{{asset($user->cover)}}" class="card-img-top" alt="...">
    <div class="card-body pt-5">
        <img src="{{asset($user->avatar)}}" alt="profile-image" class="card-image-profile">
        <h5 class="card-title">
            <i class="fa fa-circle text-success"></i>
            <a href="{{$user->present()->urlProfile}}">{{$user->username}}</a>
            <span>({{$user->roleName}})</span>
        </h5>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="description-block text-center">
                            <h5 class="description-header">
                                <a href="http://webmx2018.me/user/redmax/followers">{{$user->followers()->count()}}</a>
                            </h5>
                            <span class="description-text">Abonnements</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="description-block text-center">
                            <h5 class="description-header">
                                <a href="http://webmx2018.me/user/redmax/following">{{$user->following()->count()}}</a>
                            </h5>
                            <span class="description-text">Abonnés</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-secondary btn-block">
                            <i class="fa fa-user"></i> Suivre
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-primary btn-block">
                            <i class="fa fa-envelope"></i> Message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

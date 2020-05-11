<div class="card profile mb-3">
    <img src="{{asset($user->cover)}}" class="card-img-top" alt="...">
    <div class="card-body pt-5">
        <img src="{{asset($user->avatar)}}" alt="profile-image" class="card-image-profile">
        <h5 class="card-title">
            <status username="{{$user->username}}">
                <i class="fa fa-circle text-danger"></i>
            </status>
            <a href="{{$user->present()->urlProfile}}">{{$user->username}}</a>
            <span>({{$user->roleName}})</span>
        </h5>
        <friends :friends="{{\App\Services\Helper::ProfileStatus($user->id, Auth::id())}}"
                 :user="{{json_encode($user->present()->cordinate)}}" :activ="{{$user->id != auth()->id()? 1 : 0}}">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="description-block text-center">
                                <h5 class="description-header">
                                    <a href="{{route("user.following",[$user->username])}}">{{$user->following()->count()}}</a>
                                </h5>
                                <span class="description-text">Abonnements</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="description-block text-center">
                                <h5 class="description-header">
                                    <a href="{{route("user.followers",[$user->username])}}">{{$user->followers()->count()}}</a>
                                </h5>
                                <span class="description-text">Abonnés</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            @if($user->id != auth()->id())
                                {!!  \App\Services\Helper::ButtonFollow($user)!!}
                            @endif
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-envelope"></i> Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </friends>
    </div>
</div>

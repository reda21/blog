@extends('layouts.template')

@section("breadcrumb")
    {!! Breadcrumbs::render('profile', $user->username) !!}
@endsection

@section('content')
    <div class="col">
        <div class="row">
            <div class="divide30"></div>
            <div class="col">
                <div class="card profile">
                    <img src="{{asset($user->cover)}}" class="card-img-top" alt="...">
                    <div class="card-body pt-5 pb-0">
                        <img src="{{asset($user->avatar)}}" alt="profile-image"
                             class="card-image-profile">
                        <h5 class="card-title">
                            <i class="fa fa-circle text-success"></i>
                            <a href="{{$user->present()->urlProfile}}">{{$user->username}}</a>
                            <span>({{$user->roleName}})</span>
                        </h5>
                        <friends :friends="{{\App\Services\Helper::ProfileStatus($user)}}"
                                 :user="{{json_encode($user->present()->cordinate)}}" unit>
                            <div class="row mt-3">
                                <div class="col-md-6">
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
                                @if(Auth::id() != $user->id)
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-6">
                                                @if($user->id != auth()->id())
                                                    <button type="button" class="btn btn-outline-secondary btn-block">
                                                        <i class="fa fa-user"></i> Suivre
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-block">
                                                    <i class="fa fa-envelope"></i> Message
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </friends>
                        @include("user.layout.userMenu", compact("user"))
                    </div>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
@endsection

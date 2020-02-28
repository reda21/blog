@component("user.layout.template-user", ["user" => $user])
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Card title
                    </h5>
                </div>
                <div>
                    <div class="dropup">
                        <a class="btn btn-link after-none dropdown-toggle" href="#" role="button"
                           id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2 ">
                    <div class="profile-body">
                        <div class="profile-feilds">
                            <p class="labels"><span class="fa fa-user"></span> Nom</p>
                            <p class="value">{{$user->last_name}}</p>
                        </div>
                    </div>
                    <div class="profile-body">
                        <div class="profile-feilds">
                            <p class="labels"><span class="fa fa-user"></span> Prenom</p>
                            <p class="value">{{$user->first_name}}</p>
                        </div>
                    </div>
                    <div class="profile-body">
                        <div class="profile-feilds">
                            <p class="labels"><span class="fa fa-birthday-cake"></span> Date de naissance
                            </p>
                            <p class="value">{{$user->profile->birthday ? $user->profile->birthday->formatLocalized('%d/%m/%Y') : "--"}}</p>
                        </div>
                    </div>
                    <div class="profile-body">
                        <div class="profile-feilds">
                            <p class="labels"><span class="fa fa-venus-mars"></span> Gendre</p>
                            <p class="value">{{App\Services\Liste::GetSexe($user->profile->sexe)}}</p>
                        </div>
                    </div>
                    <div class="profile-body">
                        <div class="profile-feilds">
                            <p class="labels"><span class="fa fa-flag"></span> Pays</p>
                            <p class="value">{{App\Services\Liste::GetContry($user->profile->location ?? "default")}}</p>
                        </div>
                    </div>
                    @if($user->email_show)
                        <div class="profile-body">
                            <div class="profile-feilds">
                                <p class="labels"><span class="fa fa-user"></span> Email</p>
                                <p class="value"><a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
                            </div>
                        </div>
                    @endif
                    <ul class="text-center list-inline social-1">
                        @if($user->profile->facebook_username != "")
                            <li>
                                <a class="btn btn-fb btn-outline-facebook rounded-circle"
                                   href="http://www.facebook.com/{{$user->profile->facebook_username}}">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if ($user->profile->twitter_username != "")
                            <li>
                                <a class="btn btn-tw btn-outline-twitter rounded-circle"
                                   href="http://www.twitter.com/{{$user->profile->twitter_username}}">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if ($user->profile->google_plus_username != "")
                            <li>
                                <a class="btn btn-go btn-outline-google_plus rounded-circle"
                                   href="http://www.plus.google.com/{{$user->profile->google_plus_username}}">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        @endif
                        @if ($user->profile->pinterest_username != "")
                            <li>
                                <a class="btn btn-pt btn-outline-pinterest rounded-circle"
                                   href="http://www.pinterest.com/{{$user->profile->pinterest_username}}">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
                        @endif
                        @if ($user->profile->github_username != "")
                            <li>
                                <a class="btn btn-dr btn-outline-dribbble rounded-circle"
                                   href="http://www.dribbble.com/{{$user->profile->github_username}}">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endcomponent


<form method="POST" action="{{route("user.profil_update")}}">
    @csrf
    @include("bootstrap.form.select", ['name'=>'location','label'=>'Pays','list'=>App\Services\Liste::GetContry(),'value' => $user->profile->location ?? 'default'])
    @include('bootstrap.form.select',array('name'=>'sexe','label'=>'Gendre','list'=>App\Services\Liste::GetSexe(),'value' => $user->profile->sexe))
    @include("bootstrap.form.checkbox",array('name'=>'email_hidden','checked'=>$user->email_hide,'label'=>'Cacher l\'email'))
    @include('bootstrap.form.text',array('name'=>'facebook_username','label'=>'Pseudo Facebook','value' => $user->profile->facebook_username ))
    @include('bootstrap.form.text',array('name'=>'twitter_username','label'=>'Pseudo Twitter','value' => $user->profile->twitter_username))
    @include('bootstrap.form.text',array('name'=>'pinterest_username','label'=>'Pseudo Pinterest','value' => $user->profile->pinterest_username))
    @include('bootstrap.form.text',array('name'=>'google_plus_username','label'=>'Pseudo Google Plus','value' => $user->profile->google_plus_username))
    @include('bootstrap.form.text',array('name'=>'dribbble_username','label'=>'Pseudo Dribbble','value' => $user->profile->dribbble_username))
    @include("bootstrap.form.text", ['name' => 'github_username', 'label' => "Psuedo Guthub", "value" => $user->profile->github_username])
    @include("bootstrap.form.datetime", ['name' => 'birthday', 'label' => "Date de naissance", "value" => $user->profile->birthday])
    @include('bootstrap.form.textarea',array('name'=>'description','label'=>'Biographie','value' => $user->profile->description))
    <div class="row">
        <div class="col">
            <input class="btn btn-outline-primary btn-block" value="Mettre à jour" type="submit">
        </div>
        <div class="col">
            <input class="btn btn-outline-secondary  btn-block" value="Défaut" type="reset">
        </div>
    </div>
</form>

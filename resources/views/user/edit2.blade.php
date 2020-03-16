@component("user.layout.template-user", ["user" => $user])
    <div class="card mt-4">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" v-tab id="user-edit" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Paramètres de profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="test-tab" data-toggle="tab" href="#test" role="tab" aria-controls="test" aria-selected="false">Paramètres du compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar" aria-selected="false">Image du profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cover-tab" data-toggle="tab" href="#cover" role="tab" aria-controls="cover" aria-selected="false">Imagde du couverture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Administration de compte</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @include("user.layout.edit-profile")
                </div>
                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">account</div>
                <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">avatar</div>
                <div class="tab-pane fade" id="cover" role="tabpanel" aria-labelledby="cover-tab">clover</div>
                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">admin</div>
                <div class="tab-pane fade" id="test" role="tabpanel" aria-labelledby="test-tab">
                    <form>
                        @include("bootstrap.form.text", ["name" => "email","label" => "Nom D'utilisateur ou Adresse Email",
                            'placeholder' => "Entrer ton D'utilisateur ou ton Adress Email", "value" => old('email')])
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcomponent

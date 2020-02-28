<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://blog.me/css/bootstrap.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-4">
                <div class="card-header">
                    <ul id="myTab" role="tablist" class="nav nav-tabs card-header-tabs">
                        <li class="nav-item"><a id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                                aria-controls="profile" aria-selected="false" class="nav-link">Paramètres
                                de profil</a></li>
                        <li class="nav-item"><a id="test-tab" data-toggle="tab" href="#test" role="tab"
                                                aria-controls="test" aria-selected="true" class="nav-link active">Paramètres
                                du compte</a></li>
                        <li class="nav-item"><a id="avatar-tab" data-toggle="tab" href="#avatar" role="tab"
                                                aria-controls="avatar" aria-selected="false" class="nav-link">Image du
                                profile</a></li>
                        <li class="nav-item"><a id="cover-tab" data-toggle="tab" href="#cover" role="tab"
                                                aria-controls="cover" aria-selected="false" class="nav-link">Imagde du
                                couverture</a></li>
                        <li class="nav-item"><a id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                                                aria-controls="admin" aria-selected="false" class="nav-link">Administration
                                de compte</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div id="myTabContent" class="tab-content">
                        <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade">
                            <p>profile</p>
                        </div>
                        <div id="account" role="tabpanel" aria-labelledby="account-tab" class="tab-pane fade">
                            <p>account</p>
                        </div>
                        <div id="avatar" role="tabpanel" aria-labelledby="avatar-tab" class="tab-pane fade">
                            <p>avatar</p>
                        </div>
                        <div id="cover" role="tabpanel" aria-labelledby="cover-tab" class="tab-pane fade">
                            <p>cover</p>
                        </div>
                        <div id="admin" role="tabpanel" aria-labelledby="admin-tab" class="tab-pane fade">
                            <p>admin</p>
                        </div>
                        <div id="test" role="tabpanel" aria-labelledby="test-tab" class="tab-pane fade active show">
                            <p>test</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://blog.me/js/jquery.js"></script>
<script src="http://blog.me/js/popper.js"></script>
<script src="http://blog.me/js/bootstrap.js"></script>
<script>
    $(function () {
        var hash = window.location.hash;
        hash && $('ul.nav a[href="'+hash+'"]').tab("show");
        $(".nav-tabs a").click(function (e) {
            $(this).tab("show");
            window.location.hash = this.hash;
        });
    })
</script>
</body>
</html>

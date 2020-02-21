<?php


use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('users', route('user'));
});

// Home > users > profile
Breadcrumbs::for('profile', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user, route('user', ["user" => $user]));
});


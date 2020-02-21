@extends('layouts.template')

@section("breadcrumb")
    {!! Breadcrumbs::render('users') !!}
@endsection

@section('content')
    <div class="col">
        <div class="row">
            <div class="divide30"></div>
            @foreach($users as $user)
                <div class="col-12 col-md-6 col-lg-4">
                    @include("user.layout.ProfilItem", ['user' => $user])
                </div>
            @endforeach
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return View
     */
    public function welcome():View
    {
        return view('welcome');
    }

    /**
     * @return string
     */
    public function privacy():string
    {
        return "privacy";
    }

    /**
     * @return string
     */
    public function service():string
    {
        return "service";
    }
}

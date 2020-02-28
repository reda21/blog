<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * home page admin
     * @return View
     */
    public function index(): View
    {
        return view('admin.index');
    }

    /**
     * page test
     * @return View
     */
    public function tableau(): View
    {
        return view('admin.tableau');
    }
}

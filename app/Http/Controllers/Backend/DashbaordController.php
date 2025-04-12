<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function __construct()
    {
        // Apply auth middleware on all function in this controller
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('dashboard.pages.index');
    }
}

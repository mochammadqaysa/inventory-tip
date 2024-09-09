<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('pages.landing_page.index');
    }

    public function services()
    {
        return view('pages.landing_page.index');
    }

    public function portofolio()
    {
        return view('pages.landing_page.index');
    }

    public function about()
    {
        return view('pages.landing_page.index');
    }

    public function contacts()
    {
        return view('pages.landing_page.contacts');
    }
}

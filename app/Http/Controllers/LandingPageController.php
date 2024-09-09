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
        return view('pages.landing_page.services');
    }

    public function portofolio()
    {
        return view('pages.landing_page.portofolio');
    }

    public function about()
    {
        return view('pages.landing_page.about');
    }

    public function contacts()
    {
        return view('pages.landing_page.contacts');
    }
}

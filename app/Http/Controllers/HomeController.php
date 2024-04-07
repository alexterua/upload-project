<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return (Auth::check()) ? redirect()->to('/dashboard') : redirect()->route('login');
    }
}

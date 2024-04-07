<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /** @return RedirectResponse */
    public function index(): RedirectResponse
    {
        return (Auth::check()) ? redirect()->to('/dashboard') : redirect()->route('login');
    }
}

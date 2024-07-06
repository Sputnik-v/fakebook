<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $collectPhoto = $request->user()->images()->where('active_image', true)->get();

        $srcImage = $collectPhoto->toArray();

        $arraySrc = Arr::collapse($srcImage);


        $userName = \request()->user()->name;
        $userEmail = \request()->user()->email;
        return view('pages.dashboard', ['name' => $userName, 'email' => $userEmail, 'srcImage' => $arraySrc]);
    }
}

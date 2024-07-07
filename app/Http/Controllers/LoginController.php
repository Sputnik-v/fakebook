<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('pages.login');
    }


    public function store(StoreAuthRequest $request)
    {
        $remember = request()->boolean('remember');
        $data = $request->except(['_token', 'remember']);


        if(Auth::attempt($data, $remember))
        {
            $collectPhoto = $request->user()->images()->where('active_image', true)->get();
            $srcImage = $collectPhoto->toArray();
            $arraySrc = Arr::collapse($srcImage);
            if(!$arraySrc)
            {
                $arraySrc = '';
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard', ['user' => $request->user(), 'srcImage' => $arraySrc]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



}

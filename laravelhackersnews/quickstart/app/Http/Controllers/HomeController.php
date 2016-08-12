<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Artikel;
use App\Moderator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Artikel $artikel, Moderator $moderator, User $user)
    {

        $artikels = Artikel::with('user.votes')->orderBy('value', 'desc')->get();
        $isModerator = false;

        return view('home')->with('artikels', $artikels)->with('isModerator', $isModerator);
    }

    
    
}

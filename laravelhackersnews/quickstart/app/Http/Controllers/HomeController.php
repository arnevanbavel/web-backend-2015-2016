<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Vote;
use App\Artikel;
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
    public function index(Artikel $artikel, User $user)
    {
        $votes = Vote::all();
        $artikels = Artikel::with('user.votes')->orderBy('value', 'desc')->get();
        return view('home')->with('artikels', $artikels)->with('votes', $votes);
    }

    
    
}

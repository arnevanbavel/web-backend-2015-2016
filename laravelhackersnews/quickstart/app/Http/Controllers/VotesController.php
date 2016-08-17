<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artikel;
use App\Vote;
use Auth;
use DB;
use Session;
use App\User;
use App\Http\Requests;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voteup($id)
    {        
        $this->first($id);
        
        $vote = DB::table('votes')
        ->where('user_id', '=', Auth::user()->id)
        ->where('artikel_id', '=', $id)
        ->first();
        
        $artikel = Artikel::findOrFail($id);
        
        if($vote->algeklikt == false){            
           
            $artikel->value++;
            $vote->down = true;
            $vote->up = false;
            $vote->algeklikt = true;
            
        }elseif($vote->down == false && $vote->up == true){
            
            $artikel->value++;
            $artikel->value++;
            
            $vote->down = true;
            $vote->up = false;
        }
        
        $artikel->save();
        DB::table('votes')
            ->where('user_id', '=', Auth::user()->id)
            ->where('artikel_id', '=', $id)
            ->update(['down' => $vote->down,'up' => $vote->up,'algeklikt' => $vote->algeklikt]);
        
        Session::put('notiftype', 'succes');
        Session::put('notifmessage', 'You have upvoted "' . $artikel->title .'"');
        return back();
    }
    
    public function votedown($id)
    {
        $this->first($id);
        
        $vote = DB::table('votes')
        ->where('user_id', '=', Auth::user()->id)
        ->where('artikel_id', '=', $id)
        ->first();
        
        $artikel = Artikel::findOrFail($id);
        
        if($vote->algeklikt == false){            
           
            $artikel->value--;
            $vote->down = false;
            $vote->up = true;
            $vote->algeklikt = true;
            
        }elseif($vote->down == true && $vote->up == false){
            
            $artikel->value--;
            $artikel->value--;
            
            $vote->down = false;
            $vote->up = true;
        
        }
        
        $artikel->save();
        DB::table('votes')
            ->where('user_id', '=', Auth::user()->id)
            ->where('artikel_id', '=', $id)
            ->update(['down' => $vote->down,'up' => $vote->up,'algeklikt' => $vote->algeklikt]);
        
        Session::put('notiftype', 'succes');
        Session::put('notifmessage', 'You have downvoted "' . $artikel->title .'"');
        return back();
    }
    
    public function first($id)
    {        
        $user = DB::table('votes')
        ->where('user_id', '=', Auth::user()->id)
        ->where('artikel_id', '=', $id)
        ->first();
    
        if (is_null($user)) {
            
    	$vote = new Vote;

    	$vote->artikel_id = $id;
    	$vote->user_id = Auth::user()->id;

    	$vote->save();
            
        } 
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

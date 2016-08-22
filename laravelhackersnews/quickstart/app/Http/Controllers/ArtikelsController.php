<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Artikel;
use App\User;
use App\Comment;
use DB;
use Session;

class ArtikelsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('artikel/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'title' => 'required|max:255',           
            'link' => 'required'   
        ]);
        
        if (!filter_var($request->link, FILTER_VALIDATE_URL)) 
        { 
            Session::put('notiftype', 'error');
            Session::put('notifmessage', 'The url format is invalid.');
            return back();
        }
    
        $request->user()->artikels()->create([
            'title' => $request->title,
            'link' => $request->link
        ]);
        
        Session::put('notiftype', 'success');
        Session::put('notifmessage', 'Je hebt het artikel "' . $request->title . '" toegevoegd!');
        return redirect('/home');
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
        $artikel = Artikel::findOrFail($id);
        return view('artikel.edit', compact('artikel'));
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
        $artikel = Artikel::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|max:255'. $artikel->id,
            'link' => 'required'
        ]);
        
        if (!filter_var($request->link, FILTER_VALIDATE_URL)) 
        { 
            Session::put('notiftype', 'error');
            Session::put('notifmessage', 'The url format is invalid.');
            return back();
        }
        
        $data = $request->only('title', 'link');

        $artikel->update($data);
        
        Session::put('notiftype', 'succes');
        Session::put('notifmessage', 'Article ' . $artikel->title . ' edited successfully');  
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmdestroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        Session::put('notiftype', 'warning');
        Session::put('notifmessage', 'Are you sure you want to delete "' . $artikel->title . '" comment?');
        Session::put('delete', 'TRUE');

        return back();
    }
    
    public function destroy($id)
    {
        $vote = DB::table('votes')->where('artikel_id', $id);
        $vote->delete();
        
        $comment = DB::table('comments')->where('artikel_id', $id);
        $comment->delete();
        
        Session::put('notiftype', 'succes');
        Session::put('notifmessage', 'Article deleted successfully');  
        
        Artikel::find($id)->delete();
        
        
        return redirect('/home');
    }
}

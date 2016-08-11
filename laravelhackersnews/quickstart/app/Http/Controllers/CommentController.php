<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artikel;
use App\User;
use App\Comment;
use App\Http\Requests;
use DB;

class CommentController extends Controller
{
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
        $this->validate($request, [
            'comment' => 'required|max:255' 
        ]);
    
        $request->user()->comments()->create([
            'comment' => $request->comment,
            'artikel_id' => $request->artikel_id,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function show($id)
    {
        
        $artikel = Artikel::findOrFail($id);
          
          $comments = Comment::with('user')
                    ->where('artikel_id', '=', $id)
                    ->get();
          
          /*
        $comments = DB::table('comments')               Niet op deze manier DB bypassed Eloquent relatie is dan weg
                    ->where('artikel_id', '=', $id)
                    ->get();
          */
          
        return view('artikel.show', compact('comments', 'artikel'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.edit', compact('comment'));
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
          
        $comment = Comment::findOrFail($id);
        $this->validate($request, [
            'comment' => 'required|max:255' 
        ]);
    
        $data = $request->only('comment');
        $comment->update($data);
        
        $artikel = Artikel::findOrFail($request->artikel_id);
        $comments = Comment::with('user')
                    ->where('artikel_id', '=', $id)
                    ->get();
           
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::find($id)->delete();
        return redirect('/home');
    }
}

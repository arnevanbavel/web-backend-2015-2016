<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TodoRepository;
use Session;

class TodoController extends Controller
{

  // tweede versie controller

  protected $todos;

    public function __construct(TodoRepository $todos)
    {
        $this->middleware('auth');
        $this->todos = $todos;
    }

    public function indextest(Request $request)
    {
        return view('todos.test', ['todos' => $this->todos->forUser($request->user()), ]);
    }

    public function storetest(Request $request)
    {
        $this->validate($request, ['name' => 'required|max:255',]);
        $request->user()->todos()->create([ 'name' => $request->name,]);

        Session::put('notiftype', 'success');
        Session::put('notifmessage', 'Je hebt de taak "' . $request->name . '" toegevoegd!');
        return redirect('/test');
    }

    public function destroytest(Request $request, Todo $todo)
    {
        $this->authorize('destroy', $todo);
        $todo->delete();
        
        Session::put('notiftype', 'warning');
        Session::put('notifmessage', 'Je hebt de taak  "' . $todo->name . '" verwijderd');
        return redirect('/test');
     }

    public function completedtest(Request $request, Todo $todo)
    {
        $this->authorize('destroy', $todo);
        
        if ($todo->completed == 0) 
        {
            $todo->completed = 1;
            Session::put('notiftype', 'success');
            Session::put('notifmessage', 'Je taak "' . $todo->name . '" is klaar');
        } 
        else 
        {
            $todo->completed = 0;
            Session::put('notiftype', 'info');
            Session::put('notifmessage', 'Je taak "' . $todo->name . '" is back in business');
        }
        $todo->save();
      
        return redirect('/test');
    }
}

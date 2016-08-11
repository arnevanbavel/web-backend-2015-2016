<?php

namespace App\Repositories;

use App\User;
use App\Todo;

class TodoRepository
{
    public function forUser(User $user)
    {

        return Todo::where('user_id', $user->id)
                    ->orderBy('completed', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->paginate(10);
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
   /**
    * Filter by Author
    */
    public function filter(User $user)
    {
        return view('web.filter-articles', [
            'title' => $user->name,
            'articles' => $user->articles
        ]);
    }
}

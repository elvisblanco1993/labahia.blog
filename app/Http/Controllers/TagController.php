<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function filter($tag)
    {
        $filter = Tag::where('slug', $tag)->first();
        return view('web.filter-articles', [
            'title' => $filter->name,
            'articles' => $filter->articles()->whereNotNull('published_at')->get()
        ]);
    }
}

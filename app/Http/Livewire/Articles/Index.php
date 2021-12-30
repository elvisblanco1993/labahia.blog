<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $query;
    protected $response;
    protected $articles;

    public function render()
    {
        $this->response = Gate::inspect('viewAny', [auth()->user()]);

        return view('livewire.articles.index', [
            'articles' => ($this->response->allowed())
                            ?
                            Article::withTrashed()->where('title', 'like', '%' . $this->query . '%')->paginate(50)
                            :
                            auth()->user()->articles()->withTrashed()->where('title', 'like', '%' . $this->query . '%')->paginate(50)
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function public()
    {
        return view('web.articles', [
            'articles' => Article::with('user')->whereNotNull('published_at')->orderBy('created_at', 'desc')->paginate(13)
        ]);
    }

    public function view($article)
    {
        $article = Article::where('slug', $article)->whereNotNull('published_at')->first();
        $article->getArticleReads($article->id, $article->user->id, request()->getClientIp());
        $estimated_read_time = ( floor(str_word_count(strip_tags($article->body)) /200 ) > 0) ? floor(str_word_count(strip_tags($article->body)) / 200) : "about 1";

        return view('web.view-article', [
            'article' => $article,
            'read_time' => $estimated_read_time
        ]);
    }

    public function publish(Article $article)
    {
        // Publish or Unpublish an article
        $article->published_at = ( isset($article->published_at) ) ? null : Carbon::now();
        $article->update();
        return redirect()->route('articles');
    }

    public function delete(Article $article)
    {
        $article->published_at = null;
        $article->update();
        // Soft Deletes an Article
        $article->delete();

        request()->session()->flash('flash.banner', 'Article successfully deleted');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('articles');
    }

    public function restore($article)
    {
        $article = Article::withTrashed()->find($article);
        // Restore an Article
        $article->restore();

        request()->session()->flash('flash.banner', 'Article successfully restored');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('articles');
    }

    public function deleteForever($article)
    {
        $article = Article::withTrashed()->find($article);
        // Detach tags
        $article->tags()->detach();
        // Delete statistics associated with the article
        DB::table('article_reads')->where('article_id', $article->id)->delete();
        // Delete Article Forever
        $article->forceDelete();

        request()->session()->flash('flash.banner', 'Article was completely deleted!');
        request()->session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('articles');
    }
}

<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Writer extends Component
{

    public $totalArticleReads, $postsMade, $avgArticleReads, $monthlyIncrease, $monthlyIncreasePercentage, $monthlyCount;

    public function mount()
    {
        $this->articles = auth()->user()->articles;
    }

    public function getTotalArticleReads()
    {
        return DB::table('article_reads')->where('user_id', auth()->user()->id)->sum('reads');
    }

    public function getAvgArticleReads()
    {
        return (Article::where('user_id', auth()->user()->id)->count() > 0) ? DB::table('article_reads')->where('user_id', auth()->user()->id)->sum('reads') / Article::where('user_id', auth()->user()->id)->count() : 0 ;
    }

    public function getArticlesMade()
    {
        return auth()->user()->articles->count();
    }

    public function getMonthlyIncrease()
    {
        $untilLastMonth = (int) DB::table('article_reads')->where('user_id', auth()->user()->id)->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('reads');
        $currentMonth = (int) DB::table('article_reads')->where('user_id', auth()->user()->id)->whereMonth('created_at', Carbon::now()->format('m'))->sum('reads');
        return $currentMonth - $untilLastMonth;
    }

    public function getMonthlyIncreasePercentage()
    {
        $untilLastMonth = (int) DB::table('article_reads')->where('user_id', auth()->user()->id)->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('reads');
        $currentMonth = (int) DB::table('article_reads')->where('user_id', auth()->user()->id)->whereMonth('created_at', Carbon::now()->format('m'))->sum('reads');

        if ($untilLastMonth > 0) {
            $math = ( ($currentMonth - $untilLastMonth) / abs($untilLastMonth) ) * 100;
        } else {
            if ($currentMonth > 0) {
                $math = 100;
            } else {
                $math = 0;
            }
        }
        return $math;
    }

    public function getMonthlyCount()
    {
        return DB::table('article_reads')
                ->where('user_id', auth()->user()->id)
                ->select(DB::raw("COUNT(*) as total, DATE_FORMAT(created_at, '%m') as month, DATE_FORMAT(created_at, '%Y') as year, DATE_FORMAT(created_at, '%b') as month_label"))
                ->groupBy('month')
                ->groupBy('year')
                ->groupBy('month_label')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->take(24)
                ->get()
                ->toArray();
    }

    public function getMostPopularArticles()
    {
        return DB::table('article_reads')
                ->where('article_reads.user_id', auth()->user()->id)
                ->join('articles', 'article_reads.article_id', '=', 'articles.id')
                ->select('articles.title as title', DB::raw('COUNT(*) as total'))
                ->groupBy('article_reads.article_id')
                ->orderBy('total', 'DESC')
                ->get(10) ?? 0;
    }

    public function getMostReadsByRegion()
    {
        return DB::table('article_reads')
                ->where('user_id', auth()->user()->id)
                ->select('region', DB::raw('COUNT(*) as total'))
                ->groupBy('region')
                ->orderBy('total', 'DESC')
                ->take(10)
                ->get();
    }

    public function render()
    {
        $this->totalArticleReads = $this->getTotalArticleReads();
        $this->articlesMade = $this->getArticlesMade();
        $this->avgArticleReads = $this->getAvgArticleReads();
        $this->monthlyIncrease = $this->getMonthlyIncrease();
        $this->monthlyIncreasePercentage = $this->getMonthlyIncreasePercentage();
        $this->monthlyCount = $this->getMonthlyCount();
        $this->mostPopularArticles = $this->getMostPopularArticles();
        $this->mostReadsByRegion = $this->getMostReadsByRegion();

        return view('livewire.dashboard.writer');
    }
}

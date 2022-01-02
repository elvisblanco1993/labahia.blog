<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Admin extends Component
{

    public $totalArticleReads, $postsMade, $avgArticleReads, $monthlyIncrease, $monthlyIncreasePercentage, $monthlyCount;

    public function mount()
    {
        $this->articles = Article::all();
    }

    public function getTotalArticleReads()
    {
        return DB::table('article_reads')->sum('reads');
    }

    public function getAvgArticleReads()
    {
        return (Article::count() > 0) ? DB::table('article_reads')->sum('reads') / Article::count() : 0;
    }

    public function getArticlesMade()
    {
        return $this->articles->count();
    }

    public function getMonthlyIncrease()
    {
        $untilLastMonth = (int) DB::table('article_reads')->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('reads');
        $currentMonth = (int) DB::table('article_reads')->whereMonth('created_at', Carbon::now()->format('m'))->sum('reads');
        return $currentMonth - $untilLastMonth;
    }

    public function getMonthlyIncreasePercentage()
    {
        $untilLastMonth = (int) DB::table('article_reads')->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))->sum('reads');
        $currentMonth = (int) DB::table('article_reads')->whereMonth('created_at', Carbon::now()->format('m'))->sum('reads');

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
                ->select(DB::raw("COUNT(*) as total, DATE_FORMAT(created_at, '%m') as month, DATE_FORMAT(created_at, '%Y') as year, DATE_FORMAT(created_at, '%b') as month_label"))
                ->groupBy('month')
                ->groupBy('year')
                ->groupBy('month_label')
                ->orderBy('month', 'asc')
                ->take(24)
                ->get()
                ->toArray();
    }

    public function getMostPopularArticles()
    {
        return DB::table('article_reads')
                ->join('articles', 'article_reads.article_id', '=', 'articles.id')
                ->select('articles.title as title', DB::raw('COUNT(*) as total'))
                ->groupBy('article_reads.article_id')
                ->orderBy('total', 'DESC')
                ->get(10) ?? 0;
    }

    public function getMostReadsByRegion()
    {
        return DB::table('article_reads')
                ->select('region', DB::raw('COUNT(*) as total'))
                ->groupBy('region')
                ->orderBy('total', 'DESC')
                ->take(20)
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

        return view('livewire.dashboard.admin');
    }
}

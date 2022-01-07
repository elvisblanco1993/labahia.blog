<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'slug',
        'body',
        'image',
        'published_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Post views counter
     *
     * Simple posts visits counter. This will help display to the writers some statistics.
     *
     * @uses post id
     *
     * @return boolean
     */
    public function getArticleReads($article_id, $user_id, $remote_ip) {

        $this->article_id = $article_id;
        $this->remote_ip = $remote_ip;
        $this->region = null;


        if ($this->remote_ip != "127.0.0.1") {
            $this->position = Location::get($this->remote_ip);
            $this->region = $this->position->cityName . ', ' . $this->position->countryName;
        }

        /**
         * Search for any previous sessions. If the same person visited the same post multiple
         * times, from the same computer, a new visit will only be registered after 30 minutes
         * have passed. All interactions within 30 minutes that come from the same IP will be
         * considered as part of the same session.
         */

        $record = DB::table('article_reads')
            ->where('article_id', $this->article_id)
            ->where('region', $this->region)
            ->where('updated_at', '>', Carbon::now()->subMinutes(10)->toDateTimeString() )
            ->get()
            ->toArray();

        if ( count( $record ) < 1) {
            // Create record on database.
            DB::table('article_reads')->insert([
                'article_id' => $this->article_id,
                'user_id' => $user_id,
                'region' => $this->region,
                'reads' => 1,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        }
    }

    public function comments()
    {
        return Comment::where('article_id', $this->id)->get()->toArray();
    }
}

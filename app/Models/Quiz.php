<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'finished_at', 'status', 'slug'];

    protected $dates = ['finished_at'];

    protected $appends = ['details', 'my_rank'];

    public function getDetailsAttribute()
    {
        return (object) [
            'average'       => round($this->results()->avg('point')),
            'join_count'    => $this->results()->count(),
        ];
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function top_ten()
    {
        return $this->results()->orderBy('point', 'desc')->limit(10);
    }

    public function getMyRankAttribute()
    {
        $rank = 0;
        foreach ($this->results()->orderBy('point', 'desc')->get() as $item) {
            $rank++;
            if(auth()->user()->id == $item->user_id)
                return $rank;
        }
    }

    public function my_result()
    {
        return $this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id);
    }

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date) : null;
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    public function sluggable(): array
    {
        return [
            'slug'  => [
                'onUpdate'  => true,
                'source'    => 'title'
            ]
        ];
    }
}

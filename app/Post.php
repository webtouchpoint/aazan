<?php

namespace App;

use App\Model;

use App\Traits\{
    Sluggable,
    live
};

class Post extends Model
{
    use Sluggable, Live;

  	protected $dates = ['published_at'];
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

  	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */  
    protected $casts = [
        'live' => 'boolean',
    ];  

  	public function scopeLatestFirst($query)
    {          
        return $query->orderBy('published_at', 'desc');
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

  	public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getContentAttribute($content) 
    {
        return \Purify::clean($content);
    }

    /**
     * Sync tag relation adding new tags as needed
     *
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        if (count($tags)) {
            $this->tags()->sync($tags);
            return;
        }

        $this->tags()->detach();
    }
}

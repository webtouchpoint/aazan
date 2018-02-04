<?php

namespace App;

use App\Model;
use App\Traits\{
	Sluggable,
    SyncTags,
	Live
};

class Video extends Model
{
	use Sluggable, SyncTags, Live;

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}

	public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

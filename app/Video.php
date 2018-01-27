<?php

namespace App;

use App\Model;
use App\Traits\{
	Sluggable,
	Live
};

class Video extends Model
{
	use Sluggable, Live;

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}
}

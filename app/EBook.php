<?php

namespace App;

use App\Model;
use App\Traits\Sluggable;

class EBook extends Model
{
	use Sluggable;

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

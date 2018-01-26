<?php

namespace App\Traits;

trait Live {	
	public function scopeIsLive($query)
    {
        return $query->where('live', true);
    }
}
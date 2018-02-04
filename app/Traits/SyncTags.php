<?php

namespace App\Traits;

trait SyncTags 
{	
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
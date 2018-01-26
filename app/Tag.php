<?php

namespace App;

use App\Model;

class Tag extends Model
{
	public function getRouteKeyName()
    {
        return 'slug';
    }
    
    /**
     * Set the title attribute and automatically the slug
     *
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (! $this->exists) {
            $this->setUniqueSlug($value, '');
        }
    }

    /**
     * Recursive routine to set a unique slug
     *
     * @param string $name
     * @param mixed $extra
     */
    protected function setUniqueSlug($name, $extra)
    {
        $slug = str_slug($name.'-'.$extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($name, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}

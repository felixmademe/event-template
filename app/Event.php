<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    protected $fillable =
    [
      'name', 'location', 'description', 'public', 'registration',
      'max_visitors', 'start_time', 'mail_release_time',
      'registration_close_time', 'slug', 'image_banner',
      'price', 'swish'
    ];

    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage( 'sv' )
            ->doNotGenerateSlugsOnUpdate()
            ->slugsShouldBeNoLongerThan( 30 );
    }

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
     * Get the participants for the event.
     */
    public function participants()
    {
        return $this->hasMany( 'App\Participant' );
    }
}

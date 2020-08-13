<?php

namespace App;

use App\Http\Requests\ParticipantRequest;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Participant extends Model
{
    protected $fillable =
    [
        'name', 'email', 'phone', 'event_id', 'paid', 'checked', 'checked_when', 'slug', 'birth_date'
    ];

    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom( [ 'event_id', 'name' ] )
            ->saveSlugsTo( 'slug' )
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
     * Get the event the participant is registered to.
     */
    public function event()
    {
        return $this->belongsTo( 'App\Event' );
    }

    /**
     * Checks if email is valid and do not contain blacklisted domains.
     *
     * @param string $email
     * @return boolean
     */
    public static function validateEmail( $email )
    {
        $blacklist =
        [
            'example',
        ];

        $email = explode( '@', $email )[ 1 ];

        foreach( $blacklist as $domain )
        {
            if( strpos( $email, $domain ) !== FALSE )
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Add correct paid status to new participant.
     *
     * @param Participant $participant
     * @param Event $event
     */
    public static function setPaidStatus( $participant, $event )
    {
        $participant->paid = $event->price == 0;
        $participant->save();
    }
}

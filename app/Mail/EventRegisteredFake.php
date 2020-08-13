<?php

namespace App\Mail;

use App\Event;
use App\Http\Requests\ParticipantRequest;
use App\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRegisteredFake extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Participant
     * @var Event
     */
    public $participant;
    public $event;

    /**
     * Create a new message instance.
     *
     * @param $participant
     * @param Event $event
     */
    public function __construct( $participant, Event $event )
    {
        $this->participant = $participant;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( config( 'mail.from.address' ), config( 'mail.from.name' ) )
            ->replyTo( config( 'mail.from.address' ) )
            ->subject( $this->event->name )
            ->view('emails.events.registered');
    }
}

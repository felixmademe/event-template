<?php

namespace App\Mail;

use App\Http\Requests\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $text;

    /**
     * Create a new message instance.
     *
     * @param ContactRequest $request
     */
    public function __construct( ContactRequest $request )
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->text = $request->text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( config( 'mail.from.name' ), config( 'mail.from.name' ) )
            ->subject( 'Kontaktförfrågan' )
            ->replyTo( $this->email )
            ->view('emails.contacts.form');
    }
}

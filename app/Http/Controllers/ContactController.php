<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use App\Validators\ReCaptcha;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function form()
    {
        return view( 'contacts.form' );
    }

    public function send( ContactRequest $request )
    {
        $validated = $request->validated();
        $recaptcha = ReCaptcha::validate( $request->recaptcha );

        if( $validated && $recaptcha )
        {
            Mail::to( config( 'mail.from.address' ) )->queue( new Contact( $request ) );
            return redirect()->back()->with( 'success', 'Ditt meddelande har skickats!' );
        }
        return redirect()->back()->with( 'error', 'Något gick fel!' );
    }
}

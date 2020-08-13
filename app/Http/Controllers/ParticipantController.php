<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\ParticipantRequest;
use App\Jobs\RegisterEventEmail;
use App\Mail\EventRegistered;
use App\Mail\EventRegisteredFake;
use App\Participant;
use App\Validators\ReCaptcha;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        abort( 404 );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function create( $slug )
    {
        $event = Event::where( 'slug', $slug )->first();

        return view( 'participants.create' )->with( 'event', $event );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ParticipantRequest $request
     * @return RedirectResponse
     */
    public function store( ParticipantRequest $request )
    {
        $validated = $request->validated();

        //$validEmail = Participant::validateEmail( $request->email );
        $validEmail = true;

        $recaptcha = $request->type && $request->type == 'admin' ? true : ReCaptcha::validate( $request->recaptcha );

        $event = Event::find( $request->event_id );
        if( count( $event->participants ) >= $event->max_visitors )
        {
            return redirect()->back()->with( 'error', 'Max antal beöskare registrerad.' );
        }

        if( !$validEmail )
        {
            Mail::to( [ $request->email, env( 'MAIL_FROM_ADDRESS' ) ] )
                ->queue( new EventRegisteredFake( $request->all(), $event ) );

            return redirect()->back()->with( 'success', 'Du är nu registrerad på ' . $event->name );
        }

        if( $validated && !empty( $event ) && $recaptcha )
        {
            $participant = Participant::create( $request->except( '_token', 'recaptcha' ) );
            Participant::setPaidStatus( $participant, $event );

            Mail::to( $participant->email )
                ->queue( new EventRegistered( $participant, $event ) );

            if( $request->type == 'admin' )
            {
                return redirect()->route( 'events.admin', $event->slug )->with( 'success', 'Deltagare tillagd!' );
            }

            return redirect()->back()->with( 'success', 'Du är nu registrerad på ' . $event->name );
        }

        return redirect()->back()->with( 'error', 'Något gick fel!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return Factory|View
     */
    public function show( $slug )
    {
        $participant = Participant::where( 'slug', $slug  )->first();

        return view( 'participants.show' )->with( 'participant', $participant );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return Factory|View
     */
    public function edit( $slug )
    {
        $participant = Participant::where( 'slug', $slug  )->first();

        return view( 'participants.edit' )->with( 'participant', $participant );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $slug
     * @return RedirectResponse
     */
    public function update( Request $request, $slug )
    {
        $participant = Participant::where( 'slug', $slug  )->first();
        $participant->update( $request->except( '_token', '_method' ) );

        return redirect()->back()->with( 'success', 'Deltagare uppdaterad.' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return Factory|View
     */
    public function destroy( $slug )
    {
        $participant = Participant::where( 'slug', $slug  )->first();
        $event = $participant->event;
        $participant->delete();

        return view( 'events.admin' )->with( 'event', $event )->with( 'success', 'Deltagare borttagen.' );
    }

    /**
     * Update check in status on specified resource.
     *
     * @param Request $request
     * @param  int  $slug
     * @return RedirectResponse
     */
    public function checked( Request $request, $slug )
    {
        $participant = Participant::where( 'slug', $slug  )->first();

        if( $request->checked == true )
        {
            $participant->checked = $request->checked;
            $participant->checked_when = now();
        }
        else
        {
            $participant->checked = false;
            $participant->checked_when = null;
        }
        $participant->save();

        return redirect()->back()->with( 'success', 'Deltagare incheckad.' );
    }

    /**
     * Update paid status on specified resource.
     *
     * @param Request $request
     * @param  int  $slug
     * @return RedirectResponse
     */
    public function paid( Request $request, $slug )
    {
        $participant = Participant::where( 'slug', $slug  )->first();

        if( $request->paid )
        {
            $participant->paid = $request->paid;
        }
        else
        {
            $participant->checked = false;
            $participant->checked_when = null;
            $participant->paid = false;
        }

        $participant->save();

        return redirect()->back()->with( 'success', 'Deltagare markerad som betald.' );
    }
}

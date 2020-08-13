<?php

namespace App\Http\Controllers;

use App\Event;
use App\Exports\ParticipantExport;
use App\Http\Requests\EventRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        if( Auth::id() != null )
        {
            // Authenticated
            $events = Event::with( 'participants' )->get();
        }
        else
        {
            $events = Event::where( 'public', true )->with( 'participants' )->get();
        }
        $events = $events->sortByDesc( 'created_at' );

        return view( 'events.index' )->with( 'events', $events );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view( 'events.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventRequest $request
     * @return Factory|View
     * @return RedirectResponse
     */
    public function store( EventRequest $request )
    {
        $validated = $request->validated();
        if( $validated )
        {
            $event = Event::create( $request->except( '_token' ) );
            return view( 'events.show' )->with( 'event', $event );
        }
        return redirect()->back()->with( 'error', 'Något gick fel!' );
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function show( $slug )
    {
        $event = Event::where('slug', $slug)->first();
        return view( 'events.show' )->with( 'event', $event );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function edit( $slug )
    {
        $event = Event::where( 'slug', $slug )->first();

        return view( 'events.edit' )->with( 'event', $event );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventRequest $request
     * @param $slug
     * @return Factory|View
     */
    public function update( EventRequest $request, $slug)
    {
        $validated = $request->validated();
        $event = Event::where( 'slug', $slug )->first();

        if( $validated )
        {
            $event->update( $request->except( '_token', '_method' ) );
            return view( 'events.show' )->with( 'event', $event );
        }
        return redirect()->back()->with( 'error', 'Något gick fel!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return RedirectResponse
     */
    public function destroy( $slug )
    {
        $event = Event::where( 'slug', $slug )->first();
        $event->delete();

        return redirect()->to( 'evenemang' )->with( 'success', 'Event borttaget!' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function admin( $slug )
    {
        $event = Event::where( 'slug', $slug )->with( 'participants' )->first();

        return view( 'events.admin' )->with( 'event', $event );
    }

    /**
     * Update registration status on specified event.
     *
     * @param Request $request
     * @param  string $slug
     * @return Factory|View
     */
    public function registration( Request $request, $slug )
    {
        $event = Event::where( 'slug', $slug )->first();

        $event->registration = $request->registration;
        $event->save();

        return view( 'events.admin' )->with( 'event', $event );
    }

    /**
     * Update public status on specified event.
     *
     * @param Request $request
     * @param  string $slug
     * @return Factory|View
     */
    public function public( Request $request, $slug )
    {
        $event = Event::where( 'slug', $slug )->first();

        $event->public = $request->public;
        $event->save();

        return view( 'events.admin' )->with( 'event', $event );
    }

    /**
     * Exports participants on specific event.
     *
     * @param  string  $slug
     * @return Response|BinaryFileResponse
     */
    public function export( $slug )
    {
        $event = Event::where( 'slug', $slug )->first();

        return ( new ParticipantExport( $event->id ) )->download( 'deltagare.csv', Excel::CSV, [
                'Content-Type' => 'text/csv',
            ] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function hidden()
    {
        $events = Event::where( 'public', false )->with( 'participants' )->get();

        return view( 'events.hidden' )->with( 'events', $events );
    }
}

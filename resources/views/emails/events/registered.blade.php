@extends( 'layouts.mail' )
@section( 'content' )
    <div>
        <h1><a href="{{ route( 'events.show', $event->slug ) }}">{{ $event->name }}</a></h1>
        <p>
            Du är nu registrerad på evenemanget {{ $event->name }}. Se nedan för mer information.
        </p>
        <hr>
        <h3>
            Vad kan du göra nu?
        </h3>
        <p>
            - Tagga till, snart är det dags för fest!
            <br>
            -
            @if( $event->price === 0 )
                Eventet är gratis, va på plats vid rätt tid.
            @else
                @if( $event->swish )
                    Swisha <b><u>{{ $event->price }}kr</u></b> till {{ $event->swish }} så snart som möjligt.
                @else
                    Ta med {{ $event->price }} till evenemanget, betalning sker på plats.
                @endif
            @endif
        </p>
        <h3>Information om evenemanget</h3>
        <p>
            <b>Plats:</b> {{ $event->location }}
            <br>
            <b>Datum:</b> {{ $event->start_time }}
            <br>
            Gå till <a target="_blank" href="{{ route( 'events.show', $event->slug ) }}">evenemang</a>.
        </p>
    </div>

@endsection

@extends( 'layouts.app' )
@section( 'content' )

    @if( $events->isEmpty() )
        <div class="h-100 d-flex justify-content-center align-content-center">
            <div class="card col-md-8">
                <div class="card-body text-center">
                    <h1>Inga aktiva evenemang</h1>
                    @auth
                        <p>
                            Sätt igång och skapa ett evenemang redan nu.
                        </p>
                        <a class="btn btn-primary btn-expand" href="{{ route( 'events.create' ) }}">Skapa evenemang</a>
                    @else
                        <p>
                            Kom gärna tillbaka senare. Har du några frågor eller funderingar, hör gärna av dig till oss.
                        </p>
                        <a class="btn btn-primary btn-expand" href="{{ route( 'contacts' ) }}">Kontakta oss</a>
                    @endauth

                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            @foreach( $events as $event )
                <div class="card col-lg-5 m-2 bg-light">
                    <a href="{{ route( 'events.show', $event->slug ) }}">
                        @if( !empty( $event->image_banner ) )
                            <img class="card-img-top overflow-img" src="{{ $event->image_banner }}" alt="Bild som beskriver eventet grafiskt.">
                        @else
                            <img class="card-img-top overflow-img" src="{{ asset( 'img/event-background.jpg' ) }}" alt="{{ config( 'app.name' ) }} background">
                        @endif
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{ $event->name }}</h4>
                        <p>
                            {{ strlen( $event->description ) > 120 ? substr( $event->description, 0, strpos( $event->description,' ', 120 ) ) . '...' : $event->description }}
                        </p>
                        @auth
                            @if( !$event->public )
                                <hr>
                                <span class="text-secondary">
                                    <b>Evegemanget är gömt!</b>
                                    <small>
                                        Detta evaengemang syns inte för vanliga användare.
                                        Tryck på <a href="{{ route( 'events.admin', $event->slug ) }}">hantera evangemang</a> om du vill ändra detta.
                                    </small>
                                </span>
                            @endif
                        @endauth
                        <hr>
                        @if( $event->registration )
                            <a class="btn btn-primary btn-expand my-1" href="{{ route( 'events.show', $event->slug ) }}">Gå till anmälan</a>
                        @else
                            <a class="btn btn-primary btn-expand my-1" href="{{ route( 'events.show', $event->slug ) }}">Mer information</a>
                        @endif
                        @auth
                            <br>
                            <a class="btn btn-secondary btn-expand my-1" href="{{ route( 'events.admin', $event->slug ) }}">Hantera evengemang</a>
                            <a class="btn btn-outline-secondary btn-expand my-1" href="{{ route( 'events.edit', $event->slug ) }}">Ändra information</a>
                            <hr>
                            <h5>Snabbinfo</h5>
                            <p>Antal anmälda: {{ count($event->participants) }} av {{ $event->max_visitors }}</p>
                            <p>
                                Pris:
                                @if( $event->price == 0 )
                                    Gratis
                                @else
                                    {{ $event->price }}kr
                                @endif</p>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection

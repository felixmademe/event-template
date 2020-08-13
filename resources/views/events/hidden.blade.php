@extends( 'layouts.app' )
@section( 'content' )

    @if( $events->isEmpty() )
        <div class="h-100 d-flex justify-content-center align-content-center">
            <div class="card col-md-8">
                <div class="card-body text-center">
                    <h1>Ingen gömda event evenemang</h1>
                </div>
            </div>
        </div>
    @else
        @foreach( $events as $event )
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card my-2">
                        @if( $event->image_banner )
                            <img class="card-img-top" src="{{ $event->image_banner }}" alt="Bild som beskriver eventet grafiskt.">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">{{ $event->name }}</h4>
                            <p>
                                {{ strlen( $event->description ) > 150 ? substr( $event->description, 0, strpos( $event->description,' ', 150 ) ) . '...' : $event->description }}
                            </p>
                            <a class="btn btn-primary btn-expand my-1" href="{{ route( 'events.show', $event->slug ) }}">Visa evanegemang</a>
                            @auth
                                <a class="btn btn-secondary btn-expand my-1" href="{{ route( 'events.edit', $event->slug ) }}">Ändra eller ta bort</a>
                                <a class="btn btn-secondary btn-expand my-1" href="{{ route( 'events.admin', $event->slug ) }}">Hantera och check in</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection

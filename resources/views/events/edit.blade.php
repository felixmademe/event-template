@extends( 'layouts.app' )
@section( 'content' )

    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h1>Redigera {{ $event->name }}</h1>
                <form method="POST" action="{{ route( 'events.update', $event->slug ) }}">
                    @csrf
                    @method( 'PATCH' )
                    <div class="form-group">
                        <label for="name">Namn</label>
                        <input class="form-control" name="name" id="name" type="text" value="{{ $event->name }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="location">Plats</label>
                        <input class="form-control" name="location" id="location" type="text" value="{{ $event->location }}">
                    </div>
                    <div class="form-group">
                        <label for="start_time">Starttid</label>
                        <input class="form-control" name="start_time" id="start_time" type="date" placeholder="Ungefärlig starttid." value="{{ $event->start_time }}">
                        <small>Starttid vald: <i>{{ $event->start_time }}</i></small>
                    </div>
                    <div class="form-group">
                        <label for="description">Beskrivning</label>
                        <textarea class="form-control" name="description" id="description" rows="20">{{ $event->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_banner">
                            Bild
                            <br>
                            <small>
                                Länk till bild. Exempelvis
                                <a target="_blank" rel="noreferrer" href="https://tinyurl.com/y8mor8sb">
                                    www.tinyurl.com/y8mor8sb</a>.
                                Använd gärna
                                <a target="_blank" rel="noreferrer" href="https://tinyurl.com/">
                                    www.tinyurl.com
                                </a>
                                ifall din länk är gaaaalet lång.
                            </small>
                        </label>
                        <p>URL: {{ $event->image_banner }}</p>
                        <input class="form-control" name="image_banner" id="image_banner" value="{{ $event->image_banner }}">
                    </div>
                    <div class="form-group">
                        <label for="image_banner">
                            Bild
                            <br>
                            <small>
                                Länk till bild. Exempelvis
                                <a target="_blank" rel="noreferrer" href="https://tinyurl.com/y8mor8sb">
                                    www.tinyurl.com/y8mor8sb</a>.
                                Använd gärna
                                <a target="_blank" rel="noreferrer" href="https://tinyurl.com/">
                                    www.tinyurl.com
                                </a>
                                ifall din länk är gaaaalet lång.
                            </small>
                        </label>
                        <input class="form-control" name="image_banner" id="image_banner" placeholder="URL direkt till bild." value="{{ $event->image }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Pris *</label>
                        <input class="form-control" name="price" id="price" type="number" value="{{ $event->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="swish">Swish</label>
                        <input class="form-control" name="swish" id="swish" type="text" value="{{ $event->swish }}">
                    </div>
                    <div class="form-group">
                        <label for="max_visitors">Max antal besökare</label>
                        <input class="form-control" name="max_visitors" id="max_visitors" type="number" value="{{ $event->max_visitors }}" required>
                    </div>

                    <button class="btn btn-primary" type="submit">Spara ändringar</button>
                </form>
                <hr>
                <h4>Ta bort {{ $event->name }}</h4>
                <form action="{{ route( 'events.destroy', $event->slug ) }}" method="POST">
                    @csrf
                    @method( 'DELETE' )
                    <button onclick="return confirm( 'Är du säker på att du vill ta bort det här evenemanget?' );" class="btn btn-outline-danger" type="submit">
                        Ta bort
                    </button>
                </form>
                <hr>
                <a class="btn btn-outline-primary" href="{{ route( 'events.index' ) }}">Gå tillbaka</a>
            </div>
        </div>
    </div>

@endsection

@extends( 'layouts.app' )
@section( 'content' )

    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h1>{{ $event->name }}</h1>
                <h3>Lägg till deltagare</h3>
                <form method="POST" action="{{ route( 'participants.store' ) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Namn:</label>
                        <input class="form-control" name="name" id="name" type="text" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" name="email" id="email" type="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon:</label>
                        <input class="form-control" name="phone" id="phone" type="tel" required>
                    </div>
                    <input type="hidden" id="ip" name="ip" value="127.0.0.1">
                    <input type="hidden" id="type" name="type" value="admin">
                    <input type="hidden" id="event_id" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" id="recaptcha" name="recaptcha">
                    <button class="btn btn-primary" type="submit">Lägg till deltagare</button>
                </form>
                <hr>
                <a class="btn btn-primary" href="{{ route( 'events.show', $event->slug ) }}">Gå tillbaka</a>
            </div>
        </div>
    </div>


@endsection

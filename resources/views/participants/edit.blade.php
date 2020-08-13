@extends( 'layouts.app' )
@section( 'content' )

    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h3>
                    Deltagare: {{ $participant->name }}
                </h3>
                <form method="POST" action="{{ route( 'participants.update', $participant->slug ) }}">
                    @csrf
                    @method( 'PATCH' )
                    <div class="form-group">
                        <label for="name">Namn</label>
                        <input class="form-control" name="name" id="name" type="text" value="{{ $participant->name }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" id="email" type="email" value="{{ $participant->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefonnummer</label>
                        <input class="form-control" name="phone" id="phone" type="tel" value="{{ $participant->phone }}" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Spara ändringar</button>
                </form>
                <hr>
                <h3>Ta bort</h3>
                <form action="{{ route( 'participants.destroy', $participant->slug ) }}" method="POST">
                    @csrf
                    @method( 'DELETE' )
                    <button onclick="return confirm( 'Är du säker på att du vill ta bort det här evenemanget?' );" class="btn btn-outline-danger" type="submit">
                        Ta bort deltagare permanent
                    </button>
                </form>
                <hr>
                <a class="btn btn-outline-primary" href="{{ route( 'events.admin', $participant->event->slug ) }}">Gå tillbaka</a>
            </div>
        </div>
    </div>

@endsection

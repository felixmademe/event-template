@extends( 'layouts.app' )
@section( 'content' )

    <div class="row justify-content-center">
        <div class="card col-12">
            @if( $event->image_banner )
                <img class="card-img-top overflow-img" src="{{ $event->image_banner }}" alt="Bild som beskriver eventet grafiskt.">
            @else
                <img class="card-img-top overflow-img" src="{{ asset( 'img/event-background.jpg' ) }}" alt="{{ config( 'app.name' ) }} background">
            @endif
            <div class="card-body">
                <h1>{{ $event->name }}</h1>
                <p><span style="white-space: pre-line">{{ $event->description }}</span></p>
                <hr>
                @if( $event->registration )
                    <h2>Anmälan</h2>
                    <p>
                        Vill du vara med på <i>{{ $event->name }}</i>? Anmäl dig här!
                    </p>
                    <form method="POST" action="{{ route( 'participants.store' ) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Namn</label>
                            <input class="form-control" type="text" id="name" name="name" required placeholder="Namn Efternamn" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Epost</label>
                            <input class="form-control" type="email" id="email" name="email" required placeholder="exempel@exempel.se">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefonnummer</label>
                            <input class="form-control" type="tel" id="phone" name="phone" placeholder="070 000 00 00" required>
                            <small class="form-text text-muted">Ditt telefonnummer är ej obligatoriskt men kan underlätta vid kontakt.</small>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Födelsedatum</label>
                            <input class="form-control" name="birth_date" id="birth_date" type="date" placeholder="Din ålder">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="event_id" name="event_id" value="{{ $event->id }}">
                        </div>
                        <div class="form-group">
                            @if( config( 'services.recaptcha.sitekey' ) )
                                <input type="hidden" id="recaptcha" name="recaptcha">
                            @endif
                            <small class="form-text text-muted">
                                Den här sidan är skyddad med reCAPTCHA och Googles
                                <a href="https://policies.google.com/privacy" target="_blank">integritetspolicy</a> och
                                <a href="https://policies.google.com/terms" target="_blank">användarvillkor</a> gäller.
                            </small>
                        </div>
                        <p>
                            Pris:
                            @if( $event->price == 0 )
                                Gratis
                            @else
                                {{ $event->price }}kr
                                <br>
                                Betalmetod:
                                @if( $event->swish )
                                    {{ $event->swish }}
                                @else
                                    Kontant (på plats)
                                @endif
                            @endif
                            <br>
                            Det finns <i class="font-weight-bold">{{ $event->max_visitors - count( $event->participants ) }}</i> platser kvar!
                        </p>
                        <button type="submit" class="btn btn-primary">Skicka anmälan</button>
                    </form>
                @elseif( count( $event->participants ) >= $event->max_visitors )
                    <p>Evenemanget är fullt.</p>
                @else
                    <p>Anmälan är stängd.</p>
                @endif
                <hr>
                <a class="btn btn-outline-primary my-1" href="{{ route( 'events.index' ) }}">Gå till alla evanegemang</a>
                @auth
                    <br>
                    <a class="btn btn-secondary btn-expand my-1" href="{{ route( 'events.admin', $event->slug ) }}">Hantera evengemang</a>
                    <a class="btn btn-outline-secondary btn-expand my-1" href="{{ route( 'events.edit', $event->slug ) }}">Ändra information</a>
                @endauth
            </div>
        </div>
    </div>

@endsection

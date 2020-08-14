@extends( 'layouts.app' )
@section( 'content' )
    <div class="row">
        <div class="col-lg-12">
            <h1>Kontakt</h1>
        </div>
    </div>
    <div class="row d-flex align-items-center">
        <div class="col-lg-6">
            <div class="card my-2">
                <div class="card-body">
                    <h2 class="card-title">Skicka nu</h2>
                    <form method="POST" action="{{ route( 'contacts.send' ) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Namn</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="text">Meddelande</label>
                            <textarea id="text" name="text" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            @if( config( 'services.recaptcha.sitekey' ) )
                                <input type="hidden" id="recaptcha-contact" name="recaptcha">
                            @endif
                            <small>
                                Den här sidan är skyddad med reCAPTCHA och Googles
                                <a href="https://policies.google.com/privacy" target="_blank">integritetspolicy (Privacy Policy)</a> och
                                <a href="https://policies.google.com/terms" target="_blank">användarvillkor (Terms of Service)</a> gäller.
                            </small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Skicka</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-6">
             <img class="img-fluid" alt="{{ config( 'app.name' ) }} logga" src="{{ asset( '/img/event-logo.png' ) }}">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card my-2">
                <div class="card-body">
                    <h2 class="card-title">Skicka senare</h2>
                    <p>Skicka epost med frågor och funderingar, när du vill.</p>
                    <a href="mailto:{{ config( 'mail.to.address' ) }}"><p>{{ config( 'mail.to.address' ) }}</p></a>
                    <p class="text-muted">Vi svarar på även på frågor kring byråkrati, men helst inte.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 my-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Kryptera</h2>
                    <p>Värna om din säkerhet. Om du vill, kryptera dina meddelanden med vår publika PGP nyckel. <a href="{{ route('key.show') }}">Visa nyckel</a></p>
                    <p class="text-muted">Fingeravtryck: {{ config( 'key.fingerprint' ) }}</p>
                </div>
            </div>
       </div>
    </div>
@endsection

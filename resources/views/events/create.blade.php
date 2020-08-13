@extends( 'layouts.app' )
@section( 'content' )

    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h1>Skapa evenemang</h1>
                <small>Alla fält markerade med <strong>*</strong> är obligatoriska.</small>
                <form method="POST" action="{{ route( 'events.store' ) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Namn *</label>
                        <input class="form-control" name="name" id="name" type="text" placeholder="Namn på evegemang." required autofocus>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="location">Plats</label>
                        <input class="form-control" name="location" id="location" type="text" placeholder="Ungefärlig plats. Exakt plats skickas med e-post.">
                    </div>
                    -->
                    <!--
                    <div class="form-group">
                        <label for="start_time">Starttid</label>
                        <input class="form-control" name="start_time" id="start_time" type="date" placeholder="Ungefärlig starttid.">
                    </div>
                    -->
                    <!--
                    <div class="form-group">
                        <label for="description">Beskrivning</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Beskriv. Hype!"></textarea>
                    </div>
                    -->
                    <!--
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
                        <input class="form-control" name="image_banner" id="image_banner" placeholder="URL direkt till bild.">
                    </div>
                    -->
                    <div class="form-group">
                        <label for="price">Pris *</label>
                        <input class="form-control" name="price" id="price" type="number" placeholder="Pris i kronor, endast siffror." required>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="swish">Swish</label>
                        <input class="form-control" name="swish" id="swish" type="text" placeholder="Nummer dit deltagare swishar sin betalning.">
                    </div>
                    -->
                    <div class="form-group">
                        <label for="max_visitors">Max antal besökare *</label>
                        <input class="form-control" name="max_visitors" id="max_visitors" type="number" placeholder="Maximalt antal besökare." required>
                    </div>

                    <p class="small">Övrig information såsom swishnummer och plats läggs till i ett senare skede genom att trycka på knappen "Ändra information" på evenegemangssidan.</p>

                    <button class="btn btn-primary" type="submit">Skapa evenemang</button>
                </form>
            </div>
        </div>
    </div>

@endsection

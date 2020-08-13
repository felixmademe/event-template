@extends( 'layouts.app' )
@section( 'content' )

    @php
        Carbon\Carbon::setLocale( 'sv' );
    @endphp

    <h2>{{ $event->name }}</h2>
    <!-- Overview -->
    <div class="card my-2">
        <div class="card-header">
            Överblick
        </div>
        <div class="card-body">
            <a class="btn btn-primary btn-expand my-1" href="{{ route( 'events.show', $event->slug ) }}">Visa information</a>
            <a class="btn btn-primary btn-expand my-1" href="{{ route( 'events.edit', $event->slug ) }}">Redigera Infrmation</a>
            <a class="btn btn-outline-primary btn-expand my-1" href="{{ route( 'events.index' ) }}">Gå tillbaka</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Katergori</th>
                        <th scope="col">Antal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Anmälda</th>
                        <td>{{ $event->participants->count() }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Incheckade</th>
                        <td>{{ $event->participants->where( 'checked', true )->count() }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Betalda</th>
                        <td>{{ $event->participants->where( 'paid', true )->count() }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Obetalda</th>
                        <td>{{ $event->participants->where( 'paid', false )->count() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Accessibility -->
    <div class="card my-2">
        <div class="card-header">
            Åtkomlighet
        </div>
        <div class="card-body">
            <div class="row px-0">
                <div class="col-md-6">
                    <form method="POST" action="{{ route( 'events.public', $event->slug ) }}">
                        @csrf
                        @method( 'PATCH' )
                        <h3>Synlighet</h3>
                        <small class="text-muted">Synlighet för evengemanget.</small>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="public" name="public" value="1" {{ $event->public ? 'checked' : '' }}>
                            <label class="form-check-label" for="public">Publikt</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="private" name="public" value="0" {{ $event->public ? '' : 'checked' }}>
                            <label class="form-check-label" for="private">Privat (Olistad)</label>
                        </div>
                        <input type="hidden" id="name" name="name" value="{{ $event->name }}">
                        <input type="hidden" id="type" name="type" value="public">
                        <br>
                        <button class="btn btn-secondary btn-expand" type="submit">Spara ändring</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form method="POST" action="{{ route( 'events.registration', $event->slug ) }}">
                        @csrf
                        @method( 'PATCH' )
                        <h3>Anmälan</h3>
                        <small class="text-muted">Anmäla sig som deltagare.</small>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="open" name="registration" value="1" {{ $event->registration ? 'checked' : '' }}>
                            <label class="form-check-label" for="open">Öppen</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" id="closed" name="registration" value="0" {{ $event->registration ? '' : 'checked' }}>
                            <label class="form-check-label" for="closed">Stängd</label>
                        </div>
                        <input type="hidden" id="name" name="name" value="{{ $event->name }}">
                        <input type="hidden" id="type" name="type" value="registration">
                        <br>
                        <button class="btn btn-secondary btn-expand" type="submit">Spara ändring</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Participant management -->
    <div class="card my-2">
        <div class="card-header">
            Hantera deltagare
        </div>
        <div class="card-body">
            <h3>Exportera deltagarlista</h3>
            <a class="btn btn-secondary btn-expand" href="{{ route( 'events.export', $event->slug ) }}">Generera fil</a>
            <hr>
            <h3>Lägg till deltagare manuellt</h3>
            <a class="btn btn-secondary btn-expand" href="{{ route( 'participants.create', $event->slug ) }}">Lägg till</a>
            <hr>
            <h3>Checka-in deltagare</h3>
            <div class="container">
                <small>
                    <b>Färgkoder:</b>
                    <br>
                    <i class="bg-warning mx-3 p-1">Har inte betalat än, ta betalt först.</i>
                    <br>
                    <i class="bg-success mx-3 p-1">Betalat, kan checka in direkt.</i>
                    <br>
                    <i class="bg-light mx-3 p-1">Färdig, behöver inte mer tillsyn.</i>
                    <br>
                    <b>Hjälp:</b>
                    Du kan söka efter deltagare med sökfältet.
                    Använd knapparna till höger om deltagaren för att markera denne deltagare som
                    betald eller incheckad.
                    En deltagare måste först vara betald för att kunna checka in.
                    De blå deltagarna behålls endast för att ha en lista över personer i lokalen.
                    Då en person lämnar för dagen men kvällen fortfarande är ung, kan denna person
                    checkas ut för att lämna plats åt nytt folk. En utchckads persons betalning är
                    fortfarande giltlig.
                </small>
            </div>
            @if( $event->participants->isEmpty() )
                <p>Inga deltagare registrerade ännu.</p>
            @else
                <table class="table table-responsive-lg" style="max-height: 2000px">
                    <thead>
                        <tr>
                            <th scope="col" class="col-md-4">Deltagare<br><small>Namn & Epost</small></th>
                            <th scope="col" class="col-md-8">Status<br><small>Telefonnummer</small></th>
                            <th scope="col" class="col-md-4">Inceckad<br><small>Tidstämpel</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $event->participants as $participant )
                            @if($participant->checked && $participant->paid)
                                <!-- Paid and checked in -->
                                <tr class="bg-light">
                            @elseif(!$participant->checked && $participant->paid || $event->price == 0)
                                <!-- Paid and not checked in -->
                                <tr class="bg-success">
                            @else
                                <!-- Not paid and/or checked in -->
                                <tr class="bg-warning">
                            @endif
                                <!-- Name -->
                                <td class="align-middle">
                                    {{ $participant->name }}
                                    <br>
                                    <small>{{ $participant->email }}</small>
                                    <br>
                                    <a class="btn btn-sm btn-outline-{{ $participant->checked && $participant->paid ? 'dark' : 'light' }}" href="{{ route( 'participants.edit', $participant->slug ) }}">Ändra info</a>
                                </td>
                                <!-- Paid status -->
                                <td class="align-middle">
                                    <small>{{ $participant->phone }}</small>
                                    <form class="" method="POST" action="{{ route( 'participants.paid', $participant->slug ) }}">
                                        @csrf
                                        @method( 'PATCH' )
                                        <div class="form-check col-12" style="padding: 0">
                                            <input hidden name="paid" value="{{ $participant->paid == true ? '0' : '1'  }}">
                                            @if( $event->price > 0 )
                                                <button class="btn btn-secondary col-12" type="submit">
                                                    {{ $participant->paid == true ? 'Häv köp' : 'Betalat'  }}
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </td>
                                <!-- Checked in status -->
                                <td class="align-middle">
                                    <small>{{ $participant->checked_when ? ucfirst( Carbon\Carbon::parse( $participant->checked_when )->diffForHumans() ) : 'Ej checkad' }}</small>
                                    <form method="POST" action="{{ route( 'participants.checked', $participant->slug ) }}">
                                        @csrf
                                        @method( 'PATCH' )
                                        <div class="form-check col-12" style="padding: 0">
                                            <input hidden name="checked" value="{{ $participant->checked == true ? '0' : '1' }}">
                                            <button class="btn btn-secondary col-12" type="submit"
                                                {{ $participant->paid == true ? '' : 'disabled' }}>
                                                {{ $participant->checked == true && $participant->paid == true ? 'Ut' : 'In' }}
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <hr>
            <a class="btn btn-outline-primary btn-expand my-1" href="{{ route( 'events.index' ) }}">Gå tillbaka</a>
        </div>
    </div>

@endsection

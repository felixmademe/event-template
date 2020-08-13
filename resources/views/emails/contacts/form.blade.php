@extends( 'layouts.mail' )
@section( 'content' )

    @if( $name )
        <h1>{{ $name }}</h1>
    @endif
    <p>
        {!! $text !!}
    </p>

@endsection


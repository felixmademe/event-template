@if( session()->has( 'success' ) )
    <div class="alert success">
        <span class="closebtn">&times;</span>
        {{ session()->get( 'success' ) }}
    </div>
@endif

@if( session()->has( 'error' ) )
    <div class="alert warning">
        <span class="closebtn">&times;</span>
        {{ session()->get( 'error' ) }}
    </div>
@endif


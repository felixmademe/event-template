@extends('layouts.app')
@section( 'content' )
    <section id="welcome">
        <div class="mt-3 d-flex justify-content-center align-content-center">
            <div class="col-lg-10 text-center" id="title-box">
                <div class="text-center align-content-center">
                    <img class="col-12 col-md-4 img-fluid" alt="{{ config( 'app.name' ) }} logga" src="{{ asset( '/img/event-logo.png' ) }}">
                </div>
                <h1 id="title">
                    {{ config( 'app.name' ) }}
                </h1>
                <p class="big-text">
                    Mauris vehicula nibh sit amet mi ullamcorper, nec mollis nibh dapibus.
                    Duis tristique semper pretium. Suspendisse id mi justo. Ut nunc nisi, finibus
                    vitae risus nec, lobortis dignissim erat. Pellentesque gravida nulla et pretium
                    lacinia.
                </p>
                <p class="big-text">
                    Mauris id ex euismod, ultricies nisl non, consectetur neque. Maecenas
                    eu nunc leo. Cras eu erat vestibulum, tempus enim vitae, tincidunt leo.
                    Vivamus nec laoreet elit.
                </p>
            </div>
        </div>
    </section>
@endsection

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        :root {
            --color-scheme-background: #1A1A1A;
            --color-scheme-background-alt: #343434;
            --color-scheme-background-diff: #474747;
            --color-scheme-text-color: #fff;
            --color-scheme-text-color-diff: #bfbfbf;
            --color-scheme-text-color-invert: #000;
            --main-red: #eb573f;
            --main-red-hover: #c74935;
            --main-blue: #30b3d7;
            --main-blue-hover: #2995b4;
            --main-purple: #430d70;
            --main-purple-hover: #801ed4;
        }
        @font-face
        {
            src: url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            font-family: 'Poppins', 'Raleway', sans-serif !important;
        }

        body {
            background-color: var( --color-scheme-background );
            margin: 0;
            font-family: 'Poppins', 'Raleway', sans-serif !important;
        }

        a
        {
            color: var( --main-red );
            text-decoration: none;
        }
        a:hover
        {
            color: var( --main-red-hover );
            text-decoration: underline;
        }

        h3
        {
            margin-bottom: 5px;
        }

        body
        {
            width: 80%;
            margin: 20px auto;
        }

        @media screen and (max-width: 768px)
        {
            body
            {
                width: 100%;
                margin: 20px auto;
            }
        }

        .wrapper
        {
            border-radius: 10px;
        }

        header
        {

            color: #fff;
            padding: 20px 0;
            width: 100%;
            text-align: center;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }

        .line
        {
            width: 100%;
            height: 30px;
            background:  linear-gradient(170deg, var( --main-purple ), var( --main-purple-hover ));
        }

        .line.reversed
        {
            background:  linear-gradient(320deg, var( --main-purple ), var( --main-purple-hover ));
        }

        header h1
        {
            font-size: 8em;
            margin: 0;
            -webkit-text-stroke: 3px var( --main-blue );
            -webkit-text-fill-color: var( --color-scheme-background );
        }

        header p
        {
            color: var( --main-red );
        }

        .main
        {
            width: 100%;
            background-color: #fff;
            color: #000;
        }

        .main .container {
            padding: 30px 30px;
        }

        footer
        {
            border-top: 10px solid var(--color-scheme-background-diff);
            background-color: var(--color-scheme-background-alt);
            color: var( --color-scheme-text-color );
            padding: 20px 0;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            width: 100%;
            text-align: center;
        }

    </style>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="line"></div>
        <h1>{{ config( 'app.name' ) }}</h1>
        <p>{{ config( 'app.slogan' ) }}</p>
        <div class="line reversed"></div>
    </header>

    <div class="main">
        <div class="container">
            @yield( 'content' )
        </div>
    </div>

    <footer>
        <h3>{{ config( 'app.name' ) }}</h3>
        <a href="{{ config( 'app.url' ) }}">{{ config( 'app.url' ) }}</a>
        <br>
        <p>
            Har du en fråga? Hör av dig så kan vi prata om det.
            <br>
            <a target="_blank" href="{{ route( 'contacts' ) }}">Kontakta oss</a>
        </p>
    </footer>
</div>
</body>
</html>

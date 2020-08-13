<?php

namespace App\Validators;

class ReCaptcha
{
    public static function validate( $code )
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret'   => config( 'services.recaptcha.secret' ),
            'response' => $code
        ];

        $options = [
            'http' => [
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
                'content' => http_build_query( $data )
            ]
        ];

        $context = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        $json = json_decode( $result );

        if( config( 'app.env' ) === 'production' )
        {
            if( $json->success != true )
            {
                return false;
            }
        }

        return true;
    }
}

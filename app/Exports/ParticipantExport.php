<?php

namespace App\Exports;

use App\Participant;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ParticipantExport implements FromQuery
{
    use Exportable;

    private $id;

    public function __construct( $id )
    {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return Participant::query()->where( 'event_id', $this->id )->select( 'email' );
    }
}

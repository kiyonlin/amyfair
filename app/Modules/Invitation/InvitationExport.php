<?php

namespace App\Modules\Invitation;

use Maatwebsite\Excel\Concerns\FromCollection;

class InvitationExport implements FromCollection
{

    public function collection()
    {
        return Invitation::all();
    }
}

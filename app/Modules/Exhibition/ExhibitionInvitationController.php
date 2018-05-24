<?php

namespace App\Modules\Exhibition;

use App\Http\Controllers\ApiController;

class ExhibitionInvitationController extends ApiController
{
    /**
     * 邀请展会列表.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $columns = ['id', 'name', 'name_en', 'address', 'address_en', 'start_at', 'end_at'];

        return ExhibitionResource::collection(
            Exhibition::where('start_at', '>=', now())->get()
        );
    }
}

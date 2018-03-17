<?php

namespace App\Modules\Invitation;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class InvitationController extends ApiController
{
    /**
     * 邀请申请列表.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('perPage', 15);
        $columns = ['type', 'email', 'mobile', 'fullName',
                    'country', 'industry', 'created_at'];

        return InvitationResource::collection(
            Invitation::paginate($perPage, $columns, 'page', $page)
        );
    }

    /**
     * 保存邀请申请.
     *
     * @return InvitationResource
     */
    public function store()
    {
        $invitation = Invitation::create(request()->all());

        return new InvitationResource($invitation);
    }
}

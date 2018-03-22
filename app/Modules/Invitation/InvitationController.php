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
        $page = request('currentPage', 1);
        $perPage = request('perPage', 15);
        $columns = ['id', 'type', 'email', 'mobile', 'fullName',
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

    /**
     * 获取邀请申请详情.
     *
     * @return InvitationResource
     */
    public function show(Invitation $invitation)
    {
        return new InvitationResource($invitation);
    }

    /**
     * 删除邀请申请详情.
     *
     * return \Illuminate\Http\JsonResponse
     */
    public function destroy(Invitation $invitation)
    {
        if (empty($ids = request('ids'))) {
            $invitation->delete();
        } else {
            Invitation::whereIn('id', $ids)->delete();
        }

        return $this->respondNoContent();
    }
}

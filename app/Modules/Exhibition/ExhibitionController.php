<?php

namespace App\Modules\Exhibition;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ExhibitionController extends ApiController
{
    /**
     * 展会列表.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $page = request('currentPage', 1);
        $perPage = request('perPage', 15);
        $columns = ['id', 'name', 'name_en', 'address', 'address_en',
                    'main_products', 'main_products_en', 'start_at', 'end_at', 'created_at'];

        return ExhibitionResource::collection(
            Exhibition::paginate($perPage, $columns, 'page', $page)
        );
    }

    /**
     * 保存展会.
     *
     * @return ExhibitionResource
     */
    public function store()
    {
        $exhibition = Exhibition::create(request()->all());

        return new ExhibitionResource($exhibition);
    }

    /**
     * 获取展会详情.
     *
     * @return ExhibitionResource
     */
    public function show(Exhibition $exhibition)
    {
        return new ExhibitionResource($exhibition);
    }

    /**
     * 更新展会详情.
     *
     * @return ExhibitionResource
     */
    public function update(Exhibition $exhibition)
    {
        $exhibition->update(request()->all());

        return new ExhibitionResource($exhibition);
    }

    /**
     * 删除展会.
     * 支持批量删除.
     *
     * return \Illuminate\Http\JsonResponse
     */
    public function destroy(Exhibition $exhibition)
    {
        if (!empty($ids = request('ids'))) {
            Exhibition::whereIn('id', $ids)->delete();
        } else {
            $exhibition->delete();
        }

        return $this->respondNoContent();
    }
}

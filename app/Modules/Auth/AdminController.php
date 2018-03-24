<?php

namespace App\Modules\Auth;

use App\Http\Controllers\ApiController;

class AdminController extends ApiController
{
    public function update(User $admin, AdminRequest $request)
    {
        $admin->name = request('name');
        $admin->email = request('email');
        $admin->mobile = request('mobile');
        $admin->password = request('password');
        $admin->save();
        
        return new UserResource($admin);
    }
}

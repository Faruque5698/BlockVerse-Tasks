<?php

namespace App\Services\User;

use Illuminate\Foundation\Http\FormRequest;

interface UserServiceInterface
{
    public function getUser();

    public function rolePermissionUpdate(FormRequest $request);
}

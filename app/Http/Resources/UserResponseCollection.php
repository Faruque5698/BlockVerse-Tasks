<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResponseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'success' => true,
            'code' => 200,
            'message' => 'Users fetched successfully',
            'data' => $this->collection->transform(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles->map(fn($role) => [
                        'id' => $role->id,
                        'name' => $role->name,
                    ]),
                    'permissions' => $user->permissions()->map(fn($permission) => [
                        'id' => $permission->id,
                        'name' => $permission->name,
                    ]),
                ];
            }),
            'errors' => null,
        ];
    }
}

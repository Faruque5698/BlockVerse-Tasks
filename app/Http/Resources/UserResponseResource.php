<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'code' => 200,
            'message' => 'User fetched successfully',
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,

                'roles' => $this->roles->map(fn($role) => [
                    'id' => $role->id,
                    'name' => $role->name,
                ]),
                'permissions' => $this->permissions()->map(fn($permission) => [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ]),
            ],
            'errors' => null,
        ];
    }
}

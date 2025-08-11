<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResponseResource extends JsonResource
{
    protected ?string $message;

    public function __construct($resource, ?string $message = null)
    {
        parent::__construct($resource);
        $this->message = $message ?? 'User fetched successfully';
    }

    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'code' => 200,
            'message' => $this->message,
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

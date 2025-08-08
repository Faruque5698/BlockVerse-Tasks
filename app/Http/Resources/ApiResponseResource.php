<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponseResource extends JsonResource
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
            'message' => $this->resource['message'] ?? 'Success',
            'data' => null,
            'errors' => null,
        ];
    }
}

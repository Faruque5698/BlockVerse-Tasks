<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponseErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => false,
            'code' => $this->resource['code'] ?? 500,
            'message' => $this->resource['message'] ?? 'Something went wrong',
            'data' => null,
            'errors' => $this->resource['errors'] ?? null,
            ];
    }
}

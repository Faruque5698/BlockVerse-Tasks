<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleResponseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'code' => 200,
            'message' => 'Article fetched successfully',
            'data' => $this->collection->transform(function ($article) {
                return (new ArticleResponseResource($article))->resolve();
            }),
            'errors' => null,
        ];
    }
}

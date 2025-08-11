<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleResponseCollection extends ResourceCollection
{
    protected ?string $message;

    public function __construct($resource, ?string $message = null)
    {
        parent::__construct($resource);
        $this->message = $message ?? 'Article fetched successfully';
    }

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
            'message' => $this->message,
            'data' => $this->collection->transform(function ($article) {
                return (new ArticleResponseResource($article))->resolve();
            }),
            'errors' => null,
        ];
    }
}

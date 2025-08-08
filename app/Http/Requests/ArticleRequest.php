<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Create (POST) - কোনো id নাই, শুধু logged-in user allowed
        if ($this->isMethod('post')) {
            return auth()->check();
        }

        // Update (PUT/PATCH) - route এ article অথবা id থাকতে পারে
        $articleId = $this->route('article') ?? $this->route('id');
        if (!$articleId) {
            return false;
        }

        // Eloquent model binding হলে $articleId object হবে
        if (is_object($articleId) && property_exists($articleId, 'user_id')) {
            return auth()->id() === $articleId->user_id;
        }

        // নন-model binding হলে DB থেকে খুঁজে আনুন
        $creatorId = DB::table('articles')->where('id', $articleId)->value('user_id');
        if (!$creatorId) {
            return false;
        }

        return auth()->id() === $creatorId;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ];
    }
}

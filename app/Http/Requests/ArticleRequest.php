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
        if ($this->isMethod('post')) {
            return auth()->check();
        }

        $articleId = $this->route('article') ?? $this->route('id');
        if (!$articleId) {
            return false;
        }

        if (is_object($articleId) && property_exists($articleId, 'user_id')) {
            return auth()->id() === $articleId->user_id;
        }

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

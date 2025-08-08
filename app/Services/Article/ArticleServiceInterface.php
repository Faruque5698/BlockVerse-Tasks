<?php

namespace App\Services\Article;

use Illuminate\Foundation\Http\FormRequest;

interface ArticleServiceInterface
{
    public function getAll();

    public function getById($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function published($id);
    public function ownArticle();


}

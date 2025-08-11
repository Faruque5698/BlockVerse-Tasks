<?php

namespace App\Repositories\Contracts;

interface ArticleRepositoryInterface extends RepositoryInterface
{
    public function publishedArticle();
    public function published($id);
    public function ownArticle();
}

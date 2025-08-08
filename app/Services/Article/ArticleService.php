<?php

namespace App\Services\Article;

use App\Repositories\Contracts\ArticleRepositoryInterface;

class ArticleService implements ArticleServiceInterface
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAll()
    {
        return $this->articleRepository->all();
    }

    public function getById($id)
    {
        return $this->articleRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->articleRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->articleRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->articleRepository->delete($id);
    }

    public function published($id)
    {
        return $this->articleRepository->published($id);
    }

    public function ownArticle()
    {
        return $this->articleRepository->ownArticle();
    }
}

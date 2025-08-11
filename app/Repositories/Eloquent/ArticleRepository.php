<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $model;
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function all(){
        return $this->model->latest()->get();
    }
    public function publishedArticle(){
        return $this->model->where('published_at', '!=', null)->latest()->get();
    }
    public function find($id){
      return $this->model->find($id);
    }
    public function create(array $data){
        return $this->model->create($data);
    }
    public function update(array $data, $id){
        $article = $this->find($id);
        $article->update($data);
        return $article;
    }
    public function delete($id){
        $article = $this->find($id);
        return $article->delete();
    }

    public function ownArticle()
    {
        return $this->model->where('user_id',auth()->guard('api')->id())->get();
    }

    public function published($id)
    {
        $article = $this->find($id);
        $article->published_at = now();
        $article->save();
        return $article;
    }


}

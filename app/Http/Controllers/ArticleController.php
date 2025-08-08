<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ApiResponseResource;
use App\Http\Resources\ArticleResponseCollection;
use App\Models\Article;
use App\Services\Article\ArticleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    protected $articleService;
    public function __construct(ArticleServiceInterface $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = $this->articleService->getAll();

        return(new ArticleResponseCollection($articles));
    }

    /**
     * Store a newly created article.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::guard('api')->id();

        $article = $this->articleService->create($data);

        return (new ArticleResponseCollection(collect([$article])));
    }

    /**
     * Display the specified article.
     */
    public function show($id)
    {
        $article = $this->articleService->getById($id);

        return (new ArticleResponseCollection(collect([$article])));
    }

    /**
     * Update the specified article.
     */
    public function update(ArticleRequest $request, $id)
    {

        $data = $request->validated();


        $updatedArticle = $this->articleService->update($data, $id);

        return new ArticleResponseCollection(collect([$updatedArticle]));
    }

    /**
     * Remove the specified article.
     */
    public function destroy($id)
    {
        $this->articleService->delete($id);

        return (new ApiResponseResource([
            'success' => true,
            'code' => 200,
            'message' => 'Article deleted successfully',
            'data' => null,
            'errors' => null
        ])) ;
    }

    public function publish($id)
    {
        $this->articleService->published($id);

        return (new ApiResponseResource([
            'success' => true,
            'code' => 200,
            'message' => 'Article published successfully',
            'data' => null,
            'errors' => null
        ])) ;
    }

    public function ownArticle()
    {
      $data =   $this->articleService->ownArticle();

        return(new ArticleResponseCollection($data));

    }
}

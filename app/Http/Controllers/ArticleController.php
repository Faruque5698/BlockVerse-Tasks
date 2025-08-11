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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ArticleController extends Controller
{
    use AuthorizesRequests;

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
        $this->authorize('viewAny', Article::class);

        $articles = $this->articleService->getAll();

        return(new ArticleResponseCollection($articles));
    }

    /**
     * Store a newly created article.
     */
    public function store(ArticleRequest $request)
    {
        $this->authorize('create', Article::class);

        $data = $request->validated();
        $data['user_id'] = Auth::guard('api')->id();

        $article = $this->articleService->create($data);

        return (new ArticleResponseCollection(collect([$article]),'Article create successfully'));
    }

    /**
     * Display the specified article.
     */
    public function show($id)
    {
        $article = $this->articleService->getById($id);
        $this->authorize('view', $article);

        return (new ArticleResponseCollection(collect([$article])));
    }

    /**
     * Update the specified article.
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $this->authorize('update', $article);

        $data = $request->validated();

        $updatedArticle = $this->articleService->update($data, $article->id);

        return new ArticleResponseCollection(collect([$updatedArticle]),'Article update successfully');
    }

    /**
     * Remove the specified article.
     */
    public function destroy($id)
    {
        $article = $this->articleService->getById($id);

        $this->authorize('view', $article);

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
        $article = Article::findOrFail($id);
        $this->authorize('publish', $article);
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
        $this->authorize('viewAny', Article::class);

        $data =   $this->articleService->ownArticle();

        return(new ArticleResponseCollection($data));

    }
}

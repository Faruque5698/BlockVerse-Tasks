<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
//use App\Policies\ArticlePolicy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        Gate::define('view-all-users', fn (User $user) => $user->hasRolePermission('view_all_users'));

        Gate::define('assign-roles', fn (User $user) => $user->hasRolePermission('assign_roles'));

        Gate::define('publish-article', fn (User $user) => $user->hasRolePermission('publish_article'));

        Gate::define('delete-articles', fn (User $user) => $user->hasRolePermission('delete_article'));

        Gate::define('view-published-articles', fn (?User $user) => $user !== null);

        Gate::define('create-article', fn (User $user) => $user->hasRolePermission('create_article'));
        Gate::define('edit-own-article', fn (User $user) => $user->hasRolePermission('edit_own_article'));

        Gate::define('view-own-articles', fn (User $user) => $user->hasRolePermission('view_own_articles'));

        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(6));


    }
}

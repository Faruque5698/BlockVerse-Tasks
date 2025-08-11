<?php

namespace App\Http\Controllers\Admin;

use App\Enum\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleUpdateRequst;
use App\Http\Resources\UserResponseCollection;
use App\Http\Resources\UserResponseResource;
use App\Models\Role;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getUser();

        return new UserResponseCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateRole(RoleUpdateRequst $request)
    {
        $validated = $request->validated();
        $user = User::findOrFail($validated['user_id']);

        $role = Role::where('name', $validated['role'])->first();

        $user->roles()->sync([$role->id]);

        return new UserResponseResource(
            $user->load('roles'),
            'User role updated successfully.'
        );
    }
}

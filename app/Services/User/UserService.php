<?php

namespace App\Services\User;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser(){
        return $this->userRepository->all();
    }

    public function rolePermissionUpdate(FormRequest $request){

    }
}

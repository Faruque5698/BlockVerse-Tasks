<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all(){
        return $this->model->with('roles.permissions')->get();
    }
    public function find($id){

    }
    public function create(array $data){

    }
    public function update(array $data, $id){

    }
    public function delete($id){

    }

    public function updatePermission($permissions, $id)
    {

    }

}

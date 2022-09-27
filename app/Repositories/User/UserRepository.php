<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUsers()
    {
        return $this->connection()->get();
    }

    public function getDevelopers()
    {
        return $this->connection()->where('role_id', config('global.roles_reverse.Developer'))->get();
    }

    public function getUserById($id)
    {
        return $this->connection()->where('id', $id)->first();
    }

    public function insertUser($data)
    {
        return $this->connection()->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->connection()->where('id', $id)->update($data);
    }

    public function deleteUser($id)
    {
        return $this->connection()->where('id', $id)->delete();
    }

    public function connection()
    {
        return new User();
    }
}

<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getUsers();

    public function getDevelopers();

    public function getUserById($id);

    public function insertUser($data);

    public function updateUser($id, $data);

    public function deleteUser($id);
}

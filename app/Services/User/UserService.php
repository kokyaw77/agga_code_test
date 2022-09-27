<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    protected $limit = 10;

    protected $offset = 0;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function getDevelopers()
    {
        return $this->userRepository->getDevelopers();
    }

    public function getUsersWithMetaData($request)
    {
        $options = $this->requestParams($request);

        return $this->userRepository->getUsersWithMetaData($options);
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function insertUser($data)
    {
        return $this->userRepository->insertUser($data);
    }

    public function updateUser($id, $data)
    {
        $data = array_filter($data, function($value) {
            return ($value !== null && $value !== false && $value !== '');
        });

        if(isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }

    public function requestParams($request)
    {
        return [
            'limit' => $request->get('limit') ?? $this->limit,
            'offset' => $request->get('offset') ?? $this->offset,
            'search' => $request->get('search') ?? null
        ];
    }

    public function insertRules()
    {
        return [
            'name' => 'required|string|max:255',
            'role_id' => 'required|integer',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:6',
        ];
    }

    public function updateRules($user)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,'.$user->id,
            'role_id' => 'required|integer',
            'password' => 'nullable|string|min:6'
        ];
    }
}

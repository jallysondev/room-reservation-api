<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepository;

class UserService
{
    public function __construct(
        protected readonly UserRepository $userRepository
    ) {}

    public function create(array $validatedData): User
    {
        return $this->userRepository->create($validatedData);
    }

    public function update(User $user, array $validatedData): User
    {
        return $this->userRepository->update($user, $validatedData);
    }
}

<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    public function __construct(
        protected readonly User $user
    ) {}

    public function create(array $data): User
    {
        return $this->user->create($data);
    }

    public function update(User $user, array $validatedData): User
    {
        $user->update($validatedData);

        return $user->refresh();
    }
}

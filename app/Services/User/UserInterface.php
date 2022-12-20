<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserInterface
{
    public function getUser(int $userId): User;

    public function getAllUsers(
        int $page,
        int $perPage
    ): Collection;

}


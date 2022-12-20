<?php

declare(strict_types=1);

namespace App\Services\User;

use Illuminate\Support\Collection;

interface UserInterface
{
    public function getUser(int $userId): array;

    public function getAllUsers(int $limit, int $perPage, string $ordering = 'desc'): Collection;

}


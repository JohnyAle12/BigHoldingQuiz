<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Services\Http\HttpClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserService implements UserInterface
{
    public function __construct(
        protected HttpClient $httpClient,
    ) {
        $this->persistUserRecords();
    }

    public function getUser(int $userId): User
    {
        $user = Cache::get('users')->where('id', $userId)->first();
        return $this->newUser($user);
    }

    public function getAllUsers(
        int $page = 1,
        int $perPage = 10
    ): Collection {
        $users = Cache::get('users')
            ->sortByDesc('created_at')
            ->forPage($page, $perPage);

        return $users->map(fn($user) => $this->newUser($user));
    }

    private function newUser(array $user): User
    {
        return new User([
            'id' => $user['id'],
            'user_id' => $user['user_id'],
            'identification_number' => $user['identification_number'],
            'mobile_number' => $user['mobile_number'],
            'birth_date' => $user['birth_date'],
            'created_at' => $user['created_at'],
            'updated_at' => $user['updated_at'],
        ]);
    }

    private function persistUserRecords(): void
    {
        Cache::rememberForever('users', fn() => $this->collectUserRecords());
    }

    private function collectUserRecords(): Collection
    {
        $uri = config('services.conectados_web.uri'). 'users/' .config('services.conectados_web.token');
        return collect($this->httpClient->request('GET', $uri));
    }
}

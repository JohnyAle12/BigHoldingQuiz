<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
    ) {
    }

    public function index(Request $request): View
    {
        $page = $request->page ?? 1;
        [$users, $pagination] = $this->userService->getAllUsers((int)$page);

        return view('users', compact('users', 'pagination'));
    }
}

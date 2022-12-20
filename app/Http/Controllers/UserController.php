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
        $perPage = $request->perPage ?? 10;
        $users = $this->userService->getAllUsers($page, $perPage);
        return view('users', compact('users'));
    }
}

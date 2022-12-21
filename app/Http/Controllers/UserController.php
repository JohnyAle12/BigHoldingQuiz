<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\Transaction\TransactionService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected TransactionService $transactionService,
    ) {
    }

    public function user(UserRequest $request): View | RedirectResponse
    {
        $userId = (int)$request->userId;
        $user = $this->userService->getUser($userId);

        if(!$user){
            return redirect()->route('users.index')->withErrors(['Do not exist user with id '.$userId]);
        }

        $transactions = $this->transactionService->getTransactions($userId);
        return view('user', compact('user', 'transactions'));
    }

    public function users(Request $request): View
    {
        $page = $request->page ?? 1;
        [$users, $pagination] = $this->userService->getAllUsers((int)$page);

        return view('users', compact('users', 'pagination'));
    }

    public function transactions(int $userId): View
    {
        $transactions = $this->transactionService->getTransactions($userId);
        return view('transactions', compact('transactions'));
    }
}

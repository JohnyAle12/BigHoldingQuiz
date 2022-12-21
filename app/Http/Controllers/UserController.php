<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Transaction\TransactionService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected TransactionService $transactionService,
    ) {
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

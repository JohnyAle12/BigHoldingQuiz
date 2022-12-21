<?php

declare(strict_types=1);

namespace App\Services\Transaction;

use Illuminate\Support\Collection;

interface TransactionInterface
{
    public function getTransactions(int $userId): Collection;
}


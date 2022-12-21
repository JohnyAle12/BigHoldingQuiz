<?php

declare(strict_types=1);

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Services\Http\HttpClient;
use Illuminate\Support\Collection;

class TransactionService implements TransactionInterface
{
    public function __construct(
        protected HttpClient $httpClient,
    ) {}

    public function getTransactions(int $userId): Collection
    {
        $uri = config('services.conectados_web.uri'). 'users/' .config('services.conectados_web.token'). '/transaction/' . $userId;
        $response = array_map(
            fn($transaction) => $this->newTransaction($transaction),
            $this->httpClient->request('GET', $uri)
        );
        
        return collect($response);
    }

    private function newTransaction(array $transaction): Transaction
    {
        return new Transaction([
            'id' => $transaction['id'],
            'client_id' => $transaction['client_id'],
            'amount' => $transaction['amount'],
            'transaction_detail' => $transaction['transaction_detail'],
            'created_at' => $transaction['created_at'],
            'updated_at' => $transaction['updated_at']
        ]);
    }

}

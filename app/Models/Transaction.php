<?php

declare(strict_types=1);

namespace App\Models;

use App\Shared\AbstractModel;

class Transaction extends AbstractModel
{
    protected array $options = [
        'id' => 'integer',
        'client_id' => 'integer',
        'amount' => 'string',
        'transaction_detail' => ['string', 'null'],
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getUserId(): int
    {
        return $this->getAttribute('client_id');
    }

    public function getAmount(): string
    {
        return $this->getAttribute('amount');
    }

    public function getDetail(): string
    {
        return $this->getAttribute('transaction_detail');
    }

    public function getTimeStamps(): array
    {
        return [
            'created_at' => $this->getAttribute('created_at'),
            'updated_at' => $this->getAttribute('updated_at'),
        ];
    }
}

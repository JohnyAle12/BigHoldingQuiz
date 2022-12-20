<?php

declare(strict_types=1);

namespace App\Models;

use App\Shared\AbstractModel;

class User extends AbstractModel
{
    protected array $options = [
        'id' => 'integer',
        'mobile_number' => ['string', 'null'],
        'birth_date' => ['date', 'null'],
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }
}

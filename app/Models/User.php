<?php

declare(strict_types=1);

namespace App\Models;

use App\Shared\AbstractModel;

class User extends AbstractModel
{
    protected array $options = [
        'id' => 'integer',
        'user_id' => 'integer',
        'identification_number' => 'integer',
        'mobile_number' => ['string', 'null'],
        'birth_date' => ['date', 'null'],
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getUserId(): int
    {
        return $this->getAttribute('user_id');
    }

    public function getIdentification(): string
    {
        return $this->getAttribute('identification_number');
    }

    public function getMobileNumber(): string
    {
        return $this->getAttribute('mobile_number');
    }

    public function getBirthDate(): ?string
    {
        return $this->getAttribute('birth_date');
    }

    public function getTimeStamps(): array
    {
        return [
            'created_at' => $this->getAttribute('created_at'),
            'updated_at' => $this->getAttribute('updated_at'),
        ];
    }
}

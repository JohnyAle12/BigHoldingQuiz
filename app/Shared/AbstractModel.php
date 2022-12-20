<?php

declare(strict_types=1);

namespace App\Shared;

use JsonSerializable;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractModel implements JsonSerializable
{
    protected array $options = [];
    private array $attributes;

    public function __construct(array $parameters)
    {
        $this->attributes = $this->getResolver()->resolve($parameters);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    protected function getAttribute(string $key)
    {
        return $this->attributes[$key];
    }

    protected function getResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();

        foreach ($this->options as $attribute => $types) {
            if (is_array($types)) {
                if (!in_array('null', $types, true)) {
                    $resolver->setRequired($attribute);
                } else {
                    $resolver->setDefault($attribute, null);
                }
            } else {
                $resolver->setRequired($attribute);
            }
        }

        return $resolver;
    }

}

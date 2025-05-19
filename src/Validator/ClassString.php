<?php

declare(strict_types=1);

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ClassString extends Constraint
{
    public const ERROR_MESSAGE_STRING = 'Specified value is not a string';
    public const ERROR_MESSAGE_NOT_FOUND_FMT = "Specified class '%s' not found";
    public const ERROR_MESSAGE_SUBCLASS_FMT = "Specified class '%s' does not implement '%s'";

    public function __construct(
        private readonly ?string $instanceOf = null,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct($options, $groups, $payload);
    }

    public function getTargets(): array|string
    {
        return self::PROPERTY_CONSTRAINT;
    }

    public function getInstanceOf(): ?string
    {
        return $this->instanceOf;
    }
}

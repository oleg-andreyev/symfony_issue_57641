<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ClassStringValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!($constraint instanceof ClassString)) {
            throw new UnexpectedTypeException($constraint, ClassString::class);
        }

        if ($value === null) {
            return;
        }

        if (!is_string($value)) {
            $this->context->buildViolation(sprintf($constraint::ERROR_MESSAGE_STRING, $value))->addViolation();
        }

        if (!class_exists((string) $value)) {
            $this->context->buildViolation(sprintf($constraint::ERROR_MESSAGE_NOT_FOUND_FMT, $value))->addViolation();

            return;
        }

        if ($constraint->getInstanceOf() && !is_subclass_of($value, $constraint->getInstanceOf())) {
            if (is_string($value)) {
                $this->context->buildViolation(
                    sprintf($constraint::ERROR_MESSAGE_SUBCLASS_FMT, $value, $constraint->getInstanceOf()),
                )->addViolation();
            }
        }
    }
}

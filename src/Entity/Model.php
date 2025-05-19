<?php

namespace App\Entity;

use App\Validator\ClassString;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Model
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    public $id;

    #[ClassString(instanceOf: \stdClass::class)]
    #[Assert\NotNull]
    #[ORM\Column(type: 'string')]
    public $foo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
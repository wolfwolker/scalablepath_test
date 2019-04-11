<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="decimal")
     * @var float
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     * @var bool
     */
    private $deleted = false;

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Product constructor.
     *
     * @param string $name
     * @param string $description
     * @param float $price
     */
    public function __construct(string $name, string $description, float $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function __toString()
    {
        return sprintf('%s,%s,%s,%s,%s', $this->id, $this->name, $this->description, $this->price, $this->deleted ? 'deleted' : '');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
}
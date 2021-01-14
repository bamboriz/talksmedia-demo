<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SellerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Seller.
 *
 * @ORM\Entity(repositoryClass=SellerRepository::class)
 */
class Seller
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $type;

    /**
     * @ORM\Column(name="seller_id", type="integer")
     */
    private int $sellerId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $comment;

    /**
     * Constructor.
     */
    public function __construct(string $name, int $sellerId, ?string $comment = null)
    {
        $this->name     = $name;
        $this->sellerId = $sellerId;
        $this->comment  = $comment;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSellerId(): int
    {
        return $this->sellerId;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}

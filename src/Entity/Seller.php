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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private ?int $isConfidential;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private ?int $isPassthrough;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $domain;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSellerId(): int
    {
        return $this->sellerId;
    }

    public function setSellerId(int $sellerId): self
    {
        $this->sellerId = $sellerId;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getIsConfidential(): ?int
    {
        return $this->isConfidential;
    }

    public function setIsConfidential(int $isConfidential): self
    {
        $this->isConfidential = $isConfidential;

        return $this;
    }

    public function getIsPassthrough(): ?int
    {
        return $this->isPassthrough;
    }

    public function setIsPassthrough(int $isPassthrough): self
    {
        $this->isPassthrough = $isPassthrough;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }
}

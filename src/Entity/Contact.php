<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact
 * @package App\Entity
 * @ORM\Table(name="contacts")
 * @ORM\Entity()
 */
class Contact
{
    /**
     * @ORM\Column(type="integer", unique=true, nullable=false)
     * @ORM\GeneratedValue
     * @ORM\Id
     * @var int
     */
    private int $id;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     * @var string
     */
    private string $identifier;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $phone;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string|null
     */
    private ?string $note;

    public function __construct(
        string $firstName,
        string $lastName,
        string $phone,
        string $email,
        ?string $note = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->note = $note;
        $this->identifier = $this->generateIdentifier();
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
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     */
    public function setNote(?string $note): void
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function generateIdentifier(): string
    {
        return urlencode(strtolower($this->firstName . '-' . $this->lastName));
    }
}
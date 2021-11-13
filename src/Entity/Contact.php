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
     * @ORM\Column(type="string", unique=true, nullable=false)
     * @ORM\Id
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
    private string $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string|null
     */
    private ?string $note;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        ?string $note = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->note = $note;
        $this->identifier = $this->createIdentifier();
    }

    /**
     * Returns 0 if unique,
     * otherwise returns the counter number attached to the identifier.
     *
     * @return int
     */
    public function getCounter(): int
    {
        $parsedIdentifier = explode('-', $this->identifier);
        $lastPart = $parsedIdentifier[count($parsedIdentifier) - 1];

        if (is_numeric($lastPart)) {
            return $lastPart;
        }

        return 0;
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
    private function createIdentifier(): string
    {
        return urlencode($this->firstName . '-' . $this->lastName);
    }
}
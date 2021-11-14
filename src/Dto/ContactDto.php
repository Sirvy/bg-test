<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDto
{
    /**
     * @Assert\NotBlank
     * @var string
     */
    private string $firstName;

    /**
     * @Assert\NotBlank
     * @var string
     */
    private string $lastName;

    /**
     * @Assert\Email
     * @var string
     */
    private string $email;

    /**
     * @Assert\Regex(pattern="/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/")
     * @var string
     */
    private string $phone;

    /**
     * @var string
     */
    private string $note;

    public function __construct(
        string $firstName,
        string $lastName,
        string $phone,
        string $email,
        string $note
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }
}
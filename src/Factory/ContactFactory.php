<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\ContactDto;
use App\Entity\Contact;

class ContactFactory
{
    /**
     * @param ContactDto $contactDto
     * @return Contact
     */
    public function createFromDto(ContactDto $contactDto): Contact
    {
        return new Contact(
            $contactDto->getFirstName(),
            $contactDto->getLastName(),
            $contactDto->getPhone(),
            $contactDto->getEmail(),
            $contactDto->getNote()
        );
    }
}
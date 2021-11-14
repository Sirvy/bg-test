<?php

declare(strict_types=1);

namespace App\Handler;

use App\Dto\ContactDto;
use App\Mapper\ContactMapper;

class CreateContactHandler
{
    private ContactMapper $contactMapper;

    public function __construct(ContactMapper $contactMapper)
    {
        $this->contactMapper = $contactMapper;
    }

    public function handle(ContactDto $dto): void
    {
        $this->contactMapper->createEntity($dto);
    }
}
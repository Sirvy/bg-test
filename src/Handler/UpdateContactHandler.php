<?php

declare(strict_types=1);

namespace App\Handler;

use App\Dto\ContactDto;
use App\Mapper\ContactMapper;
use App\Repository\ContactRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateContactHandler
{
    private ContactRepository $contactRepository;
    private ContactMapper $contactMapper;

    public function __construct(
        ContactRepository $contactRepository,
        ContactMapper $contactMapper
    ) {
        $this->contactRepository = $contactRepository;
        $this->contactMapper = $contactMapper;
    }

    public function handle(ContactDto $dto, string $contactIdentifier): void
    {
        $contact = $this->contactRepository->getByIdentifier($contactIdentifier);

        if (null === $contact) {
            throw new NotFoundHttpException('Kontakt byl smazán nebo neexistuje.');
        }

        $this->contactMapper->updateEntity($contact, $dto);
    }
}
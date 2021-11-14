<?php

declare(strict_types=1);

namespace App\Handler;

use App\Mapper\ContactMapper;
use App\Repository\ContactRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteContactHandler
{
    private ContactRepository $contactRepository;
    private ContactMapper $contactMapper;

    public function __construct(ContactRepository $contactRepository, ContactMapper $contactMapper)
    {
        $this->contactRepository = $contactRepository;
        $this->contactMapper = $contactMapper;
    }

    public function handle(string $identifier): void
    {
        $contact = $this->contactRepository->getByIdentifier($identifier);

        if (null === $contact) {
            throw new NotFoundHttpException('Kontakt nebyl nalezen.');
        }

        $this->contactMapper->deleteEntity($contact);
    }
}
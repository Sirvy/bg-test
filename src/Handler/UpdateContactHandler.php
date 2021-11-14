<?php

declare(strict_types=1);

namespace App\Handler;

use App\Factory\ContactDtoFactory;
use App\Mapper\ContactMapper;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateContactHandler
{
    private ContactDtoFactory $dtoFactory;
    private ContactRepository $contactRepository;
    private ValidatorInterface $validator;
    private ContactMapper $contactMapper;

    public function __construct(
        ContactDtoFactory $dtoFactory,
        ContactRepository $contactRepository,
        ValidatorInterface $validator,
        ContactMapper $contactMapper
    ) {
        $this->dtoFactory = $dtoFactory;
        $this->contactRepository = $contactRepository;
        $this->validator = $validator;
        $this->contactMapper = $contactMapper;
    }

    public function handle(Request $request, string $contactIdentifier): void
    {
        $dto = $this->dtoFactory->createFromRequest($request);

        $this->validator->validate($dto);

        $contact = $this->contactRepository->getByIdentifier($contactIdentifier);

        if (null === $contact) {
            throw new NotFoundHttpException('Kontakt byl smazán nebo neexistuje.');
        }

        $this->contactMapper->updateEntity($contact, $dto);
    }
}
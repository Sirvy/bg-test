<?php

declare(strict_types=1);

namespace App\Handler;

use App\Factory\ContactDtoFactory;
use App\Mapper\ContactMapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateContactHandler
{
    private ContactDtoFactory $dtoFactory;
    private ValidatorInterface $validator;
    private ContactMapper $contactMapper;

    public function __construct(
        ContactDtoFactory $dtoFactory,
        ValidatorInterface $validator,
        ContactMapper $contactMapper
    ) {
        $this->dtoFactory = $dtoFactory;
        $this->validator = $validator;
        $this->contactMapper = $contactMapper;
    }

    public function handle(Request $request): void
    {
        $dto = $this->dtoFactory->createFromRequest($request);

        $this->validator->validate($dto);

        $this->contactMapper->createEntity($dto);
    }
}
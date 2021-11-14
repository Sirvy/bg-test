<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dto\ContactDto;
use App\Entity\Contact;
use App\Factory\ContactFactory;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactMapper
{
    private EntityManagerInterface $entityManager;
    private ContactRepository $contactRepository;
    private ContactFactory $contactFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        ContactRepository $contactRepository,
        ContactFactory $contactFactory
    ) {
        $this->entityManager = $entityManager;
        $this->contactRepository = $contactRepository;
        $this->contactFactory = $contactFactory;
    }

    public function createEntity(ContactDto $contactDto): Contact
    {
        $contact = $this->contactFactory->createFromDto($contactDto);

        $this->entityManager->persist($contact);

        $ctr = 1;
        while (null !== $this->contactRepository->getByIdentifier($contact->getIdentifier())) {
            $contact->setIdentifier($contact->generateIdentifier() . '-' . $ctr++);
        }

        $this->entityManager->flush();

        return $contact;
    }

    public function updateEntity(Contact $contact, ContactDto $contactDto): Contact
    {
        $contact->setFirstName($contactDto->getFirstName());
        $contact->setLastName($contactDto->getLastName());
        $contact->setEmail($contactDto->getEmail());
        $contact->setNote($contactDto->getNote());

        $contact->setIdentifier($contact->generateIdentifier());

        $ctr = 1;
        while ($this->contactRepository->contactWithSameIdentifierExists($contact)) {
            $contact->setIdentifier($contact->generateIdentifier() . '-' . $ctr++);
        }

        $this->entityManager->flush();

        return $contact;
    }

    public function deleteEntity(Contact $contact): void
    {
        $this->entityManager->remove($contact);
        $this->entityManager->flush();
    }
}
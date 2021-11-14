<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ContactDtoFactory;
use App\Handler\UpdateContactHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateContactController extends AbstractController
{
    private UpdateContactHandler $handler;
    private ContactDtoFactory $dtoFactory;
    private ValidatorInterface $validator;

    public function __construct(
        UpdateContactHandler $handler,
        ContactDtoFactory $dtoFactory,
        ValidatorInterface $validator
    ) {
        $this->handler = $handler;
        $this->dtoFactory = $dtoFactory;
        $this->validator = $validator;
    }

    /**
     * @Route("/{contactIdentifier}/update", name="app.contact.update", methods={"POST"})
     *
     * @param Request $request
     * @param string $contactIdentifier
     *
     * @return Response
     */
    public function update(Request $request, string $contactIdentifier): Response
    {
        $dto = $this->dtoFactory->createFromRequest($request);

        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $this->addFlash('danger', $error->getMessage());
            }

            return $this->redirectToRoute('app.contact', [
                'contactIdentifier' => $contactIdentifier,
            ]);
        }

        $this->handler->handle($dto, $contactIdentifier);

        $this->addFlash('success', 'Kontakt byl upraven.');

        return $this->redirectToRoute('app.index');
    }
}
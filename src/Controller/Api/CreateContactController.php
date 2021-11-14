<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Factory\ContactDtoFactory;
use App\Handler\CreateContactHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateContactController extends AbstractController
{
    private CreateContactHandler $handler;
    private ContactDtoFactory $dtoFactory;
    private ValidatorInterface $validator;

    public function __construct(
        CreateContactHandler $handler,
        ContactDtoFactory $dtoFactory,
        ValidatorInterface $validator
    ) {
        $this->handler = $handler;
        $this->dtoFactory = $dtoFactory;
        $this->validator = $validator;
    }

    /**
     * @Route("/create", name="app.contact.create", priority=1, methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $dto = $this->dtoFactory->createFromRequest($request);

        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $this->addFlash('danger', $error->getMessage());
            }

            return $this->redirectToRoute('app.contact.new');
        }

        $this->handler->handle($dto);

        $this->addFlash('success', 'Kontakt byl vytvořen.');

        return $this->redirectToRoute('app.index');
    }
}
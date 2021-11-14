<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Handler\CreateContactHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateContactController extends AbstractController
{
    private CreateContactHandler $handler;

    public function __construct(CreateContactHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/create", name="app.contact.create", priority=1, methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $this->handler->handle($request);

        $this->addFlash('success', 'Kontakt byl vytvořen.');

        return $this->redirectToRoute('app.index');
    }
}
<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Handler\UpdateContactHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateContactController extends AbstractController
{
    private UpdateContactHandler $handler;

    public function __construct(UpdateContactHandler $handler)
    {
        $this->handler = $handler;
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
        $this->handler->handle($request, $contactIdentifier);

        $this->addFlash('success', 'Kontakt byl upraven.');

        return $this->redirectToRoute('app.index');
    }
}
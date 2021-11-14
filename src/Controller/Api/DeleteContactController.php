<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Handler\DeleteContactHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteContactController extends AbstractController
{
    private DeleteContactHandler $handler;

    public function __construct(DeleteContactHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/{contactIdentifier}/delete", name="app.contact.delete", methods={"GET"})
     *
     * @param string $contactIdentifier ;
     *
     * @return Response
     */
    public function delete(string $contactIdentifier): Response
    {
        $this->handler->handle($contactIdentifier);

        $this->addFlash('success', 'Kontakt byl úspěšně smazán.');

        return $this->redirectToRoute('app.index');
    }
}
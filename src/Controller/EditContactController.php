<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class EditContactController extends AbstractController
{
    private ContactRepository $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/{contactIdentifier}", name="app.contact")
     *
     * @param string $contactIdentifier
     * @return Response
     */
    public function detail(string $contactIdentifier): Response
    {
        $contact = $this->contactRepository->getByIdentifier($contactIdentifier);

        if (null === $contact) {
            throw new NotFoundHttpException('Kontakt byl již smazán nebo neexistuje.');
        }

        return $this->render('form.html.twig', [
            'contact' => $contact,
        ]);
    }
}
<?php

declare(strict_types=1);

namespace App\Controller;

use App\Factory\ContactDtoFactory;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private ContactRepository $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/", name="app.index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'contacts' => $this->contactRepository->getAll(),
        ]);
    }
}
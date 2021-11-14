<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddContactController extends AbstractController
{
    /**
     * @Route("/new", name="app.contact.new")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('form.html.twig');
    }
}
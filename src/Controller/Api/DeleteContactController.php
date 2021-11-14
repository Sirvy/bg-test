<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteContactController extends AbstractController
{
    /**
     * @Route("/{contactIdentifier}", name="app.contact.update", methods={"POST"})
     *
     * @param Request $request
     * @param string $contactIdentifier ;
     *
     * @return Response
     */
    public function delete(Request $request, string $contactIdentifier): Response
    {
        return $this->render('form.html.twig');
    }
}
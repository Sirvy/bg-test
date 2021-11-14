<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\ContactDto;
use Symfony\Component\HttpFoundation\Request;

class ContactDtoFactory
{
    /**
     * @param Request $request
     * @return ContactDto
     */
    public function createFromRequest(Request $request): ContactDto
    {
        return new ContactDto(
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('phone'),
            $request->get('email'),
            $request->get('note')
        );
    }
}
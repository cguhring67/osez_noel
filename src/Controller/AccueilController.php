<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccueilController extends AbstractController
{

	#[Route('/', name: 'accueil')]
	public function render_accueil(): Response
	{

		return $this->render('accueil.html.twig');
	}


	#[Route('/contact', name: 'contact')]
	public function render_contact(): Response
	{

		return $this->render('contact.html.twig');
	}

}

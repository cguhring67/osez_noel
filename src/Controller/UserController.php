<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
	#[Route('/connexion', name: 'connexion')]
	public function render_connexion(): Response
	{

		return $this->render('connexion.html.twig');
	}
}

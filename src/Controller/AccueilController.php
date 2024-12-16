<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
	#[Route('/', name: 'accueil')]
	public function render_accueil(): Response
	{

		return $this->render('accueil.html.twig');
	}
}

<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalController extends AbstractController
{

	#[Route('/mentions_legales', name: 'mentions_legales')]
	public function render_mentions_legales(): Response
	{

		return $this->render('mentions_legales.html.twig');
	}


	#[Route('/confidentialite', name: 'confidentialite')]
	public function render_confidentialite(): Response
	{

		return $this->render('confidentialite.html.twig');
	}

}

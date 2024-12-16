<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MoncompteController extends AbstractController
{

	#[Route('/mon_compte', name: 'mon_compte')]
	public function render_mon_compte(): Response
	{

		return $this->render('mon_compte.html.twig');
	}

	#[Route('/nouveau_calendrier', name: 'nouveau_calendrier')]
	public function render_nouveau_calendrier(): Response
	{

		return $this->render('edit_calendrier.html.twig');
	}

	#[Route('/mes_informations', name: 'mes_informations')]
	public function render_mes_informations(): Response
	{

		return $this->render('mes_informations.html.twig');
	}

}

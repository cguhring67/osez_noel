<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListefichiersController extends AbstractController
{

	#[Route('/ajax/liste_arriere_plans', name: 'liste_arriere_plans', methods: ['GET'])]
	public function ajax_arriere_plan(): Response
	{

		$racine_projet = $this->getParameter('kernel.project_dir');
		$directory_images = '/images/fonds_calendriers';
		$directory = $racine_projet . '/public' . $directory_images;
		$files = [];

		if (is_dir($directory))
		{
			dump($directory);
			foreach (scandir($directory) as $file)
			{
				if (pathinfo($file, PATHINFO_EXTENSION) === 'jpg' || pathinfo($file, PATHINFO_EXTENSION) === 'jpeg' || pathinfo($file, PATHINFO_EXTENSION) === 'png')
				{
					$files[] = $file;
				}
			}
		}

		return $this->json($files);
//		return new Response(json_encode($files));

	}

	#[Route('/ajax/liste_themes', name: 'liste_themes', methods: ['GET'])]
	public function ajax_themes(): Response
	{

		$racine_projet = $this->getParameter('kernel.project_dir');
		$directory_images = '/images/modeles_calendriers';
		$directory = $racine_projet . '/public' . $directory_images;
		$files = [];

		if (is_dir($directory))
		{
			dump($directory);
			foreach (scandir($directory) as $file)
			{
				if (pathinfo($file, PATHINFO_EXTENSION) === 'jpg' || pathinfo($file, PATHINFO_EXTENSION) === 'jpeg' || pathinfo($file, PATHINFO_EXTENSION) === 'png')
				{
					$files[] = $file;
				}
			}
		}

		return $this->json($files);
//		return new Response(json_encode($files));

	}
}

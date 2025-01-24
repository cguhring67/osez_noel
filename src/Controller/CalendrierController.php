<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Calendrier;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Uid\Uuid;

class CalendrierController extends AbstractController
{
	#[Route('/mon_compte/nouveau_calendrier', name: 'nouveau_calendrier')]
	public function render_nouveau_calendrier(CalendrierRepository $calendrierRepository): Response
	{
		$user = $this->getUser();
		$calendrier = new Calendrier();
		$calendrier->setCalendrierUserId($user);
		$calendrierRepository->save($calendrier);

		dump($calendrier);
//		return $this->render('edit_calendrier.html.twig', [
//			'calendrier' => $calendrier,
//		]);
		return $this->redirectToRoute('calendrier_edit', ['id' => $calendrier->getId()]);

	}

	#[Route('/mon_compte/edit_calendrier/{id}', name: 'calendrier_edit', methods: ['GET'])]
	public function render_edit_calendrier(RouterInterface $router, Calendrier $calendrier = null): Response
	{
		dump($calendrier);

		return $this->render('edit_calendrier.html.twig', [
           'calendrier' => $calendrier,
       ]);
	}

	#[Route('/mon_compte/edit_calendrier_ajax/{id}', name: 'calendrier_edit_ajax', methods: ['POST'])]
	public function save_calendrier(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): JsonResponse|Response
	{
		if($request->isXmlHttpRequest()) {
			$data = json_decode($request->getContent(), true);
			dump($data);
			$message = "Requête AJAX OK";

			//$calendrierRepository->save($calendrier, true);

			return new JsonResponse(['message' => $message]);
		}
		return new JsonResponse(['error' => 'Cet appel doit être effectué via AJAX.'], Response::HTTP_BAD_REQUEST);
	}

	#[Route('/mon_compte/suppr_calendrier/{id}', name: 'calendrier_suppr', methods: ['POST'])]
	public function delete(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): Response
	{
		$calendrierRepository->remove($calendrier, true);

		return $this->redirectToRoute('mon_compte', [], Response::HTTP_SEE_OTHER);
	}
}

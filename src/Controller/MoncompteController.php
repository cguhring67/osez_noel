<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\MesInfosFormType;
use App\Repository\CalendrierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class MoncompteController extends AbstractController
{

	#[Route('/mon_compte', name: 'mon_compte')]
	public function render_mon_compte(CalendrierRepository $calendrierRepository): Response
	{

		dump($calendrierRepository->findAll());
		return $this->render('mon_compte.html.twig',
		[
			'calendriers' => $calendrierRepository->findAll(),
		]);
	}


	#[Route('/mes_informations', name: 'mes_informations')]
	public function render_mes_informations(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
	{

		$user = $this->getUser();
		$form = $this->createForm(MesInfosFormType::class, $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			/** @var string $plainPassword */
			$plainPassword = $form->get('password')->getData();
			if ($plainPassword !== null) {
				// encode the plain password
				$user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
			}

			$entityManager->persist($user);
			$entityManager->flush();

			$this->addFlash('success', 'Vos nouvelles informations ont bien été enregistrées !');
			return $this->redirectToRoute('mes_informations');

		}

		return $this->render('mes_informations.html.twig', [
			'mesInfosForm' => $form,
		]);
	}

}

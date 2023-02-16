<?php

namespace App\Controller;

use App\Entity\Typevehicule;
use App\Entity\User;
use App\Form\ChoixVehiculeType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * 
 *
 */
class LivreurController extends AbstractController
{
    /**
     * @Route("/choixVehicule/{id}", name="app_choixVehicule")
     * 
     */
    public function choixVehicule($id, UserRepository $userRepository, ManagerRegistry $doctrine, Request $request): Response
    {
        $choixVehicule = new Typevehicule();
        $User = $userRepository->find($id);
        $form = $this->createForm(ChoixVehiculeType::class, $User);

        $manager = $doctrine->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $User = $form->getData();
            //$typeVehicule->setUser($this->getUser());
            // $User->setFkTypeVehicule($form->get('fk_type_vehicule')->getData());
            $manager->persist($User);
            $manager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->renderForm('livreur/index.html.twig', [
            'form' => $form,
        ]);
    }
}

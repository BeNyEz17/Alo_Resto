<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Entity\PlatsCommander;
use App\Entity\Restaurant;
use App\Form\LivraisonType;
use App\Repository\LivraisonRepository;
use App\Repository\PlatRepository;
use App\Repository\RestaurantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Translation\Dumper\QtFileDumper;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/passerCommande/{id}", name="app_passerCommande")
     */
    public function passerCommande($id, PlatRepository $platRepository, RestaurantRepository $restaurantRepository, ManagerRegistry $doctrine, Request $request): Response
    {
        $livraison = new Livraison();
        // $restaurant = new Restaurant();
        $idRestaurant = $restaurantRepository->find($id);
        $form = $this->createForm(LivraisonType::class, $livraison);

        $manager = $doctrine->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livraison = $form->getData();
            $livraison->setFkUser($this->getUser());
            $livraison->setFkRestaurant($idRestaurant);
            $platcmd = new PlatsCommander();
            $platcmd->setFkPlats($form->get('plat')->getData());
            $platcmd->setQuantite($form->get('quantite')->getData());
            $platcmd->setFkLivraisons($livraison);
            $manager->persist($livraison);
            $manager->persist($platcmd);
            // persist platcmd
            $manager->flush();
            return $this->redirectToRoute('app_commande');
        }
        return $this->renderForm('commande/index.html.twig', [
            'form' => $form,
        ]);
    }
}

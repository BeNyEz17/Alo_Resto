<?php

namespace App\Controller;

use App\Repository\LivraisonRepository;
use App\Repository\PlatRepository;
use App\Repository\RestaurantRepository;
use App\Repository\SecteurlivraisonRepository;
use App\Repository\TypeplatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */

class ClientController extends AbstractController
{
    /**
     * @Route("/plat", name="app_plat")
     */
    public function index(PlatRepository $platRepository): Response
    {
        $plat = $platRepository->findAll();
        return $this->render('client/index.html.twig', [
            'plats' => $plat,
        ]);
    }

    /**
     * @Route("/Mescommande", name="app_commande")
     */
    public function commande(LivraisonRepository $livraisonRepository, RestaurantRepository $restaurantRepository, PlatRepository $platRepository): Response
    {
        $commande = $livraisonRepository->findAll();
        $restaurant = $restaurantRepository->findAll();
        $plat = $platRepository->findAll();
        return $this->render('client/commande.html.twig', [
            'commandes' => $commande,
            'restaurants' => $restaurant,
            'plats' => $plat,
        ]);
    }

    /**
     * @Route("/PlatsByType/{id}", name="app_platsByType")
     */
    public function repasByType(TypeplatRepository $typeplatRepository, $id): Response
    {
        $platByType = $typeplatRepository->find($id);
        return $this->render('client/repasByType.html.twig', [
            'platByType' => $platByType,
        ]);
    }

    /**
     * @Route("/RestaurantBySecteur/{id}", name="app_RestaurantBySecteur")
     */
    public function restaurantBySecteur(SecteurlivraisonRepository $secteurlivraisonRepository, $id): Response
    {
        $restaurantBySecteur = $secteurlivraisonRepository->find($id);
        return $this->render('client/restaurantBySecteur.html.twig', [
            'restaurantBySecteur' => $restaurantBySecteur,
        ]);
    }

    /**
     * @Route("/dropdown", name="app_dropdown")
     */
    public function dropdown(TypeplatRepository $typeplatRepository): Response
    {
        
        $platByType = $typeplatRepository->findAll();
        return $this->render('client/dropdownmenu.html.twig', [
            'platByTypes' => $platByType,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\SuivieDeCommande;
use App\Form\ModifierlessuivisdecommandeType;
use App\Repository\LivraisonRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\RestaurantRepository;
use App\Repository\SuivieDeCommandeRepository;
use App\Repository\TypeplatRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Livraison;
use App\Entity\Restaurant;
use App\Form\LivraisonType;
use Symfony\Component\DomCrawler\Form;

class RestaurateurController extends AbstractController
{

    /**
     * @Route("/restaurateur", name="app_restaurateur")
     * @IsGranted("ROLE_Restaurateur")
     */
    public function index(RestaurantRepository $RestaurantRepository, TypeplatRepository $typeplatRepository, UserRepository $userRepository): Response
    {
        $restaurateurs = $RestaurantRepository->findAll();
        $typeplats = $typeplatRepository->findAll();
        $users = $userRepository->findAll();

        return $this->render('restaurateur/index.html.twig', [
            'restaurateurs' => $restaurateurs,
            'typeplats' => $typeplats,
            'users' => $users,
        ]);
    }

    /**
     * @Route("/disponible/{id}", name="app_disponible")
     * @IsGranted("ROLE_Restaurateur")
     */
    public function disponible(TypeplatRepository $typeplatRepository, PlatRepository $platRepository): Response
    {
        $typeplats = $typeplatRepository->findAll();
        $plats = $platRepository->findAll();


        return $this->render('restaurateur/disponible.html.twig', [
            'typeplats' => $typeplats,
            'plats' => $plats,
        ]);
    }

    /**
     * @Route("/preparationCommandes/{id}", name="app_preparationCommandes")
     * @IsGranted("ROLE_Restaurateur")
     * @IsGranted("ROLE_livreur")
     */
    public function preparation(SuivieDeCommandeRepository $suivieDeCommandeRepository, $id): Response
    {
        $suivieDeCommandes = $suivieDeCommandeRepository->find($id);
        return $this->render('restaurateur/preparationCommandes.html.twig', [
            'suivieDeCommandes' => $suivieDeCommandes,
        ]);
    }

    /**
     * @Route("/modifierlesuivie/{id}", name="app_modifierlesuivie")
     * @IsGranted("ROLE_Restaurateur")
     * @IsGranted("ROLE_livreur")
     */
    public function modifier($id, Livraison $livraison, LivraisonRepository $livraisonRepository, ManagerRegistry $doctrine, Request $request, SuivieDeCommandeRepository $suivieDeCommandeRepository): Response
    {
        $livraison = $livraisonRepository->find($id);
        $form = $this->createForm(ModifierlessuivisdecommandeType::class, $livraison);
        $manager = $doctrine->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livraison = $form->getData();
            $manager->persist($livraison);
            $manager->flush();
            return $this->redirectToRoute("app_accueil");
        }
        return $this->renderForm('restaurateur/modifiersuiviecommande.html.twig', [
            'form' => $form,
            'livraison' => $livraison,

        ]);
    }

     /**
     * @Route("/dropdownpreparation", name="app_dropdownpreparation")
     */
    public function dropdownpreparation(SuivieDeCommandeRepository $suivieDeCommandeRepository): Response
    {
        $suivieDeCommandes = $suivieDeCommandeRepository->findAll();
        return $this->render('restaurateur/dropdownpreparation.html.twig', [
            'suivieDeCommandes' => $suivieDeCommandes,
        ]);
    }
}

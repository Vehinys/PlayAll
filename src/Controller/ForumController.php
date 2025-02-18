<?php

namespace App\Controller;

use App\Repository\AnnonceForumRepository;
use App\Repository\ForumCategoryRepository;
use App\Repository\ForumSousCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ForumCategory;
use App\Form\AnnonceForumType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class ForumController extends AbstractController
{
    #[Route('/forum', name: 'app_forum')]
    public function index(

        ForumCategoryRepository $forumCategoryRepository,
        ForumSousCategoryRepository $ForumSousCategoryRepository,
        AnnonceForumRepository $annonceForumRepository

    ): Response {

        $forumCategory = $forumCategoryRepository->findBy([]);
        $forumSousCategory = $ForumSousCategoryRepository->findBy([]);
        $annonceForum = $annonceForumRepository->findBy([]);

        return $this->render('forum/index.html.twig', [
            'forumCategory' => $forumCategory,
            'forumSousCategory' => $forumSousCategory,
            'annonceForum' => $annonceForum,
            
        ]);
    }

    #[Route('/forum/{id}/editAnnonce', name: 'app_forum_edit_annonce')]
    public function editAnnonce(

        ForumCategoryRepository $forumCategoryRepository,
        ForumSousCategoryRepository $ForumSousCategoryRepository,
        ForumCategory $ForumCategory, 
        Request $request, 
        EntityManagerInterface $manager

    ): Response {

        $forumCategory = $forumCategoryRepository->findBy([]);
        $forumSousCategory = $ForumSousCategoryRepository->findBy([]);
    
        // Création du formulaire pour l'annonce existante
        $form = $this->createForm(AnnonceForumType::class, $ForumCategory->getRelationAnnonceForum());
        $form->handleRequest($request);
    
        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde les modifications dans la base de données
            $manager->flush();
    
            // Redirige vers la page de la catégorie du forum où l'annonce a été modifiée
            // Utilise la relation à la catégorie à partir de l'annonce
            return $this->redirectToRoute('app_forum', [
                'id' => $ForumCategory->getRelationAnnonceForum()->getId(),
            ]);
        }
    
        // Rendu du formulaire et de l'annonce à la vue
        return $this->render('forum/edit_annonce.html.twig', [
            'form' => $form->createView(),
            'forumCategory' => $forumCategory,
            'forumSousCategory' => $forumSousCategory,
        ]);
    }
    

}

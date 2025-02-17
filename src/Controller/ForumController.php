<?php

namespace App\Controller;

use App\Repository\ForumCategoryRepository;
use App\Repository\ForumSousCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ForumController extends AbstractController
{
    #[Route('/forum', name: 'app_forum')]
    public function index(

        ForumCategoryRepository $forumCategoryRepository,
        ForumSousCategoryRepository $ForumSousCategoryRepository,

    ): Response {

        $forumCategory = $forumCategoryRepository->findBy([]);
        $forumSousCategory = $ForumSousCategoryRepository->findBy([]);

        return $this->render('forum/index.html.twig', [
            'forumCategory' => $forumCategory,
            'forumSousCategory' => $forumSousCategory,

        ]);
    }
}

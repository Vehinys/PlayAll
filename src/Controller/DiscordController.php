<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DiscordController extends AbstractController
{
    #[Route('/discord', name: 'app_discord')]
    public function index(): Response
    {
        return $this->render('discord/index.html.twig', [
            'controller_name' => 'DiscordController',
        ]);
    }
}

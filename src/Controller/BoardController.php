<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    #[Route('/', name: 'board')]
    public function index(Request $request): Response
    {
        return $this->render('board.html.twig', [
            'controller_name' => 'BoardController',
        ]);
    }
}

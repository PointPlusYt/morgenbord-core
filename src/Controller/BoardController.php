<?php

namespace App\Controller;

use App\Repository\UserWidgetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    #[Route('/', name: 'board')]
    public function index(Request $request, UserWidgetRepository $userWidgetRepository): Response
    {
        return $this->render('board.html.twig', [
            // TODO : make sure it's for the connected user
            'userWidgets' => $userWidgetRepository->findAll(),
        ]);
    }
}

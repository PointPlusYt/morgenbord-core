<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\UserWidgetRepository;
use App\Service\WidgetRegistration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
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

    #[Route('/add-widget', name: 'add_widget', methods: ['POST'])]
    public function register(RequestStack $request, UserRepository $userRepository, WidgetRegistration $widgetRegistration): Response
    {        
        // get widget details from form or json
        $widgetDetails = $request->getCurrentRequest()->request->all();
        // TEMP TO GET actual user
        // $this->getUser();
        $user = $userRepository->findOneBy([]);
        $userWidget = $widgetRegistration->registerWidget($widgetDetails, $user);

        return $this->redirectToRoute('board');
    }
}

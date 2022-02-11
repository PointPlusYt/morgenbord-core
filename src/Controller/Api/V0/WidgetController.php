<?php

namespace App\Controller\Api\V0;

use App\Entity\User;
use App\Service\WidgetRegistration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v0/widget', name: 'api_v0_widget')]
class WidgetController extends AbstractController
{
    private $request;
    private $widgets;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->widgets = $requestStack->getCurrentRequest()->widgets;
    }

    #[Route('', name: '_register', methods: ['POST'])]
    public function register(WidgetRegistration $widgetRegistration): Response
    {        
        // get widget details from form or json
        $widgetDetails = json_decode($this->request->getContent(), true);
        // TEMP TO GET actual user
        // $this->getUser();
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $userWidget = $widgetRegistration->registerWidget($widgetDetails, $user);

        return $this->json([$this->widgets, $userWidget], 200, [], ['groups' => ['read']]);
    }
}

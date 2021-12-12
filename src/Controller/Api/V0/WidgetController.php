<?php

namespace App\Controller\Api\V0;

use App\Entity\User;
use App\Entity\UserWidget;
use App\Service\LoadWidget;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v0/widget', name: 'api_v0_widget')]
class WidgetController extends AbstractController
{
    private $manager;
    private $request;
    private $widgets;

    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack)
    {
        $this->manager = $manager;
        $this->request = $requestStack->getCurrentRequest();
        $this->widgets = $requestStack->getCurrentRequest()->widgets;
    }

    #[Route('', name: '_register', methods: ['POST'])]
    public function register(LoadWidget $loadWidget): Response
    {        
        $widgetDetails = json_decode($this->request->getContent());

        $registeredWidget = $this->widgets[$widgetDetails->shortname];

        // Créer un objet à mettre en BDD avec les détails du widget.
        $userWidget = new UserWidget();
        $userWidget->setFqcn($registeredWidget->getFqcn());

        // TEMP TO GET actual user
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $userWidget->setOwner($user);

        $loadWidget->loadParameters($widgetDetails->widget_parameters, $registeredWidget, $userWidget);

        $this->manager->persist($userWidget);
        $this->manager->flush();

        return $this->json([$this->widgets, $userWidget], 200, [], ['groups' => ['read']]);
    }
}

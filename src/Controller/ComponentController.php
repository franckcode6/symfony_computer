<?php

namespace App\Controller;

use App\Entity\Component;
use App\Form\ComponentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/component", name="component")
 */
class ComponentController extends AbstractController
{
    /**
     * @Route("/", name="component_index")
     */
    public function index(): Response
    {
        return $this->render('component/index.html.twig', [
            'controller_name' => 'ComponentController',
        ]);
    }

    /**
     * @Route("/new", name="component_new")
     */
    public function new(): Response
    {
        $component = new Component();

        $form = $this->createForm(ComponentType::class, $component);

        return $this->render('component/new.html.twig', [
            'formComponent' => $form->createView(),
        ]);
    }
}

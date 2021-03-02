<?php

namespace App\Controller;

use App\Entity\Component;
use App\Form\ComponentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/composant", name="composant_")
 */
class ComposantController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('composant/index.html.twig', [
            'controller_name' => 'ComposantController',
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(): Response
    {
        $component = new Component();

        $form = $this->createForm(ComponentType::class, $component);

        return $this->render('composant/new.html.twig', [
            'formComponent' => $form->createView(),
        ]);
    }
}

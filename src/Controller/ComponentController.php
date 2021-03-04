<?php

namespace App\Controller;

use App\Entity\Component;
use App\Form\ComponentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/component", name="component_")
 */
class ComponentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('component/index.html.twig', [
            'controller_name' => 'ComponentController',
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $component = new Component();

        $form = $this->createForm(ComponentType::class, $component, [
            'method' => 'POST',
            'action' => $this->generateUrl('component_new'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em->persist($component);
            $em->flush();

            return $this->redirectToRoute('component_index');
        }


        return $this->render('component/new.html.twig', [
            'formComponent' => $form->createView(),
        ]);
    }
}

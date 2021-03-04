<?php

namespace App\Controller;

use App\Entity\Component;
use App\Form\ComponentType;
use App\Repository\ComponentRepository;
use DateTime;
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
    public function index(ComponentRepository $componentRepository): Response
    {
        $components = $componentRepository->findAll();
        return $this->render('component/index.html.twig', [
            'components' => $components,
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @Route("/{id}/edit", name="edit")
     * 
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Component|null $component
     * 
     */
    public function new(Request $request, EntityManagerInterface $em, Component $component = null): Response
    {
        
        if(empty($component)){
            $component = new Component();
        }

        $form = $this->createForm(ComponentType::class, $component, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $component->setUptadedAt(new DateTime());
            $em->persist($component);
            $em->flush();

            return $this->redirectToRoute('component_index');
        }


        return $this->render('component/new.html.twig', [
            'formComponent' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/remove", name="remove")
     */
    public function remove(Component $component, EntityManagerInterface $em)
    {
        $em->remove($component);
        $em->flush();

        return $this->redirectToRoute('component_index');
    }
}

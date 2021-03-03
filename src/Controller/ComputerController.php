<?php

namespace App\Controller;

use App\Entity\Computer;
use App\Form\ComputerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/computer", name="computer")
 */
class ComputerController extends AbstractController
{
    /**
     * @Route("/", name="computer_index")
     */
    public function index(): Response
    {
        return $this->render('computer/index.html.twig', [
            'controller_name' => 'ComputerController',
        ]);
    }

    /**
     * @Route("/new", name="computer_new")
     */
    public function new(): Response
    {
        $computer = new Computer();
        $form = $this->createForm(ComputerType::class, $computer);
        return $this->render('computer/new.html.twig', [
            'formComputer' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Computer;
use App\Entity\Device;
use App\Form\ComputerType;
use App\Repository\ComputerRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/computer", name="computer_")
 */
class ComputerController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ComputerRepository $computerRepository): Response
    {
        $computer = $computerRepository->findAll();
        return $this->render('computer/index.html.twig', [
            'computers' => $computer]);
    }

    /**
     * @Route("/new", name="new")
     * @Route("/{id}/edit", name="edit")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param Computer|null $computer
     */
    public function new(Request $request, EntityManagerInterface $entityManager, Computer $computer = null): Response
    {
        if (empty($computer)) {
            $computer = new Computer();
        }

        $form = $this->createForm(ComputerType::class, $computer, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $computer->setUpdatedAt(new DateTime());
            $entityManager->persist($computer);
            $entityManager->flush();

            return $this->redirectToRoute('computer_index');
        }

        return $this->render('computer/new.html.twig', [
            'formComputer' => $form->createView(),
        ]);
    }

    /**
         * @Route("/{id}/remove", name="remove")
         */
    public function remove(Computer $computer, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($computer);
        $entityManager->flush();

        return $this->redirectToRoute('computer_index');
    }
}

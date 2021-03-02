<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/device", name="device")
 */
class DeviceController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('device/index.html.twig', [
            'controller_name' => 'DeviceController',
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(): Response
    {
        $device = new Device();

        $form = $this->createForm(DeviceType::class, $device);
        /*$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($device);
            $entityManager->flush();

            return $this->redirectToRoute('device_index');
        }*/

        return $this->render('device/new.html.twig', [
            'formDevice' => $form->createView(),
        ]);
    }
}

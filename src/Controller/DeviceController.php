<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Repository\DeviceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/device")
 */
class DeviceController extends AbstractController
{
    /**
     * @Route("/", name="device_index")
     */
    public function index(DeviceRepository $deviceRepository): Response
    {
        $devices = $deviceRepository->findAll();
        return $this->render('device/index.html.twig', ['devices' => $devices]);
    }

    /**
     * @Route("/new", name="device_new")
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $device = new Device();

        $form = $this->createForm(DeviceType::class, $device, [
            'method' => 'POST',
            'action' => $this->generateUrl('device_new'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($device);
            $em->flush();

            return $this->redirectToRoute('device_index');
        }

        return $this->render('device/new.html.twig', [
            'formDevice' => $form->createView(),
        ]);
    }
}

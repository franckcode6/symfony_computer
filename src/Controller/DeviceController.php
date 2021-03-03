<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Repository\DeviceRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/device", name="device_")
 */
class DeviceController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(DeviceRepository $deviceRepository): Response
    {
        $devices = $deviceRepository->findAll();
        return $this->render('device/index.html.twig', ['devices' => $devices]);
    }

    /**
     * @Route("/new", name="new")
     * @Route("/{id}/edit", )
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
            $device->setUpdatedAt(new DateTime());

            $em->persist($device);
            $em->flush();

            return $this->redirectToRoute('device_index');
        }

        return $this->render('device/new.html.twig', [
            'formDevice' => $form->createView(),
        ]);
    }
}

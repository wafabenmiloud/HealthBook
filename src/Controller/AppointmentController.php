<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    #[Route('/appointments', name: 'appointment_list')]
    public function list(AppointmentRepository $appointmentRepository): Response
    {
        $appointments = $appointmentRepository->findAll();
        return $this->render('appointment/list.html.twig', [
            'appointments' => $appointments,
        ]);
    }

    #[Route('/appointments/{id}', name: 'appointment_view', requirements: ['id' => '\d+'])]
    public function view(int $id, AppointmentRepository $appointmentRepository): Response
    {
        $appointment = $appointmentRepository->find($id);
        if (!$appointment) {
            throw $this->createNotFoundException('The appointment does not exist');
        }

        return $this->render('appointment/view.html.twig', [
            'appointment' => $appointment,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorController extends AbstractController
{
    #[Route('/doctors', name: 'doctor_list')]
    public function list(DoctorRepository $doctorRepository): Response
    {
        $doctors = $doctorRepository->findAll();
        return $this->render('doctor/list.html.twig', [
            'doctors' => $doctors,
        ]);
    }

    #[Route('/doctors/{id}', name: 'doctor_view', requirements: ['id' => '\d+'])]
    public function view(int $id, DoctorRepository $doctorRepository): Response
    {
        $doctor = $doctorRepository->find($id);
        if (!$doctor) {
            throw $this->createNotFoundException('The doctor does not exist');
        }

        return $this->render('doctor/view.html.twig', [
            'doctor' => $doctor,
        ]);
    }
}

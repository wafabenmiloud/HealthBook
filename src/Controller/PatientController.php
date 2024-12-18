<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Appointment;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    #[Route('/patients', name: 'patient_list')]
    public function list(PatientRepository $patientRepository): Response
    {
        $patients = $patientRepository->findAll();
        return $this->render('patient/list.html.twig', [
            'patients' => $patients,
        ]);
    }

    #[Route('/patients/{id}', name: 'patient_view', requirements: ['id' => '\d+'])]
    public function view(int $id, PatientRepository $patientRepository): Response
    {
        $patient = $patientRepository->find($id);
        if (!$patient) {
            throw $this->createNotFoundException('The patient does not exist');
        }

        return $this->render('patient/view.html.twig', [
            'patient' => $patient,
        ]);
    }
}

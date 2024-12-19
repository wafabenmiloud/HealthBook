<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorController extends AbstractController
{
    #[Route('/doctors', name: 'doctor_list')]
    public function list(Request $request, DoctorRepository $doctorRepository): Response
    {
        // Get the search query from the request
        $search = $request->query->get('search', '');

        // Filter doctors by name if a search query is provided
        if ($search) {
            $queryBuilder = $doctorRepository->createQueryBuilder('d');
            $queryBuilder->where($queryBuilder->expr()->like('d.name', ':search'))
                ->setParameter('search', '%' . $search . '%');
            
            $doctors = $queryBuilder->getQuery()->getResult();
        } else {
            $doctors = $doctorRepository->findAll();
        }

        // Render the template with the filtered doctors
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

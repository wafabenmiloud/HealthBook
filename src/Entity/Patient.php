<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 15)]
    private string $phone;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $medicalHistory = null;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Appointment::class)]
    private Collection $appointments;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }

    // Getters and Setters for each attribute

    public function bookAppointment(Appointment $appointment): void
    {
        $this->appointments->add($appointment);
        $appointment->setPatient($this);
    }

    public function viewMedicalHistory(): ?string
    {
        return $this->medicalHistory;
    }
}

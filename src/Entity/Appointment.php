<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'datetime')]
    private DateTime $date;

    #[ORM\Column(type: 'string', length: 50)]
    private string $status;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'appointments')]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(targetEntity: Doctor::class, inversedBy: 'appointments')]
    private ?Doctor $doctor = null;

    #[ORM\ManyToOne(targetEntity: Clinic::class)]
    private ?Clinic $clinic = null;

    public function confirmAppointment(): void
    {
        $this->status = 'Confirmed';
    }

    public function cancelAppointment(): void
    {
        $this->status = 'Canceled';
    }

    // Getters and Setters
}

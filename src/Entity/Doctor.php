<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $specialization;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 15)]
    private string $phone;

    #[ORM\OneToMany(mappedBy: 'doctor', targetEntity: Appointment::class)]
    private Collection $appointments;

    #[ORM\ManyToOne(targetEntity: Clinic::class, inversedBy: 'doctors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clinic $clinic = null;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }

    public function getClinic(): ?Clinic
    {
        return $this->clinic;
    }

    public function setClinic(?Clinic $clinic): self
    {
        $this->clinic = $clinic;

        return $this;
    }

    public function scheduleAppointment(Appointment $appointment): void
    {
        $this->appointments->add($appointment);
        $appointment->setDoctor($this);
    }

    public function viewAppointments(): Collection
    {
        return $this->appointments;
    }
}

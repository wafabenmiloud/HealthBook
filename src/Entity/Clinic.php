<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Clinic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $address;

    #[ORM\Column(type: 'string', length: 15)]
    private string $phone;

    #[ORM\OneToMany(mappedBy: 'clinic', targetEntity: Doctor::class)]
    private Collection $doctors;

    public function __construct()
    {
        $this->doctors = new ArrayCollection();
    }

    public function addDoctor(Doctor $doctor): void
    {
        $this->doctors->add($doctor);
        $doctor->setClinic($this);
    }

    public function viewDoctors(): Collection
    {
        return $this->doctors;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 50)]
    private string $role;

    public function manageDoctors(): void
    {
        // Logic for managing doctors
    }

    public function managePatients(): void
    {
        // Logic for managing patients
    }

    public function manageAppointments(): void
    {
        // Logic for managing appointments
    }
}

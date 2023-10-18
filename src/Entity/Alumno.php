<?php

namespace App\Entity;

use App\Repository\AlumnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnoRepository::class)]
class Alumno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $nombre = null;

    #[ORM\Column(length: 16)]
    private ?string $apellidoPaterno = null;

    #[ORM\Column(length: 16)]
    private ?string $apellidoMaterno = null;

    #[ORM\Column]
    private ?int $dni = null;

    #[ORM\OneToMany(mappedBy: 'Alumno_idAlumno', targetEntity: Matricula::class)]
    private Collection $MatriculaF;

    /* #[ORM\OneToOne(inversedBy: 'idAlumno', cascade: ['persist', 'remove'])]
    private ?User $Usuarios = null; */


    #[ORM\OneToOne(targetEntity: "User", inversedBy: "alumno", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(name: "usuarios_id", referencedColumnName: "id")]
    private ?User $Usuarios = null;



    public function __construct()
    {
        $this->MatriculaF = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidoPaterno(): ?string
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno(string $apellidoPaterno): static
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    public function getApellidoMaterno(): ?string
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno(string $apellidoMaterno): static
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(int $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * @return Collection<int, Matricula>
     */
    public function getMatriculaF(): Collection
    {
        return $this->MatriculaF;
    }

    public function addMatriculaF(Matricula $matriculaF): static
    {
        if (!$this->MatriculaF->contains($matriculaF)) {
            $this->MatriculaF->add($matriculaF);
            $matriculaF->setAlumnoIdAlumno($this);
        }

        return $this;
    }

    public function removeMatriculaF(Matricula $matriculaF): static
    {
        if ($this->MatriculaF->removeElement($matriculaF)) {
            // set the owning side to null (unless already changed)
            if ($matriculaF->getAlumnoIdAlumno() === $this) {
                $matriculaF->setAlumnoIdAlumno(null);
            }
        }

        return $this;
    }

    public function getUsuarios(): ?User
    {
        return $this->Usuarios;
    }

    public function setUsuarios(?User $Usuarios): static
    {
        $this->Usuarios = $Usuarios;

        return $this;
    }
}

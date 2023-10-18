<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $creditos = null;

    #[ORM\OneToMany(mappedBy: 'Curso_idCurso', targetEntity: Matricula::class)]
    private Collection $MatriculaFC;

    public function __construct()
    {
        $this->MatriculaFC = new ArrayCollection();
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

    public function getCreditos(): ?int
    {
        return $this->creditos;
    }

    public function setCreditos(int $creditos): static
    {
        $this->creditos = $creditos;

        return $this;
    }

    /**
     * @return Collection<int, Matricula>
     */
    public function getMatriculaFC(): Collection
    {
        return $this->MatriculaFC;
    }

    public function addMatriculaFC(Matricula $matriculaFC): static
    {
        if (!$this->MatriculaFC->contains($matriculaFC)) {
            $this->MatriculaFC->add($matriculaFC);
            $matriculaFC->setCursoIdCurso($this);
        }

        return $this;
    }

    public function removeMatriculaFC(Matricula $matriculaFC): static
    {
        if ($this->MatriculaFC->removeElement($matriculaFC)) {
            // set the owning side to null (unless already changed)
            if ($matriculaFC->getCursoIdCurso() === $this) {
                $matriculaFC->setCursoIdCurso(null);
            }
        }

        return $this;
    }

    public function __toString()
{
    return $this->nombre;
}

    public function getNombreDelCurso(): ?string
    {
        return $this->nombre;
    }

    /* public function getMatriculas()
    {
        return $this->MatriculaFC;
    } */
}

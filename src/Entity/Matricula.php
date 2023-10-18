<?php

namespace App\Entity;

use App\Repository\MatriculaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatriculaRepository::class)]
class Matricula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'MatriculaF')]
    private ?Alumno $Alumno_idAlumno = null;


    #[ORM\ManyToOne(inversedBy: 'MatriculaFC')]
    private ?Curso $Curso_idCurso = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlumnoIdAlumno(): ?Alumno
    {
        return $this->Alumno_idAlumno;
    }

    public function setAlumnoIdAlumno(?Alumno $Alumno_idAlumno): static
    {
        $this->Alumno_idAlumno = $Alumno_idAlumno;

        return $this;
    }

    public function getCursoIdCurso(): ?Curso
    {
        return $this->Curso_idCurso;
    }

    public function setCursoIdCurso(?Curso $Curso_idCurso): static
    {
        $this->Curso_idCurso = $Curso_idCurso;

        return $this;
    }
}

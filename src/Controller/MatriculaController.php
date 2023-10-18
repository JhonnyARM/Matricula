<?php

namespace App\Controller;

use App\Entity\Matricula;
use App\Form\MatriculaType;
use App\Repository\UserRepository;
use App\Repository\CursoRepository;
use App\Repository\AlumnoRepository;
use App\Repository\MatriculaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatriculaController extends AbstractController
{
    #[Route('/matricula', name: 'app_matricula')]
    public function index(): Response
    {
        return $this->render('matricula/index.html.twig', [
            'controller_name' => 'MatriculaController',
        ]);
    }

    #[Route('/matricularse', name: 'app_matricularse')]
    public function crud(Request $request, EntityManagerInterface $entityManagerInterface, CursoRepository $CursoRepository, AlumnoRepository $alumnoRepository, UserRepository $userRepository, MatriculaRepository $matriculaRepository): Response
    {

        $email = $this->getUser()->getUserIdentifier();

        var_dump($email);
        $id = $userRepository->findOneBy([
            'email' => $email,
        ]);
        $nuevoid = $id->getId();
        var_dump($nuevoid);
        
        $temp = 1;
        $alumnoid = $alumnoRepository->findOneBy([
            'Usuarios' => $nuevoid,
        ]);
        
        $idobtenido = $alumnoid->getId();

        var_dump($idobtenido);

        $alumno = $alumnoRepository->find($idobtenido);
        $entity = new Matricula();

        if ($alumno) {
            $entity->setAlumnoIdAlumno($alumno);
        } else {
        } 
        

        $form = $this->createForm(MatriculaType::class, $entity); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();
            $entityManagerInterface->persist($entity);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_matricularse');
        }

        $alumno = $alumnoRepository->find($idobtenido);
        $matricula = $alumno->getMatriculaF();
        return $this->render('matricula/index.html.twig', [
            'form' => $form->createView(),
            'cursos' => $CursoRepository->findAll(),
            'alumno' => $alumno,
            'matricula' => $matricula, 
        ]);        
    }

    #[Route('/eliminar-matricula/{id}', name: 'eliminar_matricula')]
    public function eliminarMatricula(Matricula $matricula, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($matricula);
        $entityManager->flush();
        return $this->redirectToRoute('app_matricularse');
    }



}

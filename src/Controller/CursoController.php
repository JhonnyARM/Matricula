<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Form\RegistroCursoType;
use App\Repository\CursoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CursoController extends AbstractController
{
    #[Route('/curso', name: 'app_curso')]
    public function index(): Response
    {
        return $this->render('curso/index.html.twig');
    }
    /* #[Route('/crud', name: 'app_crud')]
    public function crud(): Response
    {
        return $this->render('curso/crud.html.twig');
    } */
    #[Route('/crud', name: 'app_crud')]
    public function crud(Request $request, EntityManagerInterface $entityManagerInterface, CursoRepository $cursoRepository): Response
    {
        $entity = new Curso(); // Entidad que se almacene con el formulario

        $form = $this->createForm(RegistroCursoType::class, $entity); // EntityType corresponde al nombre del formulario creado en el apartado anterior, y se envia la variable creada.

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenemos los datos desde el formulario y lo almacenamos en el "objeto" creado anteriormente $Entity
            $entity = $form->getData(); // Obteniendo los datos, no es necesario en todos los casos, dado que se actualiza automaticamente.
            // Preparo la variable Entity para ser registrada en la base de datos
            $entityManagerInterface->persist($entity);
            // Ejecuto el guardado en la bd
            $entityManagerInterface->flush();
            // retornamos a la vista de app_alumno
            return $this->redirectToRoute('app_crud'); //Redirección a una ruta especifica.
        }
        return $this->render('curso/crud.html.twig', [
            'form' => $form->createView(),
            'cursos' => $cursoRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_editarcurso', methods: ['GET', 'POST'])]
    public function editar(Request $request, Curso $curso, EntityManagerInterface $entityManagerInterface): Response
    {
        
        $form = $this->createForm(RegistroCursoType::class, $curso);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_crud', [], Response::HTTP_SEE_OTHER);
        }



        return $this->render('curso/editar.html.twig',[
            'usuario' => $curso,
            'form' => $form,

        ]);
    }
    


}

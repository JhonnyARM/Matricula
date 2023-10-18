<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Alumno;
use App\Entity\Matricula;

use App\Form\RegistroAlumnoType;
use App\Repository\AlumnoRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\Security\Core\Security;

class AlumnoController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/alumno', name: 'app_alumno')]
    public function index(): Response
    {
        return $this->render('alumno/index.html.twig');
    }

    #[Route('/completar/{userId}', name: 'app_completar_registro')]
    public function completar(Request $request, EntityManagerInterface $entityManagerInterface, $userId): Response
    {
        $entity = new Alumno(); // Entidad que se almacene con el formulario
        /* return new Response('El ID del usuario es: ' . $userId); */
        


        $form = $this->createForm(RegistroAlumnoType::class, $entity); // EntityType corresponde al nombre del formulario creado en el apartado anterior, y se envia la variable creada.
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenemos los datos desde el formulario y lo almacenamos en el "objeto" creado anteriormente $Entity
            $entity = $form->getData(); // Obteniendo los datos, no es necesario en todos los casos, dado que se actualiza automaticamente.
            // Preparo la variable Entity para ser registrada en la base de datos
            $userRepository = $entityManagerInterface->getRepository(User::class);
            $userEntity = $userRepository->findOneBy(['email' => $userId]);
            // Recuperando ID 
            $UsuarioID = $userEntity->getId();
            $entity->setUsuarios($userEntity);
            $this->entityManager->persist($entity);
            // Ejecuto el guardado en la bd
            $this->entityManager->flush();

            if ($userId) {
                // Realiza una búsqueda en la entidad User usando el correo electrónico
                $userRepository = $entityManagerInterface->getRepository(User::class);
                $userEntity = $userRepository->findOneBy(['email' => $userId]);
                if ($userEntity) {
                    // Actualiza los roles del usuario
                    $userEntity->setRoles(['ROLE_ALUMNO']);
            
                    // Persiste y guarda el usuario actualizado en la base de datos
                    $entityManagerInterface->persist($userEntity);
                    $entityManagerInterface->flush();
                }
            }
            // retornamos a la vista de app_alumno
            return $this->redirectToRoute('app_alumno'); //Redirección a una ruta especifica.
        }
        return $this->render('alumno/nuevo.html.twig', [
            'form' => $form->createView(),
        ]);        
    }


}

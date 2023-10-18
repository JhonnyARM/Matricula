<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Repository\AlumnoRepository;
use App\Entity\Alumno;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/logins', name: 'app_logins')]
    public function index(Request $request, AlumnoRepository $alumnoRepository): Response
    {
        $entity = new Alumno(); // Entidad que se almacene con el formulario

        $form = $this->createForm(LoginType::class, $entity); // EntityType corresponde al nombre del formulario creado en el apartado anterior, y se envia la variable creada.

        $form->handleRequest($request);
        
        //VALIDAR LOGIN
        if ($form->isSubmitted() && $form->isValid()) {
            $dniFormulario = $form['dni']->getData();
            $alumno_especifico = $alumnoRepository->findOneBy([
                'dni' => $dniFormulario,
            ]);
    
            if ($alumno_especifico) {
                // Si se encuentra un alumno con el DNI proporcionado
                $dniAlumnoEspecifico = $alumno_especifico->getDni();
                if ($dniFormulario === $dniAlumnoEspecifico) {
                    // Las contraseñas coinciden
                    // Realizar la acción de inicio de sesión exitoso
                    return $this->render('login/log.html.twig');
                } else {
                }
            } else {

            }
            
        }

        // FIN VALIDAR
        
        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
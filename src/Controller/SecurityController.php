<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {

            $userId = $this->getUser()->getUserIdentifier();

            $roles = $this->getUser()->getRoles();
            
            if (in_array('ROLE_USER', $roles)) {
                // Usuario con el rol 'ROLE_USER', redirige a la página de usuario
                /* return $this->redirectToRoute('app_completar_registro'); */
                return $this->redirectToRoute('app_completar_registro', ['userId' => $userId]);
            } elseif (in_array('ROLE_ALUMNO', $roles)) {
                // Usuario con el rol 'ROLE_ALUMNO', redirige a la página de administrador
                return $this->redirectToRoute('app_alumno');
            } elseif (in_array('ROLE_ADMIN', $roles)) {
                // Usuario con el rol 'ROLE_ADMIN', redirige a la página de administrador
                return $this->redirectToRoute('app_curso');
            }
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
}

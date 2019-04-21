<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController{

	/**
	 * @Route("/login", name="login")
	 */
	public function login(AuthenticationUtils $authenticationUtils){
		$error = $authenticationUtils->getLastAuthenticationError();
		$lastUsername = $authenticationUtils->getLastUsername();

		if(true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMINGENE')){
			return $this->redirectToRoute('adminGene.home');
		}else if(true === $this->get('security.authorization_checker')->isGranted('ROLE_AGENTAFF')){
			return $this->redirectToRoute('agentAff.home');
		}else if(true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
			return $this->redirectToRoute('admin.home');	
		}else{
			return $this->render('security/login.html.twig',[
				'last_username' => $lastUsername,
				'error' => $error
			]);
		}
	
	}

	


}

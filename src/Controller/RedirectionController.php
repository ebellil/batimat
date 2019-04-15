<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManager;

class RedirectionController extends AbstractController{

  	/**
	 * @Route("/redirection", name="redirection")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function redirection(){

		
		$authChecker = new AuthorizationChecker(
			$tokenStorage,
			$authenticationManager,
			$accessDecisionManager
		);

		if (true === $authChecker->isGranted('ROLE_ADMINGENE')) {
			return $this->redirectToRoute('adminGene', array('variable'=>$mavariable));
		}else if (true === $authChecker->isGranted('ROLE_AGENTAFF')){
			return $this->redirectToRoute('agentAff', array('variable'=>$mavariable));
		}else{
			return $this->redirectToRoute('admin', array('variable'=>$mavariable));
		}
	}
	


}
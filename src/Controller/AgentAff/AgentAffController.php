<?php

namespace App\Controller\AgentAff;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/** @Route("/agentAff") */
class AgentAffController extends AbstractController{


	/**
	 * @Route("/", name="agentAff.home")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){
		return $this->render('agentAff/index.html.twig');
	}


}
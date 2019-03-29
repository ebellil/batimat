<?php

namespace App\Controller\AgentAchat;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AgentAchatController extends AbstractController{


	/**
	 * @Route("/agentAchat/", name="agentAchatHome")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		return $this->render('agentAchat/index.html.twig');
	
	}


}
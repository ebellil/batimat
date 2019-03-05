<?php

namespace App\Controller\AdminGene;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminGeneController extends AbstractController{


	/**
	 * @Route("/adminGene/", name="adminGene.home")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		return $this->render('adminGene/index.html.twig');
	
	}


}
<?php

namespace App\Controller\Admin;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminMaterielController extends AbstractController{

	/**
	 *@var MaterielRepository
	 */
	private $repository;

	public function __construct(MaterielRepository $repository){

		$this->repository = $repository;
	}


	/**
	 * @Route("/admin", name="admin.materiel.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		$materiels = $this->repository->findAll();
		return $this->render('admin/materiel/index.html.twig', compact('materiels'));
	
	}

	/**
	 * @Route("/admin/{id}", name="admin.materiel.edit")
	 * @param Materiel $materiel
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Materiel $materiel){

		$form = $this->createForm(MaterielType::class, $materiel);
		
		return $this->render('admin/materiel/edit.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
	}

}
<?php

namespace App\Controller\Admin;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminMaterielController extends AbstractController{

	/**
	 *@var MaterielRepository
	 */
	private $repository;

	/**
	 *@var ObjectManager
	 */
	private $em;

	public function __construct(MaterielRepository $repository, ObjectManager $em){

		$this->repository = $repository;
		$this->em = $em;
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
	 * @Route("/admin/materiel/ajouter", name="admin.materiel.new")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$materiel = new Materiel();
		$form = $this->createForm(MaterielType::class, $materiel);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->persist($materiel);
			$this->em->flush();
			return $this->redirectToRoute('admin.materiel.index');
		}

		return $this->render('admin/materiel/new.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/admin/materiel/{id}", name="admin.materiel.edit", methods="GET|POST")
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Materiel $materiel, Request $request){

		$form = $this->createForm(MaterielType::class, $materiel);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->flush();
			return $this->redirectToRoute('admin.materiel.index');
		}
		
		return $this->render('admin/materiel/edit.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
	}

	
	/**
	 * @Route("/admin/materiel/{id}", name="admin.materiel.delete", methods="DELETE")
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Materiel $materiel){
		$this->em->delete($materiel);
		$this->em->flush();
		return $this->redirectToRoute('admin.materiel.index');
	}

}
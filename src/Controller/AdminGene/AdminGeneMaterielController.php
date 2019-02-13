<?php

namespace App\Controller\AdminGene;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminGeneMaterielController extends AbstractController{

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
	 * @Route("/adminGene", name="adminGene.materiel.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		$materiels = $this->repository->findAll();
		return $this->render('adminGene/materiel/index.html.twig', compact('materiels'));
	
	}

	/**
	 * @Route("/adminGene/materiel/ajouter", name="adminGene.materiel.new")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$materiel = new Materiel();
		$form = $this->createForm(MaterielType::class, $materiel);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->persist($materiel);
			$this->addFlash('success', 'Le matériel a bien été ajouté');
			$this->em->flush();
			return $this->redirectToRoute('adminGene.materiel.index');
		}

		return $this->render('adminGene/materiel/new.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/adminGene/materiel/{id}", name="adminGene.materiel.edit", methods="GET|POST")
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Materiel $materiel, Request $request){

		$form = $this->createForm(MaterielType::class, $materiel);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->flush();
			$this->addFlash('success', 'Le matériel a bien été modifié');
			return $this->redirectToRoute('adminGene.materiel.index');
		}
		
		return $this->render('adminGene/materiel/edit.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
	}

	
	/**
	 * @Route("/adminGene/materiel/{id}", name="adminGene.materiel.delete", methods="DELETE")
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(Materiel $materiel, Request $request){
		if($this->isCsrfTokenValid('delete' . $materiel->getId(), $request->get('_token'))){
			$this->em->remove($materiel);
			$this->addFlash('success', 'Le matériel a bien été supprimé');
			$this->em->flush();
		}
		return $this->redirectToRoute('adminGene.materiel.index');
	}

}
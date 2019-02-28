<?php

namespace App\Controller\AdminGene;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use App\Repository\FournisseurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminGeneFournisseurController extends AbstractController{

	/**
	 *@var FournisseurRepository
	 */
	private $repository;

	/**
	 *@var ObjectManager
	 */
	private $em;

	public function __construct(FournisseurRepository $repository, ObjectManager $em){

		$this->repository = $repository;
		$this->em = $em;
	}


	/**
	 * @Route("/adminGene/fournisseur", name="adminGene.fournisseur.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		$fournisseurs = $this->repository->findAll();
		return $this->render('adminGene/fournisseur/index.html.twig', compact('fournisseurs'));
	
	}

	/**
	 * @Route("/adminGene/fournisseur/ajouter", name="adminGene.fournisseur.new")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$fournisseur = new Fournisseur();
		$form = $this->createForm(FournisseurType::class, $fournisseur);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->persist($fournisseur);
			$this->addFlash('success', 'Le matériel a bien été ajouté');
			$this->em->flush();
			return $this->redirectToRoute('adminGene.fournisseur.index');
		}

		return $this->render('adminGene/fournisseur/new.html.twig', [
			'fournisseur' => $fournisseur,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/adminGene/fournisseur/{id}", name="adminGene.fournisseur.edit", methods="GET|POST")
	 * @param Fournisseur $fournisseur
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Fournisseur $fournisseur, Request $request){

		$form = $this->createForm(FournisseurType::class, $fournisseur);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->flush();
			$this->addFlash('success', 'Le fournisseur a bien été modifié');
			return $this->redirectToRoute('adminGene.fournisseur.index');
		}
		
		return $this->render('adminGene/fournisseur/edit.html.twig', [
			'fournisseur' => $fournisseur,
			'form' => $form->createView()
		]);
	}

	
	/**
	 * @Route("/adminGene/fournisseur/{id}", name="adminGene.fournisseur.delete", methods="DELETE")
	 * @param Fournisseur $fournisseur
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(Fournisseur $fournisseur, Request $request){
		if($this->isCsrfTokenValid('delete' . $fournisseur->getId(), $request->get('_token'))){
			$this->em->remove($fournisseur);
			$this->addFlash('success', 'Le fournisseur a bien été supprimé');
			$this->em->flush();
		}
		return $this->redirectToRoute('adminGene.fournisseur.index');
	}

}
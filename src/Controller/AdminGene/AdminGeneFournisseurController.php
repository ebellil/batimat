<?php

namespace App\Controller\AdminGene;
use App\Entity\Fournisseur;
use App\Entity\FournisseurRapport;
use App\Form\FournisseurType;
use App\Form\FournisseurRapportType;
use App\Repository\FournisseurRepository;
use App\Repository\FournisseurRapportRepository;
use App\Repository\AdmingeneachatRepository;
use App\Repository\AgentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/** @Route("/adminGene") */
class AdminGeneFournisseurController extends AbstractController{

	/**
	 *@var FournisseurRepository
	 */
	private $repository;

	/**
	 *@var FournisseurRapportRepository
	 */
	private $repositoryFournisseurRapport;
	
	/**
	 *@var AgentRepository
	 */
	private $repositoryAgent;

	/**
	 *@var AdmingeneachatRepository
	 */
	private $repositoryAdminGene;

	

	/**
	 *@var ObjectManager
	 */
	private $em;

	public function __construct(FournisseurRepository $repository, 
		FournisseurRapportRepository $repositoryFournisseurRapport, 
		AdmingeneachatRepository $repositoryAdminGene, 
		AgentRepository $repositoryAgent,
		ObjectManager $em){

		$this->repository = $repository;
		$this->repositoryFournisseurRapport = $repositoryFournisseurRapport;
		$this->repositoryAgent= $repositoryAgent;
		$this->repositoryAdminGene = $repositoryAdminGene;

		$this->em = $em;
	}


	/**
	 * @Route("/fournisseur", name="adminGene.fournisseur.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		$fournisseurs = $this->repository->findAll();
		return $this->render('adminGene/fournisseur/index.html.twig', compact('fournisseurs'));
	
	}

	/**
	 * @Route("/fournisseur/ajouter", name="adminGene.fournisseur.new")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$fournisseur = new Fournisseur();
		$form = $this->createForm(FournisseurType::class, $fournisseur);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->persist($fournisseur);
			$this->addFlash('success', 'Le fournisseur a bien été ajouté');
			$this->em->flush();
			return $this->redirectToRoute('adminGene.fournisseur.index');
		}

		return $this->render('adminGene/fournisseur/new.html.twig', [
			'fournisseur' => $fournisseur,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/fournisseur/{id}", name="adminGene.fournisseur.edit", methods="GET|POST")
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
	 * @Route("/fournisseur/{id}", name="adminGene.fournisseur.delete", methods="DELETE")
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


	/**
	 * @Route("/fournisseur/rapport/index", name="adminGene.fournisseur.rapport.indexRapport")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function indexRapport(){

		$fournisseurs = $this->repository->findAll();
		return $this->render('adminGene/fournisseur/rapport/index.html.twig', compact('fournisseurs'));
	
	}

	/**
	 * @Route("/fournisseur/rapport/ajouter/{id}", name="adminGene.fournisseur.rapport.newRapport")
	 * @param Fournisseur $fournisseur
	 * @param Request $request
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function newRapport(Fournisseur $fournisseur, Request $request){
		$fournisseurRapport = new FournisseurRapport();
		$form = $this->createForm(FournisseurRapportType::class, $fournisseurRapport);
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){

		
			$sql ='INSERT INTO fournisseur_rapport (`fournisseur_id`, `rapport`, `admingeneral_id`) 
				VALUES ("'.$fournisseur->getId().'", 
						"'.$form->get('rapport')->getData().'", 
						"'. $this->getUser()->getId().'")';
			$connection = $this->em->getConnection();
			$connection->executeUpdate($sql, array());
			$this->addFlash('success', 'Le rapport a bien été ajouté');
			
			return $this->redirectToRoute('adminGene.fournisseur.rapport.indexRapport');
		}

		return $this->render('adminGene/fournisseur/rapport/newRapport.html.twig', [
			'fournisseurRapport' => $fournisseurRapport,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/fournisseur/rapport/modifier/{id},{idRapport}", name="adminGene.fournisseur.rapport.editRapport", methods="GET|POST")
	 * @param Fournisseur $fournisseur
	 * @param FournisseurRapport $fournisseurRapport 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function editRapport(Fournisseur $fournisseur, FournisseurRapport $fournisseurRapport , Request $request){
		$test = $this->repositoryFournisseurRapport->findByFandU($fournisseur->getId(), $this->getUser()->getId());
		$form = $this->createForm(FournisseurRapportType::class, $test[0]);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->flush();
			$this->addFlash('success', 'Le rapport a bien été modifié');
			return $this->redirectToRoute('adminGene.fournisseur.rapport.indexRapport');
		}
		
		return $this->render('adminGene/fournisseur/rapport/editRapport.html.twig', [
			'fournisseur' => $fournisseur,
			'fournisseurRapport' => $fournisseurRapport,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/fournisseur/rapport/{id}", name="adminGene.fournisseur.rapport.deleteRapport", methods="DELETE")
	 * @param FournisseurRapport $fournisseurRapport
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteRapport(FournisseurRapport $fournisseurRapport, Request $request){
		if($this->isCsrfTokenValid('delete' . $fournisseurRapport->getId(), $request->get('_token'))){
			$this->em->remove($fournisseurRapport);
			$this->addFlash('success', 'Le rapport a bien été supprimé');
			$this->em->flush();
		}
		return $this->redirectToRoute('adminGene.fournisseur.rapport.indexRapport');
	}

}
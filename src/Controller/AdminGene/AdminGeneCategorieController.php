<?php

namespace App\Controller\AdminGene;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminGeneCategorieController extends AbstractController{

	/**
	 *@var CategorieRepository
	 */
	private $repository;

	/**
	 *@var ObjectManager
	 */
	private $em;

	public function __construct(CategorieRepository $repository, ObjectManager $em){

		$this->repository = $repository;
		$this->em = $em;
	}


	/**
	 * @Route("/adminGene/categorie", name="adminGene.categorie.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		$categories = $this->repository->findAll();
		return $this->render('adminGene/categorie/index.html.twig', compact('categories'));
	
	}

	/**
	 * @Route("/adminGene/categorie/ajouter", name="adminGene.categorie.new")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$categorie = new Categorie();
		$form = $this->createForm(CategorieType::class, $categorie);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->persist($categorie);
			$this->addFlash('success', 'La catégorie a bien été ajoutée');
			$this->em->flush();
			return $this->redirectToRoute('adminGene.categorie.index');
		}

		return $this->render('adminGene/categorie/new.html.twig', [
			'categorie' => $categorie,
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/adminGene/categorie/{id}", name="adminGene.categorie.edit", methods="GET|POST")
	 * @param Categorie $categorie
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Categorie $categorie, Request $request){

		$form = $this->createForm(CategorieType::class, $categorie);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->flush();
			$this->addFlash('success', 'La  catégorie a bien été modifiée');
			return $this->redirectToRoute('adminGene.categorie.index');
		}
		
		return $this->render('adminGene/categorie/edit.html.twig', [
			'categorie' => $categorie,
			'form' => $form->createView()
		]);
	}

	
	/**
	 * @Route("/adminGene/categorie/{id}", name="adminGene.categorie.delete", methods="DELETE")
	 * @param Categorie $categorie
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(Categorie $categorie, Request $request){
		if($this->isCsrfTokenValid('delete' . $categorie->getId(), $request->get('_token'))){
			$this->em->remove($categorie);
			$this->addFlash('success', 'La catégorie a bien été suppriméé');
			$this->em->flush();
		}
		return $this->redirectToRoute('adminGene.categorie.index');
	}

}
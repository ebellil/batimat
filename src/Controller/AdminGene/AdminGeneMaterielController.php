<<<<<<< HEAD
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

=======
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
<<<<<<< HEAD:src/Controller/Admin/AdminMaterielController.php
	 * @Route("/adminGene", name="admin.materiel.index")
=======
	 * @Route("/adminGene", name="adminGene.materiel.index")
>>>>>>> e6e0621337e78c935d99d99d178f954752e86ef7:src/Controller/AdminGene/AdminGeneMaterielController.php
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		$materiels = $this->repository->findAll();
		return $this->render('adminGene/materiel/index.html.twig', compact('materiels'));
	
	}

	/**
<<<<<<< HEAD:src/Controller/Admin/AdminMaterielController.php
	 * @Route("/adminGene/materiel/ajouter", name="admin.materiel.new")
=======
	 * @Route("/adminGene/materiel/ajouter", name="adminGene.materiel.new")
>>>>>>> e6e0621337e78c935d99d99d178f954752e86ef7:src/Controller/AdminGene/AdminGeneMaterielController.php
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$materiel = new Materiel();
		$form = $this->createForm(MaterielType::class, $materiel);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->persist($materiel);
			$this->em->flush();
			return $this->redirectToRoute('adminGene.materiel.index');
		}

		return $this->render('adminGene/materiel/new.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
	}

	/**
<<<<<<< HEAD:src/Controller/Admin/AdminMaterielController.php
	 * @Route("/adminGene/materiel/{id}", name="admin.materiel.edit", methods="GET|POST")
=======
	 * @Route("/adminGene/materiel/{id}", name="adminGene.materiel.edit", methods="GET|POST")
>>>>>>> e6e0621337e78c935d99d99d178f954752e86ef7:src/Controller/AdminGene/AdminGeneMaterielController.php
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Materiel $materiel, Request $request){

		$form = $this->createForm(MaterielType::class, $materiel);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$this->em->flush();
			return $this->redirectToRoute('adminGene.materiel.index');
		}
		
		return $this->render('adminGene/materiel/edit.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
	}

	
	/**
<<<<<<< HEAD:src/Controller/Admin/AdminMaterielController.php
	 * @Route("/adminGene/materiel/{id}", name="admin.materiel.delete", methods="DELETE")
=======
	 * @Route("/adminGene/materiel/{id}", name="adminGene.materiel.delete", methods="DELETE")
>>>>>>> e6e0621337e78c935d99d99d178f954752e86ef7:src/Controller/AdminGene/AdminGeneMaterielController.php
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(Materiel $materiel, Request $request){
		if($this->isCsrfTokenValid('delete' . $materiel->getId(), $request->get('_token'))){
			$this->em->remove($materiel);
			$this->em->flush();
		}
		return $this->redirectToRoute('adminGene.materiel.index');
	}

>>>>>>> 9ae9bc6854299e3e25d5d3345c4a68c5c9111e74
}
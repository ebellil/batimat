<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MaterielController extends AbstractController{

	/**
	 *@var MaterielRepository
	 */
	private $repository;

	public function __construct(MaterielRepository $repository){
		$this->repository = $repository;
	}

	/**
	*@Route("/materiel", name="materiel.index")
	*@return Response
	*/
	public function index(): Response{

	/*	$materiel = new Materiel();
		$materiel->setLibelle("TestMateriel1")
				->setStock(200)
				->setIdCat(1)
				->setIdF(1);
		$em = $this->getDoctrine()->getManager();
		$em->persist($materiel);
		$em->flush();	*/	
		$materiels = $this->repository->findAll();
		
		return $this->render('materiel/index.html.twig', ['materiels' => $materiels]);

	}

	/**
	*@Route("/materiel/{slug}-{id}", name="materiel.show", requirements={"slug": "[a-z0-9\-]*"})
	*@param Materiel $materiel
	*@return Response
	*/
	public function show(Materiel $materiel, string $slug): Response{
		
		if($materiel->getSlug() !== $slug){
			return $this->redirectToRoute('materiel.show', [
				'id' => $materiel->getIdMat(),
				'slug' => $materiel->getSlug() 
			],301);
		}
		return $this->render('materiel/show.html.twig', ['materiel' => $materiel, 'current_menu' => 'materiels']);
	}
}
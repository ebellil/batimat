<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

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
	public function index(PaginatorInterface $paginator, Request $request): Response
	{
		//Paginator permet de mettre n materiel dans une page
		$materiels = $paginator->paginate(
			$this->repository->findAll(),
			$request->query->getInt('page', 1),
			5
		);
	
		
		return $this->render('materiel/index.html.twig', [
			'current_menu' => 'materiels',
			'materiels' => $materiels
		]);

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
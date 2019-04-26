<?php

namespace App\Controller\AgentAff;

use App\Entity\Agent;
use App\Entity\Agentaffagence;
use App\Entity\Categorie;
use App\Entity\Demande;
use App\Entity\Materiel;

use App\Form\CategorieType;
use App\Form\FournisseurType;
use App\Form\ImageType;
use App\Form\MaterielType;
use App\Form\DemandeType;

use App\Repository\AgentaffagenceRepository;
use App\Repository\AgentRepository;
use App\Repository\CategorieRepository;
use App\Repository\DemandeRepository;
use App\Repository\DetaildemandeRepository;
use App\Repository\FournisseurRepository;
use App\Repository\ImageRepository;
use App\Repository\MaterielRepository;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AgentAffMaterielController extends AbstractController{

    /**
     *@var DemandeRepository
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
	 * @Route("/agentAff/materiel/index", name="agentAff.materiel.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){
        $demandes = $this->repository->findAll();
		return $this->render('agentAff/demanderMateriel.html.twig', compact('demandes'));
	}


        /**
     * @Route("/agentAff/materiel/demande", name="agentAff.materiel.demande")
     * @return \Symony\Component\HttpFoundation\Response
     * @param Materiel $materiel
     */
    public function new(Request $request){
        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande); 
        $form->handleRequest($request);

        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($demande);
            $this->addFlash('success', 'La demande de matériel a bien été ajoutée'. $user );
            //$this->em->flush();
            return $this->redirectToRoute('agentAff.materiel.index');
        }

        return $this->render('agentAff/materiel/new.html.twig', [
            'demande' => $demande,
            'form' => $form->createView()
        ]);
    }
}
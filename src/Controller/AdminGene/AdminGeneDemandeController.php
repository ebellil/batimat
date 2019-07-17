<?php

namespace App\Controller\AdminGene;
use App\Entity\Materiel;
use App\Entity\Demande;
use App\Entity\Detaildemande;
use App\Entity\Agentaffagence;
use App\Repository\DemandeRepository;
use App\Repository\MaterielRepository;
use App\Repository\DetaildemandeRepository;
use App\Repository\AgentaffagenceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/adminGene/demande")
 * @IsGranted("ROLE_ADMINGENE")
 */
class AdminGeneDemandeController extends AbstractController{

	/**
	 *@var DemandeRepository
	 */
	private $repositoryDemande;

	/**
	 *@var AgentaffagenceRepository
	 */
	private $repositoryAgentaffagence;
	
	/**
	 *@var MaterielRepository
	 */
	private $repositoryMateriel;

	/**
	 *@var DetaildemandeRepository
	 */
	private $repositoryDetailDemande;

	/**
	 *@var ObjectManager
	 */
	private $em;

	/**
	 * @var String
	 */
	private $error;

	public function __construct(DemandeRepository $repositoryDemande, 
		AgentaffagenceRepository $repositoryAgentaffagence,
		MaterielRepository $repositoryMateriel,
		DetaildemandeRepository $repositoryDetailDemande,
		ObjectManager $em){

		$this->repositoryDemande = $repositoryDemande;
		$this->repositoryAgentaffagence = $repositoryAgentaffagence;
		$this->repositoryMateriel = $repositoryMateriel;
		$this->repositoryDetailDemande = $repositoryDetailDemande;
		$this->em = $em;
		$error = null;
	}

	public function getError(){
		return $this->error;
	}

	public function setError(String $error){
		$this->error = $error;
	}


	/**
	 * @Route("/", name="adminGene.demande.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(PaginatorInterface $paginator, Request $request)
	{
		//Paginator permet de mettre n materiel dans une page
		$demandes = $paginator->paginate(
			$this->repositoryDemande->findAll(),
			$request->query->getInt('page', 1),
			10
		);
		$agentaffs = $this->repositoryAgentaffagence->findAll();
		$error = $this->getError();
		return $this->render('adminGene/demande/index.html.twig', 
			compact('demandes', 'agentaffs', 'error')
		);
	}

	/**
	 * @Route("/{id}", name="adminGene.demande.validation", methods="VALIDATE")
	 * @param Demande $demande
	 * @param Request $request
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function validation(PaginatorInterface $paginator, Demande $demande, Request $request){

		$demandeTest = $this->repositoryDemande->find($demande->getNumcommande());
		$materiel = $this->repositoryMateriel->find($demande->getMateriel()->getId());
		$detailDemande = $this->repositoryDetailDemande->findByNumCommande($demande->getNumcommande());
		
		if($demande->getQuantite() < $materiel->getStock() && $materiel->getStock()-$demande->getQuantite() > 0){
			$stock = $materiel->getStock()-$demande->getQuantite();
			$qMateriel = $this->repositoryMateriel->enleverQte($materiel->getId(), $stock);
			$qMateriel->execute();
			$q = $this->repositoryDemande->validation($demande->getNumcommande());
			$q->execute();
			$this->addFlash('success', 'La demande a été validée');
			return $this->redirectToRoute('adminGene.demande.index');
		}else{
			$this->setError("Le stock du matériel est insuffisant");
			//return $this->redirectToRoute('adminGene.demande.index');
		}
	
		$demandes = $paginator->paginate(
			$this->repositoryDemande->findAll(),
			$request->query->getInt('page', 1),
			10
		);
		$agentaffs = $this->repositoryAgentaffagence->findAll();
		$error = $this->getError();
		return $this->render('adminGene/demande/index.html.twig', 
			compact('demandes', 'agentaffs', 'error')
		);
		
	}

}
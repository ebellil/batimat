<?php

namespace App\Controller\AgentAff;

use App\Entity\Agent;
use App\Entity\Agentaffagence;
use App\Entity\Categorie;
use App\Entity\Demande;
use App\Entity\Materiel;
use App\Entity\Detaildemande;
use App\Entity\Image;
use App\Entity\Fournisseur;

use App\Form\CategorieType;
use App\Form\FournisseurType;
use App\Form\ImageType;
use App\Form\MaterielType;
use App\Form\DemandeType;
use App\Form\DetaildemandeType;

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

use Knp\Component\Pager\PaginatorInterface;

use Doctrine\Common\Collections\ArrayCollection;


class AgentAffMaterielController extends AbstractController{

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
	 * @Route("/agentAff/detaildemandes/index", name="agentAff.detaildemandes.view")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index_1(){
        //$detail_demandes = $this->repository->findAll();
        $detail_demandes = $this->getDoctrine()->getRepository(Detaildemande::class)->findAll();

		return $this->render('agentAff/detail_demande/index.html.twig', compact('detail_demandes'));
	}


    /**
	 * @Route("/agentAff/materiel/index", name="agentAff.home")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(PaginatorInterface $paginator,  Request $request){

		//Paginator permet de mettre n materiel dans une page
		$materiels = $paginator->paginate(
			$this->repository->findAll(),
			$request->query->getInt('page', 1),
			5
		);
	
	
		return $this->render('agentAff/materiel/index.html.twig', [
			'current_menu' => 'materiels',
			'materiels' => $materiels
		]);

	}

        /**
     * @Route("/agentAff/materiel/demande", name="agentAff.materiel.demande")
     * @return \Symony\Component\HttpFoundation\Response
     * @param Materiel $materiel
     */
    public function new(Request $request){
        $em = $this->getDoctrine()->getManager();

        $demande = new Demande();
        //$idDemande = $demande->getNumcommande();
        $userId = $this->get('security.token_storage')->getToken()->getUser()->getId();
    
        $demande->setIdagentaff($userId);

        $originalDetaildemande = new ArrayCollection();
        foreach ($demande->getDetaildemandes() as $detaild) {
            
            //$detaild->setNumcommande(1);
            $orignalDetaildemande->add($detaild);
            //$demande->getDetaildemandes()
        }

        $form = $this->createForm(DemandeType::class, $demande); 
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            foreach ($originalDetaildemande as $detaild) {
                if ($demande->getDetaildemandes()->contains($detaild) === false) {
                    $em->remove($detaild);
                }
            }

            $this->em->persist($demande);
            $this->addFlash('success', 'La demande de matériel a bien été ajoutée');
            $this->em->flush();

  

            //$this->em->flush();
            return $this->redirectToRoute('agentAff.materiel.index');
        }

        return $this->render('agentAff/materiel/new.html.twig', [
            'demande' => $demande,
            'form' => $form->createView()
        ]);
    }

    /**
	*@Route("/agentAff/{slug}-{id}", name="materiel.show1", requirements={"slug": "[a-z0-9\-]*"})
	*@param Materiel $materiel
	*@return Response
	*/
	public function show(Materiel $materiel, string $slug): Response{
		
		if($materiel->getSlug() !== $slug){
			return $this->redirectToRoute('materiel.show1', [
				'id' => $materiel->getIdMat(),
				'slug' => $materiel->getSlug() 
			],301);
		}
		return $this->render('agentAff/materiel/show.html.twig', ['materiel' => $materiel, 'current_menu' => 'materiels']);
	}

    /**
	 * @Route("/agentAff/materiel/commander/{id}", name="agentAff.materiel.commander", methods="GET|POST")
	 */
	public function commander(int $id, Request $request){
		$em = $this->getDoctrine()->getManager();

		// ajout de la demande
		$demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);
		$userId = $this->get('security.token_storage')->getToken()->getUser()->getId();
		$demande->setIdagentaff($userId);
		$this->em->persist($demande);
		$this->em->flush();

        //ajout de détail demande
        $em = $this->getDoctrine()->getManager();
        $detail_d= new Detaildemande();
		$detail_d->setDemande($demande);
		dump($request);
		//dump($request->request->get('quantity'));
        //$detail_d->setQuantite($request->request->get('quantity'));

		$detail_d->setQuantite(9);
        $detail_d->setIdmat($id);
        $form = $this->createForm(DetaildemandeType::class, $detail_d);
        $form->handleRequest($request);
        //if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($detail_d);
            $this->addFlash('success', 'La demande de matériel a bien été ajoutée');
            $this->em->flush();
                return $this->redirectToRoute('agentAff.home', [
                'detail_d' => '$detail_d',
                //'materiels' => $materiels,
                //'form' => $form->createView()
            ]);
        //}
    }
    
    /**
	 * @Route("/agentAff/materiel/commander/{id}", name="agentAff.materiel.commander.edit", methods="GET|POST")
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
			return $this->redirectToRoute('agentAff.materiel.index');
		}
		return $this->render('agentAff/materiel/edit.html.twig', [
			'materiel' => $materiel,
			'form' => $form->createView()
		]);
    }
    
    /**
	 * @Route("/agentAff/materiel/delete/{id}", name="agentAff.materiel.commander.delete", methods="DELETE")
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(Materiel $materiel, Request $request){
        $Detaildemanderepository = $this->getDoctrine()->getRepository(Detaildemande::class);

        $Demanderepository = $this->getDoctrine()->getRepository(Demande::class);

        $detail_d = $Detaildemanderepository->findOneBy( ['idmat' => $materiel->getId()] );
		if($this->isCsrfTokenValid('delete' . $materiel->getId(), $request->get('_token'))){
            //cherche le détail d'une demande à partir de l'id d'un matériel
			$this->em->remove($materiel);
			$this->addFlash('success', 'Le matériel a bien été supprimé de la demande');
			$this->em->flush();
		}
		return $this->redirectToRoute('agentAff.materiel.index');
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
		//DetaildemanderapportType
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


}
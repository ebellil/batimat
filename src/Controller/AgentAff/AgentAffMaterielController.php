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
	 * @Route("/agentAff/demandes/index", name="agentAff.demandes.view")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index_1(){
        //$detail_demandes = $this->repository->findAll();
		$Repodemandes = $this->getDoctrine()->getRepository(Demande::class);
		$demandes = $Repodemandes->findAll();
		return $this->render('agentAff/demande/index.html.twig', compact('demandes'));
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
	*@Route("/agentAff/{slug}-{id}", name="materiel.show", requirements={"slug": "[a-z0-9\-]*"})
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
		return $this->render('agentAff/materiel/show.html.twig', ['materiel' => $materiel, 'current_menu' => 'materiels']);
	}


    /**
	 * @Route("/agentAff/materiel/commander/{id}", name="agentAff.materiel.commander", methods="GET|POST")
	 */
	public function commander(int $id, Request $request){
		$em = $this->getDoctrine()->getManager();
		// ajout de la demande
		$demande = new Demande();
			$userId = $this->get('security.token_storage')->getToken()->getUser()->getId();
			$quantite = $request->query->get('qute');

			$demande->setIdagentaff($userId);
			$demande->setQuantite($quantite);
			$demande->setIdmat($id);
		
		$repository = $this->getDoctrine()->getRepository(Materiel::class);
		$materiel = $repository->find($id);

		//génerer aléatoirement la quantité
		//$quantite = rand ( 0 , $materiel->getStock());
		
		$sql ='INSERT INTO demande (`Date`, `Etat`, `idMat`, `idagentaff`, `Quantite`) 
		VALUES ("'.$demande->getDate()->format('Y-m-d').'", 
				0, 
				"'.$id.'",
				"'. $userId.'",
				"'. $quantite .'")';
		$connection = $this->em->getConnection();
		$connection->executeUpdate($sql, array());

                return $this->redirectToRoute('agentAff.home', [
                'detail_d' => '$detail_d',
            ]);
        //}
    }
    
    /**
	 * @Route("/agentAff/materiel/editer/{id}", name="agentAff.materiel.edit", methods="GET|POST")
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
    
    /*
	 * @Route("/agentAff/materiel/commande/delete/{id}", name="agentAff.materiel.commande.delete", methods="DELETE")
	 * @param Materiel $materiel
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 
	public function delethe(int $id, Request $request){
		dump($request);
        $Demanderepository = $this->getDoctrine()->getRepository(Demande::class);

		$demande = $Demanderepository->findOneBy( ['numcommande' => $id] );
		dump($demande);
		if($this->isCsrfTokenValid('delete' . $id, $request->get('_token'))){
            //cherche le détail d'une demande à partir de l'id d'un matériel
			$this->em->remove($demande);
			$this->addFlash('success', 'Le matériel a bien été supprimé de la demande');
			$this->em->flush();
		}
		dump($request);
		return "";
	}*/
	
	 /**
	 * @Route("/agentAff/materiel/commande/delete/{id}", name="agentAff.materiel.commande.delete", methods="DELETE")
	 * @param Demande $demande
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(Demande $demande, Request $request){
	
		if($this->isCsrfTokenValid('delete' . $demande->getNumcommande(), $request->get('_token'))){
			$this->em->remove($demande);
			$this->addFlash('success', 'Le matériel a bien été supprimé');
			$this->em->flush();
		}
		return $this->redirectToRoute('agentAff.demandes.view');
	}

    

    /**
	 * @Route("/agentAff/demande/rapport/ajouter/{id}", name="agentAff.demande.rapport.newRapport")
	 * @param Request $request
	 * @return \Symony\Component\HttpFoundation\Response
	 */

	 public function newRapport(int $id, Request $request){
		 //dump($request);
		 $demandeRepo = $this->getDoctrine()->getRepository(Demande::class);
		 $demande = $demandeRepo->findOneBy( ['numcommande' => $id] );
		 $em = $this->getDoctrine()->getManager();

		$rapport="test rapport";
		 if($request->request->count() > 0){
			$rapport = $request->request->get("content");
			$demande->setRapport($rapport);
		 }

		 $sql ='UPDATE `demande` SET `rapport` = "'.$rapport.'" WHERE `NumCommande` = '.$id;
		 $connection = $this->em->getConnection();
		 $connection->executeUpdate($sql, array());

		return $this->render('agentAff/demande/newRapport.html.twig',[
			'demande' => $demande
		]);
	 }


	/**
	 * @Route("/agentAff/demande/note/ajouter/{id}", name="agentAff.demande.note.newNote")
	 * @param Request $request
	 * @return \Symony\Component\HttpFoundation\Response
	 */

	public function noter(int $id, Request $request){
		//dump($request);
		$demandeRepo = $this->getDoctrine()->getRepository(Demande::class);
		$demande = $demandeRepo->findOneBy( ['numcommande' => $id] );
		$em = $this->getDoctrine()->getManager();

	   $note=1;
		if($request->request->count() > 0){
		   $note = $request->request->get("note");
		   $demande->setNote($note);
		}

		$sql ='UPDATE `demande` SET `note` = "'.$note.'" WHERE `NumCommande` = '.$id;
		$connection = $this->em->getConnection();
		$connection->executeUpdate($sql, array());

	   return $this->render('agentAff/demande/noter.html.twig',[
		   'demande' => $demande
	   ]);
	}

}

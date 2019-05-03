<?php

namespace App\Controller\AgentAff;

use App\Entity\Agent;
use App\Entity\Agentaffagence;
use App\Entity\Categorie;
use App\Entity\Demande;
use App\Entity\Materiel;
use App\Entity\Detaildemande;
use App\Entity\Image;

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


/*
	public function index_1(){
        $demandes = $this->repository->findAll();
		return $this->render('agentAff/demanderMateriel.html.twig', compact('demandes'));
	}
*/

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
     * @return \Symony\Component\HttpFoundation\Response
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
        $detail_d->setQuantite(7);
        //$detail_d->setNumcommande($demande->getNumcommande());
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

}
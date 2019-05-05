<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Agent;
use App\Entity\Agentaffagence;
use App\Form\AgentAffType;
use App\Repository\UserRepository;
use App\Repository\AgentRepository;
use App\Repository\AgentaffagenceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminAgentAffController extends AbstractController{

	/**
	 *@var UserRepository
	 */
	private $repository;

	/**
	 *@var AgentRepository
	 */
	private $repositoryAgent;

	/**
	 *@var AgentaffagenceRepository
	 */
	private $repositoryAgentAffille;

	/**
	 *@var ObjectManager
	 */
	private $em;

	private $encoder;

	public function __construct(UserRepository $repository, AgentRepository $repositoryAgent, AgentaffagenceRepository $repositoryAgentAffille, ObjectManager $em, UserPasswordEncoderInterface $encoder){
		$this->encoder = $encoder;

		$this->repository = $repository;
		$this->agentRepository = $repositoryAgent;
		$this->agentAffRepository = $repositoryAgentAffille;
		$this->em = $em;
	}


	/**
	 * @Route("/admin/agentAffile", name="admin.agentAffile.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

        $agentAffiles = $this->repository->findAgentAffile();
		return $this->render('admin/agentAffile/index.html.twig', compact('agentAffiles'));
	
	}

		/**
	 * @Route("/admin/agentAffile/ajouter", name="admin.agentAffile.new")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$user = new User();
		$agent = new Agent();
		$agentAff = new Agentaffagence();
		$form = $this->createForm(AgentAffType::class, $user);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$user->setUsername($form->get('username')->getData());
			$user->setPassword($this->encoder->encodePassword($user, $form->get('password')->getData()));
			$user->setUsername($form->get('nom')->getData());
			$user->setUsername($form->get('prenom')->getData());
			$user->setRoles('ROLE_AGENTAFF');
			$agent->setAdresse($form->get('adresse')->getData());
			$agentAff->setMatriculeag($form->get('matriculeag')->getData());
			$agentAff->setAgence($form->get('agence')->getData());
			$agentAff->setVilleAgence($form->get('villeagence')->getData());
			$this->ajoutUser($user, $agent, $agentAff);
			return $this->redirectToRoute('admin.agentAffile.index');
		}
		
		return $this->render('admin/agentAffile/new.html.twig', [
			'user' => $user,
			'form' => $form->createView(),
		]);
	}

	private function ajoutUser(User $user, Agent $agent, Agentaffagence $adminGene){
		if($user){
			$this->em->persist($user);
			$this->em->flush();
			$this->ajoutAgent($user->getId(), $agent, $adminGene);
		}	
	}

	private function ajoutAgent(int $id, Agent $agent, Agentaffagence $adminGene){
		if($agent){
			$sql ='INSERT INTO agent (id, adresse) VALUES ("'.$id.'", "'.$agent->getAdresse().'")';
			$connection = $this->em->getConnection();
       	 	$connection->executeUpdate($sql, array());
			$this->ajoutAgentAff($id, $adminGene);
		}
		
	}

	private function ajoutAgentAff(int $id, Agentaffagence $agentAff){
		if($agentAff){

			$sql ='INSERT INTO agentaffagence (id, MatriculeAg, Agence, VilleAgence) VALUES ("'.$id.'", "'.$agentAff->getMatriculeag().'", "'.$agentAff->getAgence().'", "'.$agentAff->getVilleagence().'")';
			$connection = $this->em->getConnection();
       	 	$connection->executeUpdate($sql, array());
			$this->addFlash('success', 'L\'agent affilé a bien été ajouté');
		}
		
	}

	/**
	 * @Route("/admin/agentAffile/{id}", name="admin.agentAffile.edit", methods="GET|POST")
	 * @param User $user
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(User $user, Request $request){

		$form = $this->createForm(AgentAffType::class, $user);
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$qUser= $this->repository->updateUser($user->getId(), 
				$form->get('username')->getData(), 
				$this->encoder->encodePassword($user, $form->get('password')->getData()),
				$form->get('nom')->getData(), 
				$form->get('prenom')->getData());
			$qUser->execute();
			$qAgent = $this->agentRepository->updateAgent($user->getId(), $form->get('adresse')->getData());
			$qAgent->execute();
			$qAgentAff = $this->agentAffRepository->updateAgentAff($user->getId(), $form->get('matriculeag')->getData(), $form->get('agence')->getData(), $form->get('villeagence')->getData());
			$qAgentAff->execute();
			$this->addFlash('success', 'L\'admin général a bien été modifié');
			return $this->redirectToRoute('admin.agentAffile.index');
		}
		return $this->render('admin/agentAffile/edit.html.twig', [
			'user' => $user,
			'form' => $form->createView()
		]);
	}

	/** 
	 * @Route("/admin/agentAffile/{id}", name="admin.agentAffile.delete", methods="DELETE")
	 * @param User $user
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(User $user, Request $request){
		if($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token'))){
			$this->em->remove($user);
			$this->addFlash('success', 'L\'agent affilé a bien été supprimé');
			$this->em->flush();
		}
		return $this->redirectToRoute('admin.agentAffile.index');
	}
	
}
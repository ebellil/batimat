<?php

namespace App\Controller\Admin;
use App\Entity\Agent;
use App\Entity\User;
use App\Entity\Admingeneachat;
use App\Form\AdminGeneType;
use App\Repository\UserRepository;
use App\Repository\AgentRepository;
use App\Repository\AdmingeneachatRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminAdminGeneController extends AbstractController{

	/**
	 *@var UserRepository
	 */
	private $repository;

	/**
	 *@var AgentRepository
	 */
	private $agentRepository;

	/**
	 *@var AdmingeneachatRepository
	 */
	private $admingeneRepository;

	/**
	 *@var ObjectManager
	 */
	private $em;

	private $encoder;

	public function __construct(UserRepository $repository, AgentRepository $agentRepository, AdmingeneachatRepository $admingeneRepository, ObjectManager $em,  UserPasswordEncoderInterface $encoder){
		$this->encoder = $encoder;
		$this->repository = $repository;
		$this->agentRepository = $agentRepository;
		$this->admingeneRepository = $admingeneRepository;
		$this->em = $em;
	}


	/**
	 * @Route("/admin/adminGeneral", name="admin.adminGeneral.index")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function index(){

		$adminGenerals = $this->repository->findAdminGeneral();
		return $this->render('admin/adminGeneral/index.html.twig', compact('adminGenerals'));
	
	}

	/**
	 * @Route("/admin/adminGeneral/ajouter", name="admin.adminGeneral.new")
	 * @return \Symony\Component\HttpFoundation\Response
	 */
	public function new(Request $request){
		$user = new User();
		$agent = new Agent();
		$adminGene = new Admingeneachat();
		$form = $this->createForm(AdminGeneType::class, $user);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
		
			$user->setUsername($form->get('username')->getData());
			$user->setPassword($this->encoder->encodePassword($user, $form->get('password')->getData()));
			$user->setUsername($form->get('nom')->getData());
			$user->setUsername($form->get('prenom')->getData());
			$user->setRoles('ROLE_ADMINGENE');
			$agent->setAdresse($form->get('adresse')->getData());
			$adminGene->setMatriculead($form->get('matriculead')->getData());
			$this->ajoutUser($user, $agent, $adminGene);
			return $this->redirectToRoute('admin.adminGeneral.index');
		}
		
		return $this->render('admin/adminGeneral/new.html.twig', [
			'user' => $user,
			'form' => $form->createView(),
		]);
	}

	private function ajoutUser(User $user, Agent $agent, Admingeneachat $adminGene){
		if($user){
			$this->em->persist($user);
			$this->em->flush();
			$this->ajoutAgent($user->getId() ,$agent, $adminGene);
		}
		
	}

	private function ajoutAgent(int $id, Agent $agent, Admingeneachat $adminGene){
		if($agent){
			$sql ='INSERT INTO agent (id, adresse) VALUES ("'.$id.'", "'.$agent->getAdresse().'")';
			$connection = $this->em->getConnection();
       	 	$connection->executeUpdate($sql, array());
			$this->ajoutAdminGene($id, $adminGene);
		}
		
	}

	private function ajoutAdminGene(int $id, Admingeneachat $adminGene){
		if($adminGene){
			$sql ='INSERT INTO admingeneachat (id, MatriculeAd) VALUES ("'.$id.'", "'.$adminGene->getMatriculead().'")';
			$connection = $this->em->getConnection();
       	 	$connection->executeUpdate($sql, array());
			$this->addFlash('success', 'L\'admin général a bien été ajouté');
		}		
	}

	/**
	 * @Route("/admin/adminGeneral/{id}", name="admin.adminGeneral.edit", methods="GET|POST")
	 * @param User $user
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(User $user, Request $request){

		$form = $this->createForm(AdminGeneType::class, $user);
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$qUser= $this->repository->updateUser(
				$user->getId(), 
				$form->get('username')->getData(), 
				$this->encoder->encodePassword($user, $form->get('password')->getData()), 
				$form->get('nom')->getData(), 
				$form->get('prenom')->getData()
			);
			$qUser->execute();
			$qAgent = $this->agentRepository->updateAgent(
				$user->getId(), 
				$form->get('adresse')->getData()
			);
			$qAgent->execute();
			$qAdminGene = $this->admingeneRepository->updateAdminGene(
				$user->getId(),
				$form->get('matriculead')->getData()
			);
			$qAdminGene->execute();
			$this->addFlash('success', 'L\'admin général a bien été modifié');
			return $this->redirectToRoute('admin.adminGeneral.index');
		}
		return $this->render('admin/adminGeneral/edit.html.twig', [
			'user' => $user,
			'form' => $form->createView()
		]);
	}

	/** 
	 * @Route("/admin/adminGeneral/{id}", name="admin.adminGeneral.delete", methods="DELETE")
	 * @param User $adminGeneral
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(User $adminGeneral, Request $request){
		if($this->isCsrfTokenValid('delete' . $adminGeneral->getId(), $request->get('_token'))){
			$this->em->remove($adminGeneral);
			$this->addFlash('success', 'L\'admin général a bien été supprimé');
			$this->em->flush();
		}
		return $this->redirectToRoute('admin.adminGeneral.index');
	}
}
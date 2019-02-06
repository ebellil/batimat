<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(AdminRepository $repository)
    {
        //$repository = $this->getDoctrine()->getRepository(Admin::class);
        $admins = $repository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'admin' => $admins
        ]);
    }

    /**
     * @Route("/testTableAdmin", name="testTableAdmin")
     */
    public function testTableAdmin()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $admin = new Admin();
        $admin->setNom('andria');
        $admin->setPrenom('rado');
        $admin->setMdp('mdp');

        // tell Doctrine you want to (eventually) save the admin (no queries yet)
        $entityManager->persist($admin);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new admin with id '.$admin->getId());
    }

    /**
     * @Route("/admin/{id}", name="admin_show")
     */
    public function show($id)
    {
        $admin = $this->getDoctrine()
            ->getRepository(Admin::class)
            ->find($id);

        if (!$admin) {
            throw $this->createNotFoundException(
                'No admin found for id '.$id
            );
        }

        return new Response('Check out this great admin: '.$admin->getNom());

        // or render a template
        // in the template, print things with {{ admin.name }}
        // return $this->render('admin/show.html.twig', ['admin' => $admin]);
    }

    /**
     * @Route("/admin/{id}", name="admin_show")
     */
    // public function showByname(admin $admin)
    // {
    //     // use the Admin!
    //     $admin = $this->getDoctrine()
    //     ->getRepository(Admin::class)
    //     ->find($nom);
    //     if (!$admin) {
    //         throw $this->createNotFoundException(
    //             'No admin found for id '.$id
    //         );
    //     }
    //     return new Response('Check out this great admin: '.$admin->getNom());
    // }

    /**
     * @Route("/admin/delete/{id}")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $admin = $entityManager->getRepository(Admin::class)->find($id);
        if (!$admin) {
            throw $this->createNotFoundException(
                'No admin found for id '.$id
            );
        }
        $entityManager->remove($admin);
        $entityManager->flush();
        return new Response('Admin deleted : '.$admin->getNom().'  id=   '. $admin->getId());
    }

    public function createAction(Rquest $request){
        $form =$this->createForm(Admin::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $admin = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
    }
}

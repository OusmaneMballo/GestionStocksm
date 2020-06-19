<?php

namespace App\Controller;

use App\Entity\Entree;
use App\Entity\Produit;
use App\Form\EntreeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EntreeController extends AbstractController
{
    private $repository;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->emi=$em;
        $this->repository=$em->getRepository(Entree::class);
    }

    /**
     * @Route("/entree", name="app_entree_index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $e = new Entree();
        $form = $this->createForm(EntreeType::class, $e, array('action' => $this->generateUrl('app_entree_add')));
        $data['form'] = $form->createView();

        $data['entrees'] = $em->getRepository(Entree::class)->findAll();

        return $this->render('entree/index.html.twig', $data);
    }


    /**
     * @Route("/entree/add", name="app_entree_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        $e = new Entree();
        $form = $this->createForm(EntreeType::class, $e);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $e = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($e);
            $em->flush();
        }
        return $this->redirectToRoute('app_entree_index');
    }
}

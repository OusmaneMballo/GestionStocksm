<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitFormType;
use \Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    private $repository;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->emi=$em;
        $this->repository=$em->getRepository(Produit::class);
    }

    /**
     * @Route("/produit", name="app_produit_index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $p = new Produit();
        $form = $this->createForm(ProduitFormType::class, $p, array('action' => $this->generateUrl('app_entree_add')));
        $data['form'] = $form->createView();

        $data['produits'] = $em->getRepository(Produit::class)->findAll();

        return $this->render('produit/list.html.twig',$data);
    }


    /**
     * @Route("/produit/add", name="app_produit_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        $p = new Produit();
        $form = $this->createForm(ProduitFormType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $p = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
        }
        return $this->redirectToRoute('app_produit_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Produit;
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
        $data['produits'] = $em->getRepository(Produit::class)->findAll();

        return $this->render('produit/list.html.twig',$data);
    }


    /**
     * @Route("/produit/add", name="app_produit_add")
     */
    public function add()
    {
        $p = new Produit();
        $p->setLibelle("Clavier");
        $p->setQtstocke(2);
        $this->emi->persist($p);
        $this->emi->flush();
        return $this->redirectToRoute('accueil');
    }
}

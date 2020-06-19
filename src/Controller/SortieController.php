<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{

    private $repository;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->emi=$em;
        $this->repository=$em->getRepository(Sortie::class);
    }

    /**
     * @Route("/sortie", name="app_sortie_index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $s = new Sortie();
        $form = $this->createForm(SortieType::class, $s, array('action' => $this->generateUrl('app_sortie_add')));
        $data['form'] = $form->createView();

        $data['sorties'] = $em->getRepository(Sortie::class)->findAll();

        return $this->render('sortie/index.html.twig', $data);
    }

    /**
     * @Route("/sortie/add", name="app_sortie_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        $s = new Sortie();
        $form = $this->createForm(SortieType::class, $s);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $s = $form->getData();
            $em = $this->getDoctrine()->getManager();
            //Verification de la quantite de stocke du produit disponible
            $p=$em->getRepository(Produit::class)->find($s->getProduit()->getId());
            if($s->getQteS() <= $p->getQtstocke())
            {
                $em->persist($s);
                //Mise a jour de la quantite en stocke du produit
                $p->setQtstocke($p->getQtstocke() - $s->getQteS());
                $em->flush();

            }

        }
        return $this->redirectToRoute('app_sortie_index');
    }
}

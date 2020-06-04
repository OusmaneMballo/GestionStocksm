<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/Sortie/list", name="sortie_list")
     */
    public function index()
    {
        return $this->render('sortie/list.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }
}

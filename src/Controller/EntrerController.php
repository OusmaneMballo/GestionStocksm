<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntrerController extends AbstractController
{
    /**
     * @Route("/Entrer/list", name="entrer_list")
     */
    public function index()
    {

        return $this->render('entrer/list.html.twig', [
            'controller_name' => 'EntrerController',
        ]);
    }
}

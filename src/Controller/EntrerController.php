<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntrerController extends AbstractController
{
    /**
     * @Route("/entrer", name="entrer")
     */
    public function index()
    {
        return $this->render('entrer/index.html.twig', [
            'controller_name' => 'EntrerController',
        ]);
    }
}

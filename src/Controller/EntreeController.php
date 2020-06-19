<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntreeController extends AbstractController
{
    /**
     * @Route("/entree", name="app_entree_index")
     */
    public function index()
    {
        return $this->render('entree/index.html.twig');
    }
}

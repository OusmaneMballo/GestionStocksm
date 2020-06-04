<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
//use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Symfony\Component\HttpFoundation\Request;
class HomeController extends AbstractController
{
    private $emi;
    private $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->emi=$em;
        $this->repository=$em->getRepository(User::class);
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/list.html.twig');
    }

    /**
     * @Route("/home/inscrir", name="app_home_inscrir")
     */
    public function inscrir()
    {
        return $this->render('home/inscrir.html.twig');
    }

    /**
     * @Route("/home/login", name="app_home_login", methods={"POST|PATCH"})
     */
    public function login()
    {
        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("/home/create", name="app_home_create", methods={"POST|PATCH"})
     */
    public function create(Request $request)
    {
        if($request->isMethod("POST"))
        {
            if($this->isCsrfTokenValid('user_token', $request->request->get('token')))
            {
                $user=new User();
                $user->setNom($request->request->get('nom'));
                $user->setPasswd($request->request->get('passwd'));
                $user->setLogin($request->request->get('login'));
                $user->setEmail($request->request->get('email'));
                $user->setPrenom($request->request->get('prenom'));
                $this->emi->persist($user);
                $this->emi->flush();
                return $this->redirectToRoute('app_produit_index');
            }
        }
        return $this->rander('home/inscrir.html.twig');
    }
}

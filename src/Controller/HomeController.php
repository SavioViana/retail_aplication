<?php

namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Security("is_authenticated()")
 * @Route("/")
 */
class HomeController extends AbstractController
{

   
    public function __construct()
    {

    }
    /**
     * @Route("home", name="home")
     * 
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}

<?php

namespace App\Controller;
use App\Entity\Car;

use App\Entity\Client;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $clientQtd = $this->getDoctrine()->getRepository(Client::class)->getCount();
        $carQtd = $this->getDoctrine()->getRepository(Car::class)->getCount();
        $carRentailQtd = $this->getDoctrine()->getRepository(Car::class)->getCountRentail(1);
        $carNotRentailQtd = $this->getDoctrine()->getRepository(Car::class)->getCountRentail(0);

        // dd($client_total);
        return $this->render('home/index.html.twig', [
            'clientQtd' => $clientQtd,
            'carQtd' => $carQtd,
            'carRentailQtd' => $carRentailQtd,
            'carNotRentailQtd' => $carNotRentailQtd
        ]);
    }
}

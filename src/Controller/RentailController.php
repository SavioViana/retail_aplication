<?php

namespace App\Controller;

use App\Entity\Rentail;
use App\Form\RentailType;
use App\Repository\RentailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/rentail")
 * @Security("is_authenticated()")
 */
class RentailController extends AbstractController
{
    /**
     * @Route("/", name="rentail_index", methods={"GET"})
     */
    public function index(RentailRepository $rentailRepository): Response
    {
        return $this->render('rentail/index.html.twig', [
            'rentails' => $rentailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rentail_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rentail = new Rentail();
        $form = $this->createForm(RentailType::class, $rentail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $car = $rentail->getCar();
            $car->setStatus(true);
            $rentail->setCar($car);
            $entityManager->persist($rentail);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Cadastro concluido com sucesso'
            );
            return $this->redirectToRoute('rentail_index');
        }

        return $this->render('rentail/new.html.twig', [
            'rentail' => $rentail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rentail_show", methods={"GET"})
     */
    public function show(Rentail $rentail): Response
    {
        return $this->render('rentail/show.html.twig', [
            'rentail' => $rentail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rentail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rentail $rentail): Response
    {
        $form = $this->createForm(RentailType::class, $rentail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $rentail->getCar();
            $car->setStatus(false);
            $rentail->setCar($car);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Alteração concluida com sucesso'
            );
            return $this->redirectToRoute('rentail_index');
        }

        return $this->render('rentail/edit.html.twig', [
            'rentail' => $rentail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rentail_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rentail $rentail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rentail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $car = $rentail->getCar();
            $car->setStatus(false);
            $rentail->setCar($car);
            $entityManager->remove($rentail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rentail_index');
    }
}

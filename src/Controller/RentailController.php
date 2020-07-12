<?php

namespace App\Controller;

use App\Entity\Rentail;
use App\Form\RentailType;
use App\Repository\RentailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rentail")
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
            $entityManager->persist($rentail);
            $entityManager->flush();

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
            $this->getDoctrine()->getManager()->flush();

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
            $entityManager->remove($rentail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rentail_index');
    }
}

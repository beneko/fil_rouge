<?php

namespace App\Controller;

use App\Entity\Marques;
use App\Form\MarquesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marques")
 */
class MarquesController extends AbstractController
{
    /**
     * @Route("/", name="marques_index", methods={"GET"})
     */
    public function index(): Response
    {
        $marques = $this->getDoctrine()
            ->getRepository(Marques::class)
            ->findAll();

        return $this->render('marques/index.html.twig', [
            'marques' => $marques,
        ]);
    }

    /**
     * @Route("/new", name="marques_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $marque = new Marques();
        $form = $this->createForm(MarquesType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marque);
            $entityManager->flush();

            return $this->redirectToRoute('marques_index');
        }

        return $this->render('marques/new.html.twig', [
            'marque' => $marque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMarque}", name="marques_show", methods={"GET"})
     */
    public function show(Marques $marque): Response
    {
        return $this->render('marques/show.html.twig', [
            'marque' => $marque,
        ]);
    }

    /**
     * @Route("/{idMarque}/edit", name="marques_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Marques $marque): Response
    {
        $form = $this->createForm(MarquesType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marques_index');
        }

        return $this->render('marques/edit.html.twig', [
            'marque' => $marque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMarque}", name="marques_delete", methods={"POST"})
     */
    public function delete(Request $request, Marques $marque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marque->getIdMarque(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($marque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('marques_index');
    }
}

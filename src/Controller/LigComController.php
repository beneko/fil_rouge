<?php

namespace App\Controller;

use App\Entity\LigCom;
use App\Form\LigComType;
use App\Repository\LigComRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lig/com")
 */
class LigComController extends AbstractController
{
    /**
     * @Route("/", name="lig_com_index", methods={"GET"})
     */
    public function index(LigComRepository $ligComRepository): Response
    {
        return $this->render('lig_com/index.html.twig', [
            'lig_coms' => $ligComRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lig_com_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ligCom = new LigCom();
        $form = $this->createForm(LigComType::class, $ligCom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ligCom);
            $entityManager->flush();

            return $this->redirectToRoute('lig_com_index');
        }

        return $this->render('lig_com/register.html.twig', [
            'lig_com' => $ligCom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lig_com_show", methods={"GET"})
     */
    public function show(LigCom $ligCom): Response
    {
        return $this->render('lig_com/show.html.twig', [
            'lig_com' => $ligCom,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lig_com_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LigCom $ligCom): Response
    {
        $form = $this->createForm(LigComType::class, $ligCom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lig_com_index');
        }

        return $this->render('lig_com/edit.html.twig', [
            'lig_com' => $ligCom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lig_com_delete", methods={"POST"})
     */
    public function delete(Request $request, LigCom $ligCom): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligCom->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ligCom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lig_com_index');
    }
}

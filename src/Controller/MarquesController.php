<?php

namespace App\Controller;

use App\Entity\Marques;
use App\Form\MarquesType;
use App\Repository\MarquesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use app\Entity\Produits;

/**
 * @Route("/marques")
 */
class MarquesController extends AbstractController
{
    /**
     * @Route("/", name="marques_index", methods={"GET"})
     */
    public function index(MarquesRepository $marquesRepository): Response
    {
        return $this->render('marques/index.html.twig', [
            'marques' => $marquesRepository->findAll(),
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

            /**
             *   @var UploadedFile $imgFile
             */

            $imgFile = $form->get('logo_marque')->getData();


            if ($imgFile) {
                $originalFichier = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);

                $nouvo_nom_fichier = $originalFichier . "-." . $imgFile->guessExtension();

                try {
                    $imgFile->move(
                        $this->getParameter('dossier_image'),
                        $nouvo_nom_fichier
                    );
                } catch (FileException $e) {
                }
                $marque->setLogoMarque($nouvo_nom_fichier);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marque);
            $entityManager->flush();

            return $this->redirectToRoute('marques_index');
        }

        return $this->render('marques/register.html.twig', [
            'marque' => $marque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="marques_produits", methods={"GET"})
     */
    public function show($id, Marques $marque, ProduitsRepository $produit): Response
    {
        $produits = $produit->produitParMarque($id);
        return $this->render('marques/produits.html.twig', [
            'marque' => $marque,
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/{id}/edit", name="marques_edit", methods={"GET","POST"})
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
     * @Route("/{id}", name="marques_delete", methods={"POST"})
     */
    public function delete(Request $request, Marques $marque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($marque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('marques_index');
    }

}

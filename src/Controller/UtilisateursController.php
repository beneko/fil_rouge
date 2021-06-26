<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UtilisateursController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function new(Request $request): Response
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setPassword(
                $this->passwordEncoder->encodePassword( $utilisateur, $utilisateur->getPassword() )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Vous vous êtes bien inscrit ! !!'
            );
            return $this->redirectToRoute('app_login');
        }

        return $this->render('utilisateurs/register.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="utilisateurs_show", methods={"GET"})
     */
    public function show(Utilisateurs $utilisateur): Response
    {
        return $this->render('utilisateurs/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="utilisateurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Utilisateurs $utilisateur): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setPassword(
                $this->passwordEncoder->encodePassword( $utilisateur, $utilisateur->getPassword() )
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_compte', [
                'id' => $this->getId()
            ]);
        }

        return $this->render('utilisateurs/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/compte/{id}", name="utilisateurs_compte", methods={"GET"})
     */
    public function compte(Utilisateurs $utilisateur): Response
    {
        return $this->render('utilisateurs/compte.html.twig', [
            'utilisateur' => $utilisateur
        ]);
    }
}

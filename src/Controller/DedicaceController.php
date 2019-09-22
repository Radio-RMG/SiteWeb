<?php

namespace App\Controller;

use App\Entity\Dedicace;
use App\Form\DedicaceType;
use App\Repository\DedicaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dedicace")
 */
class DedicaceController extends AbstractController
{
    /**
     * @Route("/", name="dedicace_index", methods={"GET"})
     */
    public function index(DedicaceRepository $dedicaceRepository): Response
    {
        return $this->render('dedicace/index.html.twig', [
            'dedicaces' => $dedicaceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dedicace_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dedicace = new Dedicace();
        $form = $this->createForm(DedicaceType::class, $dedicace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dedicace);
            $entityManager->flush();

            return $this->redirectToRoute('dedicace_index');
        }

        return $this->render('dedicace/new.html.twig', [
            'dedicace' => $dedicace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dedicace_show", methods={"GET"})
     */
    public function show(Dedicace $dedicace): Response
    {
        return $this->render('dedicace/show.html.twig', [
            'dedicace' => $dedicace,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dedicace_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dedicace $dedicace): Response
    {
        $form = $this->createForm(DedicaceType::class, $dedicace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dedicace_index', [
                'id' => $dedicace->getId(),
            ]);
        }

        return $this->render('dedicace/edit.html.twig', [
            'dedicace' => $dedicace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dedicace_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dedicace $dedicace): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dedicace->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dedicace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dedicace_index');
    }
}

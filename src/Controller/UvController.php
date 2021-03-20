<?php

namespace App\Controller;

use App\Entity\Uv;
use App\Form\UvType;
use App\Repository\UvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/uv")
 */
class UvController extends AbstractController
{
    /**
     * @Route("/", name="uv_index", methods={"GET"})
     */
    public function index(UvRepository $uvRepository): Response
    {
        return $this->render('uv/index.html.twig', [
            'uvs' => $uvRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="uv_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $uv = new Uv();
        $form = $this->createForm(UvType::class, $uv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($uv);
            $entityManager->flush();

            return $this->redirectToRoute('uv_index');
        }

        return $this->render('uv/new.html.twig', [
            'uv' => $uv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="uv_show", methods={"GET"})
     */
    public function show(Uv $uv): Response
    {
        return $this->render('uv/show.html.twig', [
            'uv' => $uv,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="uv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Uv $uv): Response
    {
        $form = $this->createForm(UvType::class, $uv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('uv_index');
        }

        return $this->render('uv/edit.html.twig', [
            'uv' => $uv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="uv_delete", methods={"POST"})
     */
    public function delete(Request $request, Uv $uv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$uv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($uv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('uv_index');
    }
}

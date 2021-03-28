<?php

namespace App\Controller;

use App\Entity\Admission;
use App\Form\Admission1Type;
use App\Repository\AdmissionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admission")
 */
class AdmissionController extends AbstractController
{
    /**
     * @Route("/", name="admission_index", methods={"GET"})
     * @IsGranted("ROLE_CANDIDAT")
     */
    public function index(AdmissionRepository $admissionRepository): Response
    {
        return $this->render('admission/index.html.twig', [
            'admissions' => $admissionRepository->findBy(["user"=>$this->get('security.token_storage')->getToken()->getUser()]),
        ]);
    }

    /**
     * @Route("/admission_to_accept", name="admission_to_accept", methods={"GET"})
     * @IsGranted("ROLE_SECRETAIRE")
     */
    public function toAccept(AdmissionRepository $admissionRepository): Response
    {


        return $this->render('admission/indexAcc.html.twig', [
            'admissions' => $admissionRepository->findBy(["accepted" => false]),
        ]);
    }

    /**
     * @Route("/toaccept/{id}", name="admission_show_accept", methods={"GET"})
     * @IsGranted("ROLE_SECRETAIRE")
     */
    public function showtoAccept(Admission $admission): Response
    {
        $form = $this->createFormBuilder()
            ->add('demande_insc', CheckboxType::class)
            ->add('cin', CheckboxType::class)
            ->add('bac', CheckboxType::class)
            ->add('attTravail', CheckboxType::class)
            ->add('att_titulaire', CheckboxType::class)
            ->add('autorisation', CheckboxType::class)
            ->add('cv', CheckboxType::class)
            ->add('notes', CheckboxType::class)
            ->add('diplomes', CheckboxType::class)
           // ->add('user', CheckboxType::class)
            ->add('comment', TextareaType::class, [
                "attr" => ["cols" => 60, 'id' => "form_comment",
                    "rows" => 10]
            ])
            ->add('save', SubmitType::class, ['label' => 'Refuse','attr'=>['class'=>'submit']])
            ->getForm();
        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->persist($admission);
            $entityManager->flush();

            return $this->redirectToRoute('admission_to_accept');
        }
        return $this->render('admission/showAcc.html.twig', [
            'admission' => $admission, 'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="admission_new", methods={"GET","POST"})
     * @IsGranted("ROLE_CANDIDAT")
     */
    public function new(Request $request): Response
    {
        $admission = new Admission();
        $admission->setUser($this->get('security.token_storage')->getToken()->getUser());
        $form = $this->createForm(Admission1Type::class, $admission);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()->getDiplomes() as $dip) {
                $entityManager->persist($dip);

                $admission->addDiplome($dip);
            }
            foreach ($form->getData()->getNotes() as $dip) {


                $entityManager->persist($dip);

                $admission->addNote($dip);
            }

            $entityManager->persist($admission);
            $entityManager->flush();

            return $this->redirectToRoute('admission_index');
        }

        return $this->render('admission/new.html.twig', [
            'admission' => $admission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admission_show", methods={"GET"})
     */
    public function show(Admission $admission): Response
    {
        $form = $this->createFormBuilder()
            ->add('demande_insc', CheckboxType::class)
            ->add('cinFile', CheckboxType::class)
            ->add('bacFile', CheckboxType::class)
            ->add('att_travailFile', CheckboxType::class)
            ->add('att_titulaireFile', CheckboxType::class)
            ->add('autorisationFile', CheckboxType::class)
            ->add('cvFile', CheckboxType::class)
            ->add('notes', CheckboxType::class)
            ->add('diplomes', CheckboxType::class)
            ->add('user', CheckboxType::class)
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();
        return $this->render('admission/show.html.twig', [
            'admission' => $admission, 'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admission_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Admission $admission): Response
    {
        $form = $this->createForm(Admission1Type::class, $admission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admission_index');
        }

        return $this->render('admission/edit.html.twig', [
            'admission' => $admission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admission_delete", methods={"POST"})
     */
    public function delete(Request $request, Admission $admission): Response
    {
        if ($this->isCsrfTokenValid('delete' . $admission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($admission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admission_index');
    }
}

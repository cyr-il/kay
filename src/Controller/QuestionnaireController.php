<?php

namespace App\Controller;

use App\Entity\Questionnaire;
use App\Form\QuestionnaireFormType;
use App\Repository\QuestionnaireRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionnaireController extends AbstractController
{
    #[Route('/', name: 'app_questionnaire')]
    public function index(QuestionnaireRepository $QuestRepo): Response
    {
        $questionnaires = $QuestRepo->findAll();

        return $this->render('questionnaire/index.html.twig', [
            'controller_name' => 'QuestionnaireController',
            'questionnaires' => $questionnaires
        ]);
    }

    #[Route('/addquestionnaire', name:'app_addquestionnaire')]
    public function addQuestionnaire(EntityManagerInterface $em, Request $request, FileUploader $fileUploader): Response
    {
        $questionnaire = new Questionnaire;
        $form = $this->createForm(QuestionnaireFormType::class, $questionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $questionnaire->setBrochureFilename($brochureFileName);
            }            
            $em->persist($questionnaire);
            $em->flush();
            
            return $this->redirectToRoute('app_questionnaire');
            
        }

        return $this->render('questionnaire/form.html.twig', [
            'questionnaireForm' => $form->createView()
        ]);
    }

    #[Route('/editquestionnaire/{id}', name:'app_editquestionnaire')]
    public function editQuestionnaire(EntityManagerInterface $em, $id, Request $request, Questionnaire $questionnaire): Response
    {
        $questionnaire = $em->getRepository(Questionnaire::class)->find($id);
        $form = $this->createForm(QuestionnaireFormType::class, $questionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre pin a été modifié avec succès !');
            return $this->redirectToRoute('app_questionnaire');
        }

        return $this->render('questionnaire/form.html.twig', [
            'questionnaireForm' => $form->createView()
        ]);
    }

    #[Route('/deletequestionnaire/{id}', name:'app_deletequestionnaire')]
    public function deleteQuestionnaire(EntityManagerInterface $em, $id): Response
    {
        $em->remove($em->getRepository(Questionnaire::class)->find($id));
        $em->flush();
        return $this->redirectToRoute('app_questionnaire');
    }

   
}


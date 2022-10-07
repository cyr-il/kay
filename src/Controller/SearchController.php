<?php

namespace App\Controller;

use App\Form\SearchQuestionnaireType;
use App\Repository\QuestionnaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/questionnaire/search', name: 'app_search')]
    public function search(Request $request, QuestionnaireRepository $questRepo): Response
    {
        $questionnaire = [];
        $form = $this->createForm(SearchQuestionnaireType::class);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()){
            $criteria = $form->get('name')->getData();
            $questionnaire = $questRepo->findOneBy((['name' => $criteria]));
        }
        //dd($questionnaire);
        return $this->render('search/index.html.twig', [
            'search_form' => $form->createView(),
            'questionnaire' => $questionnaire
        ]);
    }
}

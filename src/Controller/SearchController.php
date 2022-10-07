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
    #[Route('/search', name: 'app_search', methods:['GET','POST'])]
    public function index(Request $request, QuestionnaireRepository $questRepo): Response
    {
        $questionnaires = [];
        $searchQuestionnaire = $this->createForm(SearchQuestionnaireType::class);
        if ($searchQuestionnaire->handleRequest($request)->isSubmitted() && $searchQuestionnaire->isValid()){
            $criteria = $searchQuestionnaire->getData();
            $questionnaires = $questRepo->searchQuestByName($criteria);
        }
        //dd($questionnaires);
        return $this->render('search/index.html.twig', [
            'search_form' => $searchQuestionnaire->createView(),
            'questionnaires' => $questionnaires
        ]);
    }
}

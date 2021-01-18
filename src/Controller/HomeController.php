<?php

namespace App\Controller;

use App\Repository\QuestionsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(QuestionsRepository $questionsRepository, UserRepository $userRepository): Response
    {
        $questions = $questionsRepository->findAll();
        return $this->render('home/index.html.twig', [
            "questions" => $questions,
        ]);
    }
}

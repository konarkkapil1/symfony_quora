<?php

namespace App\Controller;

use App\Entity\Answers;
use App\Entity\Questions;
use App\Form\AnswerType;
use App\Form\QuestionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/question", name="question")
     */
    public function index(): Response
    {
//        check if user is logged in or not
//        if(!$this->getUser()){
//            return $this->redirect($this->generateUrl("home"));
//        }
        return $this->render('question/index.html.twig', [
            'controller_name' => 'QuestionController',
        ]);
    }

    /**
     * @Route("/question/create", name="question_create")
     */
    public function create(Request $req): Response{
        if(!$this->getUser()){
            return $this->redirect($this->generateUrl("app_login"));
        }
        $question = new Questions();
        $form = $this->createForm(QuestionFormType::class, $question);
        $form ->handleRequest($req);

        if($form->isSubmitted()){
            $question->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
            return $this->redirect($this->generateUrl("home"));
        }

        return $this->render("question/create.html.twig",[
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/question/{id}", name="view_question")
     * @param Questions
     */
    public function viewQuestion(Questions $question, Request $request): Response{
        $answer = new Answers();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $answer->setQuestion($question);
            $answer->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($answer);
            $em->flush();
            return $this->render("question/view.html.twig",[
                "question" => $question,
                "form" => $form->createView()
            ]);
        }

        return $this->render("question/view.html.twig",[
            "question" => $question,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/question/like/{id}", name="like_question")
     */
    public function likeQuestion(Questions $question,$id): Response{
        $em = $this->getDoctrine()->getManager();
        $question->setLikes($question->getLikes() + 1);
        $em->persist($question);
        $em->flush();

        return new JsonResponse(["likes" => $question->getLikes()]);

    }
}

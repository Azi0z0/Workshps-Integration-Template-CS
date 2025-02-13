<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/addStudent', name: "add")]
    public function add(ManagerRegistry $manager, Request $req)

    {
        $em = $manager->getManager();
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("app_student");
        }
        return $this->render("student/add.html.twig", ["f" => $form]);
    }

}

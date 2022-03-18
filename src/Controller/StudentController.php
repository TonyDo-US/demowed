<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('', name: 'student_index')]
    public function index()
    {
        $student= $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render('student/index.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/detail/{id}', name: 'student_detail')]
    public function studentDetail ($id) {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error","Student not found !");
            return $this->redirectToRoute("student_index");
        }
        return $this->render("student/detail.html.twig",
            [
                'student' => $student
            ]);
    }

    #[Route('/delete/{id}', name: 'student_delete')]
    public function studentDelete ($id) {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error","student not found !");
        } 
        // else if (count($student->getStudents()) != 0) {
        //     $this->addFlash("Error","Can not delete this student !");
        // }
        else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash("Success","Delete student succeed !");
        }
        return $this->redirectToRoute("student_index");
    }

    #[Route('/add', name: 'student_add')]
    public function studentAdd(Request $request) {
        $student = new Student;
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();
            return $this->redirectToRoute("student_index");
        }
        return $this->renderForm("student/add.html.twig",
        [
            'StudentForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'student_edit')]
    public function studentEdit(Request $request, $id) {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
         $form = $this->createForm(StudentType::class,$student);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $manager = $this->getDoctrine()->getManager();
             $manager->persist($student);
             $manager->flush();
             return $this->redirectToRoute("student_index");
         }
         return $this->renderForm("student/edit.html.twig",
         [
             'StudentForm' => $form
         ]);
    }
}

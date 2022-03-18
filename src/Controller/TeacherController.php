<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route("/teacher")]
class TeacherController extends AbstractController
{
    #[Route('', name: 'teacher_index')]
    public function index()
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->findAll();
        $total = count($teacher);
        return $this->render('teacher/index.html.twig', [
            'teachers' => $teacher,
            'total' => $total,
        ]);
    }

    #[Route('/detail/{id}', name: 'teacher_detail')]
    public function teacherDetail ($id) {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        if ($teacher == null) {
            $this->addFlash("Error","Teacher not found !");
            return $this->redirectToRoute("teacher_index");
        }
        return $this->render("teacher/detail.html.twig",
            [
                'teacher' => $teacher
            ]);
    }

    #[Route('/delete/{id}', name: 'teacher_delete')]
    public function teacherDelete ($id) {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        if ($teacher == null) {
            $this->addFlash("Error","teacher not found !");
        } 
        // else if (count($teacher->getTeacher()) != 0) {
        //     $this->addFlash("Error","Can not delete this teacher !");
        // }
        else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($teacher);
            $manager->flush();
            $this->addFlash("Success","Delete teacher succeed !");
        }
        return $this->redirectToRoute("teacher_index");
    }

    #[Route('/add', name: 'teacher_add')]
    public function teachertAdd(Request $request) {
        $teacher = new Teacher;
        $form = $this->createForm(TeacherType::class,$teacher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();
            return $this->redirectToRoute("teacher_index");
        }
        return $this->renderForm("teacher/add.html.twig",
        [
            'TeacherForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'teacher_edit')]
    public function teacherEdit(Request $request, $id) {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
         $form = $this->createForm(TeacherType::class,$teacher);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $manager = $this->getDoctrine()->getManager();
             $manager->persist($teacher);
             $manager->flush();
             return $this->redirectToRoute("teacher_index");
         }
         return $this->renderForm("teacher/edit.html.twig",
         [
             'TeacherForm' => $form
         ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/class")]
class RoomController extends AbstractController
{
    #[Route('/', name: 'class_index')]
    public function index()
    {
        $class = $this->getDoctrine()->getRepository(Room::class)->findAll();
        return $this->render('room/index.html.twig', [
            'class' => $class,
        ]);

    }
    
    #[Route('/detail/{id}', name: 'class_detail')]
    public function detail($id)
    {
        $class = $this->getDoctrine()->getRepository(Room::class)->find($id);
        return $this->render('room/detail.html.twig', [
            'class' => $class,
        ]);
        
    }
    #[Route('/add', name: 'class_add')]
    public function roomAdd(Request $request) {
        $room = new Room;
        $form = $this->createForm(RoomType::class,$room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($room);
            $manager->flush();
            return $this->redirectToRoute("class_index");
        }
        return $this->renderForm("room/add.html.twig",
        [
            'form' => $form
        ]);
    }
    #[Route('/edit/{id}', name: 'class_edit')]
    public function roomEdit(Request $request, $id) {
        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        $form = $this->createForm(RoomType::class,$room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($room);
            $manager->flush();
            return $this->redirectToRoute("class_index");
        }
        return $this->renderForm("room/add.html.twig",
        [
            'form' => $form
        ]);
    }
    #[Route('/delete/{id}', name: 'class_delete')]
    public function roomDelete ($id) {

        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        if ($room == null) {
            $this->addFlash("Error","class not found !");
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($room);
            $manager->flush();
            $this->addFlash("Success","Delete room succeed !");
        }
        return $this->redirectToRoute("class_index");
    }
    
}

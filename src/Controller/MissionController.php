<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Mission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    #[Route('Agence/mission', name: 'mission')]
    public function index(): Response
    {
        if(!session_id())
        {
            session_start();
            session_regenerate_id();
        }

        $missions = $this->getDoctrine()->getRepository(Mission::class)->findAll();

        return $this->render('Agence/mission/index.html.twig', [
            'controller_name' => 'MissionController',
            'missions' => $missions,
        ]);
    }


    #[Route('Agence/mission/{id}', name: 'mission_detail',requirements: ['id' => '\d+'])]
    public function missionDetail($id): Response
    {

        $mission = $this->getDoctrine()->getRepository(Mission::class)->find($id);

        return $this->render('Agence/mission/mission_detail.html.twig', [
            'controller_name' => 'MissionController',
            'mission' => $mission,
        ]);
    }


}
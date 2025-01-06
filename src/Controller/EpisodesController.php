<?php

namespace App\Controller;

use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EpisodesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/season/{season}/episodes', name: 'app_episodes')]
    public function index(Season $season): Response
    {
        return $this->render('episodes/index.html.twig', [
            'season' => $season,
            'series' => $season->getSeries(),
            'episodes' => $season->getEpisodes(),
        ]);
    }


    #[Route('/season/{season}/episodes', name: 'app_watch_episodes', methods: ['POST'])]
public function watch(Season $season, Request $request): Response {
    dd($request->request->all('episodes'));
    dd(array_keys($request->request->all('episodes')));
    $watchedEpisodes = array_keys($request->request->all('episodes'));
    foreach ($episodes as $episode) {
        $episode->setWatched(in_array($episode->getId(), $watchedEpisodes));
    }
    $this->entityManager->flush();
    return new RedirectResponse("/season/{$season->getId()}/episodes");






}




}

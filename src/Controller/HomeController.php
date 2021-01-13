<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Service\SuperHeroApi;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hero;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(AuthenticationUtils $authenticationUtils): Response {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $allHeroes = $this->getDoctrine()
            ->getRepository(Hero::class)
            ->findAll();

        // Random twelwe images    
        $random_keys=array_rand($allHeroes,12);

        for($i=0;$i<=11;$i++)
        {
        $heroes []= $allHeroes[$random_keys[$i]];
        }
      
      return $this->render('index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
             'heroes'=> $heroes
        ]);
    }       
      

}
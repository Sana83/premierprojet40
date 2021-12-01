<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Employe;
use App\Entity\Lieu;


class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index(): Response
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => "Symfony, c'est super",
        ]);
    }
    
    /**
     * @Route("/welcome/{nom}", name="welcome")
     */
    public function welcome(string $nom){
        return$this->render('principal/welcome.html.twig', array(
            "nom"=>$nom
                
        ));
    }
    
    /**
     * @Route("/message/{departement}/{sexe}", name="message")
     */
    public function message(int $departement, string $sexe='F') :Response{
        //$date = date('l jS \of F Y h:i:s A');
        
        return$this->render('principal/message.html.twig', array(
            
            "departement"=>$departement,
            "sexe"=>$sexe,
            "date"=>date('l jS \of F Y h:i:s A')
        ));
    }
    
    /**
     * @Route("/employes", name="employes")
     * @param ManagerRegistry $doctrine
     */
    public function afficheEmployes(ManagerRegistry $doctrine) :Response {
        $employes = $doctrine->getRepository(Employe::class)->findAll();
        $titre = "Liste des employés";
        return $this->render('principal/employes.html.twig', compact('titre', 'employes'));
    }
    
    /**
     * @Route("/employe/{id}", name="unemploye" , requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnEmploye(ManagerRegistry $doctrine, int $id) :Response {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° ". $id;
        return $this->render('principal/unemploye.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @Route("/emploetout/{id}", name="employetout", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnEmployeTout(ManagerRegistry $doctrine, int $id) {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° " . $id;
        return $this->render('principal/unemployetout.html.twig', compact('titre', 'employe'));
    }
}

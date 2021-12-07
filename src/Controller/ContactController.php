<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\form\ContactType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact/", name="contact")
     */
    public function contact(): Response
    {
        $contact = new contact();
        
        $form = $this->createForm(contactType::class, $contact);
            
        return $this->renderForm('principal/contact.html.twig',[
            'form' =>$form->createView(),
        ]);
    }
}

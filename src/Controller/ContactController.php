<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\form\ContactType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Bridge\Doctrine\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact/", name="contact")
     */
    public function contact(Request $request, ManagerRegistry $doctrine ): Response
    {
        $contact = new contact();
        
        $form = $this->createFormBuilder($contact)
                ->add('titre', ChoiceType::class, array(
                    'choices' => array(
                        'Monsieur' => 'M',
                        'Madame' => 'F',
                    ), 'multiple' => false,
                    'expanded' => true,
                ))
                ->add('nom', TextType::class,
                        array(
                            'label' => 'Nom : ',
                            'required' => true,
                            //'data' => $builder->getAttribute("nom", "aaa"),
                        ))
                ->add('mail', EmailType::class,
                        array(
                            'label' => 'Mail : ',
                            'required' =>true
                        ))
                ->add('tel', TelType::class,
                        array(
                            'label' => 'Téléphone : ',
                            'required' => true
                        ))
                ->add('Envoyer', SubmitType::class)
                ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $contact->setDatePremierContact(new \DateTime());
            $em = $doctrine->getManager();
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute("principal");
        }
        return $this->render('contact/contact.html.twig',[
            'formContact' =>$form->createView(),
            'titre'=>'Formulaire de contact',
        ]);
    }
}

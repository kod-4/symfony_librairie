<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            // Envoi du mail
            $email = (new Email())
            ->from('contact@mail.fr')
            ->to('doucoureissa98@gmail.com')
            ->subject($contact->getSujet())
            ->text($contact->getMessage())
            ->html('<p>'.$contact->getMessage().'</p><p>'.$contact->getEmail().'</p>');

        $mailer->send($email);
            return new Response("Envoi réussi");
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}

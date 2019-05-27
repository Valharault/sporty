<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/app", name="home")
     */
    public function home() {
        $user = $this->getUser();
        if ($user->getDetails() == null){
            return $this->redirectToRoute('form_details');
        } elseif ($user->getSports()->isEmpty()) {
            return $this->redirectToRoute('form_sports');
        } elseif ($user->getDispos() == null) {
            return $this->redirectToRoute('form_dispos');
        } else {
            return $this->render('app/index.html.twig');
        }
    }

    /**
     * @Route("/app/chat/{id}", name="chat")
     */
    public function sendChat(Request $request, ObjectManager $manager, $id, Conversation $conversation){

        $message = new Message();
        $form = $this->createFormBuilder()
            ->add('message', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Entrer votre message')))
            ->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $message->setCreateAt(new \DateTime())
                ->setConversation($conversation)
                ->setContenu($data['message'])
                ->setUser($this->getUser()->getId());
            $manager->persist($message);
            $manager->flush();

            return $this->redirectToRoute('chat', ['id' => $conversation->getId()]);
        }


        return $this->render('app/chat.html.twig', [
            'form' => $form->createView(),
            'conversation' => $conversation,
        ]);
    }

    /**
     * @Route("/app/profil/{id}", name="profil")
     */
    public function profil(User $user, Request $request, ObjectManager $manager){
        $form = $this->createFormBuilder()
            ->add('titre', TextType::class, array('label' => 'Titre de la conversation', 'attr' => array('class' =>  'form-control')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $conversation = new Conversation();
            $conversation->setCreateAt(new \DateTime());
            $conversation->setContenu($data['titre']);
            $conversation->setUserOne($this->getUser());
            $conversation->setUsertwo($user);
            $conversation->setStatut('Open');

            $manager->persist($conversation);
            $manager->flush();

            return $this->redirectToRoute('inbox');

        }
        return $this->render('app/profil.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user
            ]);
    }

    /**
     * @Route("/app/inbox", name="inbox")
     */
    public function inbox(){
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository(Conversation::class)
            ->createQueryBuilder('c');

        $conversations = $queryBuilder
            ->select('c')
            ->where('c.userOne = :userId or c.userTwo = :userId')
            ->setParameter(':userId', $this->getUser())
            ->getQuery()
            ->getResult();

        return $this->render('app/inbox.html.twig', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * @Route("/app/mesannonces", name="user_annonce")
     */
    public function userAnnonce(){
        return $this->render('app/mes_annonces.html.twig');
    }
}

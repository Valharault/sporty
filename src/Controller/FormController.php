<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Details;
use App\Entity\Dispo;
use App\Entity\Sport;
use App\Entity\User;
use App\Entity\UserSearch;
use App\Form\AnnonceType;
use App\Form\DetailsType;
use App\Form\SportType;
use App\Form\UserSearchType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/app/add_details", name="form_details")
     */
    public function details(Request $request, ObjectManager $manager)
    {
        if ($this->getUser()->getDetails() !== null){
            return $this->redirectToRoute('home');
        }
        $details = new Details();

        $form = $this->createForm(DetailsType::class, $details);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $details->setUser($this->getUser());
            $manager->persist($details);
            $manager->flush();

            $this->addFlash(
                'success',
                "Vos détails ont bien été pris en compte !"
            );

            return $this->redirectToRoute('form_sports');
        }
        return $this->render('app/details.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/app/add_sport", name="form_sports")
     */
    public function sport(Request $request, ObjectManager $manager)
    {
        //if ($this->getUser()->getSports()->isEmpty()){

            $form = $this->createForm(SportType::class);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $user = $this->getUser();
                $entityManager = $this->getDoctrine()->getManager();
                $allSports = $entityManager->getRepository(Sport::class)->findAll();
                foreach ($allSports as $sport){
                    $user->removeSport($sport);
                    $manager->persist($user);
                }
                $data = $form->getData();

                foreach ($data['nom'] as $sport){
                    $user->addSport($sport);
                    $manager->persist($user);
                }
                $manager->flush();
                $this->addFlash(
                    'success',
                    "Vos sports ont bien été pris en compte !"
                );
                return $this->redirectToRoute('form_dispos');
            }
            return $this->render('app/sport.html.twig', [
                'form' => $form->createView()
            ]);
        /*} else {
            return $this->redirectToRoute('home');
        }*/
    }

    /**
     * @Route("/app/add_dispo", name="form_dispos")
     */
    public function dispo(Request $request, ObjectManager $manager)
    {
        if ($this->getUser()->getDispos() !== null){
            return $this->redirectToRoute('home');
        }

        $form = $this->createFormBuilder()
            ->add('Lundi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Mardi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Mercredi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Jeudi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Vendredi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Samedi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Dimanche8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $dispo1 = "";
            for ($j=1; $j <= 7; $j++) {
                if ($j == 1) {
                    $jour = "Lundi";
                }
                elseif ($j == 2) {
                    $jour = "Mardi";
                }
                elseif ($j == 3) {
                    $jour = "Mercredi";
                }
                elseif ($j == 4) {
                    $jour = "Jeudi";
                }
                elseif ($j == 5) {
                    $jour = "Vendredi";
                }
                elseif ($j == 6) {
                    $jour = "Samedi";
                }
                elseif ($j == 7) {
                    $jour = "Dimanche";
                }
                for ($d=8; $d <= 23; $d++) {
                    $name = $jour.$d;
                    if (empty($data[$name])) {
                        if ($d == 23) {
                            $compteur = "0;";
                        }
                        else {
                            $compteur = 0;
                        }
                    }
                    else {
                        if ($d == 23) {
                            $compteur = "1;";
                        }
                        else {
                            $compteur = 1;
                        }
                    }
                    if ($d == 8) {
                        $dispo1 = "".$dispo1."".$compteur."";
                    }
                    else {
                        $dispo1 = "".$dispo1." ".$compteur."";
                    }

                }
            }
            $test = preg_split('/[\r\n]+/', $dispo1, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($test as $combo1) {
                $combo = explode(';', $combo1);
                $dispo = new Dispo();
                $dispo->setUser($this->getUser());
                $dispo->setLundi($combo[0]);
                $dispo->setMardi($combo[1]);
                $dispo->setMercredi($combo[2]);
                $dispo->setJeudi($combo[3]);
                $dispo->setVendredi($combo[4]);
                $dispo->setSamedi($combo[5]);
                $dispo->setDimanche($combo[6]);
                $manager->persist($dispo);
                $manager->flush();
                $this->addFlash(
                    'success',
                    "Vos disponibilités ont bien été pris en compte !"
                );
                return $this->redirectToRoute('home');
            }

        }
        return $this->render('app/dispo.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/app/add_annonce", name="form_annonce")
     */
    public function add_annonce(Request $request, ObjectManager $manager){

        $annonce = new Annonce();

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $annonce->setCreateAt(new \DateTime());
            $annonce->setMembre($this->getUser());
            $annonce->setStatut("Open");
            $manager->persist($annonce);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('app/add_annonce.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/app/parametres", name="form_user")
     */
    public function updateUser(Request $request, ObjectManager $manager){

        $details = new Details();
        $form_details = $this->createForm(DetailsType::class, $details);
        $form_details->handleRequest($request);

        $form_sport = $this->createForm(SportType::class);
        $form_sport->handleRequest($request);

        $form_dispo = $this->createFormBuilder()
            ->add('Lundi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Lundi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Mardi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mardi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Mercredi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Mercredi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Jeudi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Jeudi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Vendredi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Vendredi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Samedi8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Samedi23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))

            ->add('Dimanche8', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche9', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche10', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche11', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche12', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche13', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche14', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche15', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche16', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche17', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche18', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche19', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche20', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche21', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche22', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->add('Dimanche23', ChoiceType::class, array('choices' => array('1' => '1',), 'required' => false, 'multiple' => true, 'expanded' => true, 'attr' => array('class' => 'custom-control-input',),))
            ->getForm();
        $form_dispo->handleRequest($request);

        if ($form_details->isSubmitted() && $form_details->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $details = $entityManager->getRepository(Details::class)->find($this->getUser()->getDetails());
            $data = $form_details->getData();
            $details->setBio($data->getBio());
            $details->setCodepostal($data->getCodepostal());
            $details->setVille($data->getVille());
            $details->setTelephone($data->getTelephone());
            $entityManager->persist($details);
            $entityManager->flush();

            return $this->redirectToRoute('profil', [
                'id' => $this->getUser()->getId()
            ]);
        }

        if ($form_sport->isSubmitted() && $form_sport->isValid()){
            $user = $this->getUser();
            $entityManager = $this->getDoctrine()->getManager();
            $allSports = $entityManager->getRepository(Sport::class)->findAll();
            foreach ($allSports as $sport){
                $user->removeSport($sport);
                $manager->persist($user);
            }
            $data = $form_sport->getData();

            foreach ($data['nom'] as $sport){
                $user->addSport($sport);
                $manager->persist($user);
            }
            $manager->flush();
            return $this->redirectToRoute('profil', [
                'id' => $this->getUser()->getId()
            ]);
        }

        if ($form_dispo->isSubmitted() && $form_dispo->isValid()) {
            $data = $form_dispo->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $dispo = $entityManager->getRepository(Dispo::class)->find($this->getUser()->getDispos());
            $dispo1 = "";
            for ($j=1; $j <= 7; $j++) {
                if ($j == 1) {
                    $jour = "Lundi";
                }
                elseif ($j == 2) {
                    $jour = "Mardi";
                }
                elseif ($j == 3) {
                    $jour = "Mercredi";
                }
                elseif ($j == 4) {
                    $jour = "Jeudi";
                }
                elseif ($j == 5) {
                    $jour = "Vendredi";
                }
                elseif ($j == 6) {
                    $jour = "Samedi";
                }
                elseif ($j == 7) {
                    $jour = "Dimanche";
                }
                for ($d=8; $d <= 23; $d++) {
                    $name = $jour.$d;
                    if (empty($data[$name])) {
                        if ($d == 23) {
                            $compteur = "0;";
                        }
                        else {
                            $compteur = 0;
                        }
                    }
                    else {
                        if ($d == 23) {
                            $compteur = "1;";
                        }
                        else {
                            $compteur = 1;
                        }
                    }
                    if ($d == 8) {
                        $dispo1 = "".$dispo1."".$compteur."";
                    }
                    else {
                        $dispo1 = "".$dispo1." ".$compteur."";
                    }

                }
            }
            $test = preg_split('/[\r\n]+/', $dispo1, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($test as $combo1) {
                $combo = explode(';', $combo1);
                $dispo->setUser($this->getUser());
                $dispo->setLundi($combo[0]);
                $dispo->setMardi($combo[1]);
                $dispo->setMercredi($combo[2]);
                $dispo->setJeudi($combo[3]);
                $dispo->setVendredi($combo[4]);
                $dispo->setSamedi($combo[5]);
                $dispo->setDimanche($combo[6]);
                $entityManager->flush();
                return $this->redirectToRoute('profil', [
                    'id' => $this->getUser()->getId()
                ]);
            }

        }


        return $this->render('app/parametres.html.twig', [
            'form_details' => $form_details->createView(),
            'form_sport' => $form_sport->createView(),
            'form' => $form_dispo->createView(),
        ]);

    }

    /**
     * @Route("/app/recherche", name="form_search")
     */
    public function search(Request $request){

        $form = $this->createForm(UserSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();
            if (!isset($data['sports'])){
                $sport = "";
            } else {
                $sport = $data['sports']->getNom();
            }
            $manager = $this->getDoctrine()->getManager();
            $repository = $manager->getRepository(User::class);
            $query = $repository->createQueryBuilder('u')
                ->join('u.sports', 's')
                ->join('u.details', 'd')
                ->andWhere('d.codePostal = :departement')
                ->orWhere('s.nom = :nom')
                ->setParameter('departement', $data['departement'])
                ->setParameter('nom', $sport)
                ->getQuery()
                ->getResult();

            return $this->render('app/resultat.html.twig', [
                'resultat' => $query
            ]);
        }

        return $this->render('app/rechercher.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PersonType;


class PersonneController extends AbstractController
{
    /**
     * @Route("/personnes", name="persons_route")
     * @Route("/", name="homepage")
     * 
     */
    public function displayAll()
    {
        $repo = $this->getDoctrine()->getRepository(Person::class);
        $persons=$repo->findAll();
        return $this->render('personne/index.html.twig', [
            'persons' => $persons,
        ]);
    }

    /**
     * @Route("/personnes/{id}/detail", name="person_detail")
     * 
     * @return void
     */
    public function detail(Person $person){
        //$repo = $this->getDoctrine()->getRepository(Person::class);
        //$person=$repo->find($id);
        return $this->render('personne/detail.html.twig',[
            'detailPerson' => $person
        ]);
    }

    /**
     * @Route("/personnes/add", name="person_create")
     * @Route("/personnes/{id}/edit", name="person_edit")
     * 
     * @return void
     */
    public function createAndUpdate(Person $person = null, Request $request){
        if(!$person){
            $person = new Person();
        }
        $form = $this->createForm(PersonType::class, $person);    
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($person);
            $manager->flush();
            return $this->redirectToRoute('persons_route');
        }

        return $this->render('personne/form-personne.html.twig', [
            'formPersonne' => $form->createView()
        ]);
    }

    /**
    * @Route("/personnes/{id}/delete", name="person_delete")
    *
    * @return void
    */
    public function delete(Person $person){
        $manager=$this->getDoctrine()->getManager();
        $manager->remove($person);
        $manager->flush();
        return $this->redirectToRoute('persons_route');
    }


}

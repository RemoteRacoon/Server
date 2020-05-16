<?php

namespace App\Controller;

use App\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @Route("/admin/city/create", name="admin.city.create")
     */
    public function createCity(Request $request) {

        $form = $this->createForm(CityType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();
            
            $this->addFlash('success', 'City creation success');
            
            return $this->redirectToRoute('admin.city.create');
        }

        return $this->render('admin/city/create.html.twig', [
            'city_form' => $form->createView()
        ]);

    }
    
}

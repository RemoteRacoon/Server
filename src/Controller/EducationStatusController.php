<?php

namespace App\Controller;

use App\Form\EducationStatusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EducationStatusController extends AbstractController
{
    /**
     * @Route("admin/educ_status/create", name="admin.educ_status.create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager) {
        $form = $this->createForm(EducationStatusType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $status = $form->getData();
            $entityManager->persist($status);
            $entityManager->flush();

            $this->addFlash('success', 'Education status creation success');

            return $this->redirect($this->generateUrl('admin.educ_status.create'));
        }

        return $this->render('admin/education_status/create.html.twig', [
            'education_status_form' => $form->createView()
        ]);
    }
}

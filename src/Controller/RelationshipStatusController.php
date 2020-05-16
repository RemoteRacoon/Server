<?php

namespace App\Controller;

use App\Form\RelationshipStatusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RelationshipStatusController extends AbstractController
{
    /**
     * @Route("/admin/rel_status/create", name="admin.rel_status.create")
     */
    public function createRelationshipStatus(Request $request, EntityManagerInterface $entityManager) {
        $form = $this->createForm(RelationshipStatusType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $status = $form->getData();
            $entityManager->persist($status);
            $entityManager->flush();

            $this->addFlash('success', 'Relationship status creation success');

            return $this->redirect($this->generateUrl('admin.rel_status.create'));
        }

        return $this->render('admin/relationship/create.html.twig', [
            'relationship_form' => $form->createView()
        ]);
    }
}

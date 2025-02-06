<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em,
    )
    {
        $this->em = $em;
    }

    #[Route('/user/add', name: 'user_add')]
    public function edit(Request $request): Response
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                $user = new User();
                $user->setEmail($data->getEmail());
                $user->setPhone($data->getPhone());
                $user->setFirstName($data->getFirstName());
                $user->setLastName($data->getLastName());

                $this->em->persist($user);
                $this->em->flush();

                $request
                    ->getSession()
                    ->getFlashBag()
                    ->add('success', 'Successfully added user');

                return $this->redirectToRoute('user_list');
            }
        }

        return $this->render('User/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RemoveController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em,
    )
    {
        $this->em = $em;
    }

    #[Route('/user/remove/{userId}', name: 'user_remove')]
    public function edit($userId, Request $request): Response
    {
        $user = $this->em->getRepository(User::class)->findOneBy([
            'id' => $userId
        ]);

        if ($user) {
            $this->em->remove($user);
            $this->em->flush();

            $request
                ->getSession()
                ->getFlashBag()
                ->add('success', 'Successfully removed user');
        }

        return $this->redirectToRoute('user_list');
    }
}

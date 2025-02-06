<?php

namespace App\Datatables;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;

class UserDatatable extends Datatable
{
    private RouterInterface $router;

    public function __construct(
        EntityManagerInterface $em,
        RouterInterface        $router
    )
    {
        $this->router = $router;
        parent::__construct($em);
    }

    public function getDatatableData($request): array
    {
        $this->processRequest($request);

        $usersRepository = $this->em->getRepository(User::class);

        $count = $usersRepository->getUsersCount($this->search);
        $filteredCount = $usersRepository->getUsersCount($this->search);
        $users = $usersRepository->getUsersList($this->firstRecord, $this->recordsCount, $this->orderColumn, $this->search);

        $usersArray = [];

        foreach ($users as $user) {
            $userData = [];

            $userData['id'] = $user['id'];
            $userData['firstName'] = $user['firstName'];
            $userData['lastName'] = $user['lastName'];
            $userData['email'] = $user['email'];
            $userData['phone'] = $user['phone'];
            $userData['isEmailSubscribed'] = $user['isEmailSubscribed'] ? 'Yes' : 'No';
            $userData['isSmsSubscribed'] = $user['isSmsSubscribed'] ? 'Yes' : 'No';

            $userData['actions'] = [
                'edit' => $this->router->generate('user_edit', ['userId' => $user['id']]),
                'remove' => $this->router->generate('user_remove', ['userId' => $user['id']]),
            ];

            $usersArray[] = $userData;
        }

        $records = [
            'total' => $count,
            'filtered' => $filteredCount,
            'data' => $usersArray
        ];

        return [
            'draw' => $request->get('draw'),
            'recordsTotal' => $records['total'],
            'recordsFiltered' => $records['filtered'],
            'data' => $records['data'],
        ];
    }
}

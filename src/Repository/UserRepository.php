<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $em;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
        parent::__construct($registry, User::class);
    }

    public function getUsersCount($search): float|bool|int|string|null
    {
        $qb = $this->em->createQueryBuilder();

        $qb
            ->select('count(u.id)')
            ->from(User::class, 'u');

        if (!is_null($search)) {
            $qb = $qb
                ->andWhere('u.firstName like :phrase or u.lastName like :phrase or u.email like :phrase or u.phone like :phrase')
                ->setParameter('phrase', '%' . $search . '%');
        }

        $qb = $qb
            ->getQuery();

        return $qb->getSingleScalarResult();
    }

    public function getUsersList(
        $firstRecord,
        $recordsCount,
        $order,
        $search
    )
    {
        $qb = $this->em->createQueryBuilder();

        $qb
            ->select('u.id as id')
            ->addSelect('u.email as email')
            ->addSelect('u.firstName as firstName')
            ->addSelect('u.lastName as lastName')
            ->addSelect('u.phone as phone')
            ->addSelect('u.isEmailSubscribed as isEmailSubscribed')
            ->addSelect('u.isSmsSubscribed as isSmsSubscribed')
            ->from(User::class, 'u');

        if (!is_null($search)) {
            $qb = $qb
                ->andWhere('u.firstName like :phrase or u.lastName like :phrase or u.email like :phrase or u.phone like :phrase')
                ->setParameter('phrase', '%' . $search . '%');
        }

        $orderColumn = 'u.' . $order['column'];

        $qb = $qb
            ->orderBy($orderColumn, strtoupper($order['dir']))
            ->setFirstResult($firstRecord)
            ->setMaxResults($recordsCount)
            ->getQuery();

        return $qb->getResult();

    }
}

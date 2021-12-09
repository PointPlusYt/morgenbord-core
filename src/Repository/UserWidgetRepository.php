<?php

namespace App\Repository;

use App\Entity\UserWidget;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserWidget|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserWidget|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserWidget[]    findAll()
 * @method UserWidget[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserWidgetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserWidget::class);
    }

    // /**
    //  * @return UserWidget[] Returns an array of UserWidget objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserWidget
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

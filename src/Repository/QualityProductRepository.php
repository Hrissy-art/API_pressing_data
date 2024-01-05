<?php

namespace App\Repository;

use App\Entity\QualityProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QualityProduct>
 *
 * @method QualityProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method QualityProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method QualityProduct[]    findAll()
 * @method QualityProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QualityProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QualityProduct::class);
    }

//    /**
//     * @return QualityProduct[] Returns an array of QualityProduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QualityProduct
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\GameResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameResult[]    findAll()
 * @method GameResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameResult::class);
    }

  /**
   * @param string $stage
   *
   * @return GameResult[] Returns an array of GameResult objects
   */
    public function findByStageField(string $stage)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.stage = :val')
            ->setParameter('val', $stage)
            ->orderBy('g.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?GameResult
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

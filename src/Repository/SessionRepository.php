<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function save(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPastSessions()
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('s')
        ->where('s.dateFin < :now')
        ->setParameter('now', $now)
        ->orderBy('s.dateDebut', 'ASC')
        ->getQuery()
        ->getResult();
    }
    
    public function findCurrentSessions()
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('s')
        ->where('s.dateDebut < :now')
        ->setParameter('now', $now)
        ->andWhere('s.dateFin >'.date('d/m/Y'))
        ->orderBy('s.dateDebut', 'ASC')
        ->getQuery()
        ->getResult();
    }
    
    public function findUpcomingSessions()
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('s')
        ->where('s.dateDebut > :now')
        ->setParameter('now', $now)
        ->orderBy('s.dateDebut', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function findPastSessionsByFormation($id)
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('s')
        ->where('s.dateFin < :now')
        ->andWhere('s.formation = :id')
        ->setParameter('now', $now)
        ->setParameter('id', $id)
        ->orderBy('s.dateDebut', 'ASC')
        ->getQuery()
        ->getResult();
    }
    
    public function findCurrentSessionsByFormation($id)
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('s')
        ->where('s.dateDebut < :now')
        ->andWhere('s.dateFin > :now')
        ->andWhere('s.formation = :id')
        ->setParameter('now', $now)
        ->setParameter('id', $id)
        ->orderBy('s.dateDebut', 'ASC')
        ->getQuery()
        ->getResult();
    }
    
    public function findUpcomingSessionsByFormation($id)
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('s')
        ->where('s.dateDebut > :now')
        ->andWhere('s.formation = :id')
        ->setParameter('now', $now)
        ->setParameter('id', $id)
        ->orderBy('s.dateDebut', 'ASC')
        ->getQuery()
        ->getResult();
    }

//    /**
//     * @return Session[] Returns an array of Session objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

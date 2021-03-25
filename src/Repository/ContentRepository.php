<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Content::class);
    }

    public function advancedResearch($search)
    {
        $query= $this->createQueryBuilder('c');

            if (!empty($search->string)){
                $query= $query
                ->andWhere('c.title LIKE :val or c.keywords LIKE :val')
                ->setParameter('val', '%'.$search->string.'%');
            }
            if (!empty($search->tags)){
                $query= $query
                ->join('c.tags', 't')
                ->andWhere('t IN (:tags)')
                ->setParameter('tags', $search->tags)
                 ->groupBy('c.id')
                 ->having('count(c.id) ='.count($search->tags))
                ;
            }            
            if (!empty($search->editor)){
                $query= $query
                ->andWhere('c.editor = :editor')
                ->setParameter('editor', $search->editor);                
            }
            if (!empty($search->contentType)){
                $query= $query
                ->andWhere('c.contentType = :contentType')
                ->setParameter('contentType', $search->contentType);                
            }
        
            return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Content[] Returns an array of Content objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Content
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

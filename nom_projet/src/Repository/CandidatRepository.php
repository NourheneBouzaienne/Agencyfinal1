<?php

namespace App\Repository;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Candidat;
use App\Entity\RechercheCondidat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Candidat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidat|null findOneBy(array $criteria, array $orderBy = null)

 * @method Candidat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidat::class);
    }

     /**
      * @return Candidat[] Returns an array of Candidat objects
      */
    
     public function findAllWithPagination( RechercheCondidat $rechercheCondidat)
    {


        $req = $this->createQueryBuilder('Condidat');
        return $req-> getQuery();

        if ($rechercheCondidat->getStatus()){
            $req = $req->andWhere('Condidat.id=:val')
            ->setParameter(':val',$rechercheCondidat->getid());
        }
        
    } 

    
   
    /* public function findOneBySomeField(RechercheCondidat $rechercheCondidat): ?Candidat
    {
        return $this->createQueryBuilder('Condidat')
            ->andWhere('Condidat.id = :val')
            ->setParameter('val', $rechercheCondidat->getid())
            ->getQuery()
            ->getOneOrNullResult()
        ;
    } */
    
}

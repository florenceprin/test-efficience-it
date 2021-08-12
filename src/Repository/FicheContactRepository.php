<?php

namespace App\Repository;

use App\Entity\FicheContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheContact[]    findAll()
 * @method FicheContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheContact::class);
    }


}

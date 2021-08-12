<?php

namespace App\Repository;

use App\Entity\Departements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Departements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Departements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Departements[]    findAll()
 * @method Departements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Departements::class);
    }


}

<?php

namespace JP\MaritimeBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * NumOrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NumOrderRepository extends EntityRepository
{

	public function findOneOrder($limit )
		{
		  $req = $this->createQueryBuilder('b')	;
		  $req
		  	->orderBy('b.id', 'DESC')	
		  	->setMaxResults($limit);

		  return $req->getQuery()->getResult()	;

		}
}

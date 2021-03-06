<?php

namespace UserBundle\Entity;

/**
 * BelongRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BidRepository extends \Doctrine\ORM\EntityRepository
{
	public function getBidRelations($limit = null)
	{
		$qp = $this->createQueryBuilder('b')->select('b');

		if (false === is_null($limit))
			$qp->setMaxResults($limit);

		return $qp->getQuery()->getResult();
	}
}
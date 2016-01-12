<?php

namespace BlogBundle\Entity;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
	public function getComments($approved = true)
	{
		$qp = $this->createQueryBuilder('c')->select('c')->addOrderBy('c.created');
		if (false === is_null($approved))
		{
			$qp->andWhere('c.approved = :approved')->setParameter('approved', $approved);
		}
		return $qp->getQuery()->getResult();
	}
}

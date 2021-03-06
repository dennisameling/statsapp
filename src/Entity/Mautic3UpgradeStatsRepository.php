<?php
/**
 * Stats Gathering Application
 *
 * @copyright  Copyright (C) Mautic Contributors. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License Version 3
 */


namespace Mautic\StatsBundle\Entity;

use Doctrine\ORM\EntityRepository;

class Mautic3UpgradeStatsRepository extends EntityRepository
{
    /**
     * Retrieves all installation data for a given application
     *
     * @return array
     */
    public function getAppData($application)
    {
        $query = $this->createQueryBuilder('s');
        $query->where($query->expr()->eq('s.application', ':application'))
            ->setParameter('application', $application);

        return $query->getQuery()->getArrayResult();
    }

    /**
     * Save an entity through the repository
     *
     * @param Mautic3UpgradeStats $entity
     * @param bool  $flush true by default; use false if persisting in batches
     *
     * @return void
     */
    public function saveEntity($entity, $flush = true)
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}

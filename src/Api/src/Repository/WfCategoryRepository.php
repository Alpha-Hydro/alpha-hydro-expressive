<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Api\Repository;


use Api\Entity\WfCategory;
use Doctrine\ORM\EntityRepository;

class WfCategoryRepository extends EntityRepository
{
    /**
     * @param WfCategory $parent
     * @return array WfCategory[]
     */
    public function findByActiveNoDeleted(WfCategory $parent = null)
    {

        $categories = $this->findBy(
            [
                'parent' => $parent,
                'active' => 1,
                'deleted' => 0,
            ],
            ['sorting' => 'ASC']
        );

        return $categories;
    }
}
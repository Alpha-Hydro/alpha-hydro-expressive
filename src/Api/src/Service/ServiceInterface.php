<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2018, Alpha-Hydro
 *
 */

namespace Api\Service;


interface ServiceInterface
{
    public function save($data, $id = null);

    public function update($id, $data);

    public function delete($id);

    public function disable($id);

    public function enable($id);

}
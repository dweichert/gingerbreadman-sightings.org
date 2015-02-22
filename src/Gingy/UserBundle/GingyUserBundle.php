<?php
/**
 * This file is part of gingerbreadman-sightings.org.
 *
 * (c) David Weichert <info@davidweichert.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gingy\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GingyUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
<?php
/**
 * This file is part of gingerbreadman-sightings.org.
 *
 * (c) David Weichert <info@davidweichert.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gingy\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrganisationController extends Controller
{
    public function addAction(Request $request)
    {
        $view = $request->getLocale() == 'de' ? 'GingyCoreBundle:Organisation:add.de.html.twig' : 'GingyCoreBundle:Organisation:add.en.html.twig';
        return $this->render($view);
    }
}
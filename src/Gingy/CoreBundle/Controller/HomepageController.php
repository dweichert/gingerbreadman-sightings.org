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

class HomepageController extends Controller
{
    public function indexAction(Request $request)
    {
        $view = $request->getLocale() == 'de' ? 'GingyCoreBundle:Homepage:index.de.html.twig' : 'GingyCoreBundle:Homepage:index.en.html.twig';
        return $this->render($view);
    }

    public function imprintAction(Request $request)
    {
        $view = $request->getLocale() == 'de' ? 'GingyCoreBundle:Homepage:imprint.de.html.twig' : 'GingyCoreBundle:Homepage:imprint.en.html.twig';
        return $this->render($view);
    }
}
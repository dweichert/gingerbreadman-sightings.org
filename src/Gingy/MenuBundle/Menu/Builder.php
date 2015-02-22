<?php
/**
 * This file is part of gingerbreadman-sightings.org.
 *
 * (c) David Weichert <info@davidweichert.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gingy\MenuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class Builder extends ContainerAware
{
    private $_translations = array(
        'Home' => 'Startseite',
        'Contact' => 'Impressum',
        'Privacy Policy' => 'Datenschutzerklärung',
        'Sign in' => 'Anmelden',
        'Logout' => 'Abmelden',
        'Account' => 'Konto'
    );

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        /** @var Request $request */
        $request = $this->container->get('request');
        $menu = $factory->createItem('root', array('childrenAttributes' => array('class' => 'nav navbar-nav bs-navbar-collapse')));
        $menu->addChild('Home', array('route' => 'homepage', 'label' => $this->_getLabel($request, 'Home')));
        $menu->addChild('Contact', array('route' => 'homepage', 'label' => $this->_getLabel($request, 'Contact')));
        $menu->addChild('Privacy Policy', array('route' => 'homepage', 'label' => $this->_getLabel($request, 'Privacy Policy')));
        return $menu;
    }

    public function rightMenu(FactoryInterface $factory, array $options)
    {
        /** @var Request $request */
        $request = $this->container->get('request');
        $user= $this->container->get('security.token_storage')->getToken()->getUser();
        $menu = $factory->createItem('root', array('childrenAttributes' => array('class' => 'nav navbar-nav bs-navbar-collapse navbar-right')));
        if ($user == 'anon.')
        {
            $menu->addChild('Login', array('uri' => $this->_getLoginUri($request), 'label' => $this->_getLabel($request, 'Sign in')))
                ->setAttribute('icon', 'fa fa-user');
        }
        else
        {
            $userMenuItem = $menu
                ->addChild('CurrentUser', array(
                    'label' => $user->getFirstname() . ' ' . $user->getSurname(),
                ))
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'fa fa-user');
            $userMenuItem->addChild(
                'Profile',
                array(
                    'uri' => $this->_getProfileUri($request),
                    'label' => $this->_getLabel($request, 'Account')
                )
            );
            $userMenuItem->addChild(
                'Logout',
                array(
                    'uri' => $this->_getLogoutUri($request),
                    'label' => $this->_getLabel($request, 'Logout')
                )
            );
        }
        $menu->addChild('Language Toggler', array('uri' => $this->_getLanguageTogglerUri($request), 'label' => $this->_getLanguageTogglerLinktext($request)));
        return $menu;
    }

    private function _getLabel(Request $request, $englishLabel)
    {
        switch ($request->getLocale())
        {
            case 'de':
                return $this->_translations[$englishLabel];
            default:
                return $englishLabel;
        }
    }

    private function _getProfileUri(Request $request)
    {
        return $request->getBaseUrl()
            . '/'
            . $request->getLocale()
            . '/profile';
    }

    private function _getLoginUri(Request $request)
    {
        return $request->getBaseUrl()
            . '/'
            . $request->getLocale()
            . '/login';
    }

    private function _getLogoutUri($request)
    {
        return $request->getBaseUrl()
            . '/'
            . $request->getLocale()
            . '/logout';
    }

    private function _getLanguageTogglerUri(Request $request)
    {
        $uri = $request->getPathInfo();
        $parts = explode('/', $uri);
        switch ($request->getLocale())
        {
            case 'en':
                $parts[1] = 'de';
                break;
            default:
                $parts[1] = 'en';
                break;
        }
        $uri = implode('/', $parts);
        $uri = $request->getBaseUrl() . $uri;
        return $uri;
    }

    private function _getLanguageTogglerLinktext(Request $request)
    {
        $locale = $request->getLocale();
        switch($locale)
        {
            case 'en':
                return 'Deutsch';
                break;
            default:
                return 'English';
                break;
        }
    }
}
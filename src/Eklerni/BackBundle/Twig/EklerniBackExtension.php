<?php

namespace Eklerni\BackBundle\Twig;

class EklerniBackExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'datelocale' => new \Twig_Filter_Method($this, 'datelocale')
        );
    }

    public function datelocale($d, $format = "%d %B %Y")
    {
        if ($d instanceof \DateTime) {
            $d = $d->getTimestamp();
        }

        return strftime($format, $d);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'erklerni_back_ext';
    }
}
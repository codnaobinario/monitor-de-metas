<?php

namespace Pdm;

use Timber;

class Posts extends Pagina
{


    public static function startup($params)
    {
        $query = 'a=b';
        \Timber::load_template('index.php', $query);
    }


    public static function get_context()
    {
        $context = \Timber::get_context();
        $context['post_metas'] = Timber::get_posts([
            'post_type' => 'metas'
        ]);
        return $context;
    }

}

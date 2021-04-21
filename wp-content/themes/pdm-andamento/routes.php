<?php

// Timber::add_route('homepage', function ($params) {
//     return Pdm\PaginaPost::startup($params);
// });

Timber::add_route('meta/:id', function ($params) {
    return Pdm\PaginaMeta::startup($params);
});

Timber::add_route('projeto/:id', function ($params) {
    return Pdm\PaginaProjeto::startup($params);
});

Timber::add_route('projetos', function ($params) {

    return Pdm\PaginaProjetos::startup($params);
    // if ((empty($_GET['lat'])) || (empty($_GET['long']))) {
    //     exit;
    // }
    // $lat = $_GET['lat'];
    // $long = $_GET['long'];

    // $subprefeitura = Pdm\PaginaInicial::buscaPorCoordenada($lat, $long);

    // if (count($subprefeitura) > 0) {
    //     echo ($subprefeitura[0]['id']);
    // } else {
    //     echo 0;
    // }
    // exit;
    //return Pdm\PaginaProjeto::startup($params);

    // $query = 'bla=bla';
    // Timber::load_template('projetos.php', $query);
});

Timber::add_route('buscaPorCep', function ($params) {
    if ((empty($_GET['lat'])) || (empty($_GET['long']))) {
        exit;
    }
    $lat = $_GET['lat'];
    $long = $_GET['long'];

    $subprefeitura = Pdm\PaginaInicial::buscaPorCoordenada($lat, $long);

    if (count($subprefeitura) > 0) {
        echo ($subprefeitura[0]['id']);
    } else {
        echo 0;
    }
    exit;
    //return Pdm\PaginaProjeto::startup($params);
});

Timber::add_route('metaFollow/:meta', function ($params) {

    // if ((empty($_GET['name'])) || (empty($_GET['email']))) {
    //     exit;
    // }
    $input['meta'] = $params['meta'];
    $input['name'] = $_POST['name'];
    $input['email'] = $_POST['email'];

    print_r(Pdm\PaginaInicial::metaFollow($input));

    exit;


});


// Timber::add_route('meta/:id/page/:pg', function ($params) {
//     $query = 'posts_per_page=3&post_type='.$params['name'].'&paged='.$params['pg'];
//     Timber::load_template('archive.php', $query);
// });

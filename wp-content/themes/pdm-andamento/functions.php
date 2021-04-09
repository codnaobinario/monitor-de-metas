<?php
$api_address = get_option("pdm_andamento_api_address");
define('API_URL', $api_address);
require "vendor/autoload.php";
require "routes.php";

show_admin_bar(false);
add_theme_support('post-formats');
add_theme_support('post-thumbnails');
add_theme_support('menus');

add_filter('get_twig', 'add_to_twig');
add_filter('timber_context', 'add_to_context');

add_action('wp_enqueue_scripts', 'load_scripts');

define('THEME_URL', get_template_directory_uri());

// This tells WordPress to call the function named "setup_theme_admin_menus"
// when it's time to create the menu pages.
add_action("admin_menu", "setup_theme_admin_menus");

function setup_theme_admin_menus() {
    add_submenu_page('themes.php',
        'Front Page Elements', 'Configurações', 'manage_options',
        'front-page-elements', 'theme_front_page_settings');
}

function theme_front_page_settings() {
    // Check that the user is allowed to update options
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    $api_address = get_option("pdm_andamento_api_address");

    if (isset($_POST["update_settings"])) {
        $api_address = esc_attr($_POST["api_address"]);
        update_option("pdm_andamento_api_address", $api_address);
        ?>
            <div id="message" class="updated">Configurações atualizadas com sucesso.</div>
        <?php
    }
?>
    <div class="wrap">
        <h2>Configurações do Programa de Metas</h2>

        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="api_address">
                            Endereço da API:
                        </label>
                    </th>
                    <td>
                        <input type="text" name="api_address" value="<?php echo $api_address;?>" size="25" />
                        <p>O endereço deve obrigatoriamente terminar com barra (/).</p>
                    </td>
                </tr>
            </table>
            <p>
                <input type="hidden" name="update_settings" value="Y" />
                <input type="submit" value="Salvar" class="button-primary"/>
            </p>
        </form>
    </div>
<?php
}

function add_to_context($data)
{
    /* this is where you can add your own data to Timber's context object */
//    $api = new Pdm\ApiClient;
//    $data['metas'] = $api->getMetasFiltradas();

    if (!empty($_GET['slide'])) {
        switch ($_GET['slide']) {
            case '1':
                $data['slide1'] = "active";
                break;
            case '2':
                $data['slide2'] = "active";
                break;
            case '3':
                $data['slide3'] = "active";
                break;
            case '4':
                $data['slide4'] = "active";
                break;
            case '5':
                $data['slide5'] = "active";
                break;
            case '6':
                $data['slide6'] = "active";
                break;

            default:
                # code...
                break;
        }
    }

    $data['menu'] = new TimberMenu();
    return $data;
}

function add_to_twig($twig)
{
    /* this is where you can add your own fuctions to twig */
    $twig->addExtension(new Twig_Extension_StringLoader());
    $twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
    return $twig;
}

function myfoo($text)
{
    $text .= ' bar!';
    return $text;
}

function load_scripts ()
{
    wp_enqueue_script( 'site-main', get_template_directory_uri() . '/assets/scripts/1.0.js', null, '0.1', true );
}



/*CUSTOM METAS*/
function eixos_register() {
	$labels = array(
      'name' => __('Eixos'),
      'singular_name' => __('Eixos'),
      'add_new' => __('Nova Eixos'),
      'add_new_item' => __('Adicionar'),
      'edit_item' => __('Editar'),
      'new_item' => __('Nova'),
      'view_item' => __('Ver'),
      'search_items' => __('Procurar'),
      'not_found' =>  __('Nada encontrado'),
      'not_found_in_trash' => __('Nada encontrado na lixeira'),
      'parent_item_colon' => ''
    );
    $args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'eixos'),
		'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'publish_eixos',
            'edit_posts' => 'edit_eixos',
            'edit_others_posts' => 'edit_others_eixos',
            'read_private_posts' => 'read_private_eixos',
            'edit_post' => 'edit_eixos',
            'delete_post' => 'delete_eixos',
            'read_post' => 'read_eixos',
        ),
		'hierarchical' => false,
		'menu_position' => null,
		'taxonomies' =>false
    );
    register_post_type('eixos_register', $args );
    flush_rewrite_rules();
}

function metas_register() {
	$labels = array(
      'name' => __('Metas'),
      'singular_name' => __('Meta'),
      'add_new' => __('Nova meta'),
      'add_new_item' => __('Adicionar'),
      'edit_item' => __('Editar'),
      'new_item' => __('Nova'),
      'view_item' => __('Ver'),
      'search_items' => __('Procurar'),
      'not_found' =>  __('Nada encontrado'),
      'not_found_in_trash' => __('Nada encontrado na lixeira'),
      'parent_item_colon' => ''
    );
    $args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'metas'),
		'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'publish_metas',
            'edit_posts' => 'edit_metas',
            'edit_others_posts' => 'edit_others_metas',
            'read_private_posts' => 'read_private_metas',
            'edit_post' => 'edit_metas',
            'delete_post' => 'delete_metas',
            'read_post' => 'read_metas',
        ),
		'hierarchical' => false,
		'menu_position' => null,
		'taxonomies' =>false
    );
    register_post_type('metas_register', $args );
    flush_rewrite_rules();
}

function ouse_register() {
	$labels = array(
      'name' => __('Ouse'),
      'singular_name' => __('Ouse'),
      'add_new' => __('Nova meta'),
      'add_new_item' => __('Adicionar'),
      'edit_item' => __('Editar'),
      'new_item' => __('Nova'),
      'view_item' => __('Ver'),
      'search_items' => __('Procurar'),
      'not_found' =>  __('Nada encontrado'),
      'not_found_in_trash' => __('Nada encontrado na lixeira'),
      'parent_item_colon' => ''
    );
    $args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'ouse'),
		'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'publish_ouse',
            'edit_posts' => 'edit_ouse',
            'edit_others_posts' => 'edit_others_ouse',
            'read_private_posts' => 'read_private_ouse',
            'edit_post' => 'edit_ouse',
            'delete_post' => 'delete_ouse',
            'read_post' => 'read_ouse',
        ),
		'hierarchical' => false,
		'menu_position' => null,
		'taxonomies' =>false
    );
    register_post_type('ouse_register', $args );
    flush_rewrite_rules();
}
function grande_tema_register() {
	$labels = array(
      'name' => __('Grande Tema'),
      'singular_name' => __('Grande Temas'),
      'add_new' => __('Nova meta'),
      'add_new_item' => __('Adicionar'),
      'edit_item' => __('Editar'),
      'new_item' => __('Nova'),
      'view_item' => __('Ver'),
      'search_items' => __('Procurar'),
      'not_found' =>  __('Nada encontrado'),
      'not_found_in_trash' => __('Nada encontrado na lixeira'),
      'parent_item_colon' => ''
    );
    $args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'grande_tema'),
		'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'publish_grande_tema',
            'edit_posts' => 'edit_grande_tema',
            'edit_others_posts' => 'edit_others_grande_tema',
            'read_private_posts' => 'read_private_grande_tema',
            'edit_post' => 'edit_grande_tema',
            'delete_post' => 'delete_grande_tema',
            'read_post' => 'read_grande_tema',
        ),
		'hierarchical' => false,
		'menu_position' => null,
		'taxonomies' =>false
    );
    register_post_type('grande_tema_register', $args );
    flush_rewrite_rules();
}
function acao_register() {
	$labels = array(
      'name' => __('Plano de Ação'),
      'singular_name' => __('Ação'),
      'add_new' => __('Nova meta'),
      'add_new_item' => __('Adicionar'),
      'edit_item' => __('Editar'),
      'new_item' => __('Nova'),
      'view_item' => __('Ver'),
      'search_items' => __('Procurar'),
      'not_found' =>  __('Nada encontrado'),
      'not_found_in_trash' => __('Nada encontrado na lixeira'),
      'parent_item_colon' => ''
    );
    $args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'acao'),
		'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'publish_grande_acao',
            'edit_posts' => 'edit_acao',
            'edit_others_posts' => 'edit_others_acao',
            'read_private_posts' => 'read_private_acao',
            'edit_post' => 'edit_acao',
            'delete_post' => 'delete_acao',
            'read_post' => 'read_acao',
        ),
		'hierarchical' => false,
		'menu_position' => null,
		'taxonomies' =>false
    );
    register_post_type('acao_register', $args );
    flush_rewrite_rules();
}
function indicadores_register() {
	$labels = array(
      'name' => __('Indicadores'),
      'singular_name' => __('Indicador'),
      'add_new' => __('Nova meta'),
      'add_new_item' => __('Adicionar'),
      'edit_item' => __('Editar'),
      'new_item' => __('Nova'),
      'view_item' => __('Ver'),
      'search_items' => __('Procurar'),
      'not_found' =>  __('Nada encontrado'),
      'not_found_in_trash' => __('Nada encontrado na lixeira'),
      'parent_item_colon' => ''
    );
    $args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'indicador'),
		'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'publish_indicador',
            'edit_posts' => 'edit_indicador',
            'edit_others_posts' => 'edit_others_indicador',
            'read_private_posts' => 'read_private_indicador',
            'edit_post' => 'edit_indicador',
            'delete_post' => 'delete_indicador',
            'read_post' => 'read_indicador',
        ),
		'hierarchical' => false,
		'menu_position' => null,
		'taxonomies' =>false
    );
    register_post_type('indicadores_register', $args );
    flush_rewrite_rules();
}
// $user_roll = $user->roles[0];
// if($user_roll =="administrator") {
    add_action('init', 'eixos_register');
    add_action('init', 'metas_register');
    add_action('init', 'ouse_register');
    add_action('init', 'grande_tema_register');
    add_action('init', 'acao_register');
    add_action('init', 'indicadores_register');
// }
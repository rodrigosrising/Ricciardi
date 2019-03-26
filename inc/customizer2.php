<?php 
function bfp_theme_get_css_files($dir)
{
    //Get the list of files of the directory
    $files = scandir($dir);

    //Create an associative array
    //with the values of the previous array
    //removing the .css for the file name in the dropdown
    function associate($a)
    {
        $temp = array();
        foreach ($a as $value) {
            $temp[$value] = ucfirst(str_replace('.css', '', $value));
        }
        return $temp;
    }

    //Use the associate function only in the CSS files
    return associate(array_filter($files,
        function ($val) {
            return pathinfo($val)['extension'] == 'css';
        }));
}



function bfp_theme_customizer_register($wp_customize)
{
    $wp_customize->add_setting('bfp_theme_color_scheme', array(
        'default' => 'azul.css',
        'transport' => 'refresh'
    ));

    $wp_customize->add_section('bfp_theme_color_scheme_section', array(
        'title' => __('Cores do Tema', 'bfp_theme'),
        'description' => __('Selecione o esquema de cores que mais te agrada.'),
        'priority' => 1
    ));
    
    $wp_customize->add_control('bfp_theme_site_scheme_color',
        array('label' => __('Escolher cores do tema', 'bfp_theme'),
            'section' => 'bfp_theme_color_scheme_section',
            'priority' => 1,
            'type' => 'select',
            'settings' => 'bfp_theme_color_scheme',
            'choices' => bfp_theme_get_css_files(get_template_directory() . '/assets/css/scheme/', 'css'))
    );

    $wp_customize->remove_section('custom_css');
}

add_action( 'customize_register', 'bfp_theme_customizer_register');


function bfp_theme_scheme() {
    //Get the setting's value
    $colorScheme = get_theme_mod( 'bfp_theme_color_scheme', 'default.css');
    //register the style with the color scheme stored in the $colorScheme
    wp_register_style( 'theme', get_template_directory_uri() . '/assets/css/scheme/' . $colorScheme);
    //Append the style to the theme
    wp_enqueue_style( 'theme' );
    }

//Execute the function with the wp_enqueue_script action
add_action( 'wp_enqueue_scripts', 'bfp_theme_scheme', 199 );

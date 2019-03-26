<?php 
class Theme_Prefix_Color_Scheme {
    public function __construct() {    
        add_action( 'customize_register', array( $this, 'customizer_register' ) );
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_js' ) );
        add_action( 'customize_controls_print_footer_scripts', array( $this, 'color_scheme_template' ) );
        add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'output_css' ) );
    }

    public function customizer_register( WP_Customize_Manager $wp_customize ) {}
    public function customize_js() {}
    public function color_scheme_template() {}
    public function customize_preview_js() {}
    public function output_css() {}
}



public $options = array(
    'link_color',
    'button_background_color',
    'button_hover_background_color',
    'section_dark_background_color',
    'footer_background_color',
    'highlight_color',
);



public function get_color_schemes() {
    return array(
        'default' => array(
            'label'  => __( 'Default', 'induspress' ),
            'colors' => array(
                '#41535d',
                '#e67e22',
                '#c35b00',
                '#2c383f',
                '#222b30',
                '#e67e22',
            ),
        ),
        'orange'    => array(
            'label'  => __( 'Orange', 'induspress' ),
            'colors' => array(
                '#dd8500',
                '#1d5d8e',
                '#00508e',
                '#aa6600',
                '#9d5f00',
                '#dd8500',
            ),
        ),
        // Other color schemes
    );
}



$wp_customize->add_section( 'colors', array(
    'title' => __( 'Colors', 'induspress' ),
) );



$wp_customize->add_setting( 'color_scheme', array(
    'default' => 'default',
    'transport' => 'postMessage',
) );
$color_schemes = $this->get_color_schemes();
$choices = array();
foreach ( $color_schemes as $color_scheme => $value ) {
    $choices[$color_scheme] = $value['label'];
}
$wp_customize->add_control( 'color_scheme', array(
    'label'   => __( 'Color scheme', 'induspress' ),
    'section' => 'colors',
    'type'    => 'select',
    'choices' => $choices,
) );



$options = array(
    'link_color' => __( 'Link color', 'induspress' ),
    'button_background_color' => __( 'Button background color', 'induspress' ),
    'button_hover_background_color' => __( 'Button hover background color', 'induspress' ),
    'section_dark_background_color' => __( 'Section dark background color', 'induspress' ),
    'footer_background_color' => __( 'Footer background color', 'induspress' ),
    'highlight_color' => __( 'Hightlight color', 'induspress' ),
);
foreach ( $options as $key => $label ) {
    $wp_customize->add_setting( $key, array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
        'label' => $label,
        'section' => 'colors',
    ) ) );
}



public function get_color_scheme() {
    $color_schemes = $this->get_color_schemes();
    $color_scheme  = get_theme_mod( 'color_scheme' );
    $color_scheme  = isset( $color_schemes[$color_scheme] ) ? $color_scheme : 'default';

    $colors = array_map( 'strtolower', $color_schemes[$color_scheme]['colors'] );

    foreach ( $this->options as $k => $option ) {
        $color = get_theme_mod( $option );
        if ( $color && strtolower( $color ) != $colors[$k] ) {
            $colors[$k] = $color;
        }
    }
    return $colors;
}



public $is_custom = false;

public function get_color_scheme() {
    $color_schemes = $this->get_color_schemes();
    $color_scheme  = get_theme_mod( 'color_scheme' );
    $color_scheme  = isset( $color_schemes[$color_scheme] ) ? $color_scheme : 'default';

    if ( 'default' != $color_scheme ) {
        $this->is_custom = true;
    }

    $colors = array_map( 'strtolower', $color_schemes[$color_scheme]['colors'] );

    foreach ( $this->options as $k => $option ) {
        $color = get_theme_mod( $option );
        if ( $color && strtolower( $color ) != $colors[$k] ) {
            $colors[$k] = $color;
            $this->is_custom = true;
        }
    }
    return $colors;
}



public function output_css() {
    $colors = $this->get_color_scheme();
    if ( $this->is_custom ) {
        wp_add_inline_style( 'style', $this->get_css( $colors ) );
    }
}



wp_enqueue_style( 'awesometheme', get_stylesheet_uri() );



public function get_css( $colors ) {
    $css = '
    h1, h1 a,
    h2, h2 a,
    h3, h3 a,
    a {
        color: %1$s;
    }
    blockquote {
        border-left-color: %2$s;
    }
    code {
        color: %6$s;
    }
    button,
    input[type="submit"],
    .button {
        background: %2$s;
    }
    .section h2 span,
    .number {
        color: %6$s;
    }
    .section--dark,
    .services-1 {
        background-color: %4$s;
    }
    .footer {
        background: %5$s;
    }
    // More CSS
    return vsprintf( $css, $colors );
}'
}

public function color_scheme_template() {
    $colors = array(
        'link_color'                    => '{{ data.link_color }}',
        'button_background_color'       => '{{ data.button_background_color }}',
        'button_hover_background_color' => '{{ data.button_hover_background_color }}',
        'section_dark_background_color' => '{{ data.section_dark_background_color }}',
        'footer_background_color'       => '{{ data.footer_background_color }}',
        'highlight_color'               => '{{ data.highlight_color }}',
    );
    ?>
    <script type="text/html" id="tmpl-induspress-color-scheme">
        <?php echo $this->get_css( $colors ); ?>
    </script>
<?php
}



public function customize_js() {
   wp_enqueue_script( 'induspress-color-scheme', get_template_directory_uri() . '/js/color-scheme.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );
   wp_localize_script( 'induspress-color-scheme', 'IndusPressColorScheme', $this->get_color_schemes() );
}




public function customize_preview_js() {
   wp_enqueue_script( 'induspress-color-scheme-preview', get_template_directory_uri() . '/assets/js/color-scheme-preview.js', array( 'customize-preview' ), '', true );
}
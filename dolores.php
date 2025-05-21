<?php
/*
Plugin Name: Dolores – Ogłoszenia Towarzyskie Widget
Plugin URI:  https://dolores.sex
Description: Wyświetla ostatnie ogłoszenia oraz ogłoszenia z konkretnych miast bezpośrednio z Dolores
Version:     1.0
Author:      Dolores
Author URI:  https://dolores.sex
*/


function dolores_pobierz_ogloszenia( $endpoint ) {
    $response = wp_remote_get( $endpoint );
    if ( is_wp_error( $response ) ) {
        return new WP_Error( 'dolores_api_error', 'Błąd pobierania danych.' );
    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );

    if ( empty( $data ) || ! is_array( $data ) ) {
        return new WP_Error( 'dolores_empty', 'Brak danych do wyświetlenia.' );
    }

    return $data;
}

function dolores_renderuj_ogloszenia( $ogloszenia ) {
    $output = '<div class="ogloszenia-container">';
    foreach ( $ogloszenia as $ogloszenie ) {
        if ( ! isset( $ogloszenie['id'], $ogloszenie['url'], $ogloszenie['photo_filename'], $ogloszenie['title'], $ogloszenie['city'] ) ) {
            continue;
        }

        $output .= '<div class="anons-miniatura-item anons-type-standard" data-id="' . esc_attr( $ogloszenie['id'] ) . '">';
        $output .= '<a href="https://dolores.sex/' . esc_attr( $ogloszenie['url'] ) . '" class="related-item-img">';
        $output .= '  <div class="related-item-img3">';
        $output .= '      <img loading="lazy" src="https://media.dolores.pl/thumb/' . esc_attr( $ogloszenie['id'] ) . '/' . esc_attr( $ogloszenie['photo_filename'] ) . '_thumb" class="img-fluid" alt="' . esc_attr( $ogloszenie['title'] ) . '" title="' . esc_attr( $ogloszenie['title'] ) . '">';
        $output .= '  </div>';
        $output .= '  <div class="img-bottom-content">';
        $output .= '      <span class="anons-miniatura-title">' . esc_html( $ogloszenie['title'] ) . '</span>';
        $output .= '      <span class="anons-miniatura-city">' . esc_html( $ogloszenie['city'] ) . '</span>';
        $output .= '  </div>';
        $output .= '</a>';
        $output .= '</div>';
    }
    $output .= '</div>';

    return $output;
}

function ostatnie_ogloszenia_shortcode( $atts = array() ) {

    $atts = shortcode_atts(
        array(
            'max' => 8,
        ),
        $atts,
        'ostatnie_ogloszenia'
    );
    $limit = max( 1, intval( $atts['max'] ) );

    wp_enqueue_style( 'ostatnie-ogloszenia-style', plugins_url( 'style.css', __FILE__ ) );

    $data = dolores_pobierz_ogloszenia( 'https://dolores.sex/widget/widget_api.php' );
    if ( is_wp_error( $data ) ) {
        return $data->get_error_message();
    }

    shuffle( $data );
    $ogloszenia = array_slice( $data, 0, $limit );

    return dolores_renderuj_ogloszenia( $ogloszenia );
}
add_shortcode( 'ostatnie_ogloszenia', 'ostatnie_ogloszenia_shortcode' );

function ogloszenia_shortcode( $atts = array() ) {

    $atts = shortcode_atts(
        array(
            'miasto' => '',
            'max'    => 6,
        ),
        $atts,
        'ogloszenia'
    );

    $limit = max( 1, intval( $atts['max'] ) );
    $city  = sanitize_text_field( $atts['miasto'] );

    wp_enqueue_style( 'ostatnie-ogloszenia-style', plugins_url( 'style.css', __FILE__ ) );

    $endpoint = ! empty( $city )
        ? 'https://dolores.sex/widget/widget_api.php?from=' . rawurlencode( $city )
        : 'https://dolores.sex/widget/widget_api.php';

    $data = dolores_pobierz_ogloszenia( $endpoint );
    if ( is_wp_error( $data ) ) {
        return $data->get_error_message();
    }

    shuffle( $data );
    $ogloszenia = array_slice( $data, 0, $limit );

    if ( empty( $ogloszenia ) ) {
        return 'Brak ogłoszeń do wyświetlenia dla podanych parametrów.';
    }

    return dolores_renderuj_ogloszenia( $ogloszenia );
}
add_shortcode( 'ogloszenia', 'ogloszenia_shortcode' );

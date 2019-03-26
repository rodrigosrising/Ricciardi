<?php 
$args = array(
    'walker'            => null,
    'max_depth'         => '',
    'style'             => 'ul',
    'callback'          => null,
    'end-callback'      => null,
    'type'              => 'all',
    'reply_text'        => 'Reply',
    'page'              => '',
    'per_page'          => '',
    'avatar_size'       => 32,
    'reverse_top_level' => null,
    'reverse_children'  => '',
    'format'            => 'xhtml', //or html5 @since 3.6
    'short_ping'        => false // @since 3.6
);
wp_list_comments($args);
 ?>

<?php

$fields =  array(

  'author' =>
    '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="Nome*" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'email' =>
    '<p class="comment-form-email"><input id="email" name="email" type="text" placeholder="Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'url' =>
    '<p class="comment-form-url hide-element"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>',
);

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$comments_args = array(
        // change the title of send button 
        'label_submit'=>'Enviar Comentário',
        // change the title of the reply section
        'title_reply'=>'Escreva um comentário <br>',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        'class_submit'      => 'button secondary',
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="Mensagem*"></textarea></p>',
        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
);

comment_form($comments_args);
?>
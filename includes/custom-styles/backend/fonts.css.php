<?php

if( !empty( get_option( 'addon_main_typekit_font_face', '' ) ) ) {

    $custom_gutenberg_styles .= '
        .edit-post-visual-editor .wp-block h1,
        .edit-post-visual-editor .wp-block h2,
        .edit-post-visual-editor .wp-block h3,
        .edit-post-visual-editor .wp-block h4,
        .edit-post-visual-editor .wp-block h5,
        .edit-post-visual-editor .wp-block h6,
        .edit-post-visual-editor .wp-block label:not(.components-placeholder__label),
        .edit-post-visual-editor .wp-block table thead tr th,
        .edit-post-visual-editor .wp-block input[type="reset"],
        .edit-post-visual-editor .wp-block input[type="submit"],
        .wp-block-latest-posts a,
        .wp-block-button,
        .wp-block-cover .wp-block-cover-text,
        .wp-block-subhead,
        .wp-block-image	figcaption,
        .wp-block .wp-block-pullquote .editor-rich-text p,
        .wp-block .wp-block-quote .editor-rich-text p,
        .wp-block .wp-block-pullquote .wp-block-pullquote__citation,
        .wp-block .wp-block-quote .wp-block-quote__citation,
        .gbt_18_sk_latest_posts_title,
        .gbt_18_sk_editor_banner_title,
        .gbt_18_sk_editor_slide_title_input,
        .gbt_18_sk_editor_slide_button_input,
        .gbt_18_sk_categories_grid .gbt_18_sk_category_name,
        .gbt_18_sk_categories_grid .gbt_18_sk_category_count,
        .gbt_18_sk_slider_wrapper .gbt_18_sk_slide_button,
        .gbt_18_sk_posts_grid .gbt_18_sk_posts_grid_title,
        .gbt_18_sk_editor_portfolio_item_title,
        .editor-post-title .editor-post-title__input,
        .wc-products-block-preview .product-title,
        .wc-products-block-preview .product-add-to-cart,
        .wc-block-products-category .wc-product-preview__title,
        .wc-block-products-category .wc-product-preview__add-to-cart,
        .wp-block-media-text .editor-inner-blocks .editor-rich-text p,
        .edit-post-visual-editor p.has-drop-cap:first-letter,
        .wc-block-products-grid .wc-product-preview__title,
        .wc-block-grid__product-onsale,
        .wc-block-featured-product__price,
        .wc-block-grid__product-price,
        .wc-block-review-list-item__text__read_more,
        .wc-block-review-list-item__product a,
        .wp-block-search .wp-block-search__button,
        .wc-block-product-search__label,
    	.wp-block-search__label
        {
            font-family: ' . get_option( 'addon_main_typekit_font_face', '' ) . ', sans-serif !important;
        }
    ';
}

if( !empty( get_option( 'addon_secondary_typekit_font_face', '' ) ) ) {

    $custom_gutenberg_styles .= '
        .edit-post-visual-editor .wp-block p,
        .edit-post-visual-editor .wp-block textarea:not(.editor-post-title__input),
        .gbt_18_sk_editor_banner_subtitle,
        .gbt_18_sk_editor_slide_description_input,
        .edit-post-visual-editor .wp-block select,
        .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-link .wc-block-grid__product-title,
        .wc-block-grid__product-title,
        .edit-post-visual-editor .wp-block input,
    	.editor-styles-wrapper .wp-block
        {
            font-family: ' . get_option( 'addon_secondary_typekit_font_face', '' ) . ', serif !important;
        }
    ';
}

?>

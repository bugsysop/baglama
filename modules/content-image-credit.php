<?php
/*
 * Add photo credit info to images
 * Version: based on 1.0.1 
 * Author: Automattic, INN Labs, Project Argo
 * Author URI: https://newspack.blog/
 * License: GPL2
 */

class Baglama_Image_Credits {

	const MEDIA_CREDIT_META = '_media_credit';
	const MEDIA_CREDIT_URL_META = '_media_credit_url';
	const MEDIA_CREDIT_ORG_META = '_navis_media_credit_org';

	/**
	 * Hook actions and filters.
	 */
	public static function init() {
		add_filter( 'attachment_fields_to_save', [ __CLASS__, 'baglama_save_media_credit' ], 10, 2 );
		add_filter( 'attachment_fields_to_edit', [ __CLASS__, 'baglama_add_media_credit' ], 10, 2 );
		add_filter( 'get_the_excerpt', [ __CLASS__, 'baglama_add_credit_to_attachment_excerpts' ], 10, 2 );
		add_filter( 'render_block', [ __CLASS__, 'baglama_add_credit_to_image_block' ], 10, 2 );
	}

	/**
	 * Get media credit info for an attachment.
	 *
	 * @param int $attachment_id Post ID of the attachment.
	 * @return array Credit info. See $output at the top of this method.
	 */
	public static function baglama_get_media_credit( $attachment_id ) {
		$output = [
			'id'             => $attachment_id,
			'credit'         => '',
			'credit_url'     => '',
			'organization'   => '',
			//'can_distribute' => false,
		];

		$credit = get_post_meta( $attachment_id, self::MEDIA_CREDIT_META, true );
		if ( $credit ) {
			$output['credit'] = esc_attr( $credit );
		}

		$credit_url = get_post_meta( $attachment_id, self::MEDIA_CREDIT_URL_META, true );
		if ( $credit_url ) {
			$output['credit_url'] = esc_attr( $credit_url );
		}

		$organization = get_post_meta( $attachment_id, self::MEDIA_CREDIT_ORG_META, true );
		if ( $organization ) {
			$output['organization'] = esc_attr( $organization );
		}

		return $output;
	}

	/**
	 * Get credit info as an HTML string.
	 *
	 * @param int $attachment_id Attachment post ID.
	 * @return string The credit ready for output.
	 */
	public static function baglama_get_media_credit_string( $attachment_id ) {
		$credit_info = self::baglama_get_media_credit( $attachment_id );
		if ( ! $credit_info['credit'] ) {
			return '';
		}

		$credit = $credit_info['credit'];
		if ( $credit_info['organization'] ) {
			$credit .= '&nbsp;/&nbsp;' . $credit_info['organization'];
		}

		if ( $credit_info['credit_url'] ) {
			$credit = '<a href="' . $credit_info['credit_url'] . '" target="_blank">' . $credit . '</a>';
		}

		// See PR from @laurelfulford - https://github.com/Automattic/newspack-image-credits/pull/4/commits
		$credit = sprintf(
					'<span class="image-credit"><span class="credit-label-wrapper">%1$s</span> %2$s</span>',
					esc_html__( 'Credit:', 'baglama' ),
					$credit
				);

		return wp_kses_post( $credit );
	}

	/**
	 * Save the media credit info.
	 *
	 * @param array $post Array of post info.
	 * @param array $attachment Array of media field input info.
	 * @return array $post Unmodified post info.
	 */
	public static function baglama_save_media_credit( $post, $attachment ) {
		if ( isset( $attachment['media_credit'] ) ) {
			update_post_meta( $post['ID'], self::MEDIA_CREDIT_META, sanitize_text_field( $attachment['media_credit'] ) );
		}

		if ( isset( $attachment['media_credit_url'] ) ) {
			update_post_meta( $post['ID'], self::MEDIA_CREDIT_URL_META, sanitize_text_field( $attachment['media_credit_url'] ) );
		}

		if ( isset( $attachment['media_credit_org'] ) ) {
			update_post_meta( $post['ID'], self::MEDIA_CREDIT_ORG_META, sanitize_text_field( $attachment['media_credit_org'] ) );
		}

		return $post;
	}

	/**
	 * Add media credit fields to the media editor.
	 *
	 * @param array $fields Array of media editor field info.
	 * @param WP_Post $post Post object for current attachment.
	 * @return array Modified $fields.
	 */
	public static function baglama_add_media_credit( $fields, $post ) {
		$credit_info = self::baglama_get_media_credit( $post->ID );
        $fields['media_credit'] = [
        	'label' => __( 'Author', 'baglama' ),
        	'input' => 'text',
        	'value' => $credit_info['credit'],
        ];

        $fields['media_credit_url'] = [
        	'label' => __( 'Link', 'baglama' ),
        	'input' => 'text',
        	'value' => $credit_info['credit_url'],
        ];

        $fields['media_credit_org'] = [
        	'label' => __( 'Organization', 'baglama' ),
        	'input' => 'text',
        	'value' => $credit_info['organization'],
        ];

        return $fields;
	}

	/**
	 * Add media credit to attachment excerpts (captions) when possible.
	 *
	 * @param string $excerpt Attachment excerpt/caption.
	 * @param WP_Post $post Post object.
	 * @return string Modified $excerpt.
	 */
	public static function baglama_add_credit_to_attachment_excerpts( $excerpt, $post ) {
		if ( 'attachment' !== $post->post_type ) {
			return $excerpt;
		}

		$credit_string = self::baglama_get_media_credit_string( $post->ID );
		if ( $excerpt && $credit_string ) {
			return $excerpt . ' ' . $credit_string;
		} elseif ( $credit_string ) {
			return $credit_string;
		} else {
			return $excerpt;
		}
	}

	/**
	 * Add media credit to image blocks when possible.
	 *
	 * @param string $block_output HTML block output.
	 * @param array $block Raw block info.
	 * @return string Modified $block_output.
	 */
	public static function baglama_add_credit_to_image_block( $block_output, $block ) {
		if ( 'core/image' !== $block['blockName'] || empty( $block['attrs']['id'] ) ) {
			return $block_output;
		}

		$credit_string = self::baglama_get_media_credit_string( $block['attrs']['id'] );
		if ( ! $credit_string ) {
			return $block_output;
		}

		if ( strpos( $block_output, '</figcaption>' ) ) {
			// If an image caption exists, add the credit to it.
			$block_output = str_replace( '</figcaption>', ' ' . $credit_string . '</figcaption>', $block_output );
		} else {
			// If an image caption doesn't exist, make the credit the caption.
			$block_output = str_replace( '</figure>', '<figcaption>' . $credit_string . '</figcaption></figure>', $block_output );
		}

		return $block_output;
	}
}
Baglama_Image_Credits::init();

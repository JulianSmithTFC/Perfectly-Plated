<?php
namespace WPO\WC\PDF_Invoices_Pro;

use WPO\WC\PDF_Invoices\Compatibility\WC_Core as WCX;
use WPO\WC\PDF_Invoices\Compatibility\Order as WCX_Order;
use WPO\WC\PDF_Invoices\Compatibility\Product as WCX_Product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( '\\WPO\\WC\\PDF_Invoices_Pro\\Multilingual' ) ) :

class Multilingual {

	/**
	 * The language used before creating a PDF
	 * @var String
	 */
	public $previous_language;

	public function __construct() {
		// load switcher class
		include_once( 'wcpdf-pro-order-language-switcher.php' );

		// add actions
		add_action( 'wpo_wcpdf_before_pdf', array( $this, 'store_language' ), 10, 2 );
		add_action( 'wpo_wcpdf_before_html', array( $this, 'switch_language' ), 10, 2 );
		add_action( 'wpo_wcpdf_after_pdf', array( $this, 'reset_language' ), 10, 1 );

		// helper filters
		add_filter( 'wpo_wcpdf_order_taxes', array( $this, 'wpml_tax_labels' ), 10, 2 );

		add_action( 'pllwc_email_reload_text_domains', array( $this, 'polylang_email_reload_text_domains' ) );
	}

	public function store_language( $document_type, $document ) {
		// WPML specific
		if (class_exists('\\SitePress')) {
			global $sitepress;
			$this->previous_language = $sitepress->get_current_language();
		// Polylang specific
		} elseif (class_exists('\\Polylang') && did_action( 'pll_init' ) ) {
			$this->previous_language = pll_current_language( 'locale' );
		}
	}

	/**
	 * WPML compatibility helper function: set wpml language before pdf creation
	 */
	public function switch_language( $document_type, $document ) {
		$language_switcher = new Language_Switcher();
		// switch language
		$language_switcher->switch_language( $document_type, $document );

		// filter setting texts to use settings field translations
		$this->translate_setting_texts();
	}

	/**
	 * Set locale/language to default after PDF creation
	 */
	public function reset_language() {
		global $sitepress;
		// WPML specific
		if ( class_exists('\\SitePress') ) {
			$sitepress->switch_lang( $this->previous_language );
		// Polylang specific
		} elseif ( class_exists('\\Polylang') && did_action( 'pll_init' ) ) {
			// not sure if this is still necessary, since we're already reloading per order
			$language = PLL()->model->get_language( get_locale() );
			$language_switcher = new Language_Switcher();
			$language_switcher->reload_text_domains( $language );
		}
	}

	/**
	 * Polylang method to reload text domains for emails
	 */
	public function polylang_email_reload_text_domains() {
		unload_textdomain( 'woocommerce-pdf-invoices-packing-slips' );
		unload_textdomain( 'wpo_wcpdf' );
		unload_textdomain( 'wpo_wcpdf_pro' );

		WPO_WCPDF()->translations();
		WPO_WCPDF_Pro()->translations();
	}

	/**
	 * Parse tax labels to ensure they are translated for credit notes too
	 * @param  array $taxes    total tax rows
	 * @param  obj   $document WCPDF Order Document object
	 * @return array $taxes    total tax rows
	 */
	public function wpml_tax_labels( $taxes, $document ) {
		if ( isset($document->order) && class_exists('\\SitePress') ) {
			// only for refund orders!
			// get order type: WC3.0 = 'shop_order_refund', WC2.6 = 'refund'
			$order_type = method_exists($document->order, 'get_type') ? $document->order->get_type() : $document->order->order_type;
			if ( $order_type == 'refund' || $order_type == 'shop_order_refund' ) {
				foreach ($taxes as $key => $tax ) {
					$taxes[$key]['label'] = apply_filters('wpml_translate_single_string', $taxes[$key]['label'], 'woocommerce taxes', $taxes[$key]['label'] );
				}
			}
		}
		return $taxes;
	}

	/**
	 * Filter admin setting texts to apply translations
	 */
	public function translate_setting_texts () {
		add_filter( 'wpo_wcpdf_header_logo_id', array( $this, 'wpml_translated_media_id' ), 9, 2 );
		add_filter( 'wpo_wcpdf_shop_name_settings_text', array( $this, 'wpml_shop_name_text' ), 9, 2 );
		add_filter( 'wpo_wcpdf_shop_address_settings_text', array( $this, 'wpml_shop_address_text' ), 9, 2 );
		add_filter( 'wpo_wcpdf_footer_settings_text', array( $this, 'wpml_footer_text' ), 9, 2 );
		add_filter( 'wpo_wcpdf_extra_1_settings_text', array( $this, 'wpml_extra_1_text' ), 9, 2 );
		add_filter( 'wpo_wcpdf_extra_2_settings_text', array( $this, 'wpml_extra_2_text' ), 9, 2 );
		add_filter( 'wpo_wcpdf_extra_3_settings_text', array( $this, 'wpml_extra_3_text' ), 9, 2 );
	}

	public function wpml_translated_media_id( $media_id, $document = null ) {
		$media_id = apply_filters( 'wpml_object_id', $media_id, 'attachment', true );
		return $media_id;
	}

	/**
	 * Get string translations
	 */
	public function wpml_shop_name_text ( $shop_name, $document = null ) {
		return $this->get_string_translation( 'shop_name', $shop_name, $document );
	}
	public function wpml_shop_address_text ( $shop_address, $document = null ) {
		return wpautop( $this->get_string_translation( 'shop_address', $shop_address, $document ) );
	}
	public function wpml_footer_text ( $footer, $document = null ) {
		return wpautop( $this->get_string_translation( 'footer', $footer, $document ) );
	}
	public function wpml_extra_1_text ( $extra_1, $document = null ) {
		return wpautop( $this->get_string_translation( 'extra_1', $extra_1, $document ) );
	}
	public function wpml_extra_2_text ( $extra_2, $document = null ) {
		return wpautop( $this->get_string_translation( 'extra_2', $extra_2, $document ) );
	}
	public function wpml_extra_3_text ( $extra_3, $document = null ) {
		return wpautop( $this->get_string_translation( 'extra_3', $extra_3, $document ) );
	}

	public function get_i18n_setting( $setting_key, $default, $document ) {
		if ( !empty($document) && !empty($document->settings) && !empty($document->order) ) {
			// get language & locale for document
			extract( $this->get_document_lang_locale( $document ) ); // $order_lang, $order_locale
			// check if we have a value for this setting
			if ( isset( $document->settings[$setting_key] ) && is_array( $document->settings[$setting_key] ) ) {
				// check if we have a translation for this setting in the document language
				if ( isset( $document->settings[$setting_key][$order_lang] ) ) {
					return wptexturize( $document->settings[$setting_key][$order_lang] );
				// fallback to default
				} elseif ( isset( $document->settings[$setting_key]['default'] ) ) {
					return wptexturize( $document->settings[$setting_key]['default'] );
				// fallback to first language
				} else {
					$translation = reset($document->settings[$setting_key]);
					return wptexturize( $translation );
				}
			}
		}

		// no translation
		return false;
	}

	/**
	 * Get string translation for string name, using $woocommerce_wpml helper function
	 */
	public function get_string_translation ( $string_name, $default, $document ) {
		global $woocommerce_wpml, $sitepress;
		// check internal settings first
		$translated = $this->get_i18n_setting( $string_name, $default, $document );
		if ( $translated !== false ) {
			return $translated;
		}
		
		// fallback to 1.X method
		if ( $document_lang_locale = $this->get_document_lang_locale( $document ) ) {
			extract( $document_lang_locale ); // $order_lang, $order_locale
			$translations = get_option( 'wpo_wcpdf_translations' );
			$internal_string = 'wpo_wcpdf_template_settings['.$string_name.']';
			if ( !empty($translations[$internal_string][$order_lang]) ) {
				return wptexturize( $translations[$internal_string][$order_lang] );
			}

			// fall back to string translations
			if (class_exists('\\SitePress')) {
				$full_string_name = '[wpo_wcpdf_template_settings]'.$string_name;
				if ( isset($woocommerce_wpml->emails) && method_exists( $woocommerce_wpml->emails, 'wcml_get_email_string_info' ) ) {
					$string_data = $woocommerce_wpml->emails->wcml_get_email_string_info( $full_string_name );
					if($string_data) {
						$string = icl_t($string_data[0]->context, $full_string_name ,$string_data[0]->value);
						return wptexturize( $string );
					}
				}
			} elseif (class_exists('\\Polylang') && function_exists('\\pll_translate_string')) {
				// we don't rely on $default, it has been filtered throught wpautop &
				// wptexturize when the apply_filter function was invoked
				if (!empty($document->settings[$string_name][$order_lang])) {
					$string = pll_translate_string( $document->settings[$string_name][$order_lang], $order_locale );
					return wptexturize( $string );
				}
			}
		}

		// no translations found, try to at least return a string
		if ( is_array( $default ) ) {
			return array_shift( $default );
		} elseif ( is_string( $default ) ) {
			return $default;
		} else {
			return '';
		}
	}

	public function get_document_lang_locale( $document ) {
		// WPML specific
		if (class_exists('\\SitePress')) {
			global $sitepress;
			$order_lang = WCX_Order::get_meta( $document->order, 'wpml_language', true );
			if ( empty( $order_lang ) && $document->get_type() == 'credit-note' ) {
				if ( $document->is_refund( $document->order ) ) {
					$parent_order = $document->get_refund_parent( $document->order );
					$order_lang = WCX_Order::get_meta( $parent_order, 'wpml_language', true );
					unset($parent_order);
				}
			}
			if ( $order_lang == '' ) {
				$order_lang = $sitepress->get_default_language();
			}

			$order_lang = apply_filters( 'wpo_wcpdf_wpml_language', $order_lang, $document->order_id, $document->get_type() );
			$order_locale = $sitepress->get_locale( $order_lang );

		// Polylang specific
		} elseif (class_exists('\\Polylang')) {
			if (!function_exists('\\pll_get_post_language')) {
				return array( 'order_lang' => '', 'order_locale' => '' );
			}
			// use parent order id for refunds
			if ( $document->is_refund( $document->order ) ) {
				$order_id = $document->get_refund_parent_id( $document->order );
			} else {
				$order_id = $document->order_id;
			}

			$order_locale = pll_get_post_language( $order_id, 'locale' );
			$order_lang = pll_get_post_language( $order_id, 'slug' );
			if ( $order_lang == '' ) {
				$order_locale = pll_default_language( 'locale' );
				$order_lang = pll_default_language( 'slug' );
			}

		}

		return compact( "order_lang", "order_locale" );
	}

} // end class

endif; // end class_exists

return new Multilingual();
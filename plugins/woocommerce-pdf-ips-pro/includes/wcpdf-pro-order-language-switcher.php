<?php
namespace WPO\WC\PDF_Invoices_Pro;

use WPO\WC\PDF_Invoices\Compatibility\WC_Core as WCX;
use WPO\WC\PDF_Invoices\Compatibility\Order as WCX_Order;
use WPO\WC\PDF_Invoices\Compatibility\Product as WCX_Product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( '\\WPO\\WC\\PDF_Invoices_Pro\\Language_Switcher' ) ) :

class Language_Switcher {
	/**
	 * Locale of the order
	 * @var String
	 */
	public $order_locale;

	/**
	 * Language (slug) of the order
	 * @var String
	 */
	public $order_lang;

	public function __construct() {
		// clean up after ourselves
		add_action( 'wpo_wcpdf_template_order_processed', array( $this, 'remove_filters' ) );
	}

	/**
	 * Switch language/translations
	 */
	public function switch_language( $document_type, $document ) {
		global $sitepress, $locale;

		// get order locale and set order_lang, order_locale properties
		$this->set_order_lang_locale( $document_type, $document );

		// bail if we don't have an order_locale
		if (empty($this->order_locale)) {
			return;
		}

		// FIXME test get_user_locale for backward compatibility with WP 4.7
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();

		// apply filters for plugin locale
		add_filter( 'locale', array( $this, 'plugin_locale' ), 10, 2 );
		add_filter( 'plugin_locale', array( $this, 'plugin_locale' ), 10, 2 );
		add_filter( 'theme_locale', array( $this, 'plugin_locale' ), 10, 2 );

		// force reload text domains
		$this->reload_text_domains();

		// reload country name translations
		WC()->countries = new \WC_Countries();

		if (class_exists('\\SitePress')) {
			// WPML specific
			// filters to ensure correct locale
			add_filter( 'icl_current_string_language', array( $this, 'wpml_admin_string_language' ), 9, 2);
			$sitepress->switch_lang( $this->order_lang );
			$GLOBALS['wp_locale'] = new \WP_Locale(); // ensures correct translation of dates e.a.
		} elseif (class_exists('\\Polylang') && did_action( 'pll_init' ) ) {
			$GLOBALS['wp_locale'] = new \WP_Locale(); // ensures correct translation of dates e.a.
			// set PLL locale to order locale - Is this necessary?
			PLL()->curlang = PLL()->model->get_language( $this->order_locale );

			// load Polylang translated string
			static $cache; // Polylang string translations cache object to avoid loading the same translations object several times
			// Cache object not found. Create one...
			if ( empty( $cache ) ) {
				$cache = new \PLL_Cache();
			}

			if (false === $mo = $cache->get( $this->order_locale ) ) {
				$mo = new \PLL_MO();
				$mo->import_from_db( $GLOBALS['polylang']->model->get_language( $this->order_locale ) );
				$GLOBALS['l10n']['pll_string'] = &$mo;
				// Add to cache
				$cache->set( $this->order_locale, $mo );
			}
		}
	}

	/**
	 * Set order_lang and order_locale properties
	 */
	public function set_order_lang_locale( $document_type, $document ) {
		if (empty($document->order)) {
			return;
		}

		// get document language setting
		$document_language = isset( WPO_WCPDF_Pro()->functions->pro_settings['document_language'] ) ? WPO_WCPDF_Pro()->functions->pro_settings['document_language'] : 'order';

		// WPML specific
		if (class_exists('\\SitePress')) {
			global $sitepress;
			if ($document_language == 'order') {
				// USE ORDER LANGUAGE
				$order_lang = WCX_Order::get_meta( $document->order, 'wpml_language', true );
				if ( empty( $order_lang ) && $document_type == 'credit-note' ) {
					if ( $parent_order_id = wp_get_post_parent_id( $document->order_id ) ) {
						$parent_order = WCX::get_order( $parent_order_id );
						$order_lang = WCX_Order::get_meta( $parent_order, 'wpml_language', true );
						unset($parent_order);
					}
				}
				if ( $order_lang == '' ) {
					$order_lang = $sitepress->get_default_language();
				}
			} else {
				// USE SITE DEFAULT LANGUAGE
				$order_lang = $sitepress->get_default_language();
			}

			$this->order_lang = apply_filters( 'wpo_wcpdf_wpml_language', $order_lang, $document->order_id, $document_type );
			$this->order_locale = $sitepress->get_locale( $this->order_lang );

		// Polylang specific
		} elseif (class_exists('\\Polylang') && did_action( 'pll_init' ) ) {
			if (!function_exists('pll_get_post_language')) {
				return;
			}
			if ($document_language == 'order') {
				// USE ORDER LANGUAGE
				// use parent order id for refunds
				$order_id = $document->order_id;
				if ( get_post_type( $order_id ) == 'shop_order_refund' && $parent_order_id = wp_get_post_parent_id( $order_id ) ) {
					$order_id = $parent_order_id;
				}
				$order_locale = pll_get_post_language( $order_id, 'locale' );
				$order_lang = pll_get_post_language( $order_id, 'slug' );
				if ( $order_lang == '' ) {
					$order_locale = pll_default_language( 'locale' );
					$order_lang = pll_default_language( 'slug' );
				}
			} else {
				// USE SITE DEFAULT LANGUAGE
				$order_locale = pll_default_language( 'locale' );
				$order_lang = pll_default_language( 'slug' );
			}

			$this->order_locale = apply_filters( 'wpo_wcpdf_pll_locale', $order_locale, $document->order_id, $document_type );
			$this->order_lang = apply_filters( 'wpo_wcpdf_pll_language', $order_lang, $document->order_id, $document_type );
		}
	}

	/**
	 * Force reload textdomains
	 */
	public function reload_text_domains() {
		// prevent Polylang (2.2.6+) mo file override
		if ( class_exists('\\Polylang') && !empty(PLL()->filters) && method_exists(PLL()->filters, 'load_textdomain_mofile') ) {
			remove_filter( 'load_textdomain_mofile', array( PLL()->filters, 'load_textdomain_mofile' ) );
		}
		// from WP_Locale_Switcher - not sure if this works at all?
		$domains = $GLOBALS['l10n'] ? array_keys( $GLOBALS['l10n'] ) : array();
		$force_loaded = array( 'woocommerce', 'woocommerce-pdf-invoices-packing-slips', 'wpo_wcpdf_pro', 'default' );
		foreach ( $domains as $domain ) {
			// skip ones that we already force load
			if ( in_array($domain, $force_loaded) ) {
				continue;
			}
			unload_textdomain( $domain );
			get_translations_for_domain( $domain );
		}

		// unload text domains
		unload_textdomain( 'woocommerce' );
		unload_textdomain( 'woocommerce-pdf-invoices-packing-slips' );
		unload_textdomain( 'wpo_wcpdf' );
		unload_textdomain( 'wpo_wcpdf_pro' );

		// reload text domains
		WC()->load_plugin_textdomain();
		WPO_WCPDF()->translations();
		WPO_WCPDF_Pro()->translations();

		// WP Core
		unload_textdomain( 'default' );
		load_default_textdomain( $this->order_locale );

		// allow third party plugins to reload theirs too
		do_action( 'wpo_wcpdf_reload_text_domains', $this->order_locale );
	}

	/**
	 * set locale for plugins (used in locale and plugin_locale filters)
	 * @param  string $locale Locale
	 * @param  string $domain text domain
	 * @return string $locale Locale
	 */
	public function plugin_locale( $locale, $domain = '' ) {
		$locale = $this->order_locale;
		return $locale;
	}

	/**
	 * WPML specific filter for admin string language
	 * @param  string $current_language language slug
	 * @param  [type] $name             [description]
	 * @return string $current_language language slug
	 */
	public function wpml_admin_string_language ( $current_language, $name ) {
		if ( !empty( $this->order_lang ) ) {
			return $this->order_lang;
		} else {
			return $current_language;
		}
	}

	/**
	 * Remove language/locale filters after PDF creation
	 */
	public function remove_filters() {
		global $sitepress;
		// WPML specific
		if ( class_exists('\\SitePress') ) {
			remove_filter( 'icl_current_string_language', array( $this, 'wpml_admin_string_language' ) );
		}

		remove_filter( 'locale', array( $this, 'plugin_locale' ) );
		remove_filter( 'plugin_locale', array( $this, 'plugin_locale' ) );
		remove_filter( 'theme_locale', array( $this, 'plugin_locale' ) );

		// force reload text domains
		$this->reload_text_domains();
	}


} // end class

endif; // end class_exists
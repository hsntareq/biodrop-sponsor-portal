<?php
namespace Sponsor;

if ( ! function_exists( 'pr' ) ) {
	/**
	 * Function to print_r
	 *
	 * @param  array $var .
	 * @return array
	 */
	function pr( $var ) {
		$template = PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg' ? '<pre class="pr">%s</pre>' : "\n%s\n\n";
		printf( $template, trim( print_r( $var, true ) ) );

		return $var;
	}
}

if ( ! function_exists( 'vr' ) ) {
	/**
	 * Function to var_dump
	 *
	 * @param  array $var .
	 * @return array
	 */
	function vr( $var ) {
		$template = PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg' ? '<pre class="pr">%s</pre>' : "\n%s\n\n";
		printf( $template, trim( var_dump( $var, true ) ) );

		return $var;
	}
}



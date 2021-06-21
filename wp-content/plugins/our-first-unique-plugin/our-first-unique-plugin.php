<?php
/*
	Plugin Name: Our Test Plugin
	Description: A ver si result, jajaj
	Version: 1.0
	Author: Arne Saknussemm
	Author URI: https://web-pyme.cl
*/

/**
 * Miclase linda
 */
class RevisarTexto
{
	function __construct()
	{
		add_action( 'admin_menu', array( $this , 'menu_ajustes'));
	}
	function menu_ajustes()
	{
		add_options_page( 'Ajustes Revisión de Texto', 'Revisar texto', 'manage_options', 'revisar-texto', array($this, 'ajustes_html') );
	}
	function ajustes_html()
	{
		ob_start();
		?>
		<div class="wrap">
			<h1>Hola</h1>
		</div>
		<?php
		echo ob_get_clean();
	}
}

$revisar_texto = new RevisarTexto();

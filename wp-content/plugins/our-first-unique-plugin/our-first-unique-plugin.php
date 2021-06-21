<?php
/**
 *	Plugin Name: Our Test Plugin
 *	Description: A ver si result, jajaj
 *	Version: 1.0
 *	Author: Arne Saknussemm
 *	Author URI: https://github.com/ArneSaknussemm
 */

/**
 * Miclase linda
 */
class RevisarTexto
{
	function __construct()
	{
		add_action( 'admin_menu', array( $this, 'rvt_menu') );
		add_action( 'admin_init', array( $this, 'rvt_ajustes') );
	}
	function rvt_ajustes()
	{
		add_settings_section( 'rvt_seccion_a', null, null, 'revisar-texto' );
		add_settings_field( 'rvt_campo_ubicacion', 'Ubicación', array( $this, 'campo_ubicacion_html'), 'revisar-texto', 'rvt_seccion_a' );
			register_setting( 'rvt_grupo_ubicacion', 'rvt_campo_ubicacion', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '0'
		) );
	}
	function campo_ubicacion_html()
	{
		//ob_start();
		?>
		<div class="wrap">
			<select name="rvt_grupo_ubicacion">
				<option value="0">Al principio de la entrada</option>
				<option value="1">Al final de la entrada</option>
			</select>
		</div>
		<?php
		//echo ob_get_clean();
	}
	function rvt_menu()
	{
		add_options_page( 'Ajustes Revisión de Texto', 'Revisar texto', 'manage_options', 'revisar-texto', array($this, 'rvt_pag_ajustes_html') );
	}
	function rvt_pag_ajustes_html()
	{
		//ob_start()
		?>
		<div class="wrap">
			<h1>Hola</h1>
			<form action="options.php" method="POST">
				<?php
				settings_fields( 'rvt_grupo_ubicacion' );
				do_settings_sections( 'revisar-texto' );
				submit_button();
				?>
			</form>
		</div>
		<?php
		//echo ob_get_clean();
	}
}

$revisar_texto = new RevisarTexto();

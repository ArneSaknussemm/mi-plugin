<?php
/**
 *	Plugin Name: Our Test Plugin
 *	Description: A ver si result, jajaj
 *	Version: 1.0
 *	Author: Arne Saknussemm
 *	Author URI: https://github.com/ArneSaknussemm
 *	Text Domain: rvt-dominio
 *	Domain Path: /languages
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
		add_filter( 'the_content', array( $this, 'depende') );
		add_action( 'init', array( $this, 'idiomas') );
	}

	function idiomas()
	{
		load_plugin_textdomain( 'rvt-dominio', false, dirname(plugin_basename( __FILE__ )) . '/languages' );
	}

	function depende($contenido)
	{
		if (is_main_query() && is_single() && (
			get_option('rvt_chbox_contar_palabras', '1')||
			get_option('rvt_chbox_contar_letras', '1' )||
			get_option('rvt_chbox_tiempo_lectura', '1' )
			))
		{
			return $this->inserta_html($contenido);
		}
		return $contenido;
	}

	function inserta_html($contenido)
	{
		$html = '<h3>'. esc_html( get_option( 'rvt_campo_titulo', 'Revisión' ) ).'</h3><p>';

		if(get_option( 'rvt_chbox_contar_palabras', '1' ) || (get_option( 'rvt_chbox_contar_palabras', '1')))
		{
			$n_palabras = str_word_count(strip_tags($contenido));
		}

		if(get_option( 'rvt_chbox_contar_palabras', '1' ))
		{
			$html .= esc_html__( 'Este texto tiene', 'rvt-dominio' ).' '. $n_palabras .' '. esc_html__('palabras', 'rvt-dominio').'<br>';
		}

		if(get_option( 'rvt_chbox_contar_letras', '1' ))
		{
			$html .= 'Este texto tiene '. strlen(strip_tags($contenido)) .' letritas.<br>';
		}

		if(get_option( 'rvt_chbox_tiempo_lectura', '1' ))
		{
			$html .= 'Este texto tiene '. round($n_palabras/225) .' minutos de lectura.<br>';
		}

		$html .= '</p>';

		if (get_option('rvt_campo_ubicacion', '0') == '0')
		{
			return $html.$contenido;
		}
		return $contenido.$html;
	}
	function rvt_ajustes()
	{
		//add_settings_section( $id, $title, $callback, $page )
		add_settings_section( 'rvt_seccion_a', null, null, 'revisar-texto' );

		//add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() )
		//register_setting( $option_group, $option_name, $args = array() )
		add_settings_field( 'rvt_campo_ubicacion', 'Ubicación', array( $this, 'campo_ubicacion_html'), 'revisar-texto', 'rvt_seccion_a' );
		register_setting( 'rvt_grupo_ubicacion', 'rvt_campo_ubicacion', array(
			'sanitize_callback' => array($this, 'dato_sanito'),
			'default' => '0'
		) );

		add_settings_field( 'rvt_campo_titulo', 'Texto del título', array( $this, 'campo_titulo_html'), 'revisar-texto', 'rvt_seccion_a' );
		register_setting( 'rvt_grupo_ubicacion', 'rvt_campo_titulo', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Revisión del texto'
		) );

		add_settings_field( 'rvt_chbox_contar_palabras', 'Contar palabras', array( $this, 'chbox_html'), 'revisar-texto', 'rvt_seccion_a', array( 'nombre' => 'rvt_chbox_contar_palabras') );
		register_setting( 'rvt_grupo_ubicacion', 'rvt_chbox_contar_palabras', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '1'
		) );

		add_settings_field( 'rvt_chbox_contar_letras', 'Contar letras', array( $this, 'chbox_html'), 'revisar-texto', 'rvt_seccion_a', array( 'nombre' => 'rvt_chbox_contar_letras') );
		register_setting( 'rvt_grupo_ubicacion', 'rvt_chbox_contar_letras', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '1'
		) );

		add_settings_field( 'rvt_chbox_tiempo_lectura', 'Tiempo de lectura', array( $this, 'chbox_html'), 'revisar-texto', 'rvt_seccion_a', array( 'nombre' => 'rvt_chbox_tiempo_lectura') );
		register_setting( 'rvt_grupo_ubicacion', 'rvt_chbox_tiempo_lectura', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '1'
		) );
	}

	function dato_sanito($dato)
	{
		if (!in_array($dato, array('0','1')))
		{
			//add_settings_error( $setting, $code, $message, $type = 'error' )
			add_settings_error( 'rvt_campo_ubicacion', 'rvt_campo_ubicacion_e', 'La ubicación debe ser al princio o al final' );
			return get_option( 'rvt_campo_ubicacion' );
		}
		return $dato;
	}

	function chbox_html($args)
	{
		?>
			<input type="checkbox" name="<?php echo $args['nombre'] ?>" value="1" <?php checked(get_option($args['nombre']), '1') ?>>
		<?php
	}

	function campo_titulo_html()
	{
		//get_option( $option, $default = false )
		?>
			<input type="text" name="rvt_campo_titulo" value="<?php echo esc_attr( get_option( 'rvt_campo_titulo' ) ); ?>">
		<?php
	}

	function campo_ubicacion_html()
	{
		//ob_start();
		?>
		<div class="wrap">
			<select name="rvt_campo_ubicacion">
				<option value="0" <?php selected(get_option('rvt_campo_ubicacion'), '0') ?>>Al principio de la entrada</option>
				<option value="1" <?php selected(get_option('rvt_campo_ubicacion'), '1') ?>>Al final de la entrada</option>
			</select>
		</div>
		<?php
		//echo ob_get_clean();
	}
	function rvt_menu()
	{
		//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function = '' )
		add_options_page( 'Ajustes Revisión de Texto', esc_html__( 'Revisar texto', 'rvt-dominio' ), 'manage_options', 'revisar-texto', array($this, 'rvt_pag_ajustes_html') );
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

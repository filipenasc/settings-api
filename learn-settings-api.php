<?php

//Menus

function demo_add_options_page(){
	add_menu_page(
		'Theme Options',				// titulo da pagina
		'Theme Options',				// titulo do menu
		'manage_options',				// capability
		'demo-theme-options',			// slug
		'demo_theme_options_display'	// função que mostra o conteúdo da página

	);
}
add_action('admin_menu', 'demo_add_options_page');

//Sections, settings and fields

function demo_initialize_theme_options(){
	add_settings_section(
		'footer_section',
		'Footer Options',
		'demo_footer_options_display',
		'demo-theme-options'
	);

	add_settings_field(
		'footer_message',				// identificador do campo
		'Footer Message',				// label do campo
		'demo_footer_message_display',	// callback para renderizar o campo
		'demo-theme-options',			// página onde o campo será renderizado
		'footer_section'				// seção onde estamos adicionando o campo
	);

	register_setting(
		'footer_section',
		'footer_options'
	);
}
add_action('admin_init', 'demo_initialize_theme_options');


//Callbacks

function demo_footer_message_display(){ 
	$options = get_option('footer_options');
	$message = $options['message'];
	?>
	<input type="text" name="footer_options[message]" id="footer_options_message" value="<?= $message ?>">
<?php }

function demo_theme_options_display(){ ?>
	<div class="wrap">
		<h2>Demo Theme Options</h2>
		<form method="post" action="options.php">
			<?php
				// render the settings for the settings section identified as 'Footer Section'
				settings_fields('footer_section');

				// render all of the settings  for 'demo-theme-options' section
				do_settings_sections('demo-theme-options');

				submit_button();
			?>
		</form>
	</div>
<?php }

function demo_footer_options_display(){
	echo "Descrição da seção";
}
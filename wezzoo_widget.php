<?php
/*
Plugin Name: wezzoo
Description: Affiche la météo en temps réel
Version: 0.1
Author: wezzoo
Author URI: http://www.wezzoo.com

*/

function wezzoo_widget($args) {

	extract($args);
	$options = get_option("wezzoo_widget");
	
	if (!is_array($options))
	{
		$options = array (
		'lat' => '48.8566',
		'lng' => '2.3522',
		'zoom' => '6'
		);
	};

?>	
<section style="position: absolute; height:250px; width:250px;">
	<iframe src="http://www.wezzoo.com/plugin/?c=<?php print_r ($options['lat']); ?>,<?php print_r ($options['lng']); ?>&z=<?php print_r ($options['zoom']); ?>" style="height: 100%; width: 100%; border: none"></iframe>


<?php
	
}

function wezzoo_widget_control() {
	$options = get_option("wezzoo_widget");
	if (!is_array($options))
	{
		$options= array (
			'lat' => '48.8566',
			'lng' => '2.3522',
			'zoom' => '6'
		);
	}
	
	
	if ($_POST['wezzoo_widget_submit'])
	{
		$options['lat'] = htmlspecialchars($_POST['wezzoo_widget_latitude']);
		$options['lng'] = htmlspecialchars($_POST['wezzoo_widget_longitude']);
		$options['zoom'] = htmlspecialchars($_POST['wezzoo_widget_zoom']);
		update_option("wezzoo_widget", $options);
	}

		
	?>
		
	<p>
		<label for="wezzoo_widget_latitude" style="font-weight: bold;">Latitude :</label>
		<input type="text" id="wezzoo_widget_latitude" name="wezzoo_widget_latitude" value="<?php echo $options['lat']; ?>" style="width:75px;" /><br/>
		<label for="wezzoo_widget_longitude" style="font-weight: bold;">Longitude :</label>
		<input type="text" id="wezzoo_widget_longitude" name="wezzoo_widget_longitude" value="<?php echo $options['lng']; ?>" style="width:75px;" /><br/>
		<label for="wezzoo_widget_zoom" style="font-weight: bold;">Zoom :</label>
		<input type="text" id="wezzoo_widget_zoom" name="wezzoo_widget_zoom" value="<?php echo $options['zoom']; ?>" style="width:25px;" />
		<input type="hidden" id="wezzoo_widget_submit" name="wezzoo_widget_submit" value="1" />	
	</p> 
	
	
<?php	
}





function init_wezzoo_widget() {
	register_sidebar_widget("wezzoo", "wezzoo_widget");
	register_widget_control("wezzoo", "wezzoo_widget_control", 300, 200);	
}

add_action("plugins_loaded", "init_wezzoo_widget");

?>
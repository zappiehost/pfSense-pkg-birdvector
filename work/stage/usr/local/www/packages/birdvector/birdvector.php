<?php
require_once("config.inc");
require_once("guiconfig.inc");

require_once("/usr/local/pkg/birdvector.inc");

$pgtitle = array(gettext("Services"), gettext("Bird Vector"), gettext("Status"));

include("head.inc");

$tab_array = array();
$tab_array[] = array(gettext("Status"), true, "/packages/birdvector/birdvector.php");
$tab_array[] = array(gettext("Configuration"), false, "/packages/birdvector/birdvector_config.php");
$tab_array[] = array(gettext("Interactive Shell"), false, "/packages/birdvector/birdvector_shell.php");
display_top_tabs($tab_array);

if (!is_array($config['installedpackages']['birdvector'])) {
	$config['installedpackages']['birdvector'] = array();
}

if($_POST['save']) {
	if (isset($_POST['enable']) && !empty($_POST['enable'])) {
		$config['installedpackages']['birdvector']['config'][0]['enable'] = 'yes';
        	bird_start();
	} else {
		$config['installedpackages']['birdvector']['config'][0]['enable'] = null;
		bird_kill();
	}

	write_config(gettext("Update enable BirdVector."));
	header("Location: birdvector.php");
}

if ($config['installedpackages']['birdvector']['config'][0]['enable'] != 'yes' || !is_service_running("bird")) {
    print_info_box(gettext("Bird Daemon doesnt seem to be running."), "warning", false);
}

$enable['mode'] = $config['installedpackages']['birdvector']['config'][0]['enable'];


$form = new Form();
$section = new Form_Section('Enable Bird');
$section->addInput(new Form_Checkbox(
	'enable',
	'Enable',
	'Enable Bird BGP Daemon.',
	$enable['mode']
));
$form->add($section);
print($form);


?>
<div class="panel panel-default">
	<div class="panel-heading"><h2 class="panel-title">Status</h2></div>
	<div class="panel panel-body">
		<pre>
<?php echo get_bird_status(); ?>
		</pre>
	</div>
</div>

<?php include("foot.inc"); ?>

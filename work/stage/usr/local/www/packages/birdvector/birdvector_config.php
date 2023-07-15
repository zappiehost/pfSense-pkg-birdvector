<?php
require_once("config.inc");
require_once("guiconfig.inc");

require_once("/usr/local/pkg/birdvector.inc");

$pgtitle = array(gettext("Services"), gettext("Bird Vector"), gettext("Configuration"));

include("head.inc");

$tab_array = array();
$tab_array[] = array(gettext("Status"), false, "/packages/birdvector/birdvector.php");
$tab_array[] = array(gettext("Configuration"), true, "/packages/birdvector/birdvector_config.php");
$tab_array[] = array(gettext("Interactive Shell"), false, "/packages/birdvector/birdvector_shell.php");
display_top_tabs($tab_array);

if($_POST['save']) {
	if (isset($_POST['pathvector_config']) && !empty($_POST['pathvector_config'])) {
		$output = set_pathvector_confg($_POST['pathvector_config']);
		$output = str_replace('\n', PHP_EOL . "	", $output);
		// See if output has "line X:"
		if (preg_match('/line (\d+):/', $output, $match)) {
			$output = str_replace('line ' . $match[1] . ':', 'line ' . ($match[1] - 3) . ':', $output);
		}

		if ('level=fatal' !== '' && mb_strpos($output, 'level=fatal') !== false) {
			print_info_box('Pathvector YAML configuration generated errors:<br /><br /><pre>' . $output . '</pre>', 'danger', false);
		} else {
			print_info_box('Pathvector configuration saved and generated:<br /><br /><pre>' . $output . '</pre>', 'success', false);
		}
	}
} else {
	print_info_box('It is recommended to run Pathvector every 12 hours to update IRR prefix lists and PeeringDB prefix limits.<br />Adding the followingto your crontab will update the filters at 12 AM and PM every day.<br /<br /><pre>0 */12 * * * /usr/local/bin/pathvector -c /usr/local/etc/pathvector.yaml generate</pre>', 'info', false);
}

$pathvectorConfigText = get_pathvector_confg();
$textrowcount = max(substr_count($pathvectorConfigText,"\n"), 2) + 2;

$form = new Form();
$section = new Form_Section('Pathvector Configuration');
$section->addInput(new Form_Textarea(
	'pathvector_config',
	'Pathvector YAML Config',
	$pathvectorConfigText
))->setNoWrap()
	->setRows($textrowcount)
	->setHelp('For Pathvector yaml configuration documentations and examples visit: <a href="https://pathvector.io" target="_blank">https://pathvector.io</a>');

$form->add($section);
print($form);

include("foot.inc"); 

?>

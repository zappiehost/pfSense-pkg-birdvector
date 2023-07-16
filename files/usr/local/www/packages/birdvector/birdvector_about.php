<?php
require_once("config.inc");
require_once("guiconfig.inc");

require_once("/usr/local/pkg/birdvector.inc");

$pgtitle = array(gettext("Services"), gettext("Bird Vector"), gettext("About"));

include("head.inc");

$tab_array = array();
$tab_array[] = array(gettext("Status"), false, "/packages/birdvector/birdvector.php");
$tab_array[] = array(gettext("Configuration"), false, "/packages/birdvector/birdvector_config.php");
$tab_array[] = array(gettext("Interactive Shell"), false, "/packages/birdvector/birdvector_shell.php");
$tab_array[] = array(gettext("About"), true, "/packages/birdvector/birdvector_about.php");
display_top_tabs($tab_array);

?>

<form class="form-horizontal" method="post" action="#">
<div class="panel panel-default">
	<div class="panel-heading"><h2 class="panel-title">Bird Vector</h2></div>
	<div class="panel-body">

		<div class="form-group">
			<div class="col-sm-12">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">

			</label>
			<div class="col-sm-10">
				<span class="help-block">
					<p>
						Bird Vector is a tool created to assist the routing abilities of pfSense, since pfSense officially only supports FRR (Free Range Routing) rather thanthe BIRD Routing Platform, with great strides and additions from Nate Sales from Pathvector and BGPQ4 by Job Snijders, Bringing the CLI Based operations of BIRD, Pathvector and BGPQ4 into the GUI of pfSense.
					</p>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">
				<span class="element-required">BirdVector</span>
			</label>
			<div class="col-sm-10">
				<strong>Version: %%PKGVERSION%%</strong>
				<span class="help-block">
					<a href="https://www.zappiehost.com" target="_blank">ZappieHost.com</a> |-| <a href="https://github.com/zappiehost/pfSense-pkg-birdvector" target="_blank">BirdVector Github</a>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">
				<span class="element-required">Pathvector</span>
			</label>
			<div class="col-sm-10">
				<strong>Version: <?php echo pathvector_version(); ?></strong>
				<span class="help-block">
					<a href="https://www.pathvector.io" target="_blank">Pathvector.io</a> |-| <a href="https://github.com/NateSales/Pathvector" target="_blank">Pathvector Github</a>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">
				<span class="element-required">BIRD Routing Daemon</span>
			</label>
			<div class="col-sm-10">
				<strong>Version: <?php echo bird_version(); ?></strong>
				<span class="help-block">
					<a href="https://bird.network.cz" target="_blank">Network.CZ</a> |-| <a href="https://gitlab.nic.cz/labs/bird/tree/master" target="_blank">BIRD Gitlab</a>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">
				<span class="element-required">BGPQ4</span>
			</label>
			<div class="col-sm-10">
				<strong>Version: <?php echo bgpq4_version(); ?></strong>
				<span class="help-block">
				<a href="http://sobornost.net/~job/" target="_blank">Job Snijders</a> |-| <a href="https://github.com/bgp/bgpq4" target="_blank">BGPQ4 Github</a>
				</span>
			</div>
		</div>

    </div>
</div>
</form>
<?php
include("foot.inc");

?>

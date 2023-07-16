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
<div class="panel panel-default">
    <div class="panel-heading"><h2 class="panel-title">Bird Vector</h2></div>
    <div class="panel-body">
		<p>Bird Vector is a tool created to assist the routing abilities of pfSense, since pfSense officially only supports FRR (Free Range Routing) rather thanthe BIRD Routing Platform, with great strides and additions from Nate Sales from Pathvector and BGPQ4 by Job Snijders, Bringing the CLI Based operations of BIRD, Pathvector and BGPQ4 into the GUI of pfSense.</p>
        <dl class="dl-horizontal">
        <dt>Pathvector Version: <dt><dd><pre><?php print( pathvector_version() ); ?></pre><br /><a href="https://www.pathvector.io">Pathvector.io</a> |-| <a href="https://github.com/NateSales/Pathvector">Pathvector Github</a></dd>
          </dl>
      <dl>
        <dt>BIRD Routing Daemon Version: <dt><dd><pre><?php bird_version() ); ?></pre><br /><a href="https://bird.network.cz">Network.CZ</a> |-| <a href="https://gitlab.nic.cz/labs/bird/tree/master">BIRD Gitlab</a></dd>
        </dl>
      <dl>
          <dt>BGPQ4 Version: <dt><dd><pre><?php bgpq4_version() ); ?></pre><br /><a href="http://sobornost.net/~job/">Job Snijders</a> |-| <a href="https://github.com/bgp/bgpq4">BGPQ4 Github</a></dd>
        </dl>
      <dl>
          <dt>Birdvector Version: <dt><dd><pre>1.0</pre><br /><a href="https://www.zappiehost.com">ZappieHost.com</a> |-| <a href="https://github.com/zappiehost/pfSense-pkg-birdvector">BirdVector Github</a></dd>
        </dl>
    </div>
</div>

<?php
include("foot.inc"); 

?>

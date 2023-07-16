<?php

require_once("util.inc");
require_once("globals.inc");
require_once("config.inc");
require_once("interfaces.inc");
require_once("services.inc");
require_once("service-utils.inc");


function birdvector_install() {
	global $config, $g;
	$pathvector_config = '/usr/local/etc/pathvector.yaml';

	if (!is_array($config['installedpackages']['birdvector'])) {
		$config['installedpackages']['birdvector'] = array();
	}

	if (!is_array($config['installedpackages']['birdvector']['config'])) {
		$config['installedpackages']['birdvector']['config'] = array();
	}

	$rundir = "{$g['varrun_path']}/bird";
	$pidfile = "{$rundir}/bird.pid";

	$bird_config_dir = '/usr/local/etc/bird';
	$_rcfile['file'] = 'bird.sh';
	$_rcfile['stop'] = '/usr/bin/killall -q bird';
	$_rcfile['start'] = <<<EOD

	if [ ! -d "{$rundir}" ]; then
		install -d -g birdvty {$rundir};
	fi

        if [ ! -d "{$bird_config_dir}" ]; then
                install -d -g birdvty {$bird_config_dir};
		mv /usr/local/etc/bird.conf {$bird_config_dir}/bird.conf
        fi

	if [ ! -f "{$bird_config_dir}/bird.conf" ]; then
		cp -f /usr/local/etc/bird.conf {$bird_config_dir}/bird.conf
	fi

	/usr/local/sbin/bird -c {$bird_config_dir}/bird.conf -g birdvty -P {$pidfile}

EOD;

	write_rcfile($_rcfile);

	$pathvector_config_content = <<<EOL
bird-directory: {$bird_config_dir}
bird-binary: /usr/local/sbin/bird
bird-socket: /var/run/bird.ctl
asn: 65510
router-id: 192.0.2.1
prefixes:
  - 192.0.2.0/24
  - 2001:db8::/48
EOL;

	if (file_put_contents($pathvector_config, $pathvector_config_content) === FALSE) {
		log_error("ERROR: Could not write {$pathvector_config}");
		exit;
	}

	write_config("[birdvector] Package installed.");
}

function birdvector_deinstall() {
	global $config;

	bird_kill();

	unset($config['installedpackages']['birdvector']['config'][0]);
	write_config("[birdvector] Package uninstalled.");

	unlink_if_exists('/usr/local/etc/pathvector.yaml');
}

function birdvector_sync() {
	write_config("[birdvector] Sync.");
}

function bird_start() {
	global $config;

	if ($config['installedpackages']['birdvector']['config'][0]['enable'] == 'yes') {
		if (!is_service_running("bird")) {
			start_service("bird");
		}
	}
}

function bird_kill() {
	if (is_service_running("bird")) {
		stop_service("bird");
	}
}


function get_pathvector_confg() {
	$pathvector_config = '/usr/local/etc/pathvector.yaml';

	$contents = file_get_contents($pathvector_config);

	return explode("\n", $contents, 4)[3];
}

function set_pathvector_confg($pathvector_config_content) {
	$pathvector_config = '/usr/local/etc/pathvector.yaml';

	$updated_pathvector_config_content = "bird-directory: /usr/local/etc/bird".PHP_EOL;
	$updated_pathvector_config_content .= "bird-binary: /usr/local/sbin/bird".PHP_EOL;
	$updated_pathvector_config_content .= "bird-socket: /var/run/bird.ctl".PHP_EOL;
	$updated_pathvector_config_content .= $pathvector_config_content;

	if (file_put_contents($pathvector_config, $updated_pathvector_config_content) === FALSE) {
			log_error("ERROR: Could not write {$pathvector_config}");
			exit;
	}

	$output = pathvector_generate();

	write_config("[birdvector] Updated config");

	return $output;
}

function pathvector_generate() {
	$pathvector_config = '/usr/local/etc/pathvector.yaml';
	$output = shell_exec("/usr/local/bin/pathvector -c {$pathvector_config} generate 2>&1");
	return $output;
}

function get_bird_status() {
	$output = shell_exec("/usr/local/sbin/birdc -r 'show protocols' 2>&1");
	if (!$output) {
		return "Unable to connect to server control socket (/var/run/bird.ctl)".PHP_EOL."Is Bird running?";
	}
	return $output;
}

function pathvector_version() {
	$output = shell_exec("/usr/local/bin/pathvector version | grep -w 'Built\|Pathvector' 2>&1");
	if (!$output) {
		return "Cannot Connect to Pathvector!";
	}
	return $output;
}

function bgpq4_version() {
	$output = shell_exec("/usr/local/bin/bgpq4 -v | grep -w 'version' 2>&1");
	if (!$output) {
		return "Cannot Connect to BGPQ4!";
	}
	return $output;
}

function bird_version() {
	$output = shell_exec("/usr/local/sbin/birdc version | grep -w 'BIRD' 2>&1");
	if (!$output) {
		return "Cannot Connect to BIRD!";
	}
	return $output;
}

?>

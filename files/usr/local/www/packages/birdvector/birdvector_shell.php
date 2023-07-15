<?php
require_once("config.inc");
require_once("guiconfig.inc");

require_once("/usr/local/pkg/birdvector.inc");

$pgtitle = array(gettext("Services"), gettext("Bird Vector"), gettext("Interactive Shell"));

include("head.inc");

$tab_array = array();
$tab_array[] = array(gettext("Status"), false, "/packages/birdvector/birdvector.php");
$tab_array[] = array(gettext("Configuration"), false, "/packages/birdvector/birdvector_config.php");
$tab_array[] = array(gettext("Interactive Shell"), true, "/packages/birdvector/birdvector_shell.php");
display_top_tabs($tab_array);


?>



<div class="panel panel-default">
	<div class="panel-heading"><h2 class="panel-title">Interactive Shell</h2></div>
	<div class="panel panel-body">
    		<pre id="terminal"></pre>
    		<div id="bottombar">
        		<span id="ps1"></span>
			<div class="right">
				<input id="cursor" autofocus>
			</div>
    		</div>
	</div>
</div>
<style>
    #terminal {
        bottom: 2em;
        padding: 1em;
        margin: 0 auto;
        overflow-y: auto;
        overflow-x: hidden;
        white-space: pre-wrap;
        word-break: break-all;
    }

    #bottombar {
        width: 100%;
    }

    #ps1 {
        padding-left: 1em;
        line-height: 2em;
        height: 2em;
        float: left;
        max-width: 40%;
        padding-right: .5em;
    }

    .right { overflow: hidden; }

    #cursor {
        height: calc(2em - 1px);
        padding: 0;
        border: 0;
        float: left;
        width: 100%;
        background: #e2e2e2;
        color: #000;
        font-family: monospace;
        outline: none;
    }
</style>

    <script>
    class Terminal {
        constructor() {
            this.whoami = 'roooooot';
            this.hostname = 'FOOOBAR.com';
            this.pwd = '/DDS/sda/E';
            this.PATH_SEP = '/';
            this.commandHistory = [];
            this.commandHistoryIndex = this.commandHistory.length;

            this.termWindow = document.getElementById('terminal');
            this.cursor = document.getElementById('cursor');
            this.ps1element = document.getElementById('ps1');

            this.ps1element.innerHTML = this.ps1();

            this.attachCursor();

            // this.execCommand('ifconfig');
        }

        attachCursor() {
            this.cursor.addEventListener('keyup', ({keyCode}) => {
                switch (keyCode) {
                    case 13:
                        this.execCommand(this.cursor.value);
                        this.cursor.value = '';
                        this.ps1element.innerHTML = this.ps1();
                        this.commandHistoryIndex = this.commandHistory.length;
                        break;

                    case 38:
                        if (this.commandHistoryIndex !== 0) {
                            this.cursor.value = this.commandHistory[--this.commandHistoryIndex] || '';
                        }
                        break;

                    case 40:
                        if (this.commandHistoryIndex < this.commandHistory.length) {
                            this.cursor.value = this.commandHistory[++this.commandHistoryIndex] || '';
                        }
                        break;
                }
            });
        }

        ps1() {
            return `<span style="font-weight: bold;">bird> </span>`;
        }

        execCommand(cmd) {
            this.commandHistory.push(cmd);

            fetch('/packages/birdvector/birdvector_shell_ajax.php?' + new URLSearchParams({
    			cmd: cmd
			})).then(
                res => res.json(),
                err => console.error(err)
            ).then(({response, pwd}) => {
                this.termWindow.innerHTML += `${this.ps1()}${cmd}<br>${response}`;

                this.termWindow.scrollTop = this.termWindow.scrollHeight;

                this.ps1element.innerHTML = this.ps1();
            })
        }
    }

    window.addEventListener('load', () => {
        const terminal = new Terminal();
    });
    </script>

<?php include("foot.inc"); ?>

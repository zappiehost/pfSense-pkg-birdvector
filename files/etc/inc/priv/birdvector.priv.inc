<?php
/*
 * birdvector.priv.inc
 *
 * part of pfSense (https://www.pfsense.org)
 * Copyright (c) 2015-2023 Rubicon Communications, LLC (Netgate)
 * All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

global $priv_list;

$priv_list['page-services-birdvectorpackage'] = array();
$priv_list['page-services-birdvectorpackage']['name'] = "WebCfg - Services: BirdVector package";
$priv_list['page-services-birdvectorpackage']['descr'] = "Allow access to BirdVector package GUI";
$priv_list['page-services-birdvectorpackage']['match'] = array();
$priv_list['page-services-birdvectorpackage']['match'][] = "packages/birdvector/birdvector_status.php*";
$priv_list['page-services-birdvectorpackage']['match'][] = "packages/birdvector/birdvector_config.php*";
$priv_list['page-services-birdvectorpackage']['match'][] = "packages/birdvector/birdvector_about.php*";
$priv_list['page-services-birdvectorpackage']['match'][] = "packages/birdvector/birdvector_shell.php*";
$priv_list['page-services-birdvectorpackage']['match'][] = "packages/birdvector/birdvector_shell_ajax.php*";
$priv_list['page-services-birdvectorpackage']['match'][] = "packages/birdvector/index.php*";

?>

#!/usr/bin/php
<?php

/*

Copyright:: 2013, Sebastian Grewe

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

 */

// Change to working directory
chdir(dirname(__FILE__));

// Include all settings and classes
require_once('shared.inc.php');

// If we don't keep archives, delete some now to release disk space
if (!$share->purgeArchive()) {
  $log->logError("Failed to delete archived shares, not critical but should be checked!");
  $monitoring->setStatus($cron_name . "_active", "yesno", 0); 
  $monitoring->setStatus($cron_name . "_message", "message", "Failed to delete archived shares");
  $monitoring->setStatus($cron_name . "_status", "okerror", 1); 
  exit(1);
}

// Cron cleanup and monitoring
require_once('cron_end.inc.php');
?>

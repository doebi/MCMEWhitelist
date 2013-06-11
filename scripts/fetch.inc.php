<?php
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=whitelist.txt');
header('Pragma: no-cache');
readfile("/var/www/html/whitelist/whitelist.txt");
?>
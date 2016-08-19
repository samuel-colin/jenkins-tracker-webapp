<?php
require_once("sources/functions_ui.php");

$GLOB_url_jenkins = "http://localhost:8080";

//Header
echo display_header();

//Content
echo display_content("Liste des jobs DEV", "ressources/jobs_dev.properties", $GLOB_url_jenkins);

//Footer
echo display_footer();

?>

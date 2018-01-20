<?php include_once('./quickgit.php'); ?>

<?php 

$git = new QuickGit();

echo $git->output()['full'];

?>
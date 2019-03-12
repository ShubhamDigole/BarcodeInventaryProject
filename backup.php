<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'project_inv';
   $filename = 'backup/database_backup_' . date("Y-m-d-H-i-s") . '.gz';
   //$command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass ". "test_db | gzip > $backup_file";
   
   $command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass ". "project_inv | gzip > $filename";




   system($command);
   if ($command == '') {
    /* no output is good */
    echo 'not done';
} else {
   /* we have something to log the output here */
    echo 'done';
}
?>

<script>
alert("success");
var DOMAIN = "http://localhost:8000/public_html";
window.location.href = "dashboard.php";
</script>
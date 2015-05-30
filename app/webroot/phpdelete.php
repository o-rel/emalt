<?php
// this script will delete all your php.ini files
$path = "/homepages/39/d554731968/htdocs/app/webroot";
function search($dir) {
  $dh = opendir($dir);
  while (($filename = readdir($dh)) !== false) {
    if ( $filename !== '.' AND $filename !== '..' AND $filename !== 'cgi-bin' AND is_dir("$dir/$filename") ) {
      $path = $dir."/".$filename; 
      $target = $path . "/php.ini";
      if (file_exists($target)) {
        echo "Deleting - $target <br>";
        if (!unlink($target)) echo "<b>Delete failed for $target </b><br>";
    }
      search($path);
    }
  }
  closedir($dh);
}
$target = $path . "/php.ini";
if (file_exists($target)) {
  echo "Deleting - $target <br>";
  if (!unlink($target)) echo "<b>Delete failed for $target </b><br>";
}
search($path);
echo "<br>Done.";
?>  
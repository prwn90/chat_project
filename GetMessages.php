<?php
 $db = new PDO('mysql:host=127.0.0.1;dbname=chat','root','haslo');

  $query = $db->prepare("SELECT * FROM messages");
  $query ->execute();

  while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
    $name = $fetch['name'];
    $message = $fetch['message'];
    $id = $fetch['id'];

    echo "<li id='$id' class='msg'><b>".ucwords($name).":</b> ".$message."</li>";
  }
?>

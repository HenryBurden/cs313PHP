<?php
  require 'databaseConnect.php'
  $db=get

  $book=$_POST['book'];
  $chapter=$_POST['chapter'];
  $verse=$_POST['verse'];
  $content=$_POST['content'];

  $db->query('INSERT book, chapter, verse, content INTO scripture') VALUES ($book, $chapter, $verse, $content);

  
  
  
?>

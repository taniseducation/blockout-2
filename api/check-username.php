<?php
  include_once '../config/Database.php';
  include_once '../models/Scoreboard.php';

  // Instantiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Scoreboard Object
  $scoreboard = new Scoreboard($db);

  // Set Properties
  $scoreboard->playerName = $_POST['playerName'];

  // Get All Rows
  $result = $scoreboard->readSingleByName();

  // Username availability
  echo $result->rowCount();
?>
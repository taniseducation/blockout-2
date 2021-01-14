<?php
  include_once '../config/Database.php';
  include_once '../models/Scoreboard.php';

  // Instantiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Scoreboard Object
  $scoreboard = new Scoreboard($db);

  // Set Properties
  $scoreboard->id = $_POST['id'];
  $scoreboard->playerName = $_POST['playerName'];

  // Update Score
  $result = $scoreboard->update();

  // echo update result
  echo $result;
?>
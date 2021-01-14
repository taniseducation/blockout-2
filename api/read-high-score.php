<?php
  include_once '../config/Database.php';
  include_once '../models/Scoreboard.php';

  // Instantiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Scoreboard Object
  $scoreboard = new Scoreboard($db);

  // Set Properties
  $scoreboard->gameSetPattern = $_POST['gameSet'];
  $scoreboard->gamePitPattern = $_POST['gamePit'];
  $scoreboard->gameLevelPattern = (int) $_POST['gameLevel'];

  // Get All Scores
  $result = $scoreboard->readHighScore();

  // Fetching Result
  $result = $result->fetch(PDO::FETCH_ASSOC);

  if(is_null($result['high_score'])) {
    echo 0;
  } else {
    echo $result['high_score'];
  }
?>
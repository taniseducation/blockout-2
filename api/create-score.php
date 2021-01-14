<?php
  include_once '../config/Database.php';
  include_once '../models/Scoreboard.php';
  include_once '../php/datetime.php';

  // Instantiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Scoreboard Object
  $scoreboard = new Scoreboard($db);

  // Set Properties
  $scoreboard->playerName = $_POST['playerName'];
  $scoreboard->gameSet = $_POST['gameSet'];
  $scoreboard->gamePit = $_POST['gamePit'];
  $scoreboard->gameLevel = $_POST['gameLevel'];
  $scoreboard->playerScore = $_POST['playerScore'];
  $scoreboard->ipAddress = $scoreboard->getIPAddress();
  $scoreboard->cityName = $scoreboard->getCityName();
  $scoreboard->countryName = $scoreboard->getCountryName();
  $scoreboard->PC_Phone = $_POST['PC_Phone'];

  // Create a New Score
  $result = $scoreboard->create();

  // Successful Score Creation
  if($result['status'] == 'success') {
    $scoreboard->id = intval($db->lastInsertId());
    // Get Recently Inserted Row
    $result = $scoreboard->readSingleByID()->fetch(PDO::FETCH_ASSOC);

    $dateTime = new DatetimeConversion($result['playedAt']);
    $date = $dateTime->getDate();
    $time = $dateTime->getTime();

    echo json_encode(
      array(
        "status" => "success",
        "data" => array(
          "id" => $result['id'],
          "playedAt" => "$date at $time",
          "countryName" => $result['countryName'],
          "ipAddress" => $result['ipAddress']
        )
      )
    );
  } else {
    echo json_encode(
      array(
        "status" => "failure"
      )
    );
  }
?>

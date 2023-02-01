<?php

class Team {
	public $id;
	public $name;
	public $leader;
	public $members;
	public $points;

	public function __construct($id, $name, $leader, $points) {
		$this->id      = $id;
		$this->name    = $name;
		$this->leader  = $leader;
		$this->members = fetch_members($id);
		$this->points  = $points;
	}

	public static function fromDBObj($dbObj) {
		return new Team(
			$dbObj->id,
			$dbObj->name,
			$dbObj->leader,
			$dbObj->points
		);
	}
}
class Member {
	public $id;
	public $name;
	public $lastname;
	public $team;
	public $route;
	public $points;

	public function __construct($id, $name, $lastname, $team, $route, $points) {
		$this->id      = $id;
		$this->name    = $name;
		$this->lastname    = $lastname;
		$this->team    = $team;
		//$this->route   = fetch_route($route);
		$this->points  = $points;
	}

	public static function fromDBObj($dbObj) {
		return new Member(
			$dbObj->id,
			$dbObj->name,
			$dbObj->lastname,
			$dbObj->team,
			$dbObj->route,
			$dbObj->points
		);
	}
}

function open_read_database() {
	$auth_file = file_get_contents("/var/www/ritsi_crossing/db/auth.json");
	$auth = json_decode($auth_file);
	$idDB = @new mysqli("localhost", $auth->{"read"}->{"user"}, $auth->{"read"}->{"pass"}, "ritsi_crossing");
	
	if ( mysqli_connect_errno() ) {
		die("No puedo conectar con el gestor MySQL" . mysqli_connect_error());
	}
	$idDB->set_charset("utf8mb4");
	
	return $idDB;
}

function open_write_database() {
	$auth_file = file_get_contents("/var/www/ritsi_crossing/db/auth.json");
	$auth = json_decode($auth_file);
	$idDB = @new mysqli("localhost", $auth->{"write"}->{"user"}, $auth->{"write"}->{"pass"}, "ritsi_crossing");
	
	if ( mysqli_connect_errno() ) {
		die("No puedo conectar con el gestor MySQL" . mysqli_connect_error());
	}
	$idDB->set_charset("utf8mb4");
	
	return $idDB;
}

function close_database($idDB) {
	$idDB->close();
}

function cmp_id($a, $b) {
	return $a->id > $b->id;
}

function cmp_lastname($a, $b) {
	return $a->lastname > $b->lastname;
}

function fetch_teams() {
	$db    = open_read_database();
	$query = "SELECT * FROM teams;";

	$teams = array();
	if ($result = $db->query( $query)) {
		while ($obj = $result->fetch_object()) {
			array_push($teams, Team::fromDBObj($obj));
		}
		$result->close();
	}

	close_database($db);

	usort($teams, "cmp_id");

	return $teams;
}

function fetch_members($teamId) {
	$db    = open_read_database();
	$query = "SELECT * FROM members WHERE team = $teamId;";

	$members = array();
	if ($result = $db->query($query)) {
		while ($obj = $result->fetch_object()) {
			array_push($members, Member::fromDBObj($obj));
		}
		$result->close();
	}

	close_database($db);

	usort($members, "cmp_lastname");

	return $members;
}

function fetch_route($routeId) {
	$db    = open_read_database();
	$query = "SELECT name FROM route WHERE id = " + $routeId + ";";

	$route = "";
	if ($result = $db->query($query)) {
		$obj = $result->fetch_object();
		$route = $obj->name;
		$result->close();
	}

	close_database($db);
	return $route;
}

function updatePoints($teamId, $newPoints, $memberId, $username) {
	$db = open_write_database();
	$query = "INSERT INTO points_log (member, points, manager, updated) VALUES (?, ?, ?, NOW());";
	
	$stmt = $db->prepare($query);
	$pointsToSave = $teamPoints + $newPoints;
	$stmt->bind_param('iis', $memberId, $newPoints, $username);
	$stmt->execute();

	close_database($db);
}

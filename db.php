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
	$idDB = @new mysqli("localhost", "rc_web", "&UG*C7F(+c:s#qruG&", "ritsi_crossing");
	if ( mysqli_connect_errno() ) {
		die("No puedo conectar con el gestor MySQL" . mysqli_connect_error());
	}
	$idDB->set_charset("utf8");
	
	return $idDB;
}

function open_write_database() {
	$idDB = @new mysqli("localhost", "rc_management", "5(Fr,{R7E+E{X[z&-D", "ritsi_crossing");
	if ( mysqli_connect_errno() ) {
		die("No puedo conectar con el gestor MySQL" . mysqli_connect_error());
	}
	$idDB->set_charset("utf8");
	
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

function updatePoints($teamId, $newPoints) {
	$db = open_write_database();
	$query = " SELECT points FROM teams WHERE id = ?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('i', $teamId);
	$success = $stmt->execute();

	if($success) {
		$result = $stmt->get_result();
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$teamPoints = $row['points'];
		$stmt->close();

		$query = "UPDATE teams SET points = ? WHERE id = ?";
		$stmt = $db->prepare($query);
		$pointsToSave = $teamPoints + $newPoints;
		$stmt->bind_param('ii', $pointsToSave, $teamId);
		$stmt->execute();
	}

	close_database($db);
}

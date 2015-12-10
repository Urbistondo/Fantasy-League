<?php
function open_database_connection()
{
	$link = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('fantasy_league_db', $link);

	return $link;
}

function close_database_connection($link)
{
	mysql_close($link);
}

function get_all_posts()
{
	$link = open_database_connection();

	$result = mysql_query('SELECT id, name, lastname, club, position, birthDate, nationality FROM jugador', $link);
	$players = array();
	while ($row = mysql_fetch_assoc($result)) {
		$players[] = $row;
	}
	
	close_database_connection($link);
	
	return $players;
}

function get_post_by_id($id)
{
	$link = open_database_connection();

	$id = intval($id);
	$query = 'SELECT id, name, lastname, club, position, birthDate, nationality FROM jugador WHERE id = '.$id;
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);

	close_database_connection($link);

	return $row;
}
?>
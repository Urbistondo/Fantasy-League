<?php
function open_database_connection()
{
	$link = mysql_connect('localhost', 'root', 'fantasy');
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

	$result = mysql_query('SELECT id, name, lastname, birthDate, nationality, club, position FROM player', $link);
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
	$query = 'SELECT id, name, lastname, birthDate, nationality, club, position FROM player WHERE id = '.$id;
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);

	close_database_connection($link);

	return $row;
}
?>
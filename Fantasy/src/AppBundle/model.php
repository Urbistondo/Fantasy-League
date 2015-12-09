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
?>
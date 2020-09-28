<?php

include('../conexion.php');

header('Content-Type: text/plain;charset=UTF-8');
$id_cita=$_POST["idcita"];
$url_corta="http://localhost:8080/inventario_ferreteria/?slug=";
$url = "http://localhost:8080/inventario_ferreteria/agenda/confirmacion.php?id=".$id_cita;

if (in_array($url, array('', 'about:blank', 'undefined'))) {
	die('Enter a URL.');
}

// If the URL is already a short URL on this domain, don’t re-shorten it
/*if (strpos($url, $url_corta) === 0) {
	die($url);
}*/

function nextLetter(&$str) {
	$str = ('z' == $str ? 'a' : ++$str);
}

function getNextShortURL($s) {
	$a = str_split($s);
	$c = count($a);
	if (preg_match('/^z*$/', $s)) { // string consists entirely of `z`
		return str_repeat('a', $c + 1);
	}
	while ('z' == $a[--$c]) {
		nextLetter($a[$c]);
	}
	nextLetter($a[$c]);
	return implode($a);
}

$base->exec("set names utf8mb4");




$result = $base->query('SELECT slug FROM tbl_urls WHERE url = "' . $url . '" LIMIT 1');
if ($result && $result->rowCount() > 0) { // If there’s already a short URL for this URL
	die($url_corta . $result->fetchObject('slug'));
} else {
	$result = $base->query('SELECT slug, url FROM tbl_urls ORDER BY date DESC, slug DESC LIMIT 1');
	if ($result && $result->rowCount() > 0) {
		while($row =$result->fetch()){
		$slug = getNextShortURL($row['slug']);
		if ($base->query('INSERT INTO tbl_urls (slug, url, date, hits) VALUES ("' . $slug . '", "' . $url . '", NOW(), 0)')) {
			header('HTTP/1.1 201 Created');
			echo $url_corta.$slug;
			$base->query('OPTIMIZE TABLE `tbl_urls`');
			}
		}
 	}
}

?>
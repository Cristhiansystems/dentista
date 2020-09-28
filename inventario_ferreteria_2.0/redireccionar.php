<?php

include("conexion.php");

//$url = DEFAULT_URL . '/';

if (isset($_GET['slug'])) {

	$slug =$_GET['slug'];

	if ('@' == $slug) {
		$url = 'https://twitter.com/' . "dsd";
	} else if (' ' == $slug) { // +
		$url = 'https://plus.google.com/u/0/' . GOOGLE_PLUS_ID . '/posts';
	} else {

		$slug = preg_replace('/[^a-z0-9]/si', '', $slug);

		if (is_numeric($slug) && strlen($slug) > 8) {
			$url = 'https://twitter.com/' . "sdfsdf" . '/status/' . $slug;
		} else {

			//$db = new MySQLi(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
			$base->exec("set names utf8mb4");

			//$escapedSlug = $db->real_escape_string($slug);
			$redirectResult = $base->query('SELECT url FROM tbl_urls WHERE slug = "' . $slug . '"');
			
					if ($redirectResult &&$redirectResult->rowCount() > 0) {
						while($row =$redirectResult->fetch()){
								$base->query('UPDATE tbl_urls SET hits = hits + 1 WHERE slug = "' . $slug . '"');
								$url = $row['url'];
							}
					} else {
						$url = "www.google.com" . $_SERVER['REQUEST_URI'];
					}

					$base->close();
				

		}
	}
}

header('Location: ' . $url, null, 301);

$attributeValue = htmlspecialchars($url);
?>
<meta http-equiv=refresh content="0;URL=<?php echo $attributeValue; ?>"><a href="<?php echo $attributeValue; ?>">Continue</a><script>location.href=<?php echo json_encode($url, JSON_HEX_TAG | JSON_UNESCAPED_SLASHES); ?></script>

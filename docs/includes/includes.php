<?php
	
	include 'comment.php';
	
	function Connect() {
		$connection = mysql_connect("sql307.byethost31.com", "b31_15917997", "froggy8") or die ("<p class='error'>Sorry, we were unable to connect to the database server.</p>");
		$database = "b31_15917997_lp";
		mysql_select_db($database, $connection) or die ("<p class='error'>Sorry, we were unable to connect to the database.</p>");
	}
	
	function detect_location() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
			$ip = $_SERVER['HTTP_CLIENT_IP']; 
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
		}
		else { 
			$ip = $_SERVER['REMOTE_ADDR']; 
		}
		
		$url = 'https://db-ip.com/' . urlencode($ip);
		$content; $curl_info;
		
			$ch = curl_init();
			$curl_opt = array(
                                                         // CURLOPT_COOKIESESSION => 1,
                                                         // CURLOPT_FRESH_CONNECT => 1,
							  CURLOPT_HEADER => 0,
							  CURLOPT_RETURNTRANSFER  => 1,
							  CURLOPT_URL => $url,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_REFERER => 'http://' . $_SERVER['HTTP_HOST'],
							  );
			if (isset($_SERVER['HTTP_USER_AGENT'])) $curl_opt[CURLOPT_USERAGENT] = $_SERVER['HTTP_USER_AGENT'];
			curl_setopt_array($ch, $curl_opt);
			$content = curl_exec($ch);
			curl_close($ch);
		
		$araResp = array();
		if (preg_match('{<th>City</th><td>([^<]*)</td>}i', $content, $regs)) $araResp['city'] = trim($regs[1]);
		if (preg_match('{<th>State / Region</th><td>([^<]*)</td>}i', $content, $regs)) $araResp['state'] = trim($regs[1]);
		if (preg_match('{<th>Country</th><td>([^<]*)<img}i', $content, $regs)) $araResp['country'] = trim($regs[1]);
		
		$strResp = ($araResp['city'] != '') ? ($araResp['city'] . ', ' . $araResp['state'] . ', ' . $araResp['country'] ) : 'UNKNOWN';
		
		return $strResp;
	}
	
	function GetComments()
	{
		Connect();

		$sql = "SELECT * FROM comments ORDER BY date_posted DESC";
		$query = mysql_query($sql) or print ("Can't select entries from table blog_posts.<br />" . $sql . "<br />" . mysql_error());
								 
		$postArray = array();
		while ($row = mysql_fetch_array($query))
		{
			$myPost = new Comment($row['text'], $row['commenter'], $row['date_posted'], $row['location_info']);
			array_push($postArray, $myPost);
		}
		mysql_close();
		return $postArray;
	}
				
	function InsertComment($inText, $inCommenter)
	{
		Connect();
		
		$commenter = htmlspecialchars(strip_tags($inCommenter));
		$text = htmlspecialchars($inText);
		$locationInfo = detect_location();
		
		$text = nl2br($text);
		
		if (!get_magic_quotes_gpc()) {
			$commenter = addslashes($commenter);
			$text = addslashes($text);
		}
		
		$sql = "INSERT INTO comments (text,commenter,date_posted,location_info) VALUES ('$text','$commenter',NOW(),'$locationInfo')";
		
		$result = mysql_query($sql) or print("Can't insert into table blog_post.<br />" . $sql . "<br />" . mysql_error());
		mysql_close();
		return $result;
	}	
?>

				
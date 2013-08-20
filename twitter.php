// Twitter Auto-follow Script by Dave Stevens - http://davestevens.co.uk
$user = "";
$pass = "";
$term = "";
$userApiUrl = "http://twitter.com/statuses/friends.json";
$ch = curl_init($userApiUrl);
curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$apiresponse = curl_exec($ch);
curl_close($ch);
$followed = array();
if ($apiresponse) {
	$json = json_decode($apiresponse);
	if ($json != null) {
		foreach ($json as $u) {
			$followed[] = $u-&gt;name;
		}
	}
}
$userApiUrl = "http://search.twitter.com/search.json?q=" . $term . "&amp;rpp=100";
$ch = curl_init($userApiUrl);
curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$apiresponse = curl_exec($ch);
curl_close($ch);
if ($apiresponse) {
	$results = json_decode($apiresponse);
	$count = 20;
	if ($results != null) {
		$resultsArr = $results-&gt;results;
		if (is_array($resultsArr)) {
			foreach ($resultsArr as $result) {
				$from_user = $result-&gt;from_user;
				if (!in_array($from_user,$followed)) {
					$ch = curl_init("http://twitter.com/friendships/create/" . $from_user . ".json");
					curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,"follow=true");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$apiresponse = curl_exec($ch);
 
					if ($apiresponse) {
						$response = json_decode($apiresponse);
						if ($response != null) {
							if (property_exists($response,"following")) {
								if ($response-&gt;following === true) {
									echo "Now following " . $response-&gt;screen_name . "\n";
								} else {
									echo "Couldn't follow " . $response-&gt;screen_name . "\n";
								}
							} else {
								echo "Follow limit exceeded, skipped " . $from_user . "\n";
							}
						}
					}
					curl_close($ch);
				} else {
					echo "Already following " . $from_user . "\n";
				}
			}
		}
	}
}

<?PHP

function saveStats($profileUrl) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $profileUrl);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_AUTOREFERER, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $html = curl_exec($ch);
  curl_close($ch);

  preg_match_all("/BOfSxb[^>]+>([^<]+)/", $html, $matches);
  $followers = (int)preg_replace("/[^\d]/", "", $matches[1][0]);
  $views = (int)preg_replace("/[^\d]/", "", $matches[1][1]);

  date_default_timezone_set('Hungary/Budapest');
  $date = date('Y-m-d H:i:s', time());

  echo $date, "|", $followers, "|", $views;

}

saveStats("https://plus.google.com/+SanchoVir%C3%A1gAttila/posts");

?>

<?php
$BOOKS_FILE = "books.txt";

function filter_chars($str) {
	return preg_replace("/[^A-Za-z0-9_]*/", "", $str);
}

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

$category = "";
$delay = 0;

if (isset($_REQUEST["category"])) {
	$category = filter_chars($_REQUEST["category"]);
}
if (isset($_REQUEST["delay"])) {
	$delay = max(0, min(60, (int) filter_chars($_REQUEST["delay"])));
}

if ($delay > 0) {
	sleep($delay);
}

if (!file_exists($BOOKS_FILE)) {
	header("HTTP/1.1 500 Server Error");
	die("ERROR 500: Server error - Unable to read input file: $BOOKS_FILE");
}

header("Content-type: application/json");

print "{\n  \"books\": [\n";

$lines = file($BOOKS_FILE);
$list = array();
for ($i = 0; $i < count($lines); $i++) {
	list($title, $author, $book_category, $year, $price) = explode("|", trim($lines[$i]));
	if ($book_category == $category) {
		$book = "";
		$book = $book."{\n";
		$book = $book."\"category\": \"{$category}\",\n";
		$book = $book."\"title\": \"{$title}\",\n";
		$book = $book."\"category\": \"{$category}\",\n";
		$book = $book."\"author\": \"{$author}\",\n";
		$book = $book."\"year\": \"{$year}\",\n";
		$book = $book."\"price\": \"{$price}\"\n";
		$book = $book."}\n";
		$list.array_push($list, $book);
	}
	
}
print implode(',', $list);

print "  ]\n}\n";

?>

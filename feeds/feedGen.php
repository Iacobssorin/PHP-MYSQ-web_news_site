<?php
session_start();

ob_start();

error_reporting(E_ALL);

require_once ('../assets/database_connection.php');

require_once ('../assets/functions.php');

if(isset($_GET['category_id'])) {
  $cat_id = $_GET['category_id'];
}else{
  return false;
}

$rss_txt = '';

$getCat = mysqli_query($database_link, "SELECT * FROM categories WHERE category_id = '$cat_id'");
$fetchCat = mysqli_fetch_assoc($getCat);

$fileName = "../feeds/feed_".$fetchCat['category_title'].".xml";
$fh = fopen($fileName, 'w') or die("Fișierul nu a putut fi gasit.");

$rss_txt .= '<?xml version="1.0" encoding="utf-8"?>';
$rss_txt .= "<rss version='2.0'>";
$rss_txt .= '<channel>';
    $getFeed = mysqli_query($database_link, "SELECT * FROM news
    INNER JOIN users ON users.user_id = news.fk_users_id
    INNER JOIN categories ON categories.category_id = news.fk_categories_id
    WHERE fk_categories_id = '$cat_id'");
    while($fetchFeed = mysqli_fetch_assoc($getFeed))
    {
        $category_id = $fetchFeed['fk_categories_id'];
        $link = 'page=news&category_id='.$fetchFeed['fk_categories_id'].'&news_id='.$fetchFeed['news_id'].'';

        $rss_txt .= '<title>'.$fetchFeed['category_title'].'</title>';
        $rss_txt .= '<item>';

        $rss_txt .= '<title>' .$fetchFeed['news_title']. '</title>';
        $rss_txt .= '<link>'.htmlspecialchars($link).'</link>';
        $rss_txt .= '<description>' .htmlspecialchars($fetchFeed['news_content']). '</description>';
        $rss_txt .= '<author>' .$fetchFeed['user_email'].'</author>';
        $rss_txt .= '<pubDate>'.date(DATE_RSS, strtotime($fetchFeed['news_postdate'])). '</pubDate>';
        $rss_txt .= '<category>' .$fetchFeed['category_title']. '</category>';
        $rss_txt .= '</item>';
    }
$rss_txt .= '</channel>';
$rss_txt .= '</rss>';

fwrite($fh, $rss_txt);
fclose($fh);
if(isset($_SESSION['feedUpdate'])) {
  $cat = $_SESSION['feedUpdate'];
  unset($_SESSION['feedUpdate']);
  die(header('location: ../feeds/feedGen.php?cat='.$cat.''));
}else{
  header('location: ../admin/index.php?page=news&category_id='.$category_id.'');
}
?>

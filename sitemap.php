<?php
include ('database/connection.php');


$base_url = "http://localhost/wallpapers/";

$sql = "SELECT * FROM category ORDER BY cat_name ASC";
$result = $pdo->query($sql);

header("Content-type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;


echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . '</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>1.00</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'index.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'latest.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'topdownloads.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'random.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'allcategories.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

while($row = $result->fetch()){
    echo '<url>' . PHP_EOL;
    echo "<loc>" . $base_url . "category.php?id=$row[cat_id]&amp;catname=$row[cat_name]</loc>" . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '<priority>0.85</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

try{
    $sql = "SELECT * FROM details ORDER BY d_id ASC";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        echo '<url>' . PHP_EOL;
        echo "<loc>" . $base_url . "download.php?id=$row[d_id]</loc>" . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '<priority>0.85</priority>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
    }
}catch(PDOException $e){
    echo "Error";
}

try{
    $sql = "SELECT * FROM category ORDER BY cat_id ASC";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        echo '<url>' . PHP_EOL;
        echo "<loc>" . $base_url . "category.php?id=$row[cat_id]</loc>" . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '<priority>0.85</priority>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
    }
}catch(PDOException $e){
    echo "Error";
}

try{
    $sql = "SELECT * FROM category ORDER BY cat_id ASC";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $res = str_replace(" ", "%20", $row['cat_name']);
        echo '<url>' . PHP_EOL;
        echo "<loc>" . $base_url . "searchresults.php?id=$res</loc>" . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '<priority>0.85</priority>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
    }
}catch(PDOException $e){
    echo "Error";
}

try{
    $sql = "SELECT * FROM details ORDER BY d_id ASC";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $res = str_replace(" ", "%20", $row['tag']);
        echo '<url>' . PHP_EOL;
        echo "<loc>" . $base_url . "searchresults.php?id=$res</loc>" . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '<priority>0.85</priority>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
    }
}catch(PDOException $e){
    echo "Error";
}

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/contact.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/disclaimer.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/privacy.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/site.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/terms.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.85</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '</urlset>' . PHP_EOL;

?>
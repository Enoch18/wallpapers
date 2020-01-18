<?php
include ('database/connection.php');


$base_url = "";
$base_url1 = "";
$server = $_SERVER['SERVER_NAME'];
if ($server == 'localhost'){
    $base_url = "http://$server/wallpapers/";
    $base_url1 = "http://$server/wallpapers";
}else{
    $base_url = "http://$server/";
    $base_url1 = "http://$server/wallpapers";
}

$sql = "SELECT * FROM category ORDER BY cat_name ASC";
$result = $pdo->query($sql);

header("Content-type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;


echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url1 . '</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>1.00</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'index.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'latest.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'topdownloads.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'random.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'allcategories.php</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

while($row = $result->fetch()){
    echo '<url>' . PHP_EOL;
    echo "<loc>" . $base_url . "category.php?id=$row[cat_id]&amp;catname=$row[cat_name]</loc>" . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '<priority>0.75</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

try{
    $sql = "SELECT * FROM details ORDER BY createdat ASC";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        echo '<url>' . PHP_EOL;
        echo "<loc>" . $base_url . "download.php?value=$row[original_filename]</loc>" . PHP_EOL;
        echo '<changefreq>monthly</changefreq>' . PHP_EOL;
        echo '<priority>1.0</priority>' . PHP_EOL;
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
        echo '<priority>1.0</priority>' . PHP_EOL;
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
        echo "<loc>" . $base_url . "searchresults.php?search=$res</loc>" . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '<priority>0.75</priority>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
    }
}catch(PDOException $e){
    echo "Error";
}

try{
    $sql = "SELECT * FROM tagdetails WHERE alt = '1' ORDER BY id DESC";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $res = $row['tagname'];
        echo '<url>' . PHP_EOL;
        echo "<loc>" . $base_url . "searchresults.php?search=$res</loc>" . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '<priority>1.00</priority>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
    }
}catch(PDOException $e){
    echo "Error";
}

try{
    $sql = "SELECT * FROM details ORDER BY d_id DESC";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $res = $row['original_filename'];
        echo '<url>' . PHP_EOL;
        echo "<loc>" . $base_url . "searchresults.php?search=$res</loc>" . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '<priority>1.00</priority>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
    }
}catch(PDOException $e){
    echo "Error";
}

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/contact.php</loc>' . PHP_EOL;
echo '<changefreq>yearly</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/disclaimer.php</loc>' . PHP_EOL;
echo '<changefreq>yearly</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/privacy.php</loc>' . PHP_EOL;
echo '<changefreq>yearly</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/site.php</loc>' . PHP_EOL;
echo '<changefreq>yearly</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'footercontent/terms.php</loc>' . PHP_EOL;
echo '<changefreq>yearly</changefreq>' . PHP_EOL;
echo '<priority>0.75</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '</urlset>' . PHP_EOL;

?>
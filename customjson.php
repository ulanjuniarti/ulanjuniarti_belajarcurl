<?php

function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}

$profile = http_request("https://dummyjson.com/products");


// ubah string JSON menjadi array
$profile = json_decode($profile, TRUE);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>  
    <title>Curl Data JSON</title>
</head>

<body>
    <div class="container-medium">
        <table class = "table table-striped">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Thumbnail</th>
                <th>Images</th>
            </tr>
            <?php
                foreach($profile['products'] as $d) { ?>
            <tr>
            <?php
                echo "<td>",$d['title'],"</td>";
                echo "<td>$",$d['price'],"</td>";
                echo "<td><img width='100px' src=",$d['thumbnail'],"></img></td>";
                echo "<td>";
                foreach ($d['images'] as $image) {
                    echo "<img width='100px' alt='image' src=", $image, "></img>";
                }
                echo "</td>";
                
            } ?>
            </tr>
        </table>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Assesment</title>
</head>
<body class=" d-flex justify-content-center align-items-center vh-100">
    <div class="container d-flex justify-content-center align-items-center flex-column shadow rounded-3">
        <form action="" method="POST"  class=" d-flex justify-content-center align-items-center ">
            <input type="text" id="url" name="url">
            <input type="submit" id="url" class="btn-primary" name="submit" value="query">
        </form>

        <?php
             if(isset($_POST['url'])){
     
            $url = "https://developers.onemap.sg/commonapi/search?searchVal=revenue&returnGeom=n&getAddrDetails=n&pageNum=1";
        
            // Retrieve the data from the URL
            $data = file_get_contents($url);
            // Parse the data as JSON
    
            $jsonData = json_decode($data);
            $jsonDatarev = json_decode($data,true);
    
            // Check if JSON decoding was successful
            if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
                // Error occurred while decoding JSON
                echo "Error decoding JSON: " . json_last_error_msg();
            } else {
    
                 // Iterate over each key-value pair in the JSON object
                foreach ($jsonDatarev as $key => $value) {
                    // Sort the characters in descending order for each key string
                    $sortedKey = str_split($key);
                    arsort($sortedKey);
                    $sortedKey = implode('', $sortedKey);
                    
                    // Update the JSON object with the sorted key string
                    $jsonDatarev[$sortedKey] = $value;
                    unset($jsonDatarev[$key]);
                }
        
                // Display the JSON data
                $str = json_encode($jsonData, JSON_PRETTY_PRINT);
                $strrev = json_encode($jsonDatarev, JSON_PRETTY_PRINT);
                }
            }
        ?>
        <div class=' d-flex tex-center justify-content-center align-items-center flex-column container'>
            <label for='' class='m-4'>Url Response</label>
            <div class='container-fluid  shadow p-5 '><?=$str?></div>
            <label for='' class='m-4'>Processed URL Response</label>
             <div class='container shadow p-5'><?=$strrev?></div>
       </div>
        
    </div>
    
</body>
</html>
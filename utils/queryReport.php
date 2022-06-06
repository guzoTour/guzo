<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Report</title>
    <style>
        
        body{
            display: flex;
            justify-content: center;
            font-size:25px;
            font-weight:400;
            color:blue;
        }
        ul{
            
        }
    </style>
</head>

<body>
    <ul>
        <h2>Admin Activites</h2>
        <?php
           $file3 = fopen('../files/queryReport.log','r');
           if($file3){
           
            while(!feof($file3)) {
                $lineText = fgets($file3);
                $s2=<<<EOT
                 <li>$lineText</li>
                EOT;
                echo "$s2";
              }
              fclose($file3);
           }else{
               echo "<h1>Something Wrong</h1>";
           }
        ?>
    </ul>
</body>
</html>
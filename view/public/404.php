<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
      </script>
    <title>Document</title>
</head>
<body>
    <div class="flex flex-col justify-center items-center">
        <?php
   $url = $_SERVER["REQUEST_URI"];
   $components = parse_url($url);
   parse_str($components['query'], $results);
   $value = $results['massage'];
      echo ' <h1 class="text-4xl font-bold text-red-500 px-60 mt-20">'.$value.'</h1>';
      if($results['massage']=="reg"){
      echo  '<a href="../../view/shared/login.php">Sign Up</a>';

      }

      if($results['massage']=="pass"){

        echo '<a href="../../view/shared/register.php">Sign In</a>';
      }
  
        
        ?>
        <div class="flex items-center w-[1100px]">
            <img src="../../multimedia/img/travel3.svg" alt="" class="w-96 ">
            
            <img src="../../multimedia/img/404.png" alt="" class = 'animate-pulse'>
        </div>
    </div>
</body>
</html>
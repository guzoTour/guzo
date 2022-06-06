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
        <h1 class="text-4xl font-bold text-red-500 px-60 mt-20">Page Not Found!</h1>
        <div class="flex items-center w-[1100px]">
            <img src="../../multimedia/img/travel3.svg" alt="" class="w-96 animate-bounce">
            <img src="../../multimedia/img/404.png" alt="" class = 'animate-pulse'>
        </div>
    </div>
</body>
</html>
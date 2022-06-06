<?php
if(isset($_SESSION["username"])){
    if($_SESSION["role"]!="admin"){
        header("location:../index.php");
    }
}
?><!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@2.15.2/dist/full.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/flowbite@1.4.7/dist/datepicker.js"></script>
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
  <style>
    .input {
        transition: border 0.2s ease-in-out;
        min-width: 280px
    }

    .input:focus+.label,
    .input:active+.label,
    .input.filled+.label {
        font-size: .75rem;
        transition: all 0.2s ease-out;
        top: -1.7rem;
        color: #667eea;
    }

    .label {
        transition: all 0.2s ease-out;
        top: 0.4rem;
        left: 0;
    }
</style>
</head>
<body class="">
  <div class="">
    <div class ='flex text-center items-center justify-center'>
      <h1 class="text-center m-10 text-3xl font-bold text-green-400">Add New Tour</h1>
      <div class = 'flex items-center text-green-400 space-x-1 cursor-pointer'>
          <button class="text-center ml-10 text-3xl font-bold text-green-400" id="goto-edit-profile"><a href="../../utils/importTours.php">Import Tour </a></button>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
  </svg>
      </div>
</svg>
    </div>
      <div class="">
        <form   action="../../controller/tourController/add-tour.php" class="flex justify-center space-x-10 items-center" method = "post">
            <div>
   
            <!-- name -->
                <div class="mb-4 relative">
               
                  <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-green-400"  type="text" name = "tour_name">
                  <label for="name" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Name:</label>
                  
                </div>
                
                <!-- Duration -->
              
                  <div class="mb-4 relative">
                        <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-green-400"  type="number" name = "duration">
                  <label for="name" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Duration</label>
                
                </div>
                <!-- Max Group Size: -->
              
                  <div class="mb-4 relative">
                  <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-green-400"  type="number" name = "group_size">
                  <label for="name" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Group Size</label>
                </div>
              <!-- Difficulty -->
              <select name = "difficulty" class="select w-full max-w-xs border border-gray-400 mb-4">
                <option disabled selected class="text-gray-400 text-base mt-0 cursor-text">Pick Difficulty Level</option>
                <option  value = "easy" >Easy</option>
                <option  value = "medium" >Medium</option>
                <option value = "hard"  >Hard</option>
              </select>
              <!-- Region -->
                <div class="mb-4 relative">
                <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-green-400"  type="text" name = "region">
                  <label for="name" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Region</label>
                  </div>
              <!-- Direction -->
              <select name = "direction" class="select w-full max-w-xs border border-gray-400 mb-4">
                <option disabled selected class="text-gray-400 text-base mt-0 cursor-text">Pick Direction</option>
                <option  value = "north">North</option>
                <option  value = "south">South</option>
                <option  value = "west">West</option>
                <option  value = "east">East</option>
                <option  value = "center">Center</option>
              </select>
              <!-- Town -->
                <div class="mb-4 relative">
                <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-green-400"  type="text" name = "town">
                  <label for="name" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Town</label>
              </div>
              <!-- Price -->
              <div class="mb-4 relative">
              <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-green-400"  type="number" name = "price">
                  <label for="name" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Price</label>
            </div>
            <!-- Price Discount -->
          
              <div class="mb-4 relative">
              <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-green-400"  type="number" name = "discount_price">
                  <label for="name" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text"> Discount Price </label>
            </div>
            <!-- Start Date -->
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
              </div>
              <input name = 'start-date' datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-green-400 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-400 dark:focus:border-green-400" placeholder="Select date">
            </div>
            </div>
              <!-- Second -->
            <div>

                     
          <!-- Summary -->
                  <div class="mb-4 relative">
                    <textarea class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-indigo-600 h-60" name="summary" id="summary" cols="70" rows="90"></textarea>

                    <label for="summary" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text" name = "summary">Summary:</label>
                </div>

                <div class="mb-4 relative">
                  <textarea class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-green-400 focus:outline-none active:outline-none active:border-indigo-600 h-60" id=" Description" name = "description" cols="70" rows="90"></textarea >
                  <label for=" Description" class="label absolute mb-0 -mt-2  pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Description:</label>
              </div>
              <input class="bg-green-400 text-white p-2 rounded-full shadow-md hover:shadow-lg active:scale-90 w-full text-center transtion duration-150 cursor-pointer" value = 'Add Tour' type = 'submit' name = "submitTour"/>
            </div>
        </form>
      </div>
  </div>
</body>
<script>
  var toggleInputContainer = function (input) {
      if (input.value != "") {
          input.classList.add('filled');
      } else {
          input.classList.remove('filled');
      }
  }

  var labels = document.querySelectorAll('.label');
  for (var i = 0; i < labels.length; i++) {
      labels[i].addEventListener('click', function () {
          this.previousElementSibling.focus();
      });
  }

  window.addEventListener("load", function () {
      var inputs = document.getElementsByClassName("input");
      for (var i = 0; i < inputs.length; i++) {
          console.log('looped');
          inputs[i].addEventListener('keyup', function () {
              toggleInputContainer(this);
          });
          toggleInputContainer(inputs[i]);
      }
  });
</script>
</html>
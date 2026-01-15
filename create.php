<?php
require 'config.php';

if(!check_login()) exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
  <style>
    * {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<title>Login</title>
</head>

<body>
  <div class="max-w-[490px] mx-auto mt-[100px] px-6">
    <!-- // top section -->
    <div class="flex flex-col">
      <h1 class="fs-4xl text-[32px] font-bold">Create Note</h1>
      <p class="max-w-[300px]"><?php echo date('d F Y') ?></p>
    </div>

    <!-- // form section -->
    <form action="./action-create-note.php" method="post" class="flex flex-col gap-4 mt-6">
      <div class="flex flex-col gap-2">
        <input type="text" name="title" id="title" class="p-2 py-3 text-lg bg-[#f8fafc] rounded border border-[#9DABBE]" placeholder="Title">
      </div>
      <div class="flex flex-col gap-2">
        <textarea name="content" class="p-2 py-3 text-lg bg-[#f8fafc] rounded border border-[#9DABBE]" rows="10" placeholder="Write some ideas here"></textarea>
      </div>

      <div class="flex gap-4">
        <a href="./main.php" type="submit" class="text-center text-[#7C3AED] font-bold p-3 mt-4 hover:bg-[#6b21a8] transition w-full">Cancel</a>
        <button type="submit" class="bg-[#7C3AED] text-white font-bold p-3 mt-4 hover:bg-[#6b21a8] transition shadow-lg rounded-lg w-full">Save</button>
      </div>
    </form>
  </div>

</body>

</html>
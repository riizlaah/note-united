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
      <h1 class="fs-4xl text-[32px] font-bold">My Notes</h1>
    </div>

    <!-- // form search section -->
    <form action="" method="post" class="flex flex-col gap-4 mt-6">
      <div class="flex flex-col gap-2 relative">
        <label for="search" class="absolute flex top-2 left-3 text-[#9DABBE]"><i class="hgi hgi-stroke hgi-search-01"></i></label>
        <input type="text" name="search" id="search" class="p-2 bg-[#f8fafc] rounded border border-[#9DABBE] pl-10" placeholder="Search notes...">
      </div>
    </form>

    <!-- // notes section -->
    <div class="flex flex-col pt-5">
      <h2 class="uppercase text-[#9DABBE] font-bold">Recent</h2>

      <!-- notes holder -->
      <div class="flex flex-col top-5 gap-5" id="notes-holder"></div>
    </div>

    <!-- // floating button -->
    <a href="./create.php" class="fixed bottom-10 right-10 w-[50px] h-[50px] bg-[#7C3AED] flex items-center justify-center text-white font-bold text-2xl rounded-full shadow-lg">
       <i class="hgi hgi-stroke hgi-add-01"></i>
    </a>

  </div>
  <script>
    function query(s) {
      return document.querySelector(s);
    }
    function createElement(name, attr = {}) {
      return Object.assign(document.createElement(name), attr);
    }
    let notesHolder = query("#notes-holder");
    let timeoutId;
    let searchInput = query("#search");

    async function updateNotes(search = '') {
      let url = "/get-notes.php?id=<?= $_SESSION['login'] ?>";
      if(search !== '') url += `&s=${search}`;
      let res = await fetch(url);
      let notes = await res.json();
      notesHolder.innerHTML = "";
      notes.forEach(note => {
        let item = createElement('a', {
          href: `/edit.php?id=${note.id}`,
          innerHTML: `<div class="flex flex-col p-[20px] shadow-lg rounded-lg gap-2">
              <h3 class="text-lg font-bold">${note.title}</h3>
              <p class="text-[#666D7C]">${note.content}</p>
              <span class="text-[#9DABBE]">${note.created_at}</span>
            </div>`
        });
        notesHolder.appendChild(item);
      });
    }
    updateNotes();

    searchInput.oninput = () => {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => {
        updateNotes(searchInput.value);
      }, 500);
    }
  </script>
</body>
</html>
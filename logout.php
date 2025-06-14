<?php
session_start(); // Mengaktifkan session
session_destroy(); // Mengakhiri session
header("Location: login.html?pesan=logout");
?>
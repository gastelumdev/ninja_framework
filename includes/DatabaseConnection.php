<?php
$pdo = new PDO('mysql:host=localhost;dbname=ninja_framework;charset=utf8', 'admin', 'password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
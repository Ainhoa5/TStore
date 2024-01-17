<?php
// In /app/controllers/HomeController.php

class HomeController {
    public function index() {
        // This method would handle the logic for the home page
        // For now, let's just include a basic home view

        /* echo '<pre>';
        echo'fafa';
        echo '</pre>';
        exit(); */
        require 'app/views/home.php'; // Path to your home view file
    }
}

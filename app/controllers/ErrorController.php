<?php
namespace App\Controllers;
// In /app/controllers/HomeController.php

class ErrorController {
    
    public function errorPage() {
        require VIEWS_DIR . 'errorPage.php';
    }
}

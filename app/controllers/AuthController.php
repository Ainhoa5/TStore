<?php
// In /app/controllers/AuthController.php

class AuthController {
    public function showAuthForm() {
        // This method would handle the logic for the home page
        // For now, let's just include a basic home view
        require 'app/views/auth/authForm.php'; // Path to your home view file
    }
}

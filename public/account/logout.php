<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}
verify_csrf();
unset($_SESSION['user']);
session_regenerate_id(true);
flash('success', 'You are now signed out.');
redirect('');

<?php declare(strict_types = 1);

// Define routes
return [
    ['GET', '/job/add', ['JobBoard\Controllers\JobController', 'showForm']],
    ['POST', '/job/add', ['JobBoard\Controllers\JobController', 'postForm']],
    ['GET', '/job/approve/{id}', ['JobBoard\Controllers\JobController', 'approve']],
    ['GET', '/job/spam/{id}', ['JobBoard\Controllers\JobController', 'markAsSpam']],
    ['GET', '/auth/register', ['JobBoard\Controllers\AuthController', 'showRegisterForm']],
    ['POST', '/auth/register', ['JobBoard\Controllers\AuthController', 'postRegisterForm']],
    ['GET', '/auth/login', ['JobBoard\Controllers\AuthController', 'showLoginForm']],
    ['POST', '/auth/login', ['JobBoard\Controllers\AuthController', 'postLoginForm']],
    ['GET', '/auth/logout', ['JobBoard\Controllers\AuthController', 'logout']],
];

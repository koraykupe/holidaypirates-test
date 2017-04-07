<?php declare(strict_types = 1);

return [
    ['GET', '/job/add', ['JobBoard\Controllers\JobController', 'showForm']],
    ['POST', '/job/add', ['JobBoard\Controllers\JobController', 'postForm']],
    ['GET', '/user/add', ['JobBoard\Controllers\UserController', 'showForm']],
    ['POST', '/user/add', ['JobBoard\Controllers\UserController', 'postForm']],

];
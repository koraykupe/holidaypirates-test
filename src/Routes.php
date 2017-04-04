<?php declare(strict_types = 1);

return [
    ['GET', '/job/add', '/', ['JobBoard\Controllers\JobController', 'showForm']],
    ['POST', '/job/add', function () {
        echo 'Job Offer Added';
    }],
];
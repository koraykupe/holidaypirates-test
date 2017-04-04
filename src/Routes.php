<?php declare(strict_types = 1);

return [
    ['GET', '/job/add', function () {
        echo 'Add Job Offer Form';
    }],
    ['POST', '/job/add', function () {
        echo 'Job Offer Added';
    }],
];
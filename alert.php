<?php
if (isset($_GET['error'])) {
    echo " <div class='alert alert-error'>
        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='stroke-current shrink-0 w-6 h-6'>
            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>
        </svg>
        <span>" . $_GET['error'] . "</span>
    </div>";
} elseif (isset($_GET['success'])) {
    echo " <div class='alert alert-success'>
        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='stroke-current shrink-0 w-6 h-6'>
            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>
        </svg>
        <span>" . $_GET['success'] . "</span>
    </div>";
} elseif (isset($_GET['warning'])) {
    echo " <div class='alert alert-warning'>
        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='stroke-current shrink-0 w-6 h-6'>
            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>
        </svg>
        <span>" . $_GET['warning'] . "</span>
    </div>";
} elseif (isset($_GET['info'])) {
    echo " <div class='alert alert-info'>
        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='stroke-info shrink-0 w-6 h-6'>
            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>
        </svg>
        <span>" . $_GET['info'] . "</span>
    </div>";
}
?>
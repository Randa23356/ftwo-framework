<?php $this->extends('layout'); ?>

<?php $this->section('title'); ?>
    Dashboard - FTwoDev
<?php $this->endSection(); ?>

<div class="card">
    <h1>Welcome, <?= $this->e($user) ?></h1>
    <p>This is your dashboard.</p>
    
    <h2>Stats</h2>
    <ul>
        <li>Users: <?= $stats['users'] ?></li>
        <li>Sales: $<?= $stats['sales'] ?></li>
    </ul>
</div>

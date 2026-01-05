<?php $this->extends('layout'); ?>

<?php $this->section('title'); ?>
    Login - FTwoDev
<?php $this->endSection(); ?>

<div class="card">
    <h1>Login</h1>
    <form action="/login" method="POST">
        <?= csrf_field() ?>
        <p>
            <label>Username</label><br>
            <input type="text" name="username">
        </p>
        <p>
            <label>Password</label><br>
            <input type="password" name="password">
        </p>
        <button type="submit">Login</button>
    </form>
</div>

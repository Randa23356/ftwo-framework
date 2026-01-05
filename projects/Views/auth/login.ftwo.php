<?php $this->extends('layout'); ?>

<?php $this->section('title'); ?>
    Login - FTwoDev
<?php $this->endSection(); ?>

<style>
    .auth-card {
        max-width: 480px;
        margin: 6rem auto;
        padding: 4rem;
        background: #fff;
        border-radius: 40px;
        box-shadow: 0 40px 100px -20px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.03);
        text-align: center;
    }

    .auth-card h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
        color: var(--slate);
        letter-spacing: -1.5px;
    }

    .auth-card p.subtitle {
        color: #64748b;
        margin-bottom: 3rem;
        font-size: 1.1rem;
    }

    .form-group {
        text-align: left;
        margin-bottom: 1.75rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group input {
        width: 100%;
        padding: 1rem 1.25rem;
        border-radius: 16px;
        border: 2px solid #f1f5f9;
        font-family: inherit;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f8fafc;
    }

    .form-group input:focus {
        outline: none;
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    .auth-btn {
        width: 100%;
        padding: 1.125rem;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 18px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
        box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.3);
    }

    .auth-btn:hover { 
        background: var(--primary-dark); 
        transform: translateY(-2px);
        box-shadow: 0 15px 25px -5px rgba(5, 150, 105, 0.4);
    }

    .error-msg {
        background: #FEF2F2;
        color: #DC2626;
        padding: 1rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        font-size: 0.95rem;
        font-weight: 600;
        border: 1px solid rgba(220, 38, 38, 0.1);
    }

    .switch-auth {
        margin-top: 2.5rem;
        font-size: 1rem;
        color: #64748b;
    }

    .switch-auth a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
    }
</style>

<div class="auth-card">
    <h1>Welcome Back</h1>
    <p class="subtitle">Enter your credentials to access Bloom.</p>

    <?php if (isset($error)): ?>
        <div class="error-msg"><?= $error ?></div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="johndoe" required autofocus>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="auth-btn">Sign In to Dashboard</button>
    </form>

    <div class="switch-auth">
        New to Bloom? <a href="/register">Create an account</a>
    </div>
</div>


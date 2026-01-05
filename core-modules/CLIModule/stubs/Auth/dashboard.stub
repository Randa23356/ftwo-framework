<?php $this->extends('layout'); ?>

<?php $this->section('title'); ?>
    Dashboard - FTwoDev
<?php $this->endSection(); ?>

<style>
    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
    }

    .dash-header h1 {
        font-size: 2.25rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: #fff;
        padding: 2rem;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.03);
    }

    .stat-card .label {
        font-size: 0.875rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-card .value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--slate);
    }

    .main-card {
        background: #fff;
        padding: 3rem;
        border-radius: 32px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 20px 50px -15px rgba(0,0,0,0.05);
    }

    .welcome-banner {
        background: linear-gradient(135deg, var(--dark), var(--primary));
        color: #fff;
        padding: 3rem;
        border-radius: 28px;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-banner p {
        opacity: 0.9;
        font-size: 1.1rem;
    }
</style>

<div class="dash-header">
    <h1>Dashboard</h1>
    <div style="display: flex; gap: 1rem;">
        <span class="badge" style="margin-bottom: 0;">Online</span>
    </div>
</div>

<div class="welcome-banner">
    <h2>Welcome back, <?= $this->e($user) ?>!</h2>
    <p>Everything looks great today. You have some new data to check.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <span class="label">Total Users</span>
        <div class="value"><?= number_format($stats['users']) ?></div>
    </div>
    <div class="stat-card">
        <span class="label">Recent Sales</span>
        <div class="value">$<?= number_format($stats['sales'], 2) ?></div>
    </div>
    <div class="stat-card">
        <span class="label">Performance</span>
        <div class="value" style="color: var(--primary);">+12.5%</div>
    </div>
</div>

<div class="main-card">
    <h3 style="margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: 700;">Recent Activity</h3>
    <p style="color: #64748b;">No recent activity to show. Start building your amazing application!</p>
</div>


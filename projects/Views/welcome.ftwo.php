<?php $this->extends('layout'); ?>

<?php $this->section('title'); ?>
    FTwoDev - The Fast & Future Framework
<?php $this->endSection(); ?>

<style>
    .hero {
        text-align: center;
        max-width: 900px;
        margin: 2rem auto 8rem;
    }

    .hero h1 {
        font-size: 5rem;
        font-weight: 800;
        letter-spacing: -3px;
        margin-bottom: 2rem;
        line-height: 1;
        color: var(--slate);
    }

    .hero p {
        font-size: 1.5rem;
        color: #64748b;
        margin-bottom: 3.5rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        font-weight: 400;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
    }

    .card {
        padding: 3rem;
        background: #fff;
        border-radius: 32px;
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -1px rgba(0,0,0,0.01);
    }

    .card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px -15px rgba(5, 150, 105, 0.08);
        border-color: rgba(5, 150, 105, 0.2);
    }

    .card h3 {
        font-size: 1.6rem;
        margin-bottom: 1.25rem;
        font-weight: 700;
        color: var(--slate);
    }

    .card p {
        color: #64748b;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    .icon-box {
        width: 64px;
        height: 64px;
        background: rgba(5, 150, 105, 0.08);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        margin-bottom: 2rem;
        font-size: 2rem;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        background: rgba(5, 150, 105, 0.1);
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 700;
        border-radius: 99px;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .cta-group {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
    }

    .code-snippet {
        background: #020617;
        color: #94a3b8;
        padding: 1.5rem 2rem;
        border-radius: 20px;
        text-align: left;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.95rem;
        margin-top: 4rem;
        border: 1px solid #1e293b;
        display: flex;
        align-items: center;
        gap: 12px;
        max-width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }

    .code-snippet span.cmd { color: #f8fafc; font-weight: 600; }
    .code-snippet span.prompt { color: var(--primary); }

    .features-title {
        text-align: center;
        margin-bottom: 4rem;
    }

    .features-title h2 {
        font-size: 3rem;
        font-weight: 800;
        letter-spacing: -1.5px;
    }
</style>

<div class="hero">
    <div class="badge">
        <span style="width: 8px; height: 8px; background: var(--primary); border-radius: 50%; display: inline-block;"></span>
        Version 1.2.0 is live
    </div>
    <h1>The Engine for <br><span class="text-gradient">Modern Creators.</span></h1>
    <p>A native PHP 8 boilerplate built for velocity. FTwoDev gives you the precision of raw PHP with the elegance of a premium framework.</p>
    
    <div class="cta-group">
        <a href="/login" class="btn">Explore Bloom</a>
        <a href="https://github.com/Randa23356/ftwo-framework" class="btn" style="background: var(--slate);">Docs & Source</a>
    </div>

    <div class="code-snippet">
        <span class="prompt">➜</span> <span class="cmd">composer create-project ftwodev/framework</span>
    </div>
</div>

<div class="features-title">
    <h2>Everything you need <br><span class="text-gradient">to scale.</span></h2>
</div>

<div class="grid">
    <div class="card">
        <div class="icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
        </div>
        <h3>Magic Routing</h3>
        <p>Instant mapping of URLs to controllers. No boilerplate, no tedious config. Just build and it works.</p>
    </div>

    <div class="card">
        <div class="icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        </div>
        <h3>Bloom Auth</h3>
        <p>A premium membership starter kit ready in seconds. Fully secure, fully styled, fully integrated.</p>
    </div>

    <div class="card">
        <div class="icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
        </div>
        <h3>High Velocity</h3>
        <p>Zero dependencies. Zero bloat. Experience lightning fast execution on any PHP 8+ environment.</p>
    </div>

    <div class="card">
        <div class="icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
        </div>
        <h3>Database Flow</h3>
        <p>Advanced migration and model system using PDO. Manage your schema with programmatic precision.</p>
    </div>

    <div class="card">
        <div class="icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg>
        </div>
        <h3>Template Engine</h3>
        <p>Modern view architecture with layouts and sections. Automatic XSS protection out of the box.</p>
    </div>

    <div class="card">
        <div class="icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>
        </div>
        <h3>Creative CLI</h3>
        <p>The `ftwo` tool is your companion. Craft controllers, models, and services with a single command.</p>
    </div>
</div>


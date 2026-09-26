<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#eef1ec">
    <title>@yield('title', 'Task Manager') · Personal Task Manager</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;1,9..144,500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #1f2a24;
            --muted: #5b6b60;
            --paper: #eef1ec;
            --surface: #ffffff;
            --line: #dbe2dc;
            --accent: #3d6b5c;
            --accent-dark: #254539;
            --danger: #a6473b;
            --danger-dark: #7e332a;
            --gold: #a97a2e;
            --shadow: 0 16px 40px rgba(31, 42, 36, .10);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            min-width: 320px; margin: 0; background: var(--paper); color: var(--ink);
            font-family: 'Inter', Arial, sans-serif; line-height: 1.55;
        }
        a { color: inherit; }
        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible, select:focus-visible {
            outline: 3px solid rgba(61, 107, 92, .35); outline-offset: 3px;
        }

        h1, h2, h3 { font-family: 'Fraunces', Georgia, serif; letter-spacing: -.02em; }

        .site-header {
            position: sticky; z-index: 10; top: 0;
            border-bottom: 1px solid var(--line);
            background: rgba(238, 241, 236, .9); backdrop-filter: blur(14px);
        }
        .header-inner, .container, .site-footer { width: min(1080px, calc(100% - 40px)); margin: 0 auto; }
        .header-inner { display: flex; align-items: center; justify-content: space-between; min-height: 72px; gap: 24px; }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-size: 1.1rem; font-weight: 600; text-decoration: none; font-family: 'Fraunces', serif; }
        .brand-mark {
            display: grid; width: 30px; height: 30px; flex: 0 0 30px; place-items: center;
            border-radius: 8px; background: var(--accent); color: #fff; font-size: .85rem; font-weight: 700;
        }
        .nav-links { display: flex; align-items: center; gap: 22px; color: var(--muted); font-size: .88rem; font-weight: 500; }
        .nav-links a { text-decoration: none; }
        .nav-links a:hover { color: var(--accent-dark); }
        .nav-cta { color: var(--accent-dark) !important; font-weight: 600; border-bottom: 2px solid var(--accent); padding-bottom: 2px; }
        .nav-cta:hover { color: var(--ink) !important; border-color: var(--ink); }

        .feature-strip { border-bottom: 1px solid var(--line); background: var(--surface); }
        .feature-list { display: grid; grid-template-columns: repeat(3, 1fr); }
        .feature { display: flex; align-items: center; gap: 12px; min-height: 58px; padding: 10px 18px 10px 0; }
        .feature-icon { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); flex: 0 0 8px; }
        .feature strong, .feature small { display: block; }
        .feature strong { font-size: .87rem; }
        .feature small { color: var(--muted); font-size: .78rem; }

        .container { margin-top: 44px; margin-bottom: 72px; }
        .page-header { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 30px; padding-bottom: 22px; border-bottom: 1px solid var(--line); }
        .page-header h2 { margin: 0 0 6px; font-size: clamp(1.9rem, 4.5vw, 2.7rem); font-weight: 500; font-style: italic; }
        .page-header p { margin: 0; color: var(--muted); font-size: .92rem; }

        .button {
            display: inline-block; padding: 11px 18px; border: 0; border-radius: 8px;
            background: var(--accent); color: #fff; cursor: pointer; font-size: .87rem; font-weight: 600;
            text-decoration: none; transition: background .15s ease;
        }
        .button:hover { background: var(--accent-dark); }
        .button-done { background: #4c7a5b; }
        .button-done:hover { background: #385c44; }
        .button-edit { background: var(--gold); }
        .button-edit:hover { background: #8a6224; }
        .button-danger { background: var(--danger); }
        .button-danger:hover { background: var(--danger-dark); }

        .task-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(270px, 1fr)); gap: 18px; }
        .task-card, .form-card, .empty {
            border: 1px solid var(--line); border-left: 4px solid var(--accent); border-radius: 10px;
            background: var(--surface); box-shadow: var(--shadow);
        }
        .task-card { padding: 22px; transition: box-shadow .2s ease; }
        .task-card:hover { box-shadow: 0 20px 46px rgba(31, 42, 36, .14); }
        .task-card h3 { margin: 0 0 10px; font-size: 1.2rem; font-style: normal; font-weight: 600; }
        .task-description { margin-bottom: 16px; color: var(--muted); line-height: 1.6; }

        .status { display: inline-block; margin-bottom: 14px; padding: 5px 10px; border-radius: 6px; font-size: .74rem; font-weight: 600; }
        .pending { background: #f4ede0; color: #8a5a1c; }
        .completed { background: #e2ede2; color: var(--accent-dark); }
        .due-date { margin-bottom: 16px; color: var(--muted); font-size: .82rem; }
        .task-actions { display: flex; flex-wrap: wrap; gap: 8px; }
        .task-actions .button { padding: 8px 12px; font-size: .75rem; }

        .empty { border-left: 4px solid var(--accent); padding: 60px 20px; text-align: center; }
        .empty h3 { margin: 0 0 10px; font-weight: 500; }
        .empty p { margin: 0 0 20px; color: var(--muted); }

        .success, .error { margin-bottom: 20px; padding: 13px 16px; border-radius: 8px; font-size: .88rem; }
        .success { background: #e2ede2; color: var(--accent-dark); }
        .error { background: #f5e6e3; color: var(--danger-dark); }

        .form-card { max-width: 640px; margin: auto; padding: 30px; border-left-width: 4px; }
        label { display: block; margin-bottom: 7px; font-size: .86rem; font-weight: 600; }
        input, textarea, select {
            width: 100%; margin-bottom: 20px; padding: 12px; border: 1px solid #cdd6cf; border-radius: 8px;
            background: #fff; color: var(--ink); font: inherit; font-family: 'Inter', Arial, sans-serif;
        }
        input:focus, textarea:focus, select:focus { border-color: var(--accent); outline: none; }

        .site-footer { display: flex; justify-content: space-between; gap: 20px; padding: 22px 0 32px; border-top: 1px solid var(--line); color: var(--muted); font-size: .78rem; }

        @media (max-width: 680px) {
            .header-inner, .container, .site-footer { width: min(100% - 28px, 1080px); }
            .nav-links { gap: 12px; }
            .nav-links a:not(.nav-cta) { display: none; }
            .feature-list { grid-template-columns: 1fr; }
            .page-header { align-items: flex-start; flex-direction: column; gap: 16px; }
            .container { margin-top: 30px; margin-bottom: 50px; }
            .form-card { padding: 22px; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="{{ url('/') }}" aria-label="Task Manager home">
                <span class="brand-mark">✓</span>
                <span>TaskManager</span>
            </a>
            <nav class="nav-links" aria-label="Primary navigation">
                <a href="{{ url('/') }}">My tasks</a>
                <a href="#features">Features</a>
                <a class="nav-cta" href="{{ route('tasks.create') }}">New task</a>
            </nav>
        </div>
    </header>

    <section class="feature-strip" id="features" aria-label="Task Manager features">
        <div class="feature-list header-inner">
            <div class="feature"><span class="feature-icon"></span><span><strong>Clear priorities</strong><small>Keep the next action visible.</small></span></div>
            <div class="feature"><span class="feature-icon"></span><span><strong>Simple progress</strong><small>Mark wins as you go.</small></span></div>
            <div class="feature"><span class="feature-icon"></span><span><strong>Made for focus</strong><small>A calm place for your list.</small></span></div>
        </div>
    </section>

    <main class="container">
        @yield('content')
    </main>

    <footer class="site-footer">
        <span>Personal Task Manager &copy; {{ date('Y') }}</span>
    </footer>
</body>
</html>

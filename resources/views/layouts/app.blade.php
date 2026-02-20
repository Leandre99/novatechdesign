<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --green:      #00e5a0;
            --green-glow: rgba(0, 229, 160, 0.15);
            --dark:       #040d0a;
            --border:     rgba(0, 229, 160, 0.14);
            --text:       #ddeee8;
            --text-muted: rgba(221, 238, 232, 0.45);
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        .ntv-navbar {
            position: fixed;
            top:0; left:0; right:0;
            z-index: 1300;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.4rem 2.5rem;
            transition: background 0.4s, padding 0.3s, border-color 0.4s;
            border-bottom: 1px solid transparent;
        }
        .ntv-navbar.scrolled {
            background: rgba(4,13,10,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 1rem 2.5rem;
            border-bottom-color: var(--border);
        }
        .ntv-logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
        }
        .ntv-logo img {
            height: 34px;
            width: auto;
            border-radius: 0;
            object-fit: contain;
            box-shadow: none;
        }

        .ntv-nav-links { display: none; }

        /* Right side: top line, accueil and burger laid out */
        .header-right { display:flex; flex-direction:column; align-items:flex-end; gap:10px; }
        .header-line { width: 240px; height: 1.6px; background: rgba(255,255,255,0.7); opacity:0.6; border-radius:2px; }
        .header-content { display:flex; align-items:center; gap:18px; }
        .nav-home {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-decoration: none;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-top: 6px;
            padding-left: 6px;
            transition: color 0.2s, transform 0.15s;
        }
        .nav-home.active, .nav-home:hover { color: var(--green); transform: translateY(-2px); }

        .ntv-nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .ntv-burger {
            display: block;
            background: none;
            border: 1px solid rgba(255,255,255,0.06);
            color: var(--text);
            font-size: 1rem;
            cursor: pointer;
            padding: 0.35rem 0.6rem;
            border-radius: 6px;
            transition: border-color 0.15s, color 0.15s, transform 0.12s;
            backdrop-filter: blur(6px);
        }
        .ntv-burger:hover { border-color: var(--green); color: var(--green); transform: translateY(-1px); }

        /* Drawer (mobile full-height panel) */
        .ntv-drawer {
            display: flex;
            position: fixed;
            right: 24px;
            top: 8vh;
            height: 84vh;
            width: 320px;
            max-width: 92vw;
            transform: translateX(120%);
            transition: transform 320ms cubic-bezier(.2,.9,.2,1);
            z-index: 1200;
            flex-direction: column;
            padding: 2.4rem 1.8rem;
            gap: 1.6rem;
            background: #eef8f9;
            color: #12233a;
            box-shadow: 0 30px 80px rgba(6,20,30,0.28);
            border-radius: 12px;
        }
        .ntv-drawer.open { transform: translateX(0); }
        .ntv-drawer.exit-top { animation: ntv-exit-top 360ms ease-in forwards; }

        @keyframes ntv-exit-top {
            from { transform: translateX(0); opacity: 1; }
            to   { transform: translateY(-120%); opacity: 0; }
        }

        .ntv-drawer-top {
            width:100%; display:flex; align-items:center; justify-content:space-between; gap:1rem;
        }
        .ntv-drawer-close {
            background: none; border: none; color: #22424f; font-size: 0.78rem; letter-spacing: 0.12em; font-weight:700; cursor:pointer;
        }
        .ntv-drawer-globe { color:#22424f; font-size:1.06rem; opacity:0.95 }

        .ntv-drawer-links { display:flex; flex-direction:column; gap:1.8rem; margin-top:1.6rem; }
        .ntv-drawer-links a { font-family:'Syne',sans-serif; font-size:1.28rem; font-weight:800; color:#3b5162; text-decoration:none; letter-spacing:0.12em; text-transform:uppercase; }
        .ntv-drawer-links a.active { color:#0f2b4a; }

        .ntv-drawer-socials { margin-top:2rem; display:flex; flex-direction:column; gap:0.6rem; color:#7b8b98; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.12em; }
        .ntv-drawer-socials a { color:inherit; text-decoration:none; }

        .ntv-drawer-cta { margin-top:1.8rem; display:flex; justify-content:center; }
        .btn-nous-ecrire-drawer { background: linear-gradient(90deg,#14153b 0%, #2e1f59 100%); color:#fff; padding:0.9rem 2.2rem; border-radius:28px; text-decoration:none; font-weight:800; letter-spacing:0.08em; box-shadow: 0 10px 30px rgba(20,20,60,0.22); }

        /* ── FOOTER ── */
        .ntv-footer {
            background: #020807;
            border-top: 1px solid var(--border);
            padding: 2rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .ntv-footer-logo { font-family:'Syne',sans-serif; font-size:0.95rem; font-weight:800; }
        .ntv-footer-logo .accent { color: var(--green); }
        .ntv-footer-links { display:flex; gap:1.5rem; }
        .ntv-footer-links a { font-size:0.72rem; color:var(--text-muted); text-decoration:none; transition:color 0.2s; }
        .ntv-footer-links a:hover { color:var(--green); }
        .ntv-footer-copy { font-size:0.7rem; color:var(--text-muted); }

        @media (max-width: 991px) {
            .ntv-nav-links { display: none; }
            .ntv-burger { display: block; }
            .ntv-socials { display: none; }
            .ntv-navbar, .ntv-navbar.scrolled { padding: 1rem 1.5rem; }
            .ntv-footer { flex-direction:column; align-items:center; text-align:center; padding:2rem 1.5rem; }
            .ntv-footer-links { justify-content:center; }
        }

        /* Floating chat button */
        .ntv-chat-button {
            position: fixed;
            right: 24px;
            bottom: 24px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg,#27435a 0%, #0f2b4a 100%);
            box-shadow: 0 12px 30px rgba(10,20,30,0.35);
            z-index: 1400;
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease;
        }
        .ntv-chat-button .ntv-chat-bubble { width: 40px; height: 40px; border-radius: 50%; display:flex; align-items:center; justify-content:center; background: rgba(255,255,255,0.12); }
        .ntv-chat-button .ntv-chat-dots { display:flex; gap:4px; align-items:center; }
        .ntv-chat-button .ntv-chat-dots span { width:6px; height:6px; background:#fff; border-radius:50%; display:inline-block; }
        .ntv-chat-button:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(10,20,30,0.45); }
    </style>

    @stack('styles')
</head>
<body>

<nav class="ntv-navbar" id="ntv-navbar">
    <a href="{{ url('/') }}" class="ntv-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </a>

    <div class="header-right">
        <div class="header-line"></div>
        <div class="header-content">
            <a href="{{ url('/') }}" class="nav-home {{ request()->is('/') ? 'active' : '' }}">Accueil</a>
            <div class="ntv-nav-right">
                <button class="ntv-burger" id="ntv-burger"><i class="bi bi-grid-3x3-gap-fill"></i></button>
            </div>
        </div>
    </div>
</nav>

<div class="ntv-drawer" id="ntv-drawer" aria-hidden="true">
    <div class="ntv-drawer-top">
        <button class="ntv-drawer-globe" aria-hidden="true"><i class="bi bi-globe"></i></button>
        <button class="ntv-drawer-close" id="ntv-drawer-close">FERMER →</button>
    </div>

    <nav class="ntv-drawer-links" aria-label="Main menu">
        <a href="{{ url('/') }}" onclick="closeDrawer()" class="{{ request()->is('/') ? 'active' : '' }}">Accueil</a>
        <a href="{{ url('/apropos') }}" onclick="closeDrawer()" class="{{ request()->is('apropos') ? 'active' : '' }}">À Propos</a>
        <a href="{{ url('/services') }}" onclick="closeDrawer()" class="{{ request()->is('services') ? 'active' : '' }}">Services</a>
        <a href="{{ url('/projets') }}" onclick="closeDrawer()" class="{{ request()->is('projets') ? 'active' : '' }}">Projets</a>
        <a href="{{ url('/recrutements') }}" onclick="closeDrawer()" class="{{ request()->is('recrutements') ? 'active' : '' }}">Recrutements</a>
        <a href="{{ url('/candidature') }}" onclick="closeDrawer()" class="{{ request()->is('candidature') ? 'active' : '' }}">Candidature SP</a>
    </nav>

    <div class="ntv-drawer-socials">
        <a href="#">Instagram</a>
        <a href="#">LinkedIn</a>
        <a href="mailto:contact@novatechvision.com">Email</a>
    </div>

    <div class="ntv-drawer-cta">
        <a href="{{ url('/contact') }}" class="btn-nous-ecrire-drawer">Nous écrire</a>
    </div>
</div>

@yield('content')

<!-- footer removed per request -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', () => {
        document.getElementById('ntv-navbar').classList.toggle('scrolled', window.scrollY > 40);
    });
    const drawer = document.getElementById('ntv-drawer');
    const burger = document.getElementById('ntv-burger');
    const drawerClose = document.getElementById('ntv-drawer-close');

    burger.addEventListener('click', () => {
        // ensure any exit animation classes removed
        drawer.classList.remove('exit-top');
        drawer.classList.add('open');
        drawer.setAttribute('aria-hidden', 'false');
    });

    function doClose() {
        // play exit-to-top animation then remove open state
        drawer.classList.remove('open');
        drawer.classList.add('exit-top');
        drawer.setAttribute('aria-hidden', 'true');
    }

    drawerClose.addEventListener('click', () => doClose());
    function closeDrawer() { doClose(); }

    // when exit animation ends, clean up classes
    drawer.addEventListener('animationend', (e) => {
        if (e.animationName === 'ntv-exit-top') {
            drawer.classList.remove('exit-top');
        }
    });
</script>

@stack('scripts')
</body>
<!-- Floating chat button -->
<a href="{{ url('/contact') }}" class="ntv-chat-button" title="Nous écrire" aria-label="Ouvrir le chat">
    <span class="ntv-chat-bubble" aria-hidden="true">
        <span class="ntv-chat-dots" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </span>
</a>
</html>
</html>
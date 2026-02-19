<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NovaTech Vision')</title>

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
            z-index: 1000;
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
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text);
            text-decoration: none;
        }
        .ntv-logo:hover { color: var(--text); }
        .ntv-logo .accent { color: var(--green); }

        .ntv-nav-links {
            display: flex;
            align-items: center;
            gap: 0.1rem;
            list-style: none;
            margin: 0; padding: 0;
        }
        .ntv-nav-links a {
            font-size: 0.71rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            padding: 0.4rem 0.8rem;
            border-radius: 2px;
            transition: color 0.2s, background 0.2s;
        }
        .ntv-nav-links a:hover,
        .ntv-nav-links a.active { color: var(--green); background: var(--green-glow); }

        .ntv-nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .ntv-socials { display: flex; align-items: center; gap: 0.65rem; }
        .ntv-socials a { color: var(--text-muted); font-size: 0.9rem; transition: color 0.2s; }
        .ntv-socials a:hover { color: var(--green); }

        .btn-nous-ecrire {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--green) !important;
            text-decoration: none;
            border: 1px solid var(--border);
            padding: 0.4rem 0.95rem;
            border-radius: 3px;
            white-space: nowrap;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-nous-ecrire:hover { background: var(--green-glow); border-color: var(--green); }

        .ntv-burger {
            display: none;
            background: none;
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.3rem 0.5rem;
            border-radius: 3px;
            transition: border-color 0.2s, color 0.2s;
        }
        .ntv-burger:hover { border-color: var(--green); color: var(--green); }

        /* Drawer */
        .ntv-drawer {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(4,13,10,0.98);
            z-index: 1100;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
        }
        .ntv-drawer.open { display: flex; }
        .ntv-drawer a {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
            transition: color 0.2s;
        }
        .ntv-drawer a:hover { color: var(--green); }
        .ntv-drawer-close {
            position: absolute;
            top: 1.5rem; right: 2rem;
            background: none; border: none;
            color: var(--text-muted);
            font-size: 1.4rem;
            cursor: pointer;
        }

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
    </style>

    @stack('styles')
</head>
<body>

<nav class="ntv-navbar" id="ntv-navbar">
    <a href="{{ url('/') }}" class="ntv-logo">Nova<span class="accent">Tech</span> Vision</a>

    <ul class="ntv-nav-links">
        <li><a href="{{ url('/') }}"               class="{{ request()->is('/') ? 'active' : '' }}">Accueil</a></li>
        <li><a href="{{ url('/apropos') }}"         class="{{ request()->is('apropos') ? 'active' : '' }}">À Propos</a></li>
        <li><a href="{{ url('/services') }}"        class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
        <li><a href="{{ url('/projets') }}"         class="{{ request()->is('projets') ? 'active' : '' }}">Projets</a></li>
        <li><a href="{{ url('/recrutements') }}"    class="{{ request()->is('recrutements') ? 'active' : '' }}">Recrutements</a></li>
        <li><a href="{{ url('/candidature') }}"     class="{{ request()->is('candidature') ? 'active' : '' }}">Candidature SP</a></li>
    </ul>

    <div class="ntv-nav-right">
        <a href="{{ url('/contact') }}" class="btn-nous-ecrire">Nous écrire</a>
        <div class="ntv-socials">
            <a href="#" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="mailto:contact@novatechvision.com" aria-label="Email"><i class="bi bi-envelope"></i></a>
        </div>
        <button class="ntv-burger" id="ntv-burger"><i class="bi bi-list"></i></button>
    </div>
</nav>

<div class="ntv-drawer" id="ntv-drawer">
    <button class="ntv-drawer-close" id="ntv-drawer-close"><i class="bi bi-x-lg"></i></button>
    <a href="{{ url('/') }}"             onclick="closeDrawer()">Accueil</a>
    <a href="{{ url('/apropos') }}"      onclick="closeDrawer()">À Propos</a>
    <a href="{{ url('/services') }}"     onclick="closeDrawer()">Services</a>
    <a href="{{ url('/projets') }}"      onclick="closeDrawer()">Projets</a>
    <a href="{{ url('/recrutements') }}" onclick="closeDrawer()">Recrutements</a>
    <a href="{{ url('/candidature') }}"  onclick="closeDrawer()">Candidature SP</a>
    <a href="{{ url('/contact') }}"      onclick="closeDrawer()">Nous écrire</a>
</div>

@yield('content')

<footer class="ntv-footer">
    <div class="ntv-footer-logo">Nova<span class="accent">Tech</span> Vision</div>
    <div class="ntv-footer-links">
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Cookies</a>
    </div>
    <div class="ntv-footer-copy">© {{ date('Y') }} NovaTech Vision. Tous droits réservés.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', () => {
        document.getElementById('ntv-navbar').classList.toggle('scrolled', window.scrollY > 40);
    });
    document.getElementById('ntv-burger').addEventListener('click', () => {
        document.getElementById('ntv-drawer').classList.add('open');
    });
    document.getElementById('ntv-drawer-close').addEventListener('click', () => {
        document.getElementById('ntv-drawer').classList.remove('open');
    });
    function closeDrawer() { document.getElementById('ntv-drawer').classList.remove('open'); }
</script>

@stack('scripts')
</body>
</html>
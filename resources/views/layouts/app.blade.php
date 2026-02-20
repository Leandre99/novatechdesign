<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NovaTech Vision')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;1,9..40,300&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --green:      #00ffb2;
            --green-dim:  #00c98a;
            --green-glow: rgba(0, 255, 178, 0.15);
            --dark:       #03080f;
            --dark-2:     #060e18;
            --text:       #e8f0ec;
            --text-muted: rgba(232, 240, 236, 0.5);
            --border:     rgba(0, 255, 178, 0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        .ntv-navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.4rem 3rem;
            transition: background 0.4s, padding 0.3s, border 0.4s;
        }
        .ntv-navbar.scrolled {
            background: rgba(3, 8, 15, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 1rem 3rem;
            border-bottom: 1px solid var(--border);
        }

        /* Logo */
        .ntv-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text);
            text-decoration: none;
        }
        .ntv-logo .accent { color: var(--green); }
        .ntv-logo:hover { color: var(--text); }

        /* Nav links */
        .ntv-nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
            margin: 0; padding: 0;
        }
        .ntv-nav-links a {
            font-size: 0.75rem;
            font-weight: 400;
            color: var(--text-muted);
            text-decoration: none;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: color 0.2s;
        }
        .ntv-nav-links a:hover,
        .ntv-nav-links a.active { color: var(--green); }

        /* Actions droite */
        .ntv-nav-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .btn-ecrire {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--green) !important;
            text-decoration: none;
            border: 1px solid var(--border);
            padding: 0.45rem 1.1rem;
            border-radius: 2px;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-ecrire:hover { background: var(--green-glow); }

        .ntv-socials {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .ntv-socials a {
            color: var(--text-muted);
            font-size: 1rem;
            transition: color 0.2s;
            display: flex;
        }
        .ntv-socials a:hover { color: var(--green); }

        /* Burger */
        .ntv-burger {
            display: none;
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.4rem;
            cursor: pointer;
            padding: 4px;
        }

        /* Mobile drawer */
        .ntv-drawer {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(3, 8, 15, 0.97);
            z-index: 999;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2.5rem;
        }
        .ntv-drawer.open { display: flex; }
        .ntv-drawer a {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
            letter-spacing: 0.04em;
            transition: color 0.2s;
        }
        .ntv-drawer a:hover { color: var(--green); }
        .ntv-drawer-close {
            position: absolute;
            top: 1.5rem; right: 2rem;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.6rem;
            cursor: pointer;
        }

        /* ── FOOTER ── */
        .ntv-footer {
            background: var(--dark-2);
            border-top: 1px solid var(--border);
            padding: 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .ntv-footer-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text);
        }
        .ntv-footer-logo .accent { color: var(--green); }
        .ntv-footer-links {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .ntv-footer-links a {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-decoration: none;
            letter-spacing: 0.06em;
            transition: color 0.2s;
        }
        .ntv-footer-links a:hover { color: var(--green); }
        .ntv-footer-copy {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        @media (max-width: 991px) {
            .ntv-nav-links { display: none; }
            .ntv-burger { display: block; }
            .ntv-socials { display: none; }
            .ntv-navbar { padding: 1.2rem 1.5rem; }
            .ntv-navbar.scrolled { padding: 1rem 1.5rem; }
            .ntv-footer { flex-direction: column; text-align: center; padding: 2rem 1.5rem; }
            .ntv-footer-links { justify-content: center; }
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- ── NAVBAR ── --}}
<nav class="ntv-navbar" id="ntv-navbar">
    <a href="{{ url('/') }}" class="ntv-logo">Nova<span class="accent">Tech</span> Vision</a>

    <ul class="ntv-nav-links">
        <li><a href="{{ url('/') }}"           class="{{ request()->is('/') ? 'active' : '' }}">Accueil</a></li>
        <li><a href="{{ url('/apropos') }}"    class="{{ request()->is('apropos') ? 'active' : '' }}">À Propos</a></li>
        <li><a href="{{ url('/services') }}"   class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
        <li><a href="{{ url('/projets') }}"    class="{{ request()->is('projets') ? 'active' : '' }}">Projets</a></li>
        <li><a href="{{ url('/recrutements') }}" class="{{ request()->is('recrutements') ? 'active' : '' }}">Recrutements</a></li>
        <li><a href="{{ url('/candidature') }}" class="{{ request()->is('candidature') ? 'active' : '' }}">Candidature SP</a></li>
    </ul>

    <div class="ntv-nav-actions">
        <a href="{{ url('/contact') }}" class="btn-ecrire">Nous écrire</a>
        <div class="ntv-socials">
            <a href="#" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="mailto:contact@novatechvision.com" aria-label="Email"><i class="bi bi-envelope"></i></a>
        </div>
        <button class="ntv-burger" id="ntv-burger" aria-label="Ouvrir menu">
            <i class="bi bi-list"></i>
        </button>
    </div>
</nav>

{{-- ── DRAWER MOBILE ── --}}
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

{{-- ── CONTENU ── --}}
@yield('content')

{{-- ── FOOTER ── --}}
<footer class="ntv-footer">
    <div class="ntv-footer-logo">Nova<span class="accent">Tech</span> Vision</div>
    <div class="ntv-footer-links">
        <a href="{{ url('/mentions-legales') }}">Terms</a>
        <a href="{{ url('/confidentialite') }}">Privacy</a>
        <a href="{{ url('/cookies') }}">Cookies</a>
    </div>
    <div class="ntv-footer-copy">© {{ date('Y') }} NovaTech Vision. Tous droits réservés.</div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Navbar scroll
    const navbar = document.getElementById('ntv-navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    });

    // Burger / Drawer
    const burger = document.getElementById('ntv-burger');
    const drawer = document.getElementById('ntv-drawer');
    const drawerClose = document.getElementById('ntv-drawer-close');

    burger.addEventListener('click', () => drawer.classList.add('open'));
    drawerClose.addEventListener('click', () => drawer.classList.remove('open'));

    function closeDrawer() { drawer.classList.remove('open'); }
</script>

@stack('scripts')

</body>
</html>
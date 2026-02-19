@extends('layouts.app')

@section('title', 'NovaTech Vision — L\'Intelligence Artificielle au Cœur de l\'Industrie')

@push('styles')
<style>

    /* ══════════════════════════════════════════
       HERO SECTION
    ══════════════════════════════════════════ */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #040d0a;
    }

    /* ── Fond : cercles lumineux verts (fidèle au PDF) ── */
    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
    }

    /* Grand cercle vert central-droite */
    .hero-bg::before {
        content: '';
        position: absolute;
        top: 50%;
        right: -5%;
        transform: translateY(-50%);
        width: 700px;
        height: 700px;
        border-radius: 50%;
        background: radial-gradient(circle,
            rgba(0, 200, 130, 0.22) 0%,
            rgba(0, 140, 90, 0.10) 40%,
            transparent 70%
        );
    }

    /* Cercle vert plus petit en haut gauche */
    .hero-bg::after {
        content: '';
        position: absolute;
        top: -10%;
        left: -5%;
        width: 450px;
        height: 450px;
        border-radius: 50%;
        background: radial-gradient(circle,
            rgba(0, 180, 110, 0.12) 0%,
            transparent 65%
        );
    }

    /* Orbe supplémentaire bas-gauche */
    .hero-orb-bottom {
        position: absolute;
        bottom: -8%;
        left: 20%;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        background: radial-gradient(circle,
            rgba(0, 160, 100, 0.10) 0%,
            transparent 65%
        );
        pointer-events: none;
        z-index: 0;
    }

    /* Grille très subtile */
    .hero-grid {
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image:
            linear-gradient(rgba(0,229,160,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,229,160,0.025) 1px, transparent 1px);
        background-size: 55px 55px;
        pointer-events: none;
    }

    /* Ligne horizontale décorative fine */
    .hero-line {
        position: absolute;
        left: 0; right: 0;
        top: 50%;
        height: 1px;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0,229,160,0.06) 30%,
            rgba(0,229,160,0.12) 50%,
            rgba(0,229,160,0.06) 70%,
            transparent 100%
        );
        pointer-events: none;
        z-index: 0;
    }

    /* ── Layout 2 colonnes ── */
    .hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        min-height: 100vh;
    }

    /* ── Colonne gauche : texte ── */
    .hero-left {
        flex: 0 0 52%;
        max-width: 52%;
        padding-top: 2rem;
    }

    /* Sous-titre introductif */
    .hero-intro {
        font-size: 0.78rem;
        font-weight: 400;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--green);
        margin-bottom: 1.5rem;
        opacity: 0;
        animation: fadeUp 0.6s ease 0.2s forwards;
    }

    /* Titre principal */
    .hero-title {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.6rem, 4.5vw, 4.2rem);
        font-weight: 800;
        line-height: 1.06;
        letter-spacing: -0.025em;
        color: #fff;
        margin-bottom: 1.6rem;
    }
    .hero-title .line {
        display: block;
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.65s ease, transform 0.65s ease;
    }
    .hero-title .line.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .hero-title .line-1 { transition-delay: 0.3s; }
    .hero-title .line-2 { transition-delay: 0.45s; }
    .hero-title .line-3 { transition-delay: 0.6s; }

    /* Texte description */
    .hero-desc {
        font-size: 0.97rem;
        font-weight: 300;
        line-height: 1.75;
        color: var(--text-muted);
        margin-bottom: 2.4rem;
        opacity: 0;
        animation: fadeUp 0.6s ease 0.95s forwards;
    }

    /* Bouton CTA */
    .hero-cta {
        opacity: 0;
        animation: fadeUp 0.6s ease 1.1s forwards;
    }
    .btn-savoir-plus {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        background: var(--green);
        color: #030f09 !important;
        font-family: 'Syne', sans-serif;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-decoration: none;
        padding: 0.9rem 2rem;
        border-radius: 3px;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .btn-savoir-plus::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(255,255,255,0.12);
        opacity: 0;
        transition: opacity 0.2s;
    }
    .btn-savoir-plus:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 35px rgba(0, 229, 160, 0.35);
    }
    .btn-savoir-plus:hover::before { opacity: 1; }
    .btn-savoir-plus i { transition: transform 0.2s; }
    .btn-savoir-plus:hover i { transform: translateX(4px); }

    /* Lien secondaire "En savoir plus" */
    .hero-link-more {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.8rem;
        color: var(--text-muted);
        text-decoration: none;
        margin-left: 1.2rem;
        transition: color 0.2s;
    }
    .hero-link-more:hover { color: var(--green); }

    /* ── Colonne droite : image ── */
    .hero-right {
        flex: 0 0 45%;
        max-width: 45%;
        position: relative;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        align-self: stretch;
    }

    /* Halo vert derrière l'image */
    .hero-right::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 85%;
        height: 75%;
        border-radius: 50%;
        background: radial-gradient(ellipse at center bottom,
            rgba(0, 200, 120, 0.28) 0%,
            rgba(0, 150, 90, 0.12) 45%,
            transparent 70%
        );
        filter: blur(30px);
        z-index: 0;
    }

    /* Halo orange/chaleur (fidèle à l'image) */
    .hero-right::after {
        content: '';
        position: absolute;
        top: 20%;
        right: 5%;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(circle,
            rgba(200, 80, 0, 0.12) 0%,
            transparent 70%
        );
        filter: blur(20px);
        z-index: 0;
    }

    .hero-img {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 480px;
        height: 100%;
        max-height: 85vh;
        object-fit: contain;
        object-position: bottom center;
        display: block;
        /* Fondu vers le bas pour intégrer l'image */
        mask-image: linear-gradient(
            to top,
            transparent 0%,
            rgba(0,0,0,0.3) 8%,
            black 20%,
            black 100%
        );
        -webkit-mask-image: linear-gradient(
            to top,
            transparent 0%,
            rgba(0,0,0,0.3) 8%,
            black 20%,
            black 100%
        );
        opacity: 0;
        animation: fadeIn 1.2s ease 0.5s forwards;
        filter: brightness(0.92) contrast(1.05);
    }

    /* Sous-texte en bas du hero */
    .hero-bottom-text {
        position: absolute;
        bottom: 3rem;
        left: 0;
        right: 0;
        z-index: 2;
        text-align: center;
        opacity: 0;
        animation: fadeUp 0.6s ease 1.4s forwards;
    }
    .hero-bottom-text p {
        font-size: 0.82rem;
        font-weight: 300;
        color: var(--text-muted);
        letter-spacing: 0.03em;
        max-width: 520px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Scroll indicator */
    .scroll-hint {
        position: absolute;
        bottom: 2rem;
        right: 2.5rem;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.4rem;
        opacity: 0;
        animation: fadeIn 1s ease 1.8s forwards;
    }
    .scroll-hint span {
        font-size: 0.6rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--text-muted);
        writing-mode: vertical-lr;
    }
    .scroll-hint-line {
        width: 1px;
        height: 40px;
        background: linear-gradient(to bottom, var(--green), transparent);
        animation: scrollLine 2s ease-in-out infinite;
    }
    @keyframes scrollLine {
        0%   { opacity: 1; height: 40px; }
        100% { opacity: 0; height: 10px; }
    }

    /* ── Animations ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* ══════════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════════ */
    @media (max-width: 991px) {
        .hero-inner {
            flex-direction: column-reverse;
            justify-content: flex-end;
            padding: 7rem 1.5rem 3rem;
            gap: 0;
            min-height: 100vh;
        }
        .hero-left, .hero-right {
            flex: unset;
            max-width: 100%;
            width: 100%;
        }
        .hero-left { text-align: center; padding-top: 0; }
        .hero-right {
            height: 45vw;
            min-height: 220px;
            max-height: 320px;
        }
        .hero-img { max-height: 100%; }
        .hero-cta { display: flex; justify-content: center; flex-wrap: wrap; gap: 0.5rem; }
        .hero-link-more { margin-left: 0; }
        .hero-bottom-text { display: none; }
        .scroll-hint { display: none; }
        .hero-bg::before { width: 350px; height: 350px; right: -10%; }
    }

    @media (max-width: 576px) {
        .hero-title { font-size: 2.2rem; }
    }
</style>
@endpush

@section('content')

<section class="hero">

    {{-- Fonds décoratifs --}}
    <div class="hero-bg"></div>
    <div class="hero-orb-bottom"></div>
    <div class="hero-grid"></div>
    <div class="hero-line"></div>

    <div class="hero-inner">

        {{-- ── Colonne GAUCHE : texte ── --}}
        <div class="hero-left">

            <p class="hero-intro">L'innovation technologique</p>

            <h1 class="hero-title">
                <span class="line line-1">L'Intelligence</span>
                <span class="line line-2">Artificielle au</span>
                <span class="line line-3">Cœur de l'Industrie.</span>
            </h1>

            <p class="hero-desc">
                Là où l'innovation technologique transforme<br>
                les défis industriels en véritables opportunités.
            </p>

            <div class="hero-cta">
                <a href="{{ url('/apropos') }}" class="btn-savoir-plus">
                    En savoir plus <i class="bi bi-arrow-right"></i>
                </a>
                <a href="{{ url('/contact') }}" class="hero-link-more">
                    Obtenir une offre <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>

        </div>

        {{-- ── Colonne DROITE : image ── --}}
        <div class="hero-right">
            <img
                src="{{ asset('images/hero-ai.png') }}"
                alt="Intelligence Artificielle NovaTech Vision"
                class="hero-img"
            >
        </div>

    </div>

    {{-- Scroll hint --}}
    <div class="scroll-hint">
        <div class="scroll-hint-line"></div>
        <span>Scroll</span>
    </div>

</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Animation titre ligne par ligne
    setTimeout(() => {
        document.querySelectorAll('.hero-title .line').forEach(el => {
            el.classList.add('visible');
        });
    }, 100);
});
</script>
@endpush
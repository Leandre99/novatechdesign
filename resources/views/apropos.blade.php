@extends('layouts.app')

@section('title', 'À Propos — NovaTech Vision')

@push('styles')
<style>

    /* ══════════════════════════════════════════
       PAGE À PROPOS
    ══════════════════════════════════════════ */
    .apropos-page {
        /* Background image + dark overlay */
        background: linear-gradient(rgba(2,7,6,0.72), rgba(2,7,6,0.72)), url('{{ asset("images/hero-ai.png") }}') center left / cover no-repeat;
        min-height: 100vh;
        overflow: hidden;
        position: relative;
    }

    /* ── Fond décoratif commun ── */
    .section-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }
    .section-bg .orb-tl {
        position: absolute;
        top: -8%; left: -5%;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle,
            rgba(0,200,130,0.14) 0%, transparent 65%);
    }
    .section-bg .orb-br {
        position: absolute;
        bottom: -10%; right: -5%;
        width: 450px; height: 450px;
        border-radius: 50%;
        background: radial-gradient(circle,
            rgba(0,180,110,0.10) 0%, transparent 65%);
    }
    .section-bg .grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(0,229,160,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,229,160,0.025) 1px, transparent 1px);
        background-size: 55px 55px;
    }

    /* ════════════════════════════════
       SECTION HERO À PROPOS
    ════════════════════════════════ */
    .apropos-hero {
        position: relative;
        padding: 10rem 2.5rem 5rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Grand "5" décoratif */
    .big-number {
        position: absolute;
        top: 5rem;
        left: -1.5rem;
        font-family: 'Syne', sans-serif;
        font-size: clamp(14rem, 22vw, 22rem);
        font-weight: 800;
        line-height: 1;
        color: transparent;
        -webkit-text-stroke: 1px rgba(0, 229, 160, 0.12);
        pointer-events: none;
        user-select: none;
        z-index: 0;
        letter-spacing: -0.05em;
    }

    .apropos-hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
        margin-left: auto;
    }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--green);
        margin-bottom: 1.2rem;
    }
    .section-label::before {
        content: '';
        display: block;
        width: 28px; height: 1px;
        background: var(--green);
        opacity: 0.6;
    }

    .apropos-hero-title {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2rem, 4vw, 3.4rem);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.025em;
        color: #fff;
        margin-bottom: 1.2rem;
    }

    .apropos-hero-sub {
        font-size: 0.95rem;
        font-weight: 300;
        line-height: 1.75;
        color: var(--text-muted);
        max-width: 540px;
    }

    /* ════════════════════════════════
       5 PILIERS
    ════════════════════════════════ */
    .piliers-section {
        position: relative;
        padding: 2rem 2.5rem 6rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Ligne verticale gauche */
    .piliers-line {
        position: absolute;
        left: 2.5rem;
        top: 0; bottom: 0;
        width: 1px;
        background: linear-gradient(to bottom,
            transparent 0%,
            rgba(0,229,160,0.2) 15%,
            rgba(0,229,160,0.2) 85%,
            transparent 100%
        );
    }

    .pilier-item {
        display: grid;
        grid-template-columns: 48px 1fr;
        gap: 0 2rem;
        padding: 3rem 0 3rem 2rem;
        border-bottom: 1px solid rgba(0,229,160,0.07);
        position: relative;
        transition: background 0.3s;
    }
    .pilier-item:last-child { border-bottom: none; }
    .pilier-item:hover { background: rgba(0,229,160,0.02); }

    /* Numéro du pilier */
    .pilier-num {
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--green);
        letter-spacing: 0.1em;
        padding-top: 0.3rem;
        opacity: 0.7;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }
    .pilier-num::after {
        content: '';
        display: block;
        width: 1px;
        height: 30px;
        background: linear-gradient(to bottom, rgba(0,229,160,0.3), transparent);
    }

    /* Contenu pilier */
    .pilier-body {}

    .pilier-tag {
        display: inline-block;
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--green);
        background: rgba(0,229,160,0.08);
        border: 1px solid rgba(0,229,160,0.18);
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        margin-bottom: 0.9rem;
    }

    .pilier-title {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.3rem, 2.5vw, 1.9rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
    }

    .pilier-text {
        font-size: 0.92rem;
        font-weight: 300;
        line-height: 1.8;
        color: var(--text-muted);
        max-width: 680px;
    }

    /* Mission : liste avec puces vertes */
    .pilier-list {
        list-style: none;
        padding: 0; margin: 1rem 0 0;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }
    .pilier-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.7rem;
        font-size: 0.88rem;
        font-weight: 300;
        color: var(--text-muted);
        line-height: 1.6;
    }
    .pilier-list li::before {
        content: '';
        display: block;
        flex-shrink: 0;
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--green);
        margin-top: 0.5rem;
        box-shadow: 0 0 6px rgba(0,229,160,0.5);
    }

    /* ════════════════════════════════
       POURQUOI NOUS CHOISIR
    ════════════════════════════════ */
    .pourquoi-section {
        position: relative;
        background: linear-gradient(180deg, #040d0a 0%, #050f0b 100%);
        border-top: 1px solid rgba(0,229,160,0.08);
        padding: 6rem 2.5rem;
        overflow: hidden;
    }
    .pourquoi-bg-orb {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 700px; height: 400px;
        border-radius: 50%;
        background: radial-gradient(ellipse,
            rgba(0,200,130,0.08) 0%, transparent 65%);
        pointer-events: none;
    }

    .pourquoi-inner {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
    }

    .pourquoi-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .pourquoi-title {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.025em;
        margin-bottom: 0.8rem;
    }
    .pourquoi-sub {
        font-size: 0.9rem;
        color: var(--text-muted);
        font-weight: 300;
    }

    /* Cartes */
    .pourquoi-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .pourquoi-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 8px;
        padding: 2.2rem 2rem;
        transition: border-color 0.3s, background 0.3s, transform 0.3s;
        position: relative;
        overflow: hidden;
    }
    .pourquoi-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg,
            transparent, var(--green), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .pourquoi-card:hover {
        border-color: rgba(0,229,160,0.25);
        background: rgba(0,229,160,0.03);
        transform: translateY(-4px);
    }
    .pourquoi-card:hover::before { opacity: 1; }

    .card-icon {
        width: 48px; height: 48px;
        border-radius: 10px;
        background: rgba(0,229,160,0.08);
        border: 1px solid rgba(0,229,160,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.4rem;
        font-size: 1.2rem;
        color: var(--green);
        transition: background 0.3s;
    }
    .pourquoi-card:hover .card-icon {
        background: rgba(0,229,160,0.14);
    }

    .card-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.8rem;
        letter-spacing: -0.01em;
    }

    .card-text {
        font-size: 0.85rem;
        font-weight: 300;
        line-height: 1.75;
        color: var(--text-muted);
    }

    /* Bouton partenaires */
    .btn-partenaires {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 3rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--green);
        text-decoration: none;
        border: 1px solid rgba(0,229,160,0.25);
        padding: 0.7rem 1.5rem;
        border-radius: 3px;
        transition: background 0.2s, border-color 0.2s;
    }
    .btn-partenaires:hover {
        background: rgba(0,229,160,0.07);
        border-color: var(--green);
        color: var(--green);
    }

    /* ── Animations scroll ── */
    .reveal {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.65s ease, transform 0.65s ease;
    }
    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── Responsive ── */
    @media (max-width: 991px) {
        .apropos-hero { padding: 8rem 1.5rem 3rem; }
        .piliers-section { padding: 2rem 1.5rem 4rem; }
        .pilier-item { grid-template-columns: 36px 1fr; gap: 0 1.2rem; padding: 2.2rem 0 2.2rem 1rem; }
        .big-number { font-size: 10rem; left: -0.5rem; }
        .pourquoi-section { padding: 4rem 1.5rem; }
        .pourquoi-cards { grid-template-columns: 1fr; gap: 1rem; }
    }
    @media (max-width: 576px) {
        .big-number { display: none; }
        .apropos-hero-content { margin-left: 0; }
    }

    /* Scroll top & bottom links */
    .apropos-scroll-top {
        position: fixed;
        left: calc(50% + 360px);
        bottom: 40px;
        width: 44px; height: 44px; border-radius: 50%;
        display: flex; align-items:center; justify-content:center;
        background: rgba(0,0,0,0.45); color: #fff; border: 1px solid rgba(255,255,255,0.06);
        z-index: 1400; cursor: pointer; backdrop-filter: blur(6px);
    }
    .apropos-scroll-top:hover { transform: translateY(-4px); }

    .apropos-bottom-links { position: fixed; left: 20px; bottom: 18px; z-index:1300; display:flex; gap:18px; align-items:center; color:var(--text-muted); }
    .apropos-bottom-links .bottom-left a { color: rgba(255,255,255,0.6); margin-right: 12px; font-size:0.85rem; text-decoration:none; }
    .apropos-bottom-links .bottom-right a { color: rgba(255,255,255,0.6); margin-left: 8px; }

    @media (max-width: 991px) {
        .apropos-scroll-top { left: auto; right: 24px; }
        .apropos-bottom-links { left: 12px; bottom: 12px; }
    }
</style>
@endpush

@section('content')
<div class="apropos-page">

    {{-- ════ HERO À PROPOS ════ --}}
    <section style="position:relative; overflow:hidden;">
        <div class="section-bg">
            <div class="orb-tl"></div>
            <div class="grid"></div>
        </div>

        <div class="apropos-hero">
            {{-- Grand "5" décoratif --}}
            <div class="big-number">5</div>

            <div class="apropos-hero-content reveal">
                <div class="section-label">À Propos de NovaTech Vision</div>
                <h1 class="apropos-hero-title">
                    Tout ce qu'il faut savoir sur<br>
                    NovaTech Vision à travers<br>
                    <span style="color: var(--green);">5 piliers fondamentaux</span>
                </h1>
                <p class="apropos-hero-sub">
                    Qui définissent notre identité et notre vision.
                </p>
            </div>
        </div>
    </section>

    {{-- ════ 5 PILIERS ════ --}}
    <section style="position:relative;">
        <div class="section-bg">
            <div class="orb-br"></div>
            <div class="grid"></div>
        </div>

        <div class="piliers-section">
            <div class="piliers-line"></div>

            {{-- 01 - Qui sommes-nous ? --}}
            <div class="pilier-item reveal">
                <div class="pilier-num">01</div>
                <div class="pilier-body">
                    <span class="pilier-tag">Qui sommes-nous ?</span>
                    <h2 class="pilier-title">Notre Équipe</h2>
                    <p class="pilier-text">
                        Fondée et dirigée par une équipe passionnée, NovaTech Vision réunit des designers
                        et experts du numérique animés par une même ambition : innover utilement.
                        L'entreprise conçoit des solutions numériques avancées, performantes et évolutives,
                        capables de transformer durablement la manière dont les organisations utilisent
                        la technologie face aux défis d'aujourd'hui et de demain.
                    </p>
                </div>
            </div>

            {{-- 02 - Notre Vision --}}
            <div class="pilier-item reveal">
                <div class="pilier-num">02</div>
                <div class="pilier-body">
                    <span class="pilier-tag">Notre Vision</span>
                    <h2 class="pilier-title">Devenir un acteur de référence</h2>
                    <p class="pilier-text">
                        Devenir un acteur de référence des infrastructures technologiques fiables et critiques,
                        en concevant des solutions numériques sans compromis qui combinent performance industrielle,
                        sécurité et agilité numérique.
                        <br><br>
                        Placer l'intégrité, l'excellence et l'innovation au cœur de chaque décision afin de
                        transformer la technologie en un moteur invisible mais essentiel de la réussite
                        économique durable des entreprises.
                    </p>
                </div>
            </div>

            {{-- 03 - Nos Valeurs --}}
            <div class="pilier-item reveal">
                <div class="pilier-num">03</div>
                <div class="pilier-body">
                    <span class="pilier-tag">Nos Valeurs</span>
                    <h2 class="pilier-title">Intégrité · Excellence · Innovation</h2>
                    <p class="pilier-text">
                        Nos valeurs reposent sur l'intégrité, l'excellence et l'innovation. Nous agissons
                        avec transparence et responsabilité afin de bâtir des relations de confiance durables.
                        Nous visons en permanence les plus hauts standards de qualité et de fiabilité,
                        en appliquant une rigueur technique et opérationnelle à chaque projet.
                        <br><br>
                        Nous plaçons l'innovation au cœur de notre démarche, en intégrant des technologies
                        modernes et éprouvées pour concevoir des solutions évolutives, capables d'anticiper
                        les besoins et les enjeux futurs des entreprises.
                    </p>
                </div>
            </div>

            {{-- 04 - Notre Mission --}}
            <div class="pilier-item reveal">
                <div class="pilier-num">04</div>
                <div class="pilier-body">
                    <span class="pilier-tag">Notre Mission</span>
                    <h2 class="pilier-title">Transformer le paysage technologique africain</h2>
                    <p class="pilier-text">
                        Transformer le paysage technologique africain en créant des solutions innovantes
                        qui améliorent concrètement la qualité de vie et l'efficacité des entreprises.
                        Nous croyons fermement que la technologie doit être accessible, intuitive et
                        capable de résoudre des problèmes complexes.
                    </p>
                    <ul class="pilier-list">
                        <li>Démocratiser l'accès aux technologies de pointe pour toutes les entreprises</li>
                        <li>Accompagner nos clients dans leur transformation digitale avec expertise et proximité</li>
                        <li>Garantir des solutions durables, évolutives et adaptées au contexte local</li>
                        <li>Former et développer les compétences technologiques au Bénin</li>
                    </ul>
                </div>
            </div>

            {{-- 05 - Pourquoi nous choisir (aperçu) --}}
            <div class="pilier-item reveal">
                <div class="pilier-num">05</div>
                <div class="pilier-body">
                    <span class="pilier-tag">Pourquoi nous choisir ?</span>
                    <h2 class="pilier-title">Ce qui nous distingue</h2>
                    <p class="pilier-text">
                        Des certifications mondiales, un support local disponible 24h/24 et une fiabilité
                        industrielle éprouvée. Découvrez les 3 engagements qui font de NovaTech Vision
                        un partenaire de confiance pour votre transformation digitale.
                    </p>
                </div>
            </div>

        </div>
    </section>

    {{-- ════ POURQUOI NOUS CHOISIR ════ --}}
    <section class="pourquoi-section">
        <div class="pourquoi-bg-orb"></div>

        <div class="pourquoi-inner">

            <div class="pourquoi-header reveal">
                <div class="section-label" style="justify-content:center;">Pourquoi nous choisir ?</div>
                <h2 class="pourquoi-title">Nos 3 engagements</h2>
                <p class="pourquoi-sub">Des garanties concrètes pour votre transformation digitale</p>
            </div>

            <div class="pourquoi-cards">

                {{-- Carte 1 --}}
                <div class="pourquoi-card reveal">
                    <div class="card-icon">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <div class="card-title">Certifications Mondiales</div>
                    <p class="card-text">
                        Nos ingénieurs sont formés et certifiés par les plus grands constructeurs
                        : Cisco, HP, Dell. Une expertise reconnue internationalement au service de vos projets.
                    </p>
                </div>

                {{-- Carte 2 --}}
                <div class="pourquoi-card reveal">
                    <div class="card-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div class="card-title">Support Local 24/7</div>
                    <p class="card-text">
                        Une présence physique à Cotonou pour des interventions rapides et un support
                        de proximité. Disponibles à toute heure pour garantir la continuité de vos opérations.
                    </p>
                </div>

                {{-- Carte 3 --}}
                <div class="pourquoi-card reveal">
                    <div class="card-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="card-title">Fiabilité Industrielle</div>
                    <p class="card-text">
                        Nous concevons des systèmes redondants pour garantir zéro temps d'arrêt
                        pour vos opérations. Une infrastructure robuste pensée pour les environnements critiques.
                    </p>
                </div>

            </div>

            <div class="text-center reveal" style="margin-top: 3rem;">
                <a href="{{ url('/partenaires') }}" class="btn-partenaires">
                    Découvrir nos partenaires <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </section>

</div>
    <!-- Scroll to top button + bottom links -->
    <button id="apropos-scroll-top" class="apropos-scroll-top" aria-label="Remonter">↑</button>
    <footer class="apropos-bottom-links" aria-hidden="false">
        <div class="bottom-left">
            <a href="#">Terms</a>
            <a href="#">Privacy</a>
            <a href="#">Cookies</a>
        </div>
        <div class="bottom-right">
            <a href="#" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="#" title="Twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
        </div>
    </footer>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Intersection Observer pour les animations au scroll
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                // Délai progressif pour les éléments groupés
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    reveals.forEach(el => observer.observe(el));
});
</script>
@endpush

@push('scripts')
<script>
// Scroll to top behavior
document.getElementById('apropos-scroll-top')?.addEventListener('click', function (){
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
@endpush
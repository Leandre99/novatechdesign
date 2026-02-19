@extends('layouts.app')

@section('title', 'Services — NovaTech Vision')

@push('styles')
<style>
    .services-page { background: #040d0a; min-height: 100vh; }

    /* ── Fond déco ── */
    .s-bg {
        position: absolute; inset: 0;
        pointer-events: none; z-index: 0; overflow: hidden;
    }
    .s-bg .orb-1 {
        position: absolute; top: -10%; right: -5%;
        width: 550px; height: 550px; border-radius: 50%;
        background: radial-gradient(circle, rgba(0,200,130,0.16) 0%, transparent 65%);
    }
    .s-bg .orb-2 {
        position: absolute; bottom: 10%; left: -8%;
        width: 420px; height: 420px; border-radius: 50%;
        background: radial-gradient(circle, rgba(0,160,100,0.10) 0%, transparent 65%);
    }
    .s-bg .grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(0,229,160,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,229,160,0.025) 1px, transparent 1px);
        background-size: 55px 55px;
    }

    /* ── Hero Services ── */
    .services-hero {
        position: relative; z-index: 2;
        padding: 10rem 2.5rem 5rem;
        max-width: 1200px; margin: 0 auto;
        text-align: center;
    }
    .section-label {
        display: inline-flex; align-items: center; gap: 0.6rem;
        font-size: 0.7rem; font-weight: 500; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--green);
        margin-bottom: 1.2rem; justify-content: center;
    }
    .section-label::before, .section-label::after {
        content: ''; display: block;
        width: 24px; height: 1px;
        background: var(--green); opacity: 0.5;
    }
    .services-hero h1 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.2rem, 4.5vw, 3.8rem);
        font-weight: 800; line-height: 1.08;
        letter-spacing: -0.025em; color: #fff;
        margin-bottom: 1.2rem;
    }
    .services-hero p {
        font-size: 0.97rem; font-weight: 300;
        line-height: 1.75; color: var(--text-muted);
        max-width: 560px; margin: 0 auto;
    }

    /* ── Grille services ── */
    .services-grid-section {
        position: relative; z-index: 2;
        padding: 0 2.5rem 6rem;
        max-width: 1200px; margin: 0 auto;
    }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .service-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 10px;
        padding: 2.5rem 2.2rem;
        position: relative; overflow: hidden;
        transition: border-color 0.3s, background 0.3s, transform 0.3s;
        cursor: default;
    }
    .service-card::after {
        content: '';
        position: absolute; top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--green), transparent);
        opacity: 0; transition: opacity 0.3s;
    }
    .service-card:hover {
        border-color: rgba(0,229,160,0.28);
        background: rgba(0,229,160,0.03);
        transform: translateY(-5px);
    }
    .service-card:hover::after { opacity: 1; }

    /* Numéro décoratif */
    .service-num {
        position: absolute; top: 1.5rem; right: 2rem;
        font-family: 'Syne', sans-serif;
        font-size: 3.5rem; font-weight: 800;
        color: transparent;
        -webkit-text-stroke: 1px rgba(0,229,160,0.1);
        line-height: 1; user-select: none;
    }

    .service-icon {
        width: 52px; height: 52px;
        border-radius: 12px;
        background: rgba(0,229,160,0.08);
        border: 1px solid rgba(0,229,160,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; color: var(--green);
        margin-bottom: 1.5rem;
        transition: background 0.3s;
    }
    .service-card:hover .service-icon { background: rgba(0,229,160,0.14); }

    .service-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.15rem; font-weight: 700;
        color: #fff; margin-bottom: 0.9rem;
        letter-spacing: -0.01em;
    }
    .service-text {
        font-size: 0.88rem; font-weight: 300;
        line-height: 1.78; color: var(--text-muted);
        margin-bottom: 1.5rem;
    }
    .service-features {
        list-style: none; padding: 0; margin: 0;
        display: flex; flex-direction: column; gap: 0.5rem;
    }
    .service-features li {
        display: flex; align-items: center; gap: 0.6rem;
        font-size: 0.82rem; color: var(--text-muted); font-weight: 300;
    }
    .service-features li i {
        color: var(--green); font-size: 0.7rem; flex-shrink: 0;
    }

    /* ── CTA Section ── */
    .services-cta {
        position: relative; z-index: 2;
        background: linear-gradient(135deg,
            rgba(0,229,160,0.06) 0%,
            rgba(0,0,0,0) 50%,
            rgba(0,229,160,0.04) 100%);
        border-top: 1px solid rgba(0,229,160,0.1);
        border-bottom: 1px solid rgba(0,229,160,0.1);
        padding: 5rem 2.5rem;
        text-align: center;
    }
    .services-cta h2 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.6rem, 3vw, 2.4rem);
        font-weight: 800; color: #fff;
        letter-spacing: -0.02em; margin-bottom: 1rem;
    }
    .services-cta p {
        font-size: 0.92rem; color: var(--text-muted);
        font-weight: 300; margin-bottom: 2rem;
    }
    .btn-ntv-primary {
        display: inline-flex; align-items: center; gap: 0.55rem;
        background: var(--green); color: #030f09 !important;
        font-family: 'Syne', sans-serif;
        font-size: 0.82rem; font-weight: 700;
        letter-spacing: 0.04em; text-decoration: none;
        padding: 0.9rem 2rem; border-radius: 3px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-ntv-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 35px rgba(0,229,160,0.3);
        color: #030f09 !important;
    }

    /* ── Reveal ── */
    .reveal { opacity: 0; transform: translateY(22px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 768px) {
        .services-hero { padding: 8rem 1.5rem 3rem; }
        .services-grid-section { padding: 0 1.5rem 4rem; }
        .services-grid { grid-template-columns: 1fr; }
        .services-cta { padding: 3.5rem 1.5rem; }
    }
</style>
@endpush

@section('content')
<div class="services-page">

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-1"></div><div class="grid"></div></div>

        <div class="services-hero reveal">
            <div class="section-label">Nos Services</div>
            <h1>Des solutions IT<br>pour chaque défi</h1>
            <p>Conception, déploiement et maintenance de solutions technologiques
                performantes adaptées aux besoins des entreprises africaines.</p>
        </div>
    </section>

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-2"></div><div class="grid"></div></div>

        <div class="services-grid-section">
            <div class="services-grid">

                {{-- 01 --}}
                <div class="service-card reveal">
                    <span class="service-num">01</span>
                    <div class="service-icon"><i class="bi bi-hdd-network"></i></div>
                    <div class="service-title">Solutions Réseaux IT</div>
                    <p class="service-text">Conception, installation et optimisation de vos réseaux informatiques pour une connectivité fluide et sécurisée au sein de votre entreprise.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill"></i> Architecture réseau sur mesure</li>
                        <li><i class="bi bi-check-circle-fill"></i> Configuration switches & routeurs</li>
                        <li><i class="bi bi-check-circle-fill"></i> VPN & accès distant sécurisé</li>
                        <li><i class="bi bi-check-circle-fill"></i> Monitoring & supervision réseau</li>
                    </ul>
                </div>

                {{-- 02 --}}
                <div class="service-card reveal">
                    <span class="service-num">02</span>
                    <div class="service-icon"><i class="bi bi-tools"></i></div>
                    <div class="service-title">Maintenance Pro</div>
                    <p class="service-text">Support technique continu pour garantir la disponibilité maximale de vos systèmes. Des interventions rapides, sur site ou à distance.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill"></i> Maintenance préventive & corrective</li>
                        <li><i class="bi bi-check-circle-fill"></i> Support 24/7 à Cotonou</li>
                        <li><i class="bi bi-check-circle-fill"></i> Gestion de parc informatique</li>
                        <li><i class="bi bi-check-circle-fill"></i> Contrats SLA personnalisés</li>
                    </ul>
                </div>

                {{-- 03 --}}
                <div class="service-card reveal">
                    <span class="service-num">03</span>
                    <div class="service-icon"><i class="bi bi-shield-lock"></i></div>
                    <div class="service-title">Audit & Cybersécurité</div>
                    <p class="service-text">Identification des vulnérabilités, sécurisation de vos infrastructures et mise en place de stratégies de protection robustes contre les cybermenaces.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill"></i> Audit de sécurité complet</li>
                        <li><i class="bi bi-check-circle-fill"></i> Firewall & antivirus managés</li>
                        <li><i class="bi bi-check-circle-fill"></i> Politique de sauvegarde & PRA</li>
                        <li><i class="bi bi-check-circle-fill"></i> Formation & sensibilisation équipes</li>
                    </ul>
                </div>

                {{-- 04 --}}
                <div class="service-card reveal">
                    <span class="service-num">04</span>
                    <div class="service-icon"><i class="bi bi-pc-display"></i></div>
                    <div class="service-title">Vente Matériel</div>
                    <p class="service-text">Fourniture d'équipements informatiques professionnels certifiés. Serveurs, postes de travail, imprimantes, licences logicielles et accessoires.</p>
                    <ul class="service-features">
                        <li><i class="bi bi-check-circle-fill"></i> Matériel certifié (Cisco, HP, Dell)</li>
                        <li><i class="bi bi-check-circle-fill"></i> Licences Windows, Office, Antivirus</li>
                        <li><i class="bi bi-check-circle-fill"></i> Installation & configuration incluses</li>
                        <li><i class="bi bi-check-circle-fill"></i> Garantie & SAV assuré</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="services-cta reveal">
        <h2>Un projet en tête ?<br>Parlons-en ensemble.</h2>
        <p>Obtenez une estimation détaillée sous 24h pour votre projet IT.</p>
        <a href="{{ url('/contact') }}" class="btn-ntv-primary">
            Obtenir un devis <i class="bi bi-arrow-right"></i>
        </a>
    </section>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
});
</script>
@endpush
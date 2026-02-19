@extends('layouts.app')

@section('title', 'Projets — NovaTech Vision')

@push('styles')
<style>
    .projets-page { background: #040d0a; min-height: 100vh; }

    .s-bg { position: absolute; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
    .s-bg .orb-1 { position: absolute; top: -10%; right: -5%; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(0,200,130,0.15) 0%, transparent 65%); }
    .s-bg .orb-2 { position: absolute; bottom: 5%; left: -5%; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(0,160,100,0.10) 0%, transparent 65%); }
    .s-bg .grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(0,229,160,0.025) 1px, transparent 1px), linear-gradient(90deg, rgba(0,229,160,0.025) 1px, transparent 1px); background-size: 55px 55px; }

    /* ── Hero ── */
    .projets-hero {
        position: relative; z-index: 2;
        padding: 10rem 2.5rem 4rem;
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
        content: ''; display: block; width: 24px; height: 1px;
        background: var(--green); opacity: 0.5;
    }
    .projets-hero h1 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.2rem, 4.5vw, 3.8rem);
        font-weight: 800; line-height: 1.08;
        letter-spacing: -0.025em; color: #fff; margin-bottom: 1.2rem;
    }
    .projets-hero p {
        font-size: 0.97rem; font-weight: 300;
        line-height: 1.75; color: var(--text-muted);
        max-width: 540px; margin: 0 auto 3rem;
    }

    /* ── Stats ── */
    .stats-bar {
        display: flex; justify-content: center;
        gap: 4rem; flex-wrap: wrap;
        padding: 2.5rem 0;
        border-top: 1px solid rgba(0,229,160,0.08);
        border-bottom: 1px solid rgba(0,229,160,0.08);
    }
    .stat-item { text-align: center; }
    .stat-num {
        display: block;
        font-family: 'Syne', sans-serif;
        font-size: 2.8rem; font-weight: 800;
        color: var(--green); line-height: 1;
    }
    .stat-label {
        display: block; font-size: 0.72rem;
        color: var(--text-muted); letter-spacing: 0.08em;
        text-transform: uppercase; margin-top: 0.4rem;
    }

    /* ── Filtres catégories ── */
    .projets-content {
        position: relative; z-index: 2;
        padding: 4rem 2.5rem 6rem;
        max-width: 1200px; margin: 0 auto;
    }
    .projets-cats {
        display: flex; gap: 0.6rem; flex-wrap: wrap;
        margin-bottom: 3rem;
    }
    .cat-btn {
        font-size: 0.72rem; font-weight: 500;
        letter-spacing: 0.07em; text-transform: uppercase;
        color: var(--text-muted);
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(0,229,160,0.1);
        padding: 0.5rem 1.1rem; border-radius: 20px;
        cursor: pointer; transition: all 0.2s;
    }
    .cat-btn:hover, .cat-btn.active {
        color: var(--green);
        background: rgba(0,229,160,0.08);
        border-color: rgba(0,229,160,0.3);
    }

    /* ── Groupes de projets ── */
    .projets-group { margin-bottom: 4rem; }
    .group-header {
        display: flex; align-items: center; gap: 1rem;
        margin-bottom: 1.8rem;
    }
    .group-tag {
        font-size: 0.62rem; font-weight: 600;
        letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--green);
        background: rgba(0,229,160,0.08);
        border: 1px solid rgba(0,229,160,0.18);
        padding: 0.28rem 0.8rem; border-radius: 20px;
    }
    .group-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem; font-weight: 700;
        color: #fff; letter-spacing: -0.01em;
    }
    .group-line {
        flex: 1; height: 1px;
        background: linear-gradient(to right, rgba(0,229,160,0.15), transparent);
    }

    /* ── Cartes projet ── */
    .projets-list { display: flex; flex-direction: column; gap: 1px; }

    .projet-item {
        display: grid; grid-template-columns: 48px 1fr auto;
        align-items: start; gap: 1.5rem;
        padding: 1.6rem 1.5rem;
        background: rgba(255,255,255,0.015);
        border: 1px solid rgba(0,229,160,0.07);
        border-radius: 6px; margin-bottom: 0.6rem;
        transition: background 0.25s, border-color 0.25s, transform 0.25s;
        position: relative; overflow: hidden;
    }
    .projet-item::before {
        content: ''; position: absolute;
        left: 0; top: 0; bottom: 0; width: 2px;
        background: var(--green); opacity: 0;
        transition: opacity 0.25s;
    }
    .projet-item:hover {
        background: rgba(0,229,160,0.03);
        border-color: rgba(0,229,160,0.18);
        transform: translateX(4px);
    }
    .projet-item:hover::before { opacity: 1; }

    .projet-icon {
        width: 48px; height: 48px;
        border-radius: 10px;
        background: rgba(0,229,160,0.07);
        border: 1px solid rgba(0,229,160,0.12);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; color: var(--green);
        flex-shrink: 0;
    }
    .projet-info {}
    .projet-client {
        font-size: 0.62rem; font-weight: 500;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--green); margin-bottom: 0.3rem;
    }
    .projet-name {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem; font-weight: 700;
        color: #fff; margin-bottom: 0.5rem;
        letter-spacing: -0.01em;
    }
    .projet-desc {
        font-size: 0.82rem; font-weight: 300;
        color: var(--text-muted); line-height: 1.6;
    }
    .projet-badge {
        flex-shrink: 0;
        font-size: 0.62rem; font-weight: 500;
        letter-spacing: 0.06em; text-transform: uppercase;
        color: var(--text-muted);
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 0.25rem 0.7rem; border-radius: 3px;
        white-space: nowrap; align-self: center;
    }

    /* ── Reveal ── */
    .reveal { opacity: 0; transform: translateY(22px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 768px) {
        .projets-hero { padding: 8rem 1.5rem 3rem; }
        .projets-content { padding: 3rem 1.5rem 4rem; }
        .stats-bar { gap: 2rem; }
        .projet-item { grid-template-columns: 40px 1fr; }
        .projet-badge { display: none; }
    }
</style>
@endpush

@section('content')
<div class="projets-page">

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-1"></div><div class="grid"></div></div>

        <div class="projets-hero reveal">
            <div class="section-label">Projets Réalisés</div>
            <h1>Des solutions informatiques<br>performantes</h1>
            <p>Au service des entreprises et institutions. Découvrez nos réalisations concrètes à travers le Bénin et la sous-région.</p>

            <div class="stats-bar">
                <div class="stat-item">
                    <span class="stat-num">+150</span>
                    <span class="stat-label">Clients satisfaits</span>
                </div>
                <div class="stat-item">
                    <span class="stat-num">+450</span>
                    <span class="stat-label">Projets finis</span>
                </div>
                <div class="stat-item">
                    <span class="stat-num">+10</span>
                    <span class="stat-label">Solutions créées</span>
                </div>
            </div>
        </div>
    </section>

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-2"></div><div class="grid"></div></div>

        <div class="projets-content">

            {{-- Filtres --}}
            <div class="projets-cats reveal">
                <button class="cat-btn active">Tous</button>
                <button class="cat-btn">Réseaux & Systèmes</button>
                <button class="cat-btn">Maintenance</button>
                <button class="cat-btn">Solutions Web</button>
            </div>

            {{-- Groupe 1 : Réseaux & Systèmes --}}
            <div class="projets-group reveal">
                <div class="group-header">
                    <span class="group-tag">Réseaux & Systèmes</span>
                    <span class="group-title">Infrastructure & Réseaux</span>
                    <div class="group-line"></div>
                </div>
                <div class="projets-list">
                    <div class="projet-item">
                        <div class="projet-icon"><i class="bi bi-server"></i></div>
                        <div class="projet-info">
                            <div class="projet-client">CREC</div>
                            <div class="projet-name">Installation et administration de serveurs</div>
                            <div class="projet-desc">Déploiement de +15 serveurs PSC, sécurisation du réseau et maintenance des équipements informatiques (réseaux, imprimantes, ordinateurs).</div>
                        </div>
                        <span class="projet-badge">Infrastructure</span>
                    </div>
                    <div class="projet-item">
                        <div class="projet-icon"><i class="bi bi-hdd-network"></i></div>
                        <div class="projet-info">
                            <div class="projet-client">Étude Maître Rufine Hunkabrin Bassirou</div>
                            <div class="projet-name">Sécurisation & maintenance réseau</div>
                            <div class="projet-desc">Sécurisation complète du réseau informatique et maintenance des équipements (réseaux, imprimantes, ordinateurs) du cabinet juridique.</div>
                        </div>
                        <span class="projet-badge">Réseau</span>
                    </div>
                </div>
            </div>

            {{-- Groupe 2 : Maintenance --}}
            <div class="projets-group reveal">
                <div class="group-header">
                    <span class="group-tag">Maintenance</span>
                    <span class="group-title">Maintenance & Support Informatique</span>
                    <div class="group-line"></div>
                </div>
                <div class="projets-list">
                    <div class="projet-item">
                        <div class="projet-icon"><i class="bi bi-recycle"></i></div>
                        <div class="projet-info">
                            <div class="projet-client">WECYCLE BENIN</div>
                            <div class="projet-name">Maintenance ordinateurs & imprimantes</div>
                            <div class="projet-desc">Contrat de maintenance préventive et corrective de l'ensemble du parc informatique incluant ordinateurs et imprimantes.</div>
                        </div>
                        <span class="projet-badge">Maintenance</span>
                    </div>
                    <div class="projet-item">
                        <div class="projet-icon"><i class="bi bi-building"></i></div>
                        <div class="projet-info">
                            <div class="projet-client">SAINT GALL</div>
                            <div class="projet-name">Fournitures & entretien équipements</div>
                            <div class="projet-desc">Fourniture et entretien complet des équipements informatiques professionnels pour l'institution Saint Gall.</div>
                        </div>
                        <span class="projet-badge">Support</span>
                    </div>
                    <div class="projet-item">
                        <div class="projet-icon"><i class="bi bi-windows"></i></div>
                        <div class="projet-info">
                            <div class="projet-client">FHP</div>
                            <div class="projet-name">Licences Windows & Office + entretien</div>
                            <div class="projet-desc">Fourniture des licences logicielles Windows et Microsoft Office, configuration et entretien du parc informatique.</div>
                        </div>
                        <span class="projet-badge">Licences</span>
                    </div>
                    <div class="projet-item">
                        <div class="projet-icon"><i class="bi bi-shield-check"></i></div>
                        <div class="projet-info">
                            <div class="projet-client">SOCONEME SARL</div>
                            <div class="projet-name">Licences + SSD + Antivirus + entretien</div>
                            <div class="projet-desc">Fourniture complète : licences Windows & Office, disques SSD, solutions antivirus et contrat d'entretien du parc informatique.</div>
                        </div>
                        <span class="projet-badge">Multi-services</span>
                    </div>
                </div>
            </div>

            {{-- Groupe 3 : Solutions Web --}}
            <div class="projets-group reveal">
                <div class="group-header">
                    <span class="group-tag">Solutions Web</span>
                    <span class="group-title">Solutions Digitales & Web</span>
                    <div class="group-line"></div>
                </div>
                <div class="projets-list">
                    <div class="projet-item">
                        <div class="projet-icon"><i class="bi bi-globe"></i></div>
                        <div class="projet-info">
                            <div class="projet-client">Avocat DEDJI Koundé — France</div>
                            <div class="projet-name">Conception, SEO & sécurité — koundeavicets.fr</div>
                            <div class="projet-desc">Conception complète du site web du cabinet d'avocat, optimisation SEO pour la visibilité sur les moteurs de recherche et sécurisation de la plateforme.</div>
                        </div>
                        <span class="projet-badge">Web</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal scroll
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

    // Filtres catégories
    document.querySelectorAll('.cat-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
@endpush
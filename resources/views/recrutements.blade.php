@extends('layouts.app')

@section('title', 'Recrutements — NovaTech Vision')

@push('styles')
<style>
    .recrutements-page { background: #040d0a; min-height: 100vh; }

    .s-bg { position: absolute; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
    .s-bg .orb-1 { position: absolute; top: -10%; right: -5%; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(0,200,130,0.15) 0%, transparent 65%); }
    .s-bg .orb-2 { position: absolute; bottom: 0%; left: -5%; width: 420px; height: 420px; border-radius: 50%; background: radial-gradient(circle, rgba(0,160,100,0.10) 0%, transparent 65%); }
    .s-bg .grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(0,229,160,0.025) 1px, transparent 1px), linear-gradient(90deg, rgba(0,229,160,0.025) 1px, transparent 1px); background-size: 55px 55px; }

    /* ── Hero ── */
    .recru-hero {
        position: relative; z-index: 2;
        padding: 10rem 2.5rem 4rem;
        max-width: 1200px; margin: 0 auto;
    }
    .section-label {
        display: inline-flex; align-items: center; gap: 0.6rem;
        font-size: 0.7rem; font-weight: 500; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--green); margin-bottom: 1.2rem;
    }
    .section-label::before { content: ''; display: block; width: 24px; height: 1px; background: var(--green); opacity: 0.5; }

    .recru-hero h1 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.2rem, 4.5vw, 3.8rem);
        font-weight: 800; line-height: 1.08;
        letter-spacing: -0.025em; color: #fff; margin-bottom: 1rem;
    }
    .recru-hero p {
        font-size: 0.97rem; font-weight: 300;
        line-height: 1.75; color: var(--text-muted);
        max-width: 540px; margin-bottom: 0;
    }
    .offres-count {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-family: 'Syne', sans-serif;
        font-size: 0.75rem; font-weight: 700;
        color: var(--green); background: rgba(0,229,160,0.08);
        border: 1px solid rgba(0,229,160,0.2);
        padding: 0.4rem 1rem; border-radius: 20px;
        margin-top: 1.5rem;
    }
    .offres-count span { font-size: 1rem; }

    /* ── Filtres ── */
    .recru-filters {
        position: relative; z-index: 2;
        padding: 0 2.5rem 3rem;
        max-width: 1200px; margin: 0 auto;
    }
    .filter-bar {
        display: flex; align-items: center; gap: 1rem;
        flex-wrap: wrap;
        padding: 1.2rem 1.5rem;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 8px;
    }
    .filter-input {
        flex: 1; min-width: 200px;
        background: transparent; border: none; outline: none;
        font-size: 0.85rem; color: var(--text);
        font-family: 'Inter', sans-serif;
    }
    .filter-input::placeholder { color: var(--text-muted); }
    .filter-sep { width: 1px; height: 24px; background: rgba(0,229,160,0.1); }
    .filter-select {
        background: transparent; border: none; outline: none;
        font-size: 0.82rem; color: var(--text-muted);
        font-family: 'Inter', sans-serif; cursor: pointer;
    }
    .filter-select option { background: #040d0a; color: var(--text); }
    .btn-rechercher {
        background: var(--green); color: #030f09;
        font-family: 'Syne', sans-serif;
        font-size: 0.75rem; font-weight: 700;
        letter-spacing: 0.06em; text-transform: uppercase;
        border: none; padding: 0.6rem 1.3rem; border-radius: 4px;
        cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
        white-space: nowrap;
    }
    .btn-rechercher:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,229,160,0.25); }

    /* Recherches associées */
    .recru-tags {
        display: flex; align-items: center; gap: 0.6rem;
        flex-wrap: wrap; margin-top: 1rem;
        font-size: 0.72rem; color: var(--text-muted);
    }
    .recru-tags span { color: var(--text-muted); letter-spacing: 0.05em; }
    .recru-tag {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 0.25rem 0.7rem; border-radius: 20px;
        cursor: pointer; transition: all 0.2s; color: var(--text-muted);
    }
    .recru-tag:hover { border-color: var(--green); color: var(--green); background: rgba(0,229,160,0.06); }

    /* ── Liste offres ── */
    .recru-content {
        position: relative; z-index: 2;
        padding: 0 2.5rem 6rem;
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 260px; gap: 2rem;
    }

    /* Cartes offres */
    .offres-list { display: flex; flex-direction: column; gap: 1rem; }

    .offre-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 8px; padding: 1.8rem 2rem;
        position: relative; overflow: hidden;
        transition: border-color 0.3s, background 0.3s, transform 0.3s;
        cursor: pointer;
    }
    .offre-card::before {
        content: ''; position: absolute;
        left: 0; top: 0; bottom: 0; width: 3px;
        background: var(--green); opacity: 0; transition: opacity 0.3s;
    }
    .offre-card:hover {
        border-color: rgba(0,229,160,0.25);
        background: rgba(0,229,160,0.025);
        transform: translateX(3px);
    }
    .offre-card:hover::before { opacity: 1; }

    .offre-header {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 1rem;
        margin-bottom: 0.9rem;
    }
    .offre-avatar {
        width: 40px; height: 40px; border-radius: 8px;
        background: rgba(0,229,160,0.1);
        border: 1px solid rgba(0,229,160,0.15);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif; font-size: 0.9rem;
        font-weight: 800; color: var(--green); flex-shrink: 0;
    }
    .offre-meta { flex: 1; }
    .offre-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem; font-weight: 700;
        color: #fff; margin-bottom: 0.4rem; letter-spacing: -0.01em;
    }
    .offre-badges {
        display: flex; gap: 0.5rem; flex-wrap: wrap;
    }
    .badge-mode, .badge-contrat, .badge-domaine {
        font-size: 0.62rem; font-weight: 500;
        letter-spacing: 0.08em; text-transform: uppercase;
        padding: 0.2rem 0.6rem; border-radius: 20px; border: 1px solid;
    }
    .badge-mode    { color: #7dd3c0; border-color: rgba(125,211,192,0.25); background: rgba(125,211,192,0.06); }
    .badge-contrat { color: #a3c4f3; border-color: rgba(163,196,243,0.25); background: rgba(163,196,243,0.06); }
    .badge-domaine { color: var(--green); border-color: rgba(0,229,160,0.25); background: rgba(0,229,160,0.06); }

    .offre-date {
        font-size: 0.68rem; color: var(--text-muted);
        white-space: nowrap; flex-shrink: 0; padding-top: 0.2rem;
    }
    .offre-desc {
        font-size: 0.84rem; font-weight: 300;
        line-height: 1.7; color: var(--text-muted);
        margin-bottom: 1.3rem;
    }
    .btn-postuler {
        display: inline-flex; align-items: center; gap: 0.45rem;
        font-size: 0.75rem; font-weight: 600;
        letter-spacing: 0.06em; text-transform: uppercase;
        color: var(--green); text-decoration: none;
        border: 1px solid rgba(0,229,160,0.25);
        padding: 0.5rem 1.1rem; border-radius: 3px;
        transition: background 0.2s, border-color 0.2s;
    }
    .btn-postuler:hover {
        background: rgba(0,229,160,0.08);
        border-color: var(--green); color: var(--green);
    }

    /* ── Sidebar filtres ── */
    .sidebar {}
    .sidebar-block {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.08);
        border-radius: 8px; padding: 1.5rem;
        margin-bottom: 1rem;
    }
    .sidebar-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.78rem; font-weight: 700;
        color: #fff; letter-spacing: 0.05em; text-transform: uppercase;
        margin-bottom: 1rem;
    }
    .sidebar-filters { display: flex; flex-direction: column; gap: 0.5rem; }
    .filter-check {
        display: flex; align-items: center; gap: 0.6rem;
        font-size: 0.82rem; color: var(--text-muted); cursor: pointer;
        transition: color 0.2s;
    }
    .filter-check:hover { color: var(--green); }
    .filter-check input[type="checkbox"] {
        width: 14px; height: 14px;
        accent-color: var(--green); cursor: pointer;
    }

    .btn-candidature-sp {
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        width: 100%; padding: 0.85rem;
        background: rgba(0,229,160,0.08);
        border: 1px solid rgba(0,229,160,0.25);
        border-radius: 6px;
        font-family: 'Syne', sans-serif;
        font-size: 0.78rem; font-weight: 700;
        color: var(--green); text-decoration: none;
        letter-spacing: 0.05em; text-align: center;
        transition: background 0.2s, transform 0.2s;
    }
    .btn-candidature-sp:hover {
        background: rgba(0,229,160,0.14);
        transform: translateY(-2px);
        color: var(--green);
    }

    /* Modal postuler */
    .modal-ntv .modal-content {
        background: #060f0c;
        border: 1px solid rgba(0,229,160,0.15);
        border-radius: 10px; color: var(--text);
    }
    .modal-ntv .modal-header {
        border-bottom: 1px solid rgba(0,229,160,0.1);
        padding: 1.5rem 2rem;
    }
    .modal-ntv .modal-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem; font-weight: 700; color: #fff;
    }
    .modal-ntv .btn-close { filter: invert(1) opacity(0.5); }
    .modal-ntv .modal-body { padding: 2rem; }
    .modal-ntv .modal-footer { border-top: 1px solid rgba(0,229,160,0.1); padding: 1rem 2rem; }

    .ntv-label {
        font-size: 0.75rem; font-weight: 500;
        letter-spacing: 0.06em; text-transform: uppercase;
        color: var(--text-muted); margin-bottom: 0.5rem;
        display: block;
    }
    .ntv-input {
        width: 100%; background: rgba(255,255,255,0.04);
        border: 1px solid rgba(0,229,160,0.12);
        border-radius: 4px; padding: 0.75rem 1rem;
        color: var(--text); font-family: 'Inter', sans-serif;
        font-size: 0.88rem; outline: none;
        transition: border-color 0.2s;
    }
    .ntv-input:focus { border-color: rgba(0,229,160,0.4); background: rgba(0,229,160,0.03); }
    .ntv-input::placeholder { color: rgba(200,220,215,0.3); }

    .upload-zone {
        border: 1px dashed rgba(0,229,160,0.2);
        border-radius: 6px; padding: 1.5rem;
        text-align: center; cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
    }
    .upload-zone:hover { border-color: rgba(0,229,160,0.4); background: rgba(0,229,160,0.03); }
    .upload-zone i { font-size: 1.4rem; color: var(--green); margin-bottom: 0.5rem; }
    .upload-zone p { font-size: 0.8rem; color: var(--text-muted); margin: 0; }
    .upload-zone input { display: none; }

    .btn-submit {
        background: var(--green); color: #030f09;
        font-family: 'Syne', sans-serif; font-size: 0.82rem;
        font-weight: 700; letter-spacing: 0.05em;
        border: none; padding: 0.85rem 2rem; border-radius: 3px;
        cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(0,229,160,0.3); }

    /* Success message */
    .success-msg {
        display: none; text-align: center; padding: 2rem;
    }
    .success-msg i { font-size: 2.5rem; color: var(--green); margin-bottom: 1rem; }
    .success-msg h4 { font-family: 'Syne', sans-serif; color: #fff; margin-bottom: 0.5rem; }
    .success-msg p { font-size: 0.88rem; color: var(--text-muted); }

    /* ── Reveal ── */
    .reveal { opacity: 0; transform: translateY(22px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 991px) {
        .recru-hero { padding: 8rem 1.5rem 3rem; }
        .recru-filters { padding: 0 1.5rem 2rem; }
        .recru-content { grid-template-columns: 1fr; padding: 0 1.5rem 4rem; }
        .sidebar { order: -1; }
        .sidebar-block { display: none; }
    }
</style>
@endpush

@section('content')
<div class="recrutements-page">

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-1"></div><div class="grid"></div></div>

        <div class="recru-hero reveal">
            <div class="section-label">Recrutements</div>
            <h1>8 Opportunités à pourvoir<br>chez NovaTech Vision</h1>
            <p>Découvrez les postes actuellement ouverts et rejoignez une équipe tournée vers l'innovation.</p>
            <div class="offres-count"><span>8</span> postes ouverts</div>
        </div>
    </section>

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-2"></div><div class="grid"></div></div>

        {{-- Barre de filtres --}}
        <div class="recru-filters reveal">
            <div class="filter-bar">
                <i class="bi bi-search" style="color:var(--text-muted); font-size:0.9rem;"></i>
                <input type="text" class="filter-input" placeholder="Intitulé du poste ou mot-clé">
                <div class="filter-sep"></div>
                <select class="filter-select">
                    <option value="">Type de contrat</option>
                    <option>CDI</option><option>CDD</option>
                    <option>Stage</option><option>Alternance</option>
                </select>
                <div class="filter-sep"></div>
                <select class="filter-select">
                    <option value="">Mode de travail</option>
                    <option>Télétravail</option>
                    <option>Présentiel</option>
                    <option>Hybride</option>
                </select>
                <button class="btn-rechercher">Rechercher</button>
            </div>
            <div class="recru-tags">
                <span>Recherches associées :</span>
                <span class="recru-tag">Intelligence artificielle</span>
                <span class="recru-tag">Data & Analytics</span>
                <span class="recru-tag">Développement</span>
            </div>
        </div>

        <div class="recru-content">

            {{-- Liste offres --}}
            <div class="offres-list">

                {{-- Offre 1 --}}
                <div class="offre-card reveal">
                    <div class="offre-header">
                        <div class="offre-avatar">I</div>
                        <div class="offre-meta">
                            <div class="offre-title">Ingénieur IA & Machine Learning</div>
                            <div class="offre-badges">
                                <span class="badge-mode"><i class="bi bi-house"></i> Télétravail</span>
                                <span class="badge-contrat">Stage</span>
                                <span class="badge-domaine">Intelligence artificielle</span>
                            </div>
                        </div>
                        <div class="offre-date">Il y a 3 jours</div>
                    </div>
                    <p class="offre-desc">Dans le cadre de l'amélioration de nos infrastructures, nous recherchons un Ingénieur IA & Machine Learning passionné pour rejoindre notre équipe d'innovation. Vous serez au cœur du développement de solutions d'intelligence artificielle révolutionnaires destinées à transformer l'industrie 4.0.</p>
                    <a href="#" class="btn-postuler" data-bs-toggle="modal" data-bs-target="#modalPostuler" data-poste="Ingénieur IA & Machine Learning">
                        Postuler <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                {{-- Offre 2 --}}
                <div class="offre-card reveal">
                    <div class="offre-header">
                        <div class="offre-avatar">D</div>
                        <div class="offre-meta">
                            <div class="offre-title">Data Scientist Senior</div>
                            <div class="offre-badges">
                                <span class="badge-mode"><i class="bi bi-house"></i> Télétravail</span>
                                <span class="badge-contrat">CDI</span>
                                <span class="badge-domaine">Data & Analytics</span>
                            </div>
                        </div>
                        <div class="offre-date">28/01/26</div>
                    </div>
                    <p class="offre-desc">Nous recherchons un Data Scientist Senior qui dirigera l'analyse des données industrielles massives et créera des modèles prédictifs pour anticiper les besoins de nos clients.</p>
                    <a href="#" class="btn-postuler" data-bs-toggle="modal" data-bs-target="#modalPostuler" data-poste="Data Scientist Senior">
                        Postuler <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                {{-- Offre 3 --}}
                <div class="offre-card reveal">
                    <div class="offre-header">
                        <div class="offre-avatar">I</div>
                        <div class="offre-meta">
                            <div class="offre-title">Développeur Full Stack</div>
                            <div class="offre-badges">
                                <span class="badge-mode"><i class="bi bi-house"></i> Télétravail</span>
                                <span class="badge-contrat">Alternance</span>
                                <span class="badge-domaine">Développement</span>
                            </div>
                        </div>
                        <div class="offre-date">Il y a 6 jours</div>
                    </div>
                    <p class="offre-desc">Nous recherchons un Développeur Full Stack qui sera chargé de créer des interfaces utilisateur exceptionnelles pour rendre nos technologies d'IA accessibles et intuitives pour les professionnels de l'industrie.</p>
                    <a href="#" class="btn-postuler" data-bs-toggle="modal" data-bs-target="#modalPostuler" data-poste="Développeur Full Stack">
                        Postuler <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                {{-- Offre 4 --}}
                <div class="offre-card reveal">
                    <div class="offre-header">
                        <div class="offre-avatar">D</div>
                        <div class="offre-meta">
                            <div class="offre-title">Stage Data Analyst</div>
                            <div class="offre-badges">
                                <span class="badge-mode"><i class="bi bi-house"></i> Télétravail</span>
                                <span class="badge-contrat">Stage</span>
                                <span class="badge-domaine">Data & Analytics</span>
                            </div>
                        </div>
                        <div class="offre-date">Il y a 6 jours</div>
                    </div>
                    <p class="offre-desc">Nous recherchons un Data Analyst stagiaire pour analyser les données opérationnelles et créer des tableaux de bord permettant d'améliorer la prise de décision de nos clients.</p>
                    <a href="#" class="btn-postuler" data-bs-toggle="modal" data-bs-target="#modalPostuler" data-poste="Stage Data Analyst">
                        Postuler <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="sidebar">
                <div class="sidebar-block">
                    <div class="sidebar-title">Type de contrat</div>
                    <div class="sidebar-filters">
                        <label class="filter-check"><input type="checkbox"> CDI</label>
                        <label class="filter-check"><input type="checkbox"> CDD</label>
                        <label class="filter-check"><input type="checkbox"> Stage</label>
                        <label class="filter-check"><input type="checkbox"> Alternance</label>
                    </div>
                </div>
                <a href="{{ url('/candidature') }}" class="btn-candidature-sp">
                    <i class="bi bi-send"></i> Candidature Spontanée
                </a>
            </div>

        </div>
    </section>
</div>

{{-- ── MODAL POSTULER ── --}}
<div class="modal fade modal-ntv" id="modalPostuler" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Postuler — <span id="modal-poste-title"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modal-form-body">
                <form id="form-postuler">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="ntv-label">Prénom *</label>
                            <input type="text" class="ntv-input" placeholder="Ex. Jean" required>
                        </div>
                        <div class="col-md-6">
                            <label class="ntv-label">Nom *</label>
                            <input type="text" class="ntv-input" placeholder="Ex. ZANOU" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="ntv-label">Email *</label>
                            <input type="email" class="ntv-input" placeholder="jeanzanou@email.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="ntv-label">Téléphone *</label>
                            <input type="tel" class="ntv-input" placeholder="+229 01 XX XX XX">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="ntv-label">CV *</label>
                        <label class="upload-zone d-block">
                            <i class="bi bi-cloud-upload"></i>
                            <p>Importer votre CV (PDF, DOC)</p>
                            <input type="file" accept=".pdf,.doc,.docx">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="ntv-label">Lettre de motivation *</label>
                        <label class="upload-zone d-block">
                            <i class="bi bi-file-text"></i>
                            <p>Importer votre lettre (PDF, DOC)</p>
                            <input type="file" accept=".pdf,.doc,.docx">
                        </label>
                    </div>
                </form>
            </div>
            <div class="success-msg" id="modal-success">
                <i class="bi bi-check-circle-fill"></i>
                <h4>Candidature envoyée !</h4>
                <p>Félicitations, vous venez de soumettre votre candidature.<br>Les recruteurs vous recontacteront.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-submit" id="btn-submit-postuler">
                    Postuler <i class="bi bi-send ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

    // Injecter le titre du poste dans la modal
    document.querySelectorAll('.btn-postuler').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('modal-poste-title').textContent = this.dataset.poste || '';
            document.getElementById('modal-form-body').style.display = 'block';
            document.getElementById('modal-success').style.display = 'none';
            document.getElementById('btn-submit-postuler').style.display = 'block';
        });
    });

    // Simulation soumission
    document.getElementById('btn-submit-postuler').addEventListener('click', () => {
        document.getElementById('modal-form-body').style.display = 'none';
        document.getElementById('modal-success').style.display = 'block';
        document.getElementById('btn-submit-postuler').style.display = 'none';
    });
});
</script>
@endpush
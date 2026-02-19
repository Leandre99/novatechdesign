@extends('layouts.app')

@section('title', 'Candidature Spontanée — NovaTech Vision')

@push('styles')
<style>
    .candidature-page { background: #040d0a; min-height: 100vh; }

    .s-bg { position: absolute; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
    .s-bg .orb-1 { position: absolute; top: -10%; right: -5%; width: 550px; height: 550px; border-radius: 50%; background: radial-gradient(circle, rgba(0,200,130,0.15) 0%, transparent 65%); }
    .s-bg .orb-2 { position: absolute; bottom: 0; left: -5%; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(0,160,100,0.10) 0%, transparent 65%); }
    .s-bg .grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(0,229,160,0.025) 1px, transparent 1px), linear-gradient(90deg, rgba(0,229,160,0.025) 1px, transparent 1px); background-size: 55px 55px; }

    /* ── Layout ── */
    .candidature-inner {
        position: relative; z-index: 2;
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 8rem 2.5rem 5rem;
    }

    .candidature-wrap {
        width: 100%; max-width: 620px;
    }

    /* En-tête */
    .section-label {
        display: inline-flex; align-items: center; gap: 0.6rem;
        font-size: 0.7rem; font-weight: 500; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--green); margin-bottom: 1.2rem;
    }
    .section-label::before { content: ''; display: block; width: 24px; height: 1px; background: var(--green); opacity: 0.5; }

    .candidature-title {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800; line-height: 1.1;
        letter-spacing: -0.025em; color: #fff;
        margin-bottom: 0.8rem;
    }
    .candidature-sub {
        font-size: 0.92rem; font-weight: 300;
        line-height: 1.7; color: var(--text-muted);
        margin-bottom: 2.5rem;
    }

    /* Formulaire */
    .candidature-form {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.12);
        border-radius: 12px; padding: 2.5rem;
    }

    .ntv-label {
        font-size: 0.72rem; font-weight: 500;
        letter-spacing: 0.07em; text-transform: uppercase;
        color: var(--text-muted); margin-bottom: 0.45rem; display: block;
    }
    .ntv-input {
        width: 100%; background: rgba(255,255,255,0.03);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 4px; padding: 0.8rem 1rem;
        color: var(--text); font-family: 'Inter', sans-serif;
        font-size: 0.88rem; outline: none;
        transition: border-color 0.2s, background 0.2s;
    }
    .ntv-input:focus { border-color: rgba(0,229,160,0.35); background: rgba(0,229,160,0.02); }
    .ntv-input::placeholder { color: rgba(200,220,215,0.28); }

    /* Upload zone */
    .upload-zone {
        border: 1px dashed rgba(0,229,160,0.2);
        border-radius: 6px; padding: 1.5rem 1rem;
        text-align: center; cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        display: block; width: 100%;
    }
    .upload-zone:hover { border-color: rgba(0,229,160,0.4); background: rgba(0,229,160,0.03); }
    .upload-zone i { font-size: 1.5rem; color: var(--green); margin-bottom: 0.4rem; display: block; }
    .upload-zone .upload-text { font-size: 0.82rem; color: var(--text-muted); }
    .upload-zone .upload-sub { font-size: 0.7rem; color: rgba(200,220,215,0.3); margin-top: 0.2rem; }
    .upload-zone input { display: none; }
    .upload-zone.has-file { border-color: rgba(0,229,160,0.4); background: rgba(0,229,160,0.03); }
    .upload-zone.has-file i { color: var(--green); }

    /* Bouton */
    .btn-envoyer {
        width: 100%; background: var(--green); color: #030f09;
        font-family: 'Syne', sans-serif; font-size: 0.88rem;
        font-weight: 700; letter-spacing: 0.05em;
        border: none; padding: 1rem; border-radius: 4px;
        cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
    }
    .btn-envoyer:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,229,160,0.28); }

    /* Lien retour offres */
    .back-link {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-size: 0.8rem; color: var(--text-muted); text-decoration: none;
        margin-top: 1.5rem; transition: color 0.2s;
    }
    .back-link:hover { color: var(--green); }

    /* ── Success ── */
    .success-screen {
        display: none;
        text-align: center; padding: 4rem 2rem;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.12);
        border-radius: 12px;
    }
    .success-icon-wrap {
        width: 72px; height: 72px; border-radius: 50%;
        background: rgba(0,229,160,0.1);
        border: 1px solid rgba(0,229,160,0.25);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem;
    }
    .success-icon-wrap i { font-size: 1.8rem; color: var(--green); }
    .success-screen h3 {
        font-family: 'Syne', sans-serif;
        font-size: 1.3rem; font-weight: 700; color: #fff; margin-bottom: 0.7rem;
    }
    .success-screen p { font-size: 0.88rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 1.5rem; }
    .btn-retour {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-size: 0.8rem; font-weight: 500; color: var(--green);
        text-decoration: none; border: 1px solid rgba(0,229,160,0.25);
        padding: 0.6rem 1.4rem; border-radius: 3px;
        transition: background 0.2s;
    }
    .btn-retour:hover { background: rgba(0,229,160,0.08); color: var(--green); }

    /* Domaines d'intérêt */
    .domaines-grid {
        display: flex; flex-wrap: wrap; gap: 0.5rem;
        margin-top: 0.2rem;
    }
    .domaine-chip {
        font-size: 0.72rem; font-weight: 500;
        padding: 0.3rem 0.8rem; border-radius: 20px;
        border: 1px solid rgba(0,229,160,0.15);
        background: rgba(255,255,255,0.03);
        color: var(--text-muted); cursor: pointer;
        transition: all 0.2s;
    }
    .domaine-chip:hover, .domaine-chip.selected {
        border-color: rgba(0,229,160,0.4);
        background: rgba(0,229,160,0.08);
        color: var(--green);
    }

    /* ── Reveal ── */
    .reveal { opacity: 0; transform: translateY(22px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 576px) {
        .candidature-inner { padding: 7rem 1.2rem 3rem; }
        .candidature-form { padding: 1.5rem; }
    }
</style>
@endpush

@section('content')
<div class="candidature-page">
    <div class="s-bg"><div class="orb-1"></div><div class="orb-2"></div><div class="grid"></div></div>

    <div class="candidature-inner">
        <div class="candidature-wrap reveal">

            <div class="section-label">Candidature Spontanée</div>
            <h1 class="candidature-title">Rejoignez<br>NovaTech Vision</h1>
            <p class="candidature-sub">
                Vous ne trouvez pas le poste qui vous correspond parmi nos offres ?
                Envoyez-nous votre candidature spontanée et intégrez une équipe tournée vers l'innovation.
            </p>

            {{-- Formulaire --}}
            <div id="candidature-form-wrap">
                <div class="candidature-form">

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="ntv-label">Prénom *</label>
                            <input type="text" class="ntv-input" placeholder="Ex. Jean">
                        </div>
                        <div class="col-md-6">
                            <label class="ntv-label">Nom *</label>
                            <input type="text" class="ntv-input" placeholder="Ex. ZANOU">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="ntv-label">Profession *</label>
                        <input type="text" class="ntv-input" placeholder="Ex : Ingénieur IA">
                    </div>

                    <div class="mb-3">
                        <label class="ntv-label">Email *</label>
                        <input type="email" class="ntv-input" placeholder="jeanzanou@email.com">
                    </div>

                    <div class="mb-3">
                        <label class="ntv-label">Domaine d'intérêt</label>
                        <div class="domaines-grid">
                            <span class="domaine-chip" onclick="toggleChip(this)">Intelligence artificielle</span>
                            <span class="domaine-chip" onclick="toggleChip(this)">Data & Analytics</span>
                            <span class="domaine-chip" onclick="toggleChip(this)">Développement</span>
                            <span class="domaine-chip" onclick="toggleChip(this)">Réseaux & Infrastructure</span>
                            <span class="domaine-chip" onclick="toggleChip(this)">Cybersécurité</span>
                            <span class="domaine-chip" onclick="toggleChip(this)">Design & UI</span>
                            <span class="domaine-chip" onclick="toggleChip(this)">Commercial</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="ntv-label">CV *</label>
                        <label class="upload-zone" id="upload-cv">
                            <i class="bi bi-cloud-upload"></i>
                            <div class="upload-text">Importer votre CV</div>
                            <div class="upload-sub">PDF, DOC — Max 5Mo</div>
                            <input type="file" accept=".pdf,.doc,.docx" onchange="fileSelected(this, 'upload-cv')">
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="ntv-label">Lettre de motivation *</label>
                        <label class="upload-zone" id="upload-lm">
                            <i class="bi bi-file-text"></i>
                            <div class="upload-text">Importer votre lettre de motivation</div>
                            <div class="upload-sub">PDF, DOC — Max 5Mo</div>
                            <input type="file" accept=".pdf,.doc,.docx" onchange="fileSelected(this, 'upload-lm')">
                        </label>
                    </div>

                    <button class="btn-envoyer" onclick="submitCandidature()">
                        Envoyer ma candidature <i class="bi bi-send"></i>
                    </button>
                </div>

                <a href="{{ url('/recrutements') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i> Retour aux offres
                </a>
            </div>

            {{-- Écran succès --}}
            <div class="success-screen" id="candidature-success">
                <div class="success-icon-wrap">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h3>Candidature envoyée !</h3>
                <p>
                    Félicitations, vous venez de soumettre votre candidature.<br>
                    Les recruteurs vous recontacteront dans les meilleurs délais.
                </p>
                <a href="{{ url('/recrutements') }}" class="btn-retour">
                    <i class="bi bi-arrow-left"></i> Retour aux offres
                </a>
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
});

function toggleChip(el) { el.classList.toggle('selected'); }

function fileSelected(input, zoneId) {
    if (input.files && input.files[0]) {
        const zone = document.getElementById(zoneId);
        zone.classList.add('has-file');
        zone.querySelector('.upload-text').textContent = input.files[0].name;
        zone.querySelector('.upload-sub').textContent = (input.files[0].size / 1024).toFixed(0) + ' Ko';
    }
}

function submitCandidature() {
    document.getElementById('candidature-form-wrap').style.display = 'none';
    document.getElementById('candidature-success').style.display = 'block';
}
</script>
@endpush
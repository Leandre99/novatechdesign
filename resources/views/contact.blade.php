@extends('layouts.app')

@section('title', 'Contact & Devis — NovaTech Vision')

@push('styles')
<style>
    .contact-page { background: #040d0a; min-height: 100vh; }

    .s-bg { position: absolute; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
    .s-bg .orb-1 { position: absolute; top: -10%; right: -5%; width: 550px; height: 550px; border-radius: 50%; background: radial-gradient(circle, rgba(0,200,130,0.15) 0%, transparent 65%); }
    .s-bg .orb-2 { position: absolute; bottom: 5%; left: -5%; width: 430px; height: 430px; border-radius: 50%; background: radial-gradient(circle, rgba(0,160,100,0.10) 0%, transparent 65%); }
    .s-bg .grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(0,229,160,0.025) 1px, transparent 1px), linear-gradient(90deg, rgba(0,229,160,0.025) 1px, transparent 1px); background-size: 55px 55px; }

    /* ── Hero Contact ── */
    .contact-hero {
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

    .contact-hero h1 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.2rem, 4.5vw, 3.8rem);
        font-weight: 800; line-height: 1.08;
        letter-spacing: -0.025em; color: #fff; margin-bottom: 1rem;
    }
    .contact-hero p {
        font-size: 0.97rem; font-weight: 300;
        line-height: 1.75; color: var(--text-muted);
        max-width: 500px;
    }

    /* ── Layout 2 colonnes ── */
    .contact-content {
        position: relative; z-index: 2;
        padding: 0 2.5rem 6rem;
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 1.2fr; gap: 4rem; align-items: start;
    }

    /* Colonne gauche : infos */
    .contact-info {}
    .info-block { margin-bottom: 2.5rem; }
    .info-label {
        font-size: 0.65rem; font-weight: 600;
        letter-spacing: 0.14em; text-transform: uppercase;
        color: var(--green); margin-bottom: 0.6rem;
    }
    .info-value {
        font-size: 0.92rem; color: var(--text);
        font-weight: 300; line-height: 1.6;
    }
    .info-value a { color: var(--text); text-decoration: none; transition: color 0.2s; }
    .info-value a:hover { color: var(--green); }

    .info-icon-row {
        display: flex; align-items: flex-start;
        gap: 0.9rem; margin-bottom: 0.8rem;
    }
    .info-icon {
        width: 38px; height: 38px; border-radius: 8px;
        background: rgba(0,229,160,0.08); border: 1px solid rgba(0,229,160,0.12);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem; color: var(--green); flex-shrink: 0;
    }
    .info-icon-text { font-size: 0.88rem; color: var(--text-muted); font-weight: 300; line-height: 1.5; }
    .info-icon-text strong { display: block; font-weight: 500; color: var(--text); font-size: 0.9rem; margin-bottom: 0.1rem; }

    /* Séparateur */
    .info-sep { width: 100%; height: 1px; background: rgba(0,229,160,0.08); margin: 2rem 0; }

    /* Socials */
    .contact-socials { display: flex; gap: 0.8rem; margin-top: 0.5rem; }
    .social-btn {
        width: 40px; height: 40px; border-radius: 8px;
        background: rgba(255,255,255,0.03); border: 1px solid rgba(0,229,160,0.1);
        display: flex; align-items: center; justify-content: center;
        color: var(--text-muted); font-size: 1rem; text-decoration: none;
        transition: background 0.2s, border-color 0.2s, color 0.2s;
    }
    .social-btn:hover { background: rgba(0,229,160,0.1); border-color: rgba(0,229,160,0.3); color: var(--green); }

    /* ── Formulaire ── */
    .contact-form-wrap {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 12px; padding: 2.5rem;
    }
    .form-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem; font-weight: 700; color: #fff;
        margin-bottom: 0.4rem; letter-spacing: -0.01em;
    }
    .form-sub { font-size: 0.82rem; color: var(--text-muted); margin-bottom: 2rem; }

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
    textarea.ntv-input { resize: vertical; min-height: 120px; }

    .btn-send {
        width: 100%; background: var(--green); color: #030f09;
        font-family: 'Syne', sans-serif; font-size: 0.85rem;
        font-weight: 700; letter-spacing: 0.05em;
        border: none; padding: 0.95rem; border-radius: 4px;
        cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
    }
    .btn-send:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,229,160,0.28); }

    /* ── Section Devis ── */
    .devis-section {
        position: relative; z-index: 2;
        background: linear-gradient(180deg, #040d0a 0%, #050f0c 100%);
        border-top: 1px solid rgba(0,229,160,0.08);
        padding: 6rem 2.5rem;
    }
    .devis-inner { max-width: 1200px; margin: 0 auto; }
    .devis-header { text-align: center; margin-bottom: 3.5rem; }
    .devis-header h2 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 800; color: #fff;
        letter-spacing: -0.025em; margin-bottom: 0.6rem;
    }
    .devis-header p { font-size: 0.9rem; color: var(--text-muted); font-weight: 300; }

    /* Sélection type d'intervention */
    .type-grid {
        display: grid; grid-template-columns: repeat(4, 1fr);
        gap: 1rem; margin-bottom: 2.5rem;
    }
    .type-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 8px; padding: 1.3rem 1rem;
        text-align: center; cursor: pointer;
        transition: all 0.2s; position: relative;
    }
    .type-card:hover, .type-card.selected {
        border-color: rgba(0,229,160,0.35);
        background: rgba(0,229,160,0.05);
    }
    .type-card.selected::after {
        content: '✓'; position: absolute; top: 0.5rem; right: 0.7rem;
        font-size: 0.7rem; color: var(--green);
    }
    .type-card i { font-size: 1.4rem; color: var(--green); margin-bottom: 0.6rem; display: block; }
    .type-card span { font-size: 0.78rem; font-weight: 500; color: var(--text-muted); line-height: 1.4; }
    .type-card.selected span { color: var(--green); }

    /* Formulaire devis */
    .devis-form-wrap {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(0,229,160,0.1);
        border-radius: 12px; padding: 2.5rem;
    }

    /* Success */
    .success-msg {
        display: none; text-align: center; padding: 3rem 2rem;
    }
    .success-msg i { font-size: 3rem; color: var(--green); margin-bottom: 1rem; display: block; }
    .success-msg h4 { font-family: 'Syne', sans-serif; font-size: 1.2rem; color: #fff; margin-bottom: 0.5rem; }
    .success-msg p { font-size: 0.88rem; color: var(--text-muted); }

    /* ── Reveal ── */
    .reveal { opacity: 0; transform: translateY(22px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 991px) {
        .contact-hero { padding: 8rem 1.5rem 3rem; }
        .contact-content { grid-template-columns: 1fr; gap: 2.5rem; padding: 0 1.5rem 4rem; }
        .devis-section { padding: 4rem 1.5rem; }
        .type-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .type-grid { grid-template-columns: 1fr 1fr; }
        .contact-form-wrap, .devis-form-wrap { padding: 1.5rem; }
    }
</style>
@endpush

@section('content')
<div class="contact-page">

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-1"></div><div class="grid"></div></div>

        <div class="contact-hero reveal">
            <div class="section-label">Contact</div>
            <h1>Nous sommes là<br>pour vous aider</h1>
            <p>Parlons de vos besoins en infrastructure. Contactez-nous dès maintenant.</p>
        </div>
    </section>

    <section style="position:relative; overflow:hidden;">
        <div class="s-bg"><div class="orb-2"></div><div class="grid"></div></div>

        <div class="contact-content">

            {{-- Info colonne --}}
            <div class="contact-info reveal">

                <div class="info-icon-row">
                    <div class="info-icon"><i class="bi bi-envelope"></i></div>
                    <div class="info-icon-text">
                        <strong>Email</strong>
                        <a href="mailto:contact@novatechvision.com">contact@novatechvision.com</a><br>
                        <a href="mailto:projets@novatechvision.com">projets@novatechvision.com</a>
                    </div>
                </div>

                <div class="info-icon-row">
                    <div class="info-icon"><i class="bi bi-telephone"></i></div>
                    <div class="info-icon-text">
                        <strong>Direct IT Support</strong>
                        <a href="tel:+22901913485 57">+229 01 91 34 85 57</a>
                    </div>
                </div>

                <div class="info-icon-row">
                    <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                    <div class="info-icon-text">
                        <strong>Bénin HQ</strong>
                        Cotonou, Haie Vive, Avenue Steinmetz<br>
                        Immeuble NovaTech
                    </div>
                </div>

                <div class="info-sep"></div>

                <div class="info-label">Nous suivre</div>
                <div class="contact-socials">
                    <a href="#" class="social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="mailto:contact@novatechvision.com" class="social-btn" aria-label="Email"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            {{-- Formulaire contact --}}
            <div class="contact-form-wrap reveal">
                <div class="form-title">Parlons de votre projet</div>
                <div class="form-sub">Nous vous répondons dans les plus brefs délais.</div>

                <div id="contact-form">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="ntv-label">Nom complet *</label>
                            <input type="text" class="ntv-input" placeholder="Ex. Jean ZANOU">
                        </div>
                        <div class="col-md-6">
                            <label class="ntv-label">Structure *</label>
                            <input type="text" class="ntv-input" placeholder="Ex. INFOTECH">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="ntv-label">Email professionnel *</label>
                        <input type="email" class="ntv-input" placeholder="jeanzanou@email.com">
                    </div>
                    <div class="mb-4">
                        <label class="ntv-label">Votre besoin *</label>
                        <textarea class="ntv-input" placeholder="Décrivez brièvement votre projet, vos objectifs ou vos contraintes..."></textarea>
                    </div>
                    <button class="btn-send" onclick="submitContact()">
                        Envoyer <i class="bi bi-send"></i>
                    </button>
                </div>

                <div class="success-msg" id="contact-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <h4>Message envoyé !</h4>
                    <p>Votre formulaire a bien été envoyé.<br>Nous vous répondrons dans les plus brefs délais.</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ════ SECTION DEVIS ════ --}}
    <section class="devis-section">
        <div class="devis-inner">
            <div class="devis-header reveal">
                <div class="section-label" style="justify-content:center;">Devis sur mesure</div>
                <h2>Configurez votre projet</h2>
                <p>Recevez une estimation détaillée sous 24h.</p>
            </div>

            {{-- Sélection type --}}
            <div class="type-grid reveal">
                <div class="type-card selected" onclick="selectType(this)">
                    <i class="bi bi-hdd-network"></i>
                    <span>Infrastructure</span>
                </div>
                <div class="type-card" onclick="selectType(this)">
                    <i class="bi bi-shield-lock"></i>
                    <span>Audit & CyberSécurité</span>
                </div>
                <div class="type-card" onclick="selectType(this)">
                    <i class="bi bi-code-slash"></i>
                    <span>Logiciels & Digitalisation</span>
                </div>
                <div class="type-card" onclick="selectType(this)">
                    <i class="bi bi-pc-display"></i>
                    <span>Vente & Équipement Pro</span>
                </div>
            </div>

            {{-- Formulaire devis --}}
            <div class="devis-form-wrap reveal">
                <div id="devis-form">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="ntv-label">Nom complet *</label>
                            <input type="text" class="ntv-input" placeholder="Ex. Jean ZANOU">
                        </div>
                        <div class="col-md-4">
                            <label class="ntv-label">Téléphone *</label>
                            <input type="tel" class="ntv-input" placeholder="+229 01 XX XX XX">
                        </div>
                        <div class="col-md-4">
                            <label class="ntv-label">Email *</label>
                            <input type="email" class="ntv-input" placeholder="email@example.com">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="ntv-label">Message / Besoin spécifique</label>
                        <textarea class="ntv-input" placeholder="Décrivez votre besoin..."></textarea>
                    </div>
                    <button class="btn-send" onclick="submitDevis()">
                        Obtenir un devis <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

                <div class="success-msg" id="devis-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <h4>Demande de devis envoyée !</h4>
                    <p>Merci de nous avoir soumis votre projet.<br>Nous vous répondrons dans les plus brefs délais.</p>
                </div>
            </div>

        </div>
    </section>

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

function selectType(el) {
    document.querySelectorAll('.type-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
}

function submitContact() {
    document.getElementById('contact-form').style.display = 'none';
    document.getElementById('contact-success').style.display = 'block';
}

function submitDevis() {
    document.getElementById('devis-form').style.display = 'none';
    document.getElementById('devis-success').style.display = 'block';
}
</script>
@endpush
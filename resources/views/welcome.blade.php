@extends('layouts.app')

@section('title', 'NovaTech Vision — L\'Intelligence Artificielle au Cœur de l\'Industrie')

@push('styles')
<style scoped>
/* Container principal - Full Screen Responsive */
.home-container {
    position: relative;
    width: 100vw;
    height: 100vh;
    background: linear-gradient(56.5508deg, rgb(30, 29, 71) 0.56191%, rgb(68, 221, 170) 54.489%, rgb(30, 29, 71) 95.635%);
    overflow: hidden;
}

/* Logo */
.logo {
    position: absolute;
    left: 80px;
    top: 60px;
    width: 180px;
    z-index: 10;
}

.logo img {
    height: 100%;
    object-fit: contain;
}

/* Image centrale */
.hero-image {
    position: absolute;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    overflow: hidden;
}

.hero-image img {
    height: 110%;
    width: auto;
    object-fit: cover;
}

/* Titre principal */
.main-title {
    position: absolute;
    left: 50%;
    top: 48%;
    transform: translate(-50%, -50%);
    text-align: center;
    text-transform: uppercase;
    font-family: 'Inter', sans-serif;
    font-weight: 800;
    font-size: 64px;
    line-height: 1;
    letter-spacing: -1px;
    color: white;
    text-shadow: 0px 4px 30px rgba(0, 0, 0, 0.5);
    z-index: 5;
    width: 100%;
    max-width: 1000px;
}

.main-title p { margin: 0; }

/* Bouton CTA */
.cta-button {
    position: absolute;
    left: 50%;
    top: 68%;
    transform: translateX(-50%);
    width: 240px;
    padding: 18px 0;
    background: linear-gradient(64deg, #1e1b4b 21%, #4338ca 50%, #1e1b4b 78%);
    border-radius: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 10;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
}

.cta-button:hover { transform: translateX(-50%) translateY(-3px) scale(1.05); }
.cta-button p { font-family: 'Inter', sans-serif; font-weight: 800; font-size: 14px; color: white; margin:0 }

.learn-more { position: absolute; left: 55px; bottom: 55px; display:flex; align-items:center; gap:8px; color:white; z-index:10 }
.learn-more p { margin:0 }
.down-arrow { width:16px; height:16px }

.description-text { position: absolute; right: 55px; bottom: 90px; width: 250px; color: white; opacity:0.8; z-index:10 }

.chat-bubble-spot { position: absolute; right: 40px; bottom: 40px; z-index:10 }
.chat-bubble { width:50px; height:50px; background: rgba(255,255,255,0.2); border-radius:50%; display:flex; align-items:center; justify-content:center; padding:12px }

@media (max-width: 1280px) {
    .home-container { width:1280px; height:832px; transform-origin: top left; transform: scale(calc(100vw / 1280)); }
}

</style>
@endpush

@section('content')

  <div class="home-container">
    <!-- Image centrale -->
    <div class="hero-image">
      <img src="{{ asset('images/hero-ai.png') }}" alt="AI Specialist">
    </div>

    <!-- Titre principal -->
    <div class="main-title">
      <p>L'INTELLIGENCE</p>
      <p>ARTIFICIELLE AU</p>
      <p>CŒUR DE L'INDUSTRIE.</p>
    </div>

    <!-- Bouton CTA -->
    <a href="{{ url('/contact') }}" class="cta-button">
      <p>Obtenir une offre</p>
    </a>

    <!-- Lien "En savoir plus" -->
    <a href="{{ url('/apropos') }}" class="learn-more">
      <p>En savoir plus</p>
      <svg class="down-arrow" viewBox="0 0 24 24" fill="none" stroke="white">
        <path d="M12 5v14M19 12l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>

    <!-- Texte descriptif en bas à droite -->
    <p class="description-text">La ou l'innovation technologique transforme les défis industriels en véritables opportunités.</p>

    <!-- Chat Bubble Icon -->
    <div class="chat-bubble-spot">
      <div class="chat-bubble">
        <svg viewBox="0 0 24 24" fill="white">
          <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
          <circle cx="7" cy="9" r="1.5" fill="rgba(0,0,0,0.5)"/>
          <circle cx="12" cy="9" r="1.5" fill="rgba(0,0,0,0.5)"/>
          <circle cx="17" cy="9" r="1.5" fill="rgba(0,0,0,0.5)"/>
        </svg>
      </div>
    </div>
  </div>

@endsection

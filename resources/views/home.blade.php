@extends('layouts.app')

@section('content')
<style>
    /* ========== GLOBAL STYLES ========== */
    :root {
      --primary: #2c7be5;
      --secondary: #1a3a6e;
      --accent: #00d97e;
      --light: #f8f9fa;
      --dark: #12263f;
      --text: #6e84a3;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--dark);
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }

    h1, h2, h3, h4, h5 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
    }

    a {
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn {
      padding: 12px 24px;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background-color: var(--primary);
      border-color: var(--primary);
    }

    .btn-primary:hover {
      background-color: var(--secondary);
      border-color: var(--secondary);
      transform: translateY(-2px);
    }

    .btn-outline-light:hover {
      background-color: rgba(255,255,255,0.2);
    }

    /* ========== HEADER ========== */
    .site-header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      background: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 15px 0;
    }

    /* ========== HERO SECTION ========== */
    .hero {
      position: relative;
      margin-top: 80px;
      /*height: 100vh;*/
      height: calc(100vh-80vh);
      min-height: 500px;
      max-height: 800px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      color: white;
      text-align: center;
      padding: 0 20px;
      max-width: 800px;
      margin: 0 auto;
    }

    .hero-content h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .hero-content p {
      font-size: 1.3rem;
      margin-bottom: 30px;
      opacity: 0.9;
    }

    /* ========== SECTIONS STYLES ========== */
    section {
      padding: 80px 0;
      position: relative;
    }

    .section-title {
      position: relative;
      margin-bottom: 60px;
      text-align: center;
    }

    .section-title:after {
      content: '';
      display: block;
      width: 80px;
      height: 4px;
      background: var(--primary);
      margin: 20px auto;
      border-radius: 2px;
    }

    .bg-light {
      background-color: var(--light) !important;
    }

    /* About Section */
    .about-img {
      border-radius: 10px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      width: 100%;
      height: auto;
      max-height: 500px;
      object-fit: cover;
    }

    .about-img:hover {
      transform: scale(1.02);
    }

    /* Services Section */
    .service-item {
      padding: 25px;
      background: white;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .service-item i {
      font-size: 1.5rem;
      margin-bottom: 15px;
      color: var(--primary);
    }

    /* Products Section */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
    }

    .product-card {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .product-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .product-info {
      padding: 20px;
    }

    /* Carousel */
    .carousel {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .carousel-item img {
      height: 500px;
      object-fit: cover;
    }

    .carousel-control-prev, 
    .carousel-control-next {
      width: 50px;
      height: 50px;
      background: rgba(0,0,0,0.3);
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .carousel:hover .carousel-control-prev,
    .carousel:hover .carousel-control-next {
      opacity: 1;
    }

    /* News Section */
    .card {
      border: none;
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease;
      height: 100%;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .card-img-top {
      height: 200px;
      object-fit: cover;
    }

    /* ========== ANIMATIONS ========== */
    [data-aos] {
      transition: opacity 0.5s ease, transform 0.5s ease;
    }

    /* ========== RESPONSIVE STYLES ========== */
    @media (max-width: 992px) {
      .hero-content h1 {
        font-size: 2.8rem;
      }
      
      .hero-content p {
        font-size: 1.1rem;
      }
      
      section {
        padding: 60px 0;
      }
    }

    @media (max-width: 768px) {
      .hero {
        min-height: 500px;
        height: 70vh;
      }
      
      .hero-content h1 {
        font-size: 2.2rem;
      }
      
      .product-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      }

      .row {
        flex-direction: column;
      }

      .col-lg-6 {
        width: 100%;
      }

      .order-lg-2 {
        order: 2;
      }


    }

    @media (max-width: 576px) {
      .hero {
        min-height: 400px;
        margin-top: 60px;
        height: 60vh;
      }
      
      .hero-content h1 {
        font-size: 1.8rem;
      }
      
      .hero-content .btn {
        width: 100%;
        margin-bottom: 10px;
      }
      
      .section-title {
        margin-bottom: 40px;
      }

      .hero-content p {
        font-size: 1rem;
      }

      .btn {
        padding: 10px 20px;
        font-size: 0.9rem;
      }
    }
</style>

<!-- Hero Section -->
<section class="hero position-relative">
    <div class="hero-image-container">
        <img src="{{ asset('images/kan.png') }}" 
             alt="Poissonnerie 3D"
             class="hero-image">
    </div>
    
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-down">Poissonnerie 3D</h1>
        <p class="lead mb-4" data-aos="fade-down" data-aos-delay="100">Dieu Donne Davantage - La fraîcheur de la mer à votre service</p>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up" data-aos-delay="200">
            <a href="#contact" class="btn btn-outline-light btn-lg px-4">Nos horaires</a>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Créer un compte</a>
        </div>
    </div>
</section>

<!-- Présentation -->
<section class="container py-5" id="about">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
            <img src="{{ asset('images/image9.png') }}" 
                 alt="Poissonnerie"
                 class="about-img">
        </div>

        <div class="col-lg-6" data-aos="fade-left">
            <h2 class="fw-bold mb-4">Qui sommes-nous ?</h2>
            <p class="lead text-muted mb-4">
                La Poissonnerie 3D vous propose chaque jour le meilleur de la mer : poissons frais, crustacés, fruits de mer, et plus encore.
            </p>
            <p>
                Située au cœur de la ville, notre boutique est synonyme de fraîcheur et de qualité. Nous travaillons directement avec les pêcheurs locaux pour vous offrir des produits de la mer d'une fraîcheur incomparable.
            </p>
        </div>
    </div>
</section>

<!-- Nos services -->
<section class="bg-light py-5" id="services">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0" data-aos="fade-left">
                <img src="{{ asset('images/image1.png') }}" 
                     alt="Services"
                     class="about-img">
            </div>
            
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="fw-bold mb-4">Nos services</h2>
                <div class="service-item mb-3">
                    <h5><i class="fas fa-cut text-primary me-2"></i> Découpe sur mesure</h5>
                    <p class="text-muted">Nous préparons vos poissons selon vos préférences.</p>
                </div>
                <div class="service-item mb-3">
                    <h5><i class="fas fa-truck text-primary me-2"></i> Livraison à domicile</h5>
                    <p class="text-muted">Service de livraison rapide et soigné.</p>
                </div>
                <div class="service-item">
                    <h5><i class="fas fa-utensils text-primary me-2"></i> Conseils culinaires</h5>
                    <p class="text-muted">Nos experts vous conseillent pour préparer vos produits.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos produits -->
<section class="container py-5" id="products">
    <h2 class="text-center fw-bold mb-5">Nos Produits</h2>
    <div class="product-grid">
        <div class="product-card" data-aos="zoom-in">
            <img src="{{ asset('images/poisson10.jpg') }}" 
                 class="product-image"
                 alt="Dorade Royale">
            <div class="product-info">
                <h5 class="text-center">Dorade Royale</h5>
                <p class="text-muted text-center small">Produit frais du jour</p>
            </div>
        </div>
        
        <div class="product-card" data-aos="zoom-in" data-aos-delay="100">
            <img src="{{ asset('images/poisson9.webp') }}" 
                 class="product-image"
                 alt="Crevettes Roses">
            <div class="product-info">
                <h5 class="text-center">Crevettes Roses</h5>
                <p class="text-muted text-center small">Pêchées localement</p>
            </div>
        </div>
        
        <div class="product-card" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/poisson3.jpg') }}" 
                 class="product-image"
                 alt="Homard Bleu">
            <div class="product-info">
                <h5 class="text-center">Homard Bleu</h5>
                <p class="text-muted text-center small">Produit de luxe</p>
            </div>
        </div>
        
        <div class="product-card" data-aos="zoom-in">
            <img src="{{ asset('images/image2.png') }}" 
                 class="product-image"
                 alt="Saucisse">
            <div class="product-info">
                <h5 class="text-center">Saucisse</h5>
                <p class="text-muted text-center small">Maison</p>
            </div>
        </div>
        
        <div class="product-card" data-aos="zoom-in" data-aos-delay="100">
            <img src="{{ asset('images/image4.jpeg') }}" 
                 class="product-image"
                 alt="Viande Fraiche">
            <div class="product-info">
                <h5 class="text-center">Viande Fraiche</h5>
                <p class="text-muted text-center small">Qualité premium</p>
            </div>
        </div>
        
        <div class="product-card" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset('images/poissons3.jpg') }}" 
                 class="product-image"
                 alt="Poisson Frais">
            <div class="product-info">
                <h5 class="text-center">Poisson Frais</h5>
                <p class="text-muted text-center small">Arrivage du jour</p>
            </div>
        </div>
    </div>
</section>

<!-- Carrousel -->
<section class="container my-5">
    <div id="carouselProduits" class="carousel slide shadow-lg" data-bs-ride="carousel" data-aos="fade-up">
        <div class="carousel-inner rounded-3 overflow-hidden">
            <div class="carousel-item active">
                <img src="{{ asset('images/ois1.jpg') }}" 
                     class="d-block w-100" 
                     alt="Photo 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/pois2.jpg') }}" 
                     class="d-block w-100" 
                     alt="Photo 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/pois3.jpg') }}" 
                     class="d-block w-100" 
                     alt="Photo 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduits" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProduits" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</section>

<!-- Actualités -->
<section class="container py-5">
    <h2 class="text-center fw-bold mb-5">Actualités & Recettes</h2>
    <div class="row g-4">
        <div class="col-md-6" data-aos="fade-right">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('images/poisson3.jpg') }}" 
                     class="card-img-top"
                     alt="Recette">
                <div class="card-body">
                    <h5>Recette du mois : Filet de bar au citron</h5>
                    <p class="text-muted">Découvrez comment cuisiner un délicieux filet de bar avec une touche d'agrumes...</p>
                    <a href="#" class="btn btn-outline-primary">Lire la suite</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6" data-aos="fade-left">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('images/poissons3.jpg') }}" 
                     class="card-img-top"
                     alt="Arrivage">
                <div class="card-body">
                    <h5>Arrivage spécial : Fruits de mer</h5>
                    <p class="text-muted">Cette semaine, profitez d'un arrivage exceptionnel de palourdes, bulots et moules fraîches...</p>
                    <a href="#" class="btn btn-outline-primary">Lire la suite</a>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    /* Supprime l'espace entre le header et l'image hero */
.site-header {
    margin-bottom: 0;
}

.hero {
    margin-top: 0;
    padding-top: 0;
}

/* Ajuste la hauteur du hero pour compenser le header fixe */
.hero {
    height: calc(100vh - 80px); /* 80px correspond à la hauteur de votre header */
    min-height: 500px;
}

/* Assure que l'image remplit tout l'espace */
.hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block; /* Supprime l'espace sous l'image */
}

/* Ajustement pour le contenu hero */
.hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    padding: 0 20px;
    text-align: center;
    z-index: 2;
}
</style>

@endsection
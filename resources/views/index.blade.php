@extends('layouts.app')

@section('content')

                 <!-- Hero section -->
  <div class="site-blocks-cover overlay" style="background-image: url({{ asset('images/bde/DSC_0377.JPG') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row mb-4">
              <div class="col-md-7 mt-5">
                <h1>Bureau des élèves Exia</h1>
                <p class="mb-5 lead font-weight-normal">Le bureau des élèves "ExarOffice" est une association de l’Exia centre d'Alger ayant pour but d’organiser et d’animer la vie estudiantine des étudiants à travers des événements culturels et festifs. </p>
                <div>
                  <a href="/accueil#contact-section" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 mb-lg-0 mb-2 d-block d-sm-inline-block">Contactez-nous</a>
                  <a href="{{ route('register') }}" class="btn btn-white py-3 px-5 rounded-0 d-block d-sm-inline-block">Rejoindre l'Équipe du BDE</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!--End Hero section -->



          <!-- About us Section -->
    <div class="site-section" id="about-section">
      <div class="container">
        <div class="row align-items-lg-center">
          <div class="col-md-8 mb-5 mb-lg-0 position-relative">
            <img src="{{ asset('images/bde/70017724_245204489154.jpg') }}" class="img-fluid" alt="Image">
            <div class="experience">
              <span class="year">Promos 2019</span>
            </div>
          </div>
          <div class="col-md-3 ml-auto">
            <h3 class="section-sub-title">A propos du BDE</h3>
            <h2 class="section-title mb-3">a propos</h2>
            <p class="mb-4">Le bureau des étudiants (BDE) à l'Exia, est une partie incontournable de la vie à l'école. De nombreux événements culturels et soirées sont organisés au cours de l'année.</p>
            <p><a href="{{ route('home.about') }}" class="btn btn-black btn-black--hover rounded-0">En savoir plus</a></p>
          </div>
        </div>
      </div>

    </div>   <!-- End About us Section -->



                    <!-- testimonial Section -->
      <div class="site-section testimonial-wrap" id="testimonials-section">
        <div class="container">
          <div class="row mb-5">
            <div class="col-12 text-center">
              <h3 class="section-sub-title">Yanis MAAFI</h3>
              <h2 class="section-title mb-3">Message du président</h2>
            </div>
          </div>
        </div>
        <div class="slide-one-item home-slider owl-carousel">
           
              <div class="testimonial">
                <figure class="mb-4 d-block align-items-center justify-content-center">
                  <div><img src="{{ asset('images/bde/President.jpg') }}" alt="Image_President" class="w-100 img-fluid mb-3"></div>
                </figure>
                <blockquote class="mb-3">
                  <p>&ldquo;Le BDE, c'est une vraie PME. Entre la trésorerie, la gestion des campagnes et l'organisation des activités, les équipes de BDE développent des qualités à faire valoir sur le marché du travail et surtout de développer un réseau très soudé&rdquo;</p>
                </blockquote>
                <p class="text-black"><strong>Yanis Maafi</strong></p>  
              </div>        
        </div>
      </div>  <!--End testimonial Section -->

    
      @include('includes.contact')
    
@endsection
    



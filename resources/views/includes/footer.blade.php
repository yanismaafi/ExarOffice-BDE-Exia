  <footer class="site-footer bg-white">

      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">A propos du BDE</h2>
                <p>Le bureau des étudiants (BDE) à l'Exia, est une partie incontournable de la vie à l'école. De nombreux événements culturels et soirées sont organisés au cours de l'année.</p>
              </div>
              <div class="col-md-3 ">
                <h2 class="footer-heading mb-4">Liens rapides</h2>
                <ul class="list-unstyled">
                  <li><a href="{{ route('home.about') }}">A propos</a></li>
                  <li><a href="{{ route('event.index') }}">Evenements</a></li>
                  <li><a href="{{ route('blog.index') }}">Blog</a></li>
                  <li><a href="{{ route('product.index') }}">Boutique</a></li>
                </ul>
              </div>
              <div class="col-md-4">
                <h2 class="footer-heading mb-4">Suivez-nous sur les reseaux :</h2>
                <a href="https://www.facebook.com/ExiaAlgerie" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="https://twitter.com/algeriecesi" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="https://www.instagram.com/exiacesialgerie/?hl=fr" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="https://www.youtube.com/user/ExiaAlgerie" class="pl-3 pr-3"><span class="icon-youtube"></span></a>
              </div>
            </div>
          </div>

          <div class="col-md-3 ml-auto">
            <h2 class="footer-heading mb-1">Cesi Exia Centre d'Alger</h2>
              <a href="https://www.cesi-algerie.com" class="text-center">
                <img src="{{ asset('images/bde/CesiExia.png') }}" alt="Logo_CesiExia" class="img-fluid mb-3">
                <b style="margin-left:40px"> Cesi-algerie.com </b>
              </a>
              <p class="text-black mb-3 d-inline-block"></p>
          </div>
        </div>
        
        <div class="row pt-1 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top">
              <p>
                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous droits réservés | Ce site a été developpé avec  <i class="icon-heart" aria-hidden="true"></i> par l'Exar <a href="" target="_blank" ><strong> Yanis Maafi</strong></a>
              </p>
            </div>
          </div>
        </div>
      </div>
  </footer>

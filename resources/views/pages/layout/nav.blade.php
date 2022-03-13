<nav class="navbar navbar-expand-lg navbar-light  bg-dhealth">
    <div class="container-fluid d-flex justify-content-between">
      <a class="navbar-brand" href="#">
          <img src="https://static.wixstatic.com/media/108403_8eaedce31c5b4f848961e46b530394dc~mv2.png/v1/fill/w_133,h_45,al_c,usm_0.66_1.00_0.01,enc_auto/Logo_D'health.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">HOME</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              MASTER OBAT
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="{{route('MasterObat')}}">Data obat</a></li>
              <li><a class="dropdown-item" href="#">Racikan obat</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('MasterSigna')}}">MASTER SIGNA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('TransaksiResep')}}">TRANSAKSI RESEP</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/style.css" />
  <title><?=$title?> · CI4 Starter App</title>
</head>

<body>
  <header>
    <div class="nav-container">
      <a class="text-link py-1 px-0" href="/admin">Admin</a>
      <a class="text-link py-1 px-0" href="/tests">Tests</a>
      <a class="text-link py-1 px-0" href="/news">Blog</a>
      <a class="text-link py-1 px-0" href="/peanut-butter">Peanut Butter</a>
      <a class="text-link py-1 px-0" href="/jelly">Jelly</a>
    </div>
    <nav class="nav-container nav-container-second">
      <a class="text-link" target="_blank" href="#"><p>Email</p></a>
      <a class="text-link" target="_blank" href="#"><p>Images</p></a>
      <a class="icon-link" target="_blank" href="#"><i class="fa-solid fa-flask"></i></a>
      <a class="icon-link" target="_blank" href="#"><i class="fa-solid fa-braille"></i></a>
      <button class="image-button">
        <img src="/assets/images/profil.png" alt="profil image" />
      </button>
    </nav>
  </header>
  <main>
    <h1 class=""><?= setting()->get('AppJay.companyName'); ?></h1>
    <h2><?= setting()->get('AppJay.slogan'); ?></h2>
    
    <div class="input-bar">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" title="search" />
      <div>
        <button class="input-icon">
          <i class="fa-solid fa-microphone"></i>
        </button>
        <button class="input-icon"><i class="fa-solid fa-camera"></i></button>
      </div>
    </div>
    <p><?= setting()->get('AppJay.about'); ?></p>
    <div class="button-grid">
      <button>
        <p>Googl Search</p>
      </button>
      <button>
        <p>I'm feeling lucky</p>
      </button>
    </div>
    <p class="language-text">
      Google offered : <a href="#" class="language-link">Mandarin</a>
    </p>
  </main>
  <footer>
    <div>
      <p>Business Solutions</p>
    </div>
    <hr />
    <div class="footer-grid">
      <div class="footer-links">
        <a href="">
          <p>advertising</p>
        </a>
        <a href="">
          <p>Business</p>
        </a>
        <a href="">
          <p>How search works</p>
        </a>
      </div>
      <div class="footer-links">
        <a href="">
          <p>Privacy</p>
        </a>
        <a href="">
          <p>Terms</p>
        </a>
        <a href="">
          <p>Setting</p>
        </a>
      </div>
    </div>
  </footer>
</body>

</html>
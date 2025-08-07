<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portfolio</title>

    <!-- Vite directive untuk load CSS dan JS -->
    @vite(['resources/css/portfolio.css', 'resources/js/portfolio.js'])


    <!-- Optional: Font & Icon CDN (jika perlu) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Optional: Icon Library -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css"/>

    <!-- Optional: Tambahan meta SEO -->
    <meta name="description" content="Portfolio Brian Yudhistira">
    <meta name="author" content="Brian Yudhistira">
    <link rel="icon" href="{{ asset('image/web_icon.png') }}" type="image/png">
</head>
  <body class="text-white">
    <nav class="fixed w-full z-50 glass-effect bg-black/90">
      <div class="max-w-6xl mx-auto px-6 py-4">
        <div class="flex items-center justify-end md:justify-between">
          <div>
            <img src="{{ asset('image/web_icon.png') }}" alt="Web Icon" class="h-8">
          </div>
          <div class="hidden md:flex space-x-8">
            <a
              href="#about"
              class="nav-link text-gray-300 hover:text-primary font-medium"
              >Tentang</a
            >
            <a
              href="#skills"
              class="nav-link text-gray-300 hover:text-primary font-medium"
              >Keahlian</a
            >
            <a
              href="#projects"
              class="nav-link text-gray-300 hover:text-primary font-medium"
              >Proyek</a
            >
            <a
              href="#contact"
              class="nav-link text-gray-300 hover:text-primary font-medium"
              >Kontak</a
            >
          </div>
          <div>
            <button
              class="hidden md:flex w-8 h-8 items-center justify-center text-white hover:text-primary log-hover"
              style="font-size: 1.2rem;"
              id="login-btn"
            >
              <i class="ri-login-box-line"></i>
            </button>
            <button
              class="md:hidden w-8 h-8 flex items-center justify-center text-white"
              id="mobile-menu-btn"
            >
              <i class="ri-menu-line ri-lg"></i>
            </button>
          </div>
        </div>
        <div class="md:hidden mt-4 hidden" id="mobile-menu">
          <div class="flex flex-col space-y-3">
            <a
              href="#about"
              class="text-gray-300 hover:text-primary font-medium"
              >Tentang</a
            >
            <a
              href="#skills"
              class="text-gray-300 hover:text-primary font-medium"
              >Keahlian</a
            >
            <a
              href="#projects"
              class="text-gray-300 hover:text-primary font-medium"
              >Proyek</a
            >
            <a
              href="#contact"
              class="text-gray-300 hover:text-blue-500 font-medium"
              >Kontak</a
            >
          </div>
        </div>
      </div>
    </nav>
    <main>
      <section id="about" class="min-h-screen pt-24 pb-16 flex items-center">
        <div class="max-w-6xl mx-auto">
          <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/2 fade-in">
              <h1 class="text-5xl lg:text-6xl font-bold mb-6">
                <span class="text-white leading-relaxed">Halo, Saya</span>
                <span class="text-primary"> {{ $portfolio->name ?? 'User' }} </span>
              </h1>
              <p class="text-xl text-white mb-8 leading-relaxed font-light">
                {{$portfolio->description ?? 'Pengembang web yang passionate dalam menciptakan solusi digital inovatif. Saya memiliki ketertarikan mendalam terhadap teknologi web modern dan selalu antusias untuk mempelajari hal-hal baru dalam dunia IT.'}}
              </p>
              <div class="flex space-x-2">
                @if($portfolio && $portfolio->git_link)
                <a
                  href="{{ $portfolio->git_link }}"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="bg-gray-900 text-white hover:bg-primary font-medium text-2xl items-center justify-center px-3 py-2 rounded-2xl transition-colors duration-300"
                >
                  <i class="ri-github-line"></i>
                </a>
                @endif

                @if($portfolio && $portfolio->linkedin_link)
                <a
                  href="{{ $portfolio->linkedin_link }}"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="bg-gray-900 text-white hover:bg-primary font-medium text-2xl items-center justify-center px-3 py-2 rounded-2xl transition-colors duration-300"
                >
                  <i class="ri-linkedin-line"></i>
                </a>
                @endif

                @if($portfolio && $portfolio->insta_link)
                <a
                  href="{{ $portfolio->insta_link }}"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="bg-gray-900 text-white hover:bg-primary font-medium text-2xl items-center justify-center px-3 py-2 rounded-2xl transition-colors duration-300"
                >
                  <i class="ri-instagram-line"></i>
                </a>
                @endif
              </div>
            </div>
            <div class="lg:w-1/2 fade-in">
              <div class="relative">
                <div class="mb-8">
                  <img
                    src="{{ asset($portfolio->profile_image) }}"
                    alt="{{ $portfolio ? $portfolio->name . ' image' : 'Profile_image' }}"
                    class="w-23 h-20 md:w-80 md:h-80 rounded-full mx-auto mt-4 object-cover object-top"
                  />
                </div>
              </div>
              <div
                class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-primary to-secondary rounded-full opacity-20 blur-xl"
              ></div>
              <div
                class="absolute -bottom-4 -left-4 w-32 h-32 bg-gradient-to-br from-secondary to-primary rounded-full opacity-15 blur-xl"
              ></div>
            </div>
          </div>
        </div>
      </section>
      <section id="skills" class="min-h-screen py-5 px-6">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl font-bold mb-4 text-white">
              Keahlian & Teknologi
            </h2>
            <p class="text-xl text-gray-400">
              Teknologi dan tools yang saya kuasai
            </p>
          </div>
          @if($portfolio && $portfolio->skills)
            <div class="grid md:grid-cols-4 gap-8">
              @foreach($portfolio->skills as $skill)
                <div class="group bg-gray-900/50 p-8 rounded-2xl fade-in border-2 border-gray-600 hover:border-primary hover:bg-gray-800/70 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-primary/20 cursor-pointer">
                  <div class="text-center">
                    <i class="{{ $skill->icon }} text-4xl mb-4 text-gray-400 group-hover:text-primary transition-colors duration-300"></i>
                    <span class="block text-lg font-medium text-gray-300 group-hover:text-white transition-colors duration-300">{{ ucfirst($skill->name) }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </section>
      <section id="projects" class="min-h-screen">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl font-bold mb-4 text-white">Proyek Saya</h2>
            <p class="text-xl text-gray-400">
              Beberapa proyek yang telah saya kerjakan
            </p>
          </div>
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-9">
            @if($portfolio && $portfolio->projects)
              @foreach($portfolio->projects as $project)
                <div class="project-card rounded-2xl overflow-hidden border-2 border-gray-600 bg-gray-900/50 fade-in transition-all">
                  <div class="h-48 overflow-hidden">
                    <img
                      src="{{ asset($project->image) }}"
                      alt="{{ $project->name . '_image' }}"
                      class="w-full h-full content-center object-cover object-top hover:scale-105 transition-transform duration-300"
                    />
                  </div>
                  <div class="p-6">
                    <h3 class="text-2xl font-semibold mb-4">{{ $project->name }}</h3>
                    <p class="text-gray-400 mb-4">
                      {{ $project->description }}
                    </p>
                    <div class="flex flex-row gap-2">
                      @foreach($project->tech_stack as $tech)
                        <div class="bg-gray-800 p-2 rounded-2xl w-8 h-8 flex items-center justify-center">
                          <i class="{{ $tech }}"></i>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </section>
      <section id="contact" class="py-5 px-6 mb-11">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl font-bold mb-4 text-white">Kontak Saya</h2>
            <p class="text-xl text-gray-400">
              Saya terbuka untuk peluang kerja dan kolaborasi
            </p>
          </div>
          <form
            id="contact-form"
            class="space-y-6 fade-in"
            action="submit.php"
            method="POST"
          >
            <div>
              <label for="name" class="block text-gray-300 mb-2">Nama</label>
              <input
                type="text"
                id="name"
                name="name"
                required
                class="w-full p-3 bg-gray-800 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary transition-colors"
              />
            </div>
            <div>
              <label for="email" class="block text-gray-300 mb-2">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                required
                class="w-full p-3 bg-gray-800 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary transition-colors"
              />
            </div>
            <div>
              <label for="message" class="block text-gray-300 mb-2"
                >Pesan</label
              >
              <textarea
                id="message"
                name="message"
                rows="4"
                required
                class="w-full p-3 bg-gray-800 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary transition-colors"
              ></textarea>
            </div>
            <button
              type="submit"
              class="w-full bg-primary hover:bg-secondary text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300"
            >
              Kirim Pesan
            </button>
          </form>
        </div>
      </section>
      <footer class="bg-gray-900 py-6 ">
        <div class="max-w-6xl mx-auto text-center">
          <p class="text-gray-400">
            &copy; 2025 Portfolio. All rights reserved.
          </p>
        </div>
      </footer>
    </main>
    <script src="logic.js"></script>
    <script id="smooth-scroll">
      document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach((link) => {
          link.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href");
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
              const offsetTop = targetSection.offsetTop - 80;
              window.scrollTo({
                top: offsetTop,
                behavior: "smooth",
              });
            }
          });
        });
      });
    </script>
    <script id="scroll-animations">
      document.addEventListener("DOMContentLoaded", function () {
        const observerOptions = {
          threshold: 0.1,
          rootMargin: "0px 0px -50px 0px",
        };
        const observer = new IntersectionObserver(function (entries) {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("visible");
            }
          });
        }, observerOptions);
        const fadeElements = document.querySelectorAll(".fade-in");
        fadeElements.forEach((el) => observer.observe(el));
      });
    </script>
  </body>
</html>

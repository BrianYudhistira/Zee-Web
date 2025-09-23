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
  <body class="text-white relative overflow-x-hidden">
    <nav class="fixed w-full z-50 glass-effect bg-black/90 backdrop-blur-md border-b border-gray-800/50">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 py-3 sm:py-4">
        <div class="flex items-center justify-between">
          <div class="flex-shrink-0">
            <a href="/menu" title="Go to Menu">
              <img src="{{ asset('image/web_icon.png') }}" alt="Web Icon" class="h-6 sm:h-8">
            </a>
          </div>
          <div class="hidden md:flex space-x-6 lg:space-x-8">
            <a
              href="#about"
              class="nav-link text-gray-300 hover:text-primary font-medium text-sm lg:text-base transition-colors duration-300"
              >Tentang</a
            >
            <a
              href="#skills"
              class="nav-link text-gray-300 hover:text-primary font-medium text-sm lg:text-base transition-colors duration-300"
              >Keahlian</a
            >
            <a
              href="#projects"
              class="nav-link text-gray-300 hover:text-primary font-medium text-sm lg:text-base transition-colors duration-300"
              >Proyek</a
            >
            <a
              href="#contact"
              class="nav-link text-gray-300 hover:text-primary font-medium text-sm lg:text-base transition-colors duration-300"
              >Kontak</a
            >
          </div>
          <div class="flex items-center space-x-2">
            <a
              href="{{ asset('documents/cv.pdf') }}"
              download
              class="hidden md:flex items-center space-x-2 text-white bg-gradient-to-r from-primary/10 to-secondary/10 hover:from-primary/20 hover:to-secondary/20 border border-primary/30 hover:border-primary/50 font-medium text-sm transition-all duration-300 px-4 py-2 rounded-lg hover:shadow-lg hover:shadow-primary/20"
              title="Download CV"
            >
              <i class="ri-download-2-line text-sm text-primary"></i>
              <span>Unduh CV</span>
            </a>

            <button
              class="md:hidden w-8 h-8 flex items-center justify-center text-white hover:text-primary transition-colors duration-300"
              id="mobile-menu-btn"
            >
              <i class="ri-menu-line text-xl"></i>
            </button>
          </div>
        </div>
        <div class="md:hidden mt-3 sm:mt-4 hidden" id="mobile-menu">
          <div class="flex flex-col space-y-2 sm:space-y-3 py-2">
            <a
              href="#about"
              class="text-gray-300 hover:text-primary font-medium text-sm transition-colors duration-300 py-1"
              >Tentang</a
            >
            <a
              href="#skills"
              class="text-gray-300 hover:text-primary font-medium text-sm transition-colors duration-300 py-1"
              >Keahlian</a
            >
            <a
              href="#projects"
              class="text-gray-300 hover:text-primary font-medium text-sm transition-colors duration-300 py-1"
              >Proyek</a
            >
            <a
              href="#contact"
              class="text-gray-300 hover:text-primary font-medium text-sm transition-colors duration-300 py-1"
              >Kontak</a
            >
          </div>
        </div>
      </div>
    </nav>
    <main>
      <section id="about" class="min-h-screen pt-20 sm:pt-24 pb-16 px-4 sm:px-6 flex items-center">
        <div class="max-w-6xl mx-auto w-full">
          <div class="flex flex-col lg:flex-row items-center lg:items-start text-center lg:text-left gap-8 lg:gap-12">
            <div class="lg:w-1/2 fade-in px-4 lg:px-0">
              <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold mb-4 sm:mb-6">
                <span class="text-white leading-relaxed">Halo, Saya</span>
                <span class="text-primary"> {{ $user->name ?? 'User' }} </span>
              </h1>
              <p class="text-base sm:text-lg lg:text-xl text-white mb-6 sm:mb-8 leading-relaxed font-light">
                {{$user->bio ?? 'Pengembang web yang passionate dalam menciptakan solusi digital inovatif. Saya memiliki ketertarikan mendalam terhadap teknologi web modern dan selalu antusias untuk mempelajari hal-hal baru dalam dunia IT.'}}
              </p>
              <div class="flex flex-col lg:flex-row gap-4 items-center justify-center lg:items-center lg:justify-start">
                <!-- Social Media Icons -->
                <div class="flex space-x-2 justify-center">
                  @if($user && $user->git_link)
                  <a
                    href="{{ $user->git_link }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="bg-gray-900 text-white hover:bg-primary font-medium text-xl sm:text-2xl flex items-center justify-center px-3 py-2 rounded-2xl transition-all duration-300 hover:scale-110"
                  >
                    <i class="ri-github-line"></i>
                  </a>
                  @endif

                  @if($user && $user->linkedin_link)
                  <a
                    href="{{ $user->linkedin_link }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="bg-gray-900 text-white hover:bg-primary font-medium text-xl sm:text-2xl flex items-center justify-center px-3 py-2 rounded-2xl transition-all duration-300 hover:scale-110"
                  >
                    <i class="ri-linkedin-line"></i>
                  </a>
                  @endif

                  @if($user && $user->insta_link)
                  <a
                    href="{{ $user->insta_link }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="bg-gray-900 text-white hover:bg-primary font-medium text-xl sm:text-2xl flex items-center justify-center px-3 py-2 rounded-2xl transition-all duration-300 hover:scale-110"
                  >
                    <i class="ri-instagram-line"></i>
                  </a>
                  @endif
                </div>

                <!-- CV Button for Mobile -->
                <div class="md:hidden flex justify-center">
                  <a 
                    href="{{ asset('documents/cv.pdf') }}" 
                    download 
                    class="bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-semibold flex items-center space-x-2 px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-primary/25" 
                    title="Download CV"
                  >
                    <i class="ri-download-2-line text-sm"></i>
                    <span class="text-sm">Unduh CV</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="lg:w-1/2 fade-in mt-8 lg:mt-0 px-4 lg:px-0">
              <div class="relative flex justify-center lg:justify-end">
                <div class="relative group">
                  <div class="absolute -inset-1 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                  <div class="relative">
                    <img
                      src="{{ $user->profile_image_url }}"
                      alt="{{ $user->name . ' image' }}"
                      class="w-48 h-48 sm:w-64 sm:h-64 md:w-80 md:h-80 rounded-full mx-auto object-cover object-top shadow-2xl border-4 border-gray-800 group-hover:border-primary transition-all duration-300"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="skills" class="py-12 sm:py-16 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-10 sm:mb-16 fade-in">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-white">
              Keahlian & Teknologi
            </h2>
            <p class="text-lg sm:text-xl text-gray-400">
              Teknologi dan tools yang saya kuasai
            </p>
          </div>
          @if($skills)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
              @foreach($skills as $skill)
                <div class="group bg-gradient-to-br from-gray-900/80 to-gray-800/50 backdrop-blur-sm p-4 sm:p-6 lg:p-8 rounded-2xl fade-in border border-gray-700/50 hover:border-primary/50 hover:bg-gradient-to-br hover:from-gray-800/90 hover:to-gray-700/60 transition-all duration-500 transform hover:scale-105 hover:shadow-2xl hover:shadow-primary/20 cursor-pointer relative overflow-hidden">
                  <!-- Glow effect on hover -->
                  <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-secondary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                  
                  <div class="text-center relative z-10">
                    <div class="relative inline-block">
                      <i class="{{ $skill->icon }} text-2xl sm:text-3xl lg:text-4xl mb-2 sm:mb-4 text-gray-400 group-hover:text-primary transition-all duration-500 transform group-hover:scale-110"></i>
                      <!-- Pulse ring on hover -->
                      <div class="absolute inset-0 rounded-full border-2 border-primary/30 scale-150 opacity-0 group-hover:opacity-100 group-hover:animate-ping"></div>
                    </div>
                    <span class="block text-sm sm:text-base lg:text-lg font-medium text-gray-300 group-hover:text-white transition-colors duration-300">{{ ucfirst($skill->name) }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </section>
      <section id="projects" class="py-12 sm:py-16 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
          <div class="text-center mb-10 sm:mb-16 fade-in">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-white">Proyek Saya</h2>
            <p class="text-lg sm:text-xl text-gray-400">
              Beberapa proyek yang telah saya kerjakan
            </p>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-9">
            @if($projects)
              @foreach($projects as $project)
                <div class="group project-card rounded-2xl overflow-hidden border border-gray-700/50 bg-gradient-to-br from-gray-900/80 to-gray-800/50 backdrop-blur-sm fade-in transition-all duration-500 hover:border-primary/50 hover:shadow-2xl hover:shadow-primary/10 transform hover:scale-[1.02] hover:-translate-y-1">
                  <div class="relative h-40 sm:h-48 overflow-hidden">
                    <img
                      src="{{ $project->image_url }}"
                      alt="{{ $project->name . '_image' }}"
                      loading="lazy"
                      class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-700"
                    />
                    <!-- Overlay with project links -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                      <div class="absolute bottom-4 left-4 right-4 flex gap-2">
                        <a href="{{ $project->github_link?? '' }}" class="bg-gray-900/90 hover:text-primary text-white px-3 py-1.5 rounded-lg text-xs font-medium backdrop-blur-sm transition-colors duration-300">
                          <i class="ri-github-line mr-1"></i>Code
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 sm:p-6 relative">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-3 sm:mb-4 text-white group-hover:text-primary transition-colors duration-300">{{ $project->name }}</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-3 sm:mb-4 leading-relaxed line-clamp-3">
                      {{ $project->description }}
                    </p>
                    <div class="flex flex-wrap gap-2">
                      @if($project->tech_stack && count($project->tech_stack) > 0)
                        @foreach($project->tech_stack as $tech)
                          <div class="bg-gray-800/80 group-hover:bg-primary/20 p-1.5 sm:p-2 rounded-xl w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="{{ $tech }} text-xs sm:text-sm text-gray-400 group-hover:text-primary transition-colors duration-300"></i>
                          </div>
                        @endforeach
                      @endif
                    </div>
                    
                    <!-- Subtle glow effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-secondary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </section>
      <section id="contact" class="py-10 px-4 sm:px-6 mb-8 sm:mb-11">
        <div class="max-w-4xl mx-auto">
          <div class="text-center mb-12 sm:mb-16 fade-in">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-white">Kontak Saya</h2>
            <p class="text-lg sm:text-xl text-gray-400">
              Saya terbuka untuk peluang kerja dan kolaborasi
            </p>
          </div>
          <form
            id="contact-form"
            class="space-y-4 sm:space-y-6 fade-in max-w-2xl mx-auto bg-gradient-to-br from-gray-900/80 to-gray-800/50 backdrop-blur-sm p-6 sm:p-8 rounded-2xl border border-gray-700/50"
            action="submit.php"
            method="POST"
          >
            <div class="group">
              <label for="name" class="block text-gray-300 mb-2 text-sm sm:text-base font-medium">Nama</label>
              <input
                type="text"
                id="name"
                name="name"
                required
                class="w-full p-3 sm:p-4 bg-gray-800/80 rounded-xl border border-gray-600/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-sm sm:text-base placeholder-gray-500 group-hover:border-gray-500"
                placeholder="Masukkan nama lengkap"
              />
            </div>
            <div class="group">
              <label for="email" class="block text-gray-300 mb-2 text-sm sm:text-base font-medium">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                required
                class="w-full p-3 sm:p-4 bg-gray-800/80 rounded-xl border border-gray-600/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-sm sm:text-base placeholder-gray-500 group-hover:border-gray-500"
                placeholder="nama@email.com"
              />
            </div>
            <div class="group">
              <label for="message" class="block text-gray-300 mb-2 text-sm sm:text-base font-medium"
                >Pesan</label
              >
              <textarea
                id="message"
                name="message"
                rows="4"
                required
                class="w-full p-3 sm:p-4 bg-gray-800/80 rounded-xl border border-gray-600/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-sm sm:text-base resize-none placeholder-gray-500 group-hover:border-gray-500"
                placeholder="Tulis pesan Anda di sini..."
              ></textarea>
            </div>
            <button
              type="submit"
              class="w-full bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-semibold py-3 sm:py-4 px-6 rounded-xl transition-all duration-300 text-sm sm:text-base transform hover:scale-[1.02] hover:shadow-lg hover:shadow-primary/25 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-gray-900"
            >
              <i class="ri-send-plane-line mr-2"></i>Kirim Pesan
            </button>
          </form>
        </div>
      </section>
      <footer class="bg-gray-900 py-4 sm:py-6">
        <div class="max-w-6xl mx-auto text-center px-4">
          <p class="text-gray-400 text-sm sm:text-base">
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

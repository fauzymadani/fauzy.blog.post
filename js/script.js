const routes = {
  "/tentang": "tentang",
  "/proyek": "proyek",
  "/kontak": "kontak",
  "/archive": "archive"
};

// Fungsi untuk mengambil dan menampilkan repo GitHub
async function loadGitHubRepos() {
  const username = "fauzymadani"; // ganti dengan username GitHub kamu
  const container = document.getElementById("project-list");
  container.innerHTML = "<p>Fetching...</p>";

  try {
    const res = await fetch(`https://api.github.com/users/${username}/repos`);
    if (!res.ok) throw new Error("Gagal memuat repo.");
    const repos = await res.json();

    // Urutkan berdasarkan update terbaru
    repos.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));

    // Kosongkan kontainer
    container.innerHTML = "";

    // Tambahkan setiap proyek sebagai kotak
    repos.forEach(repo => {
      const box = document.createElement("div");
      box.className = "project-box";

      const title = document.createElement("a");
      title.href = repo.html_url;
      title.target = "_blank";
      title.textContent = repo.name;

      const desc = document.createElement("div");
      desc.className = "project-description";
      desc.textContent = repo.description || "(no description)";

      box.appendChild(title);
      box.appendChild(desc);
      container.appendChild(box);
    });
  } catch (err) {
    container.innerHTML = `<p>${err.message}</p>`;
  }
}

// Terjemahan multilingual
const translations = {
  id: {
    title: "Blog Post",
    nav_about: "Tentang",
    nav_projects: "Proyek",
    nav_contact: "Kontak",
    latest_notes: "Catatan Terbaru",
    note1: "Zathura: Tema Gelap yang Nyaman",
    note2: "Membuat Peacefox: userChrome.css Retro",
    note3: "Mengintegrasi DWM dengan NsCDE",
    note4: "Menjaga Tampilan Sederhana di Web",
    about_heading: "Tentang Saya",
    about_text1: "Saya adalah pengguna Linux yang suka hal klasik, terminal, dan desain minimal.",
    about_text2: "Situs ini adalah tempat saya menulis, mendokumentasikan proyek pribadi, dan berbagi hal-hal yang menurut saya menarik.",
    projects_heading: "Proyek",
    loading_projects: "memuat...",
    contact_heading: "Kontak",
    footer_text: "&copy; 2025 Halaman Saya. Dibuat dengan ♥ dan HTML polos."
  },
  en: {
    title: "My Blog Post",
    nav_about: "About",
    nav_projects: "Projects",
    nav_contact: "Contact",
    latest_notes: "Latest Notes",
    note1: "Zathura: A Comfortable Dark Theme",
    note2: "Making Peacefox: Retro userChrome.css",
    note3: "Integrating DWM with NsCDE",
    note4: "Keeping Web Design Simple",
    about_heading: "About Me",
    about_text1: "I'm a Linux user who loves classic things, terminals, and minimal design.",
    about_text2: "This site is where I write, document personal projects, and share things I find interesting.",
    projects_heading: "Projects",
    loading_projects: "fetching...",
    contact_heading: "Contact",
    footer_text: "&copy; 2025 My Page. Made with ♥ and plain HTML."
  }
};

// Navigasi antar halaman
function navigate(path) {
  const target = routes[path] || "tentang";
  document.querySelectorAll("main section").forEach(sec => {
    sec.classList.remove("active");
  });
  document.getElementById(target).classList.add("active");

  if (target === "proyek" && !document.getElementById("proyek").dataset.loaded) {
    loadGitHubRepos();
    document.getElementById("proyek").dataset.loaded = "true";
  }

  history.pushState({ path }, "", path);
}

// Inisialisasi event untuk semua link internal
document.querySelectorAll("a[data-link]").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const path = link.getAttribute("href");
    navigate(path);
  });
});

// Handle tombol "back" browser
window.addEventListener("popstate", e => {
  const path = e.state?.path || "/tentang";
  navigate(path);
});

// Ganti bahasa
function updateLanguage(lang) {
  const elements = document.querySelectorAll("[data-i18n]");
  elements.forEach(el => {
    const key = el.dataset.i18n;
    if (translations[lang] && translations[lang][key]) {
      el.innerHTML = translations[lang][key];
    }
  });
  document.documentElement.lang = lang;
}

document.getElementById("language-switcher").addEventListener("change", e => {
  const lang = e.target.value;
  updateLanguage(lang);
});

// Load pertama kali
navigate(location.pathname);
updateLanguage("id");


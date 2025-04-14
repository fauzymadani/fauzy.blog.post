<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Saya</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container">
    <header>
      <div class="header-flex">
        <h1 data-i18n="title">Blog post</h1>
        <div class="search-container">
          <div class="gcse-search"></div>
        </div>
      </div>
      <nav class="topnav">
        <div class="nav-links">
          <a href="/" data-link data-i18n="nav_about">Home</a>
          <a href="/tentang" data-link data-i18n="nav_about">About</a>
          <a href="/proyek" data-link data-i18n="nav_projects">Project</a>
          <a href="/kontak" data-link data-i18n="nav_contact">Contact</a>
          <a href="/archive" data-link data-i18n="nav_contact">Archive</a>
        </div>
        <!-- <select id="language-switcher" class="lang-select">
          <option value="id">🇮🇩 Indonesia</option>
          <option value="en">🇬🇧 English</option>
        </select> -->
      </nav>
    </header>

    <div class="content-wrapper">
      <aside id="sidebar">
        <h3 data-i18n="latest_notes">Latest Post</h3>
        <ul>
          <li><a href="blog/zathura.php" data-i18n="note1">Customizing Zathura</a></li>
          <li><a href="blog/creating-custom-malloc.php" data-i18n="note2">creating Custom malloc in c</a></li>
          <li><a href="blog/ncurses-basic.php" data-i18n="note3">Ncurses Basic</a></li>
          <li><a href="#" data-i18n="note4">unix like operating system</a></li>
        </ul>
      </aside>

      <main>
        <section id="tentang" class="active">
          <h2 data-i18n="about_heading">Behind the Terminal</h2>

          <p data-i18n="about_text1">
            I’m not a developer by profession, nor a designer by trade. I’m just someone who finds peace in clean terminals, classic interfaces, and software that does one thing well.
          </p>

          <p data-i18n="about_text2">
            This site is a small corner of the internet where I document personal projects, tinker with UI tweaks, and occasionally write about tools I love — mostly on Linux.
          </p>

          <p data-i18n="about_text3">
            I have a preference for things that are simple but powerful. Give me a dark-themed terminal with monospaced fonts over a bloated GUI any day. Most of the time, I’m more excited about customizing <code>userChrome.css</code> or <code>~/.bashrc</code> than scrolling social media.
          </p>

          <p data-i18n="about_text4">
            For example, here’s how I like to set up my terminal prompt to be minimal yet informative:
          </p>

          <pre>
# ~/.bashrc or ~/.zshrc
PS1='\[\e[38;5;250m\]\u@\h \[\e[38;5;240m\]\w \[\e[0m\]\$ '
  </pre>

          <p data-i18n="about_text5">
            It’s nothing fancy — just the username, hostname, and working directory in subtle colors. But it feels like home.
          </p>

          <p data-i18n="about_text6">
            If you’re someone who enjoys this kind of aesthetic and philosophy, maybe you’ll find something useful here. Or at least, relatable.
          </p>
        </section>

        <section id="proyek">
          <h2 data-i18n="projects_heading">Projects</h2>
          <div id="project-list" class="project-listing">
            <p id="project-loading" data-i18n="loading_projects">fetching....</p>
          </div>
        </section>

        <section id="kontak">
          <h2 data-i18n="contact_heading">Contact</h2>
          <div class="contact-box">
            <div class="contact-label">Email:</div>
            <div class="contact-info"><a href="mailto:you@example.com">you@example.com</a></div>

            <div class="contact-label">GitHub:</div>
            <div class="contact-info"><a href="https://github.com/username" target="_blank">username</a></div>

            <div class="contact-label">Blog:</div>
            <div class="contact-info"><a href="https://your-blog.example" target="_blank">your-blog.example</a></div>
          </div>
        </section>

        <section id="archive">
          <header style="text-align:right;">
            <a href="blog/permalink.php" style="text-decoration: none; color: navy;">permalink</a>
          </header>
          <h2 style="border-bottom: 2px solid navy; color: navy;" data-i18n="contact_heading">Archived Blog Posts</h2>

          <table class="archive-table">
            <tr>
              <th>Date</th>
              <th>Title</th>
              <th>Description</th>
            </tr>
            <tr>
              <td>2025-04-14</td>
              <td><a href="blog_malloc.php">Creating Custom malloc in C</a></td>
              <td>Build your own memory allocator, the hard (and fun) way.</td>
            </tr>
            <tr>
              <td>2025-04-13</td>
              <td><a href="blog_ncurses.php">Ncurses Basic</a></td>
              <td>Intro to terminal-based UIs with ncurses. Feels like `make menuconfig`!</td>
            </tr>
            <tr>
              <td>2025-04-12</td>
              <td><a href="blog_zathura.php">Zathura: Dark Theme</a></td>
              <td>How to make Zathura easier on your eyes at night.</td>
            </tr>
          </table>
        </section>
      </main>
    </div>

    <footer>
      <p data-i18n="footer_text">&copy; 2024 Fauzy Madani, Made with ♥</p>
    </footer>
  </div>

  <script async src="https://cse.google.com/cse.js?cx=727215aa94c34467a"></script>
  <script src="js/script.js"></script>
</body>

</html>

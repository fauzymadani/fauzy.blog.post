<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Saya</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="alternate" type="application/rss+xml" title="RSS Feed" href="/rss.xml">
</head>

<body>
  <div class="container">
    <header>
      <div class="header-flex">
        <h1 data-i18n="title">fauzy.blog.post</h1>
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
          <a href="https://github.com/fauzymadani">Source Code</a>
          <!-- <a href="rss.xml" data-link data-i18n="nav_contact">RSS</a> -->
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
          <li><img src="https://www.svgrepo.com/show/8625/pin.svg" height="15">-><a href="blog/the-gray-that-lives-within.php" data-i18n="note4">The Gray That Lives within</a></li>
          <li><a href="blog/zathura.php" data-i18n="note1">Customizing Zathura</a></li>
          <li><a href="blog/creating-custom-malloc.php" data-i18n="note2">creating Custom malloc in c</a></li>
          <li><a href="blog/ncurses-basic.php" data-i18n="note3">Ncurses Basic</a></li>
        </ul>
      </aside>

      <main>
        <section id="tentang" class="active">
          <header>
            <strong style="font-size: 20px;">
              <a href="rss.xml" style="color: #444; text-decoration: none;">
                <img src="https://apps.disroot.org/image_proxy?url=https%3A%2F%2Fcdn4.iconfinder.com%2Fdata%2Ficons%2Fshare-solid-style%2F24%2Fshare-rss-feed-1024.png&h=6296e0fb5961985d78b96c940cf86ed7365745a1081a02803e2d88c38772de0c" alt="RSS" width="24" height="24">
                RSS Feeds
              </a>
            </strong>
          </header>
          <h2>About</h2>
          <strong>Note: Maybe this website is not a clean code example or the best practice. because this website is just for fun only!, any help for improving
            and advice is appreciated.</strong>

          <p>
            This website is a small, quiet corner of the internet — a place to archive experiments, share technical notes, and document tools I enjoy using. There’s no agenda, no tracking, no distractions. Just plain HTML, CSS, a sprinkle of PHP, and a love for simplicity.
          </p>

          <p>
            You won’t find a modern JavaScript framework here. No analytics. No ads. Just content that’s meant to be read, not consumed. If that feels refreshing to you, then we already have something in common.
          </p>

          <h2>Philosophy</h2>

          <p>
            I like things that are simple — not because I reject complexity, but because I want to understand and shape the tools I use. I prefer software that works *how I want*, not how someone else decided it should.
          </p>

          <p>
            To me, control matters. I like to configure, customize, and sometimes even break things — because that's when I feel most at home. Whether it's scripting a workflow, tweaking a UI, or editing config files, I want to be the one in charge.
          </p>

          <p>
            Simplicity isn't about less — it's about clarity. It's about knowing what each part does, and why it's there. It's about reducing friction, not functionality.
          </p>

          <p>
            I don’t chase modern trends or flashy interfaces. I care more about stability, focus, and tools that stay out of the way. A terminal with a clean prompt and well-tuned dotfiles brings me more joy than a glossy app ever will.
          </p>

          <p>
            This site is my space to share that mindset — to document the tools I use, the things I make, and the way I think about computing. Maybe it resonates with you. Maybe it doesn’t. But it’s honest.
          </p>

          <pre>
# ~/.bashrc
PS1='\[\e[38;5;250m\]\u@\h \[\e[38;5;240m\]\w \[\e[0m\]\$ '
  </pre>

          <p>
            A terminal prompt, minimal and soft. That’s where I start.
          </p>

          <h2>License</h2>
          <img src="assets/license.png"> <!-- lisensi gpl -->

          <p>This is part of Fauzy's Blog.<br>
            <br>
            Copyright (C) 2024 Fauzy Madani<br>
            <br>
            This program is free software: you can redistribute it and/or modify
            it under the terms of the GNU General Public License as published by
            the Free Software Foundation, either version 3 of the License, or
            (at your option) any later version.<br>
            <br>
            See
            https: //www.gnu.org/licenses for details.
          </p>

        </section>


        <section id="proyek">
          <header><strong style="font-size: 20px;"><a href="rss.xml" style="color: #444; text-decoration: none;"><img src="assets/rss.png" alt="RSS" width="24" height="24"> RSS Feeds</a></strong></header>

          <h2 data-i18n="projects_heading">Projects</h2>
          <div id="project-list" class="project-listing">
            <p id="project-loading" data-i18n="loading_projects">fetching....</p>
          </div>
          <br>
        </section>

        <section id="kontak">
          <header><strong style="font-size: 20px;"><a href="rss.xml" style="color: #444; text-decoration: none;"><img src="assets/rss.png" alt="RSS" width="24" height="24"> RSS Feeds</a></strong></header>

          <h2 data-i18n="contact_heading">Contact</h2>
          <div class="contact-box">
            <div class="contact-label">Email:</div>
            <div class="contact-info"><a href="mailto:keperluansekolahfauzy@gmail.com">gmail</a></div>

            <div class="contact-label">GitHub:</div>
            <div class="contact-info"><a href="https://github.com/fauzymadani" target="_blank">fauzymadani</a></div>

            <div class="contact-label">IRC:</div>
            <div class="contact-info">
              <p>join me at <i>#archlinux-offtopic</i> on libera chat</p>
            </div>
            <div class="contact-label">PublicKey: </div>
            <div class="contact-info">
              <a href="assets/fauzy_0x0A48BF3C_public.asc">GPG key</a>
            </div>

          </div>
          <br>
          <br>
        </section>

        <section id="archive">
          <header><strong style="font-size: 20px;"><a href="rss.xml" style="color: #444; text-decoration: none;"><img src="assets/rss.png" alt="RSS" width="24" height="24"> RSS Feeds</a></strong></header>

          <h2 style="border-bottom: 2px solid navy; color: navy;" data-i18n="contact_heading">Archived Blog Posts</h2>

          <table class="archive-table">
            <tr>
              <th>Date</th>
              <th>Title</th>
              <th>Description</th>
            </tr>

          </table>
          <br>
        </section>
      </main>
    </div>

    <div class="inner-footer">
      <div>
        All content licensed under <a href="https://www.gnu.org/licenses/gpl-3.0.en.html">GPL 3.0 License</a> 2024 - Fauzy
      </div>
      <div>
        <img src="assets/license.png" height="20"> <!-- lisensi gpl -->
      </div>
    </div>

  </div>


  <footer>
    <p data-i18n="footer_text">&copy; 2024 Fauzy Madani, Made with ♥</p>
  </footer>

  <script async src="https://cse.google.com/cse.js?cx=727215aa94c34467a"></script>
  <script src="js/script.js"></script>
</body>

</html>

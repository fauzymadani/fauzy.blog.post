<?php include __DIR__ . '/../include/layout/header.php'; ?>
<?php include __DIR__ . '/../include/layout/sidebar.php'; ?>

<main>
  <section id="blog" class="active">
    <header><i>Translation not yet available</i></header>
    <h2>Zathura: A Comfortable Dark Theme</h2>
    <p>
      If you're someone who values simplicity, speed, and control in your Linux environment, chances are you've heard of <strong>Zathura</strong>. It's a minimalist and highly customizable PDF viewer that's perfect for keyboard-driven workflows.
    </p>

    <p>
      However, one common complaint among users is the default bright appearance. For those working in dark environments, late-night study sessions, or who simply prefer a dark interface, the standard look can be a strain on the eyes.
    </p>

    <p>
      Fortunately, Zathura allows deep customization through a configuration file called <code>zathurarc</code>. You can easily change its colors and behavior to suit your preferences.
    </p>

    <p>
      Here's a minimal and cozy dark theme configuration you can try:
    </p>

    <pre>
# ~/.config/zathura/zathurarc

set recolor              true
set recolor-keephue      true
set recolor-darkcolor    "#1e1e1e"
set recolor-lightcolor   "#eeeeee"
set default-bg           "#1e1e1e"
set default-fg           "#eeeeee"
set statusbar-bg         "#282828"
set statusbar-fg         "#a8a8a8"
set inputbar-bg          "#282828"
set inputbar-fg          "#ffffff"
    </pre>

    <p>
      This configuration enables recoloring mode, keeps the hue of images, and sets comfortable contrast between text and background. It also styles the status bar and input bar to match the overall theme.
    </p>

    <p>
      After saving the above snippet to your <code>~/.config/zathura/zathurarc</code> file, restart Zathura. You should immediately notice a sleek, distraction-free interface that's easier on the eyes—especially in low-light setups.
    </p>

    <p>
      Whether you're reading academic papers, technical manuals, or even comic books, this dark theme will give you a better, more enjoyable experience with Zathura. Feel free to tweak the colors further to make it truly yours.
    </p>
  </section>
</main>

<?php include __DIR__ . '/../include/layout/footer.php'; ?>

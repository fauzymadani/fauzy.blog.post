<?php include __DIR__ . '/../include/layout/header.php'; ?>
<?php include __DIR__ . '/../include/layout/sidebar.php'; ?>

<main>
    <section id="blog" class="active">
        <header><i><i>01-08-2024 21:09</i></i></header>
        <h2>Building Text-Based Interfaces with <code>ncurses</code> in C</h2>

        <p>
            The <code>ncurses</code> library provides a powerful toolkit for creating terminal-based user interfaces (TUIs) in C. It abstracts away low-level terminal handling and offers features like windows, input, colors, and layout management. TUIs are still widely used in configuration tools (e.g., <code>make menuconfig</code>), system monitors (e.g., <code>htop</code>), and CLI apps.
        </p>

        <p>
            This post covers the fundamentals of ncurses, including initialization, input handling, window management, colors, and building a minimal <code>menuconfig</code>-like interface.
        </p>

        <h3>1. Initializing and Ending ncurses</h3>
        <p>
            Every ncurses program begins by initializing the screen and ends by restoring the terminal to normal mode.
        </p>

        <pre>
#include &lt;ncurses.h&gt;

int main() {
    initscr();              // Initialize ncurses
    cbreak();               // Disable line buffering
    noecho();               // Don't echo user input
    keypad(stdscr, TRUE);   // Enable special keys

    printw("Hello from ncurses!");
    refresh();
    getch();

    endwin();               // Restore terminal
    return 0;
}
    </pre>

        <h3>2. Creating Windows</h3>
        <p>
            ncurses supports multiple windows. A window is a rectangular area you can draw to separately from the main screen.
        </p>

        <pre>
WINDOW* win = newwin(10, 30, 5, 5); // height, width, y, x
box(win, 0, 0);                     // Draw border
mvwprintw(win, 1, 1, "Window content");
wrefresh(win);
getch();
delwin(win);                       // Clean up
    </pre>

        <h3>3. Handling Keyboard Input</h3>
        <p>
            Use <code>getch()</code> to read input. Special keys like arrow keys are enabled with <code>keypad()</code>.
        </p>

        <pre>
int ch;
while ((ch = getch()) != 'q') {
    switch (ch) {
        case KEY_UP:
            printw("Up arrow pressed\n");
            break;
        case KEY_DOWN:
            printw("Down arrow pressed\n");
            break;
        default:
            printw("Key: %d\n", ch);
    }
    refresh();
}
    </pre>

        <h3>4. Working with Colors</h3>
        <p>
            ncurses allows colored text and background. First call <code>start_color()</code> and define color pairs.
        </p>

        <pre>
start_color();
init_pair(1, COLOR_GREEN, COLOR_BLACK);
attron(COLOR_PAIR(1));
printw("This is green on black\n");
attroff(COLOR_PAIR(1));
refresh();
    </pre>

        <h3>5. Building a Menuconfig-like UI</h3>
        <p>
            You can simulate a kernel config UI with simple navigation and selection.
        </p>

        <pre>
#define OPTIONS 3

const char* menu[OPTIONS] = {
    "[*] Enable Feature A",
    "[ ] Enable Feature B",
    "[ ] Enable Feature C"
};

int highlight = 0;

void draw_menu() {
    clear();
    for (int i = 0; i &lt; OPTIONS; ++i) {
        if (i == highlight)
            attron(A_REVERSE);
        mvprintw(i + 2, 2, menu[i]);
        if (i == highlight)
            attroff(A_REVERSE);
    }
    refresh();
}

int main() {
    initscr();
    cbreak();
    noecho();
    keypad(stdscr, TRUE);

    int ch;
    while (1) {
        draw_menu();
        ch = getch();
        if (ch == KEY_UP) highlight = (highlight - 1 + OPTIONS) % OPTIONS;
        else if (ch == KEY_DOWN) highlight = (highlight + 1) % OPTIONS;
        else if (ch == ' ') {
            menu[highlight][1] = (menu[highlight][1] == '*') ? ' ' : '*';
        } else if (ch == 'q') break;
    }

    endwin();
    return 0;
}
    </pre>

        <h3>6. Compiling ncurses Programs</h3>
        <p>
            You must link the <code>ncurses</code> library using <code>-lncurses</code>.
        </p>

        <pre>
gcc -o tui tui.c -lncurses
    </pre>

        <h3>7. Layout Tips and Tricks</h3>
        <ul>
            <li>Use <code>getmaxyx(stdscr, y, x)</code> to get terminal size.</li>
            <li>Use <code>mvprintw(y, x, "...")</code> to position text precisely.</li>
            <li>To center text: <code>mvprintw(y, (COLS - strlen(str)) / 2, str)</code></li>
        </ul>

        <h3>8. Mouse Support (Bonus)</h3>
        <p>
            ncurses supports mouse input in terminals that allow it. Enable mouse events:
        </p>

        <pre>
#include &lt;ncurses.h&gt;

int main() {
    initscr();
    keypad(stdscr, TRUE);
    mousemask(ALL_MOUSE_EVENTS, NULL);

    MEVENT event;
    while (1) {
        int ch = getch();
        if (ch == KEY_MOUSE) {
            if (getmouse(&event) == OK) {
                mvprintw(0, 0, "Mouse clicked at %d,%d", event.y, event.x);
            }
        }
        refresh();
    }

    endwin();
    return 0;
}
    </pre>

        <h3>Conclusion</h3>
        <p>
            Ncurses is a great way to create rich interactive command-line applications. Whether you’re building a config UI or a dashboard, it offers low-level control with high-level simplicity. Mastering it can unlock a lot of power in the terminal.
        </p>

        <p>
            You can explore more advanced features such as panels, forms, and menus using the extended ncurses libraries.
        </p>

        <div class="inner-footer">
            <div>
                All content licensed under <a href="https://www.gnu.org/licenses/gpl-3.0.en.html">GPL 3.0 License</a> 2024 - Fauzy
            </div>
            <div>
                This site is powered by <a href="https://www.vim.org/">Vim</a>, and <a href="https://www.php.net/">php</a>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../include/layout/footer.php'; ?>

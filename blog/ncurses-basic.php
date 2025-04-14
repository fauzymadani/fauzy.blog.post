<?php include __DIR__ . '/../include/layout/header.php'; ?>
<?php include __DIR__ . '/../include/layout/sidebar.php'; ?>

<main>
    <section id="blog" class="active">
        <header><i>Part 1</i> <a href="permalink.php">permalink</a></header>
        <h2>Ncurses Basic: Building TUIs with C</h2>

        <p>
            <strong>ncurses</strong> is a powerful C library that allows developers to create text-based user interfaces (TUIs) in a terminal. It provides an API for managing input, output, windows, colors, and user interaction in terminal environments.
            It's widely used in applications like <code>htop</code>, <code>vim</code>, and the Linux kernel's <code>menuconfig</code>.
        </p>

        <h3>1. Initializing Ncurses</h3>
        <p>
            To start using ncurses, you must initialize the screen using <code>initscr()</code> and terminate it with <code>endwin()</code>. Here's the minimal setup:
        </p>

        <pre>
#include &lt;ncurses.h&gt;

int main() {
    initscr();            // Initialize screen
    printw("Hello, ncurses!");
    refresh();            // Refresh screen to show text
    getch();              // Wait for user input
    endwin();             // Clean up and return terminal to normal
    return 0;
}
    </pre>

        <h3>2. Handling User Input</h3>
        <p>
            Ncurses provides input functions like <code>getch()</code> and <code>keypad()</code>. You can detect arrow keys and function keys with ease.
        </p>

        <pre>
int ch;
keypad(stdscr, TRUE);  // Enable special keys
while ((ch = getch()) != 'q') {
    switch (ch) {
        case KEY_UP:
            printw("Up key pressed\n");
            break;
        case KEY_DOWN:
            printw("Down key pressed\n");
            break;
        default:
            printw("Key code: %d\n", ch);
    }
}
    </pre>

        <h3>3. Creating Windows and Boxes</h3>
        <p>
            Windows help divide your terminal into separate sections. You can create a box around a window using <code>box()</code>.
        </p>

        <pre>
WINDOW *win = newwin(10, 40, 5, 5);  // height, width, y, x
box(win, 0, 0);
mvwprintw(win, 1, 1, "Window with a box!");
wrefresh(win);
getch();
delwin(win);
    </pre>

        <h3>4. Colors and Attributes</h3>
        <p>
            Ncurses supports colored text using <code>start_color()</code> and <code>init_pair()</code>.
        </p>

        <pre>
start_color();
init_pair(1, COLOR_RED, COLOR_BLACK);
attron(COLOR_PAIR(1));
printw("Red text on black background\n");
attroff(COLOR_PAIR(1));
refresh();
getch();
    </pre>

        <h3>5. Full Example: Kernel-like Menu</h3>
        <p>
            Here's a more complex ncurses application that mimics the Linux kernel's <code>menuconfig</code>. It features nested menus, selectable items, and keyboard navigation:
        </p>

        <pre>
#include <ncurses.h>
#include <string.h>

typedef struct Menu Menu;

typedef enum {
    STATUS_EXCLUDED,
    STATUS_BUILTIN,
    STATUS_MODULE,
    STATUS_ALLIN
} MenuStatus;

typedef struct MenuItem {
    const char *label;
    int is_submenu;
    Menu *submenu;
    MenuStatus status;
} MenuItem;

struct Menu {
    const char *title;
    MenuItem *items;
    int num_items;
};

const char* status_symbol(MenuStatus status) {
    switch (status) {
        case STATUS_EXCLUDED: return "[ ]";
        case STATUS_BUILTIN:  return "[*]";
        case STATUS_MODULE:   return "<M>";
        case STATUS_ALLIN:    return "<*>";
        default: return "   ";
    }
}

void show_menu(Menu *menu, WINDOW *win, int max_lines) {
    int choice = 0, ch;
    keypad(win, TRUE);

    while (1) {
        werase(win);
        box(win, 0, 0);

        for (int i = 0; i < menu->num_items && i < max_lines - 2; i++) {
            if (i == choice) {
                wattron(win, COLOR_PAIR(2));
                mvwprintw(win, 1 + i, 2, " %s %-30s %s",
                    status_symbol(menu->items[i].status),
                    menu->items[i].label,
                    menu->items[i].is_submenu ? "--->" : "");
                wattroff(win, COLOR_PAIR(2));
            } else {
                mvwprintw(win, 1 + i, 2, " %s %-30s %s",
                    status_symbol(menu->items[i].status),
                    menu->items[i].label,
                    menu->items[i].is_submenu ? "--->" : "");
            }
        }

        wrefresh(win);
        ch = wgetch(win);

        switch (ch) {
            case KEY_UP:
                choice = (choice - 1 + menu->num_items) % menu->num_items;
                break;
            case KEY_DOWN:
                choice = (choice + 1) % menu->num_items;
                break;
            case 10: // Enter
                if (menu->items[choice].is_submenu) {
                    show_menu(menu->items[choice].submenu, win, max_lines);
                } else if (strcmp(menu->items[choice].label, "Exit") == 0) {
                    return;
                } else {
                    menu->items[choice].status = (menu->items[choice].status + 1) % 4;
                }
                break;
            case 27: // ESC
                return;
        }
    }
}

int main() {
    initscr();
    start_color();
    cbreak();
    noecho();
    curs_set(0);
    keypad(stdscr, TRUE);

    int screen_height, screen_width;
    getmaxyx(stdscr, screen_height, screen_width);

    init_pair(1, COLOR_WHITE, COLOR_BLUE);   // Main background
    init_pair(2, COLOR_WHITE, COLOR_BLUE);  // Highlighted menu
    init_pair(3, COLOR_CYAN, COLOR_BLACK);   // Title
    init_pair(4, COLOR_BLACK, COLOR_WHITE);  // Menu box
    init_pair(5, COLOR_YELLOW, COLOR_BLUE);  // Footer

    WINDOW *main_win = newwin(screen_height, screen_width, 0, 0);
    wbkgd(main_win, COLOR_PAIR(1));
    box(main_win, 0, 0);
    wattron(main_win, COLOR_PAIR(3));
    mvwprintw(main_win, 0, 2, ".config - Linux/x86 Kernel Configuration");
    wattroff(main_win, COLOR_PAIR(3));

    // Help text
    wattron(main_win, A_BOLD);
    mvwprintw(main_win, 1, 2, "Arrow keys navigate the menu. <Enter> selects submenus ---> (or empty submenus ----).");
    mvwprintw(main_win, 2, 2, "Highlighted letters are hotkeys. Pressing <Y> includes, <N> excludes, <M> modularizes features.");
    mvwprintw(main_win, 3, 2, "Press <Esc><Esc> to exit, <?> for Help, </> for Search. Legend: [*] built-in  [ ] excluded  <M> module  <*> all-in");
    wattroff(main_win, A_BOLD);

    // Menu window
    int menu_height = screen_height - 9;
    int menu_width = screen_width - 6;
    int menu_starty = 5;
    int menu_startx = 3;
    WINDOW *menu_win = derwin(main_win, menu_height, menu_width, menu_starty, menu_startx);
    wbkgd(menu_win, COLOR_PAIR(4));
    box(menu_win, 0, 0);
    wrefresh(main_win);

    // Footer
    wattron(main_win, COLOR_PAIR(5));
    mvwprintw(main_win, screen_height - 2, 2, "<Select>  < Exit >  < Help >  < Save >  < Load >");
    wattroff(main_win, COLOR_PAIR(5));
    wrefresh(main_win);

    // Submenu: General setup
    MenuItem general_items[] = {
        {"Enable module support", 0, NULL, STATUS_EXCLUDED},
        {"Processor type", 0, NULL, STATUS_BUILTIN},
        {"Exit", 0, NULL, STATUS_EXCLUDED},
    };
    Menu general_menu = {
        "General Setup",
        general_items,
        sizeof(general_items) / sizeof(MenuItem)
    };

    // Main menu
    MenuItem main_items[] = {
        {"64-bit kernel", 0, NULL, STATUS_BUILTIN},
        {"General setup", 1, &general_menu, STATUS_EXCLUDED},
        {"Networking support", 0, NULL, STATUS_MODULE},
        {"Exit", 0, NULL, STATUS_EXCLUDED},
    };
    Menu main_menu = {
        "Main Menu",
        main_items,
        sizeof(main_items) / sizeof(MenuItem)
    };

    // Tampilkan menu
    show_menu(&main_menu, menu_win, menu_height);

    delwin(menu_win);
    delwin(main_win);
    endwin();
    return 0;
}
    </pre>

        <h4>Preview:</h4>
        <p>
            Below is a preview of the program output mimicking <code>make menuconfig</code>:
        </p>
        <img src="/assets/images/menuconfig-preview.png" alt="Ncurses Menuconfig Preview" style="border:1px solid #ccc;max-width:100%;margin:1em 0;" />

        <h3>6. Tips and Best Practices</h3>
        <ul>
            <li>Use <code>cbreak()</code> to get characters immediately without waiting for Enter.</li>
            <li><code>noecho()</code> prevents typed characters from being shown (useful for password prompts).</li>
            <li>Always call <code>endwin()</code> to clean up when your program ends.</li>
            <li>Use <code>wrefresh()</code> for windows and <code>refresh()</code> for the main screen.</li>
        </ul>

        <h3>7. Compiling Ncurses Programs</h3>
        <p>
            Don't forget to link against ncurses when compiling:
        </p>

        <pre>
gcc -o myapp myapp.c -lncurses
    </pre>

        <h3>Conclusion</h3>
        <p>
            Ncurses is an essential tool in a Linux developer’s toolkit when it comes to building terminal-based applications. With it, you can create powerful, interactive, and lightweight interfaces without relying on graphical libraries. From simple forms to complex nested menus, it gives you full control over terminal I/O.
        </p>
        <p>
            In the next post, we’ll explore how to build forms, manage field validation, and even integrate mouse support into your TUI applications using <code>form.h</code> and <code>menu.h</code>.
        </p>
    </section>
</main>

<?php include __DIR__ . '/../include/layout/footer.php'; ?>

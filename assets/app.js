/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.css";

const root = document.documentElement;
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");

// Tema (claro/escuro)
try {
    if (
        localStorage.theme === "dark" ||
        (!localStorage.theme &&
            matchMedia("(prefers-color-scheme: dark)").matches)
    )
        root.classList.add("dark");
} catch (e) {}
document.getElementById("theme-toggle").addEventListener("click", () => {
    const dark = root.classList.toggle("dark");
    try {
        localStorage.theme = dark ? "dark" : "light";
    } catch (e) {}
});

// Sidebar no mobile
document.querySelectorAll("[data-toggle-sidebar]").forEach((el) =>
    el.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-full");
        overlay.classList.toggle("hidden");
    }),
);

// Dropdown do usuário
const menu = document.getElementById("user-menu");
const btn = menu.querySelector("[data-dropdown-btn]");
const panel = menu.querySelector("[data-dropdown-panel]");
const setOpen = (open) => {
    panel.classList.toggle("hidden", !open);
    btn.setAttribute("aria-expanded", open);
};
btn.addEventListener("click", () =>
    setOpen(panel.classList.contains("hidden")),
);
document.addEventListener("click", (e) => {
    if (!menu.contains(e.target)) setOpen(false);
});
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") setOpen(false);
});

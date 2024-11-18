const themes = [
    {
        background: "#0F3460",
        color: "#000000",
        primaryColor: "#0F3460"
    },
    {
        background: "#E94560",
        color: "#000000",
        primaryColor: "#E94560"
    },
    {
        background: "#967AA1",
        color: "#000000",
        primaryColor: "#967AA1"
    },
    {
        background: "#F7B267",
        color: "#000000",
        primaryColor: "#F7B267"
    },
    {
        background: "#F25F5C",
        color: "#000000",
        primaryColor: "#F25F5C"
    },
    {
        background: "#BB4430",
        color: "#000000",
        primaryColor: "#BB4430"
    }
];

const setTheme = (theme) => {
    const root = document.querySelector(":root");
    root.style.setProperty("--background", theme.background);
    root.style.setProperty("--color", theme.color);
    root.style.setProperty("--primary-color", theme.primaryColor);

    // Simpan preferensi tema ke localStorage
    localStorage.setItem("selectedTheme", JSON.stringify(theme));
};

const displayThemeButtons = () => {
    const btnContainer = document.querySelector(".theme-btn-container");
    themes.forEach((theme) => {
        const div = document.createElement("div");
        div.className = "theme-btn";
        div.style.cssText = `background: ${theme.background}; width: 25px; height: 25px`;
        btnContainer.appendChild(div);
        div.addEventListener("click", () => setTheme(theme));
    });
};

// Terapkan tema yang disimpan, jika ada
const savedTheme = localStorage.getItem("selectedTheme");
if (savedTheme) {
    setTheme(JSON.parse(savedTheme));
}

// Tampilkan tombol tema
displayThemeButtons();

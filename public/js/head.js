/*
Template Name: Hubila - Responsive Bootstrap 5 Admin Dashboard
Author: Zoyothemes
Version: 1.0.0
Website: https://zoyothemes.com/
File: Main Js File
*/

class ThemeManager {
    constructor() {
        this.STORAGE_KEY = "__CONFIG__";
        this.DEFAULT_THEME = "light";
        this.THEME_ATTR = "data-bs-theme";
        
        // Initialize config from localStorage or use the default config
        this.config = this.getConfig();
        this.applyTheme(this.config.theme);

        // Initialize theme toggle
        this.initThemeToggle();
    }

    // Helper: Retrieve saved config from localStorage or default config
    getConfig() {
        try {
            const savedConfig = localStorage.getItem(this.STORAGE_KEY);
            return savedConfig ? { ...JSON.parse(savedConfig) } : { theme: this.DEFAULT_THEME };
        } catch (error) {
            return { theme: this.DEFAULT_THEME }; // Fallback on error
        }
    }

    // Helper: Save the config to localStorage
    saveState() {
        localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.config));
    }

    // Helper: Apply the theme to the <html> element
    applyTheme(theme) {
        document.documentElement.setAttribute(this.THEME_ATTR, theme);
    }

    // Change theme mode and update the config
    changeThemeMode(theme) {
        this.applyTheme(theme);
        this.config.theme = theme;
        this.saveState();
    }

    // Initialize theme toggle functionality
    initThemeToggle() {
        window.addEventListener("load", () => {
            const themeColorToggle = document.getElementById("light-dark-mode");

            if (themeColorToggle) {
                themeColorToggle.addEventListener("click", () => {
                    const newTheme = this.config.theme === "light" ? "dark" : "light";
                    this.changeThemeMode(newTheme);
                });
            }
        });
    }
}

// Instantiate the class to manage the theme
new ThemeManager();
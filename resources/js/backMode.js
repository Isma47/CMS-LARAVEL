
console.log('Hola..');

document.addEventListener('alpine:init', () => {
    Alpine.data('darkModeToggle', () => ({
        darkMode: false,

        init() {
            // Lee la preferencia guardada (true/false) o usa false por defecto.
            this.darkMode = JSON.parse(localStorage.getItem('darkMode') || 'false');

            // Si estaba en modo oscuro, añade la clase 'dark' al <html>.
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            }
        },

        toggleDarkMode() {
            // Cambia el booleano
            this.darkMode = !this.darkMode;

            // Almacena la preferencia en localStorage
            localStorage.setItem('darkMode', JSON.stringify(this.darkMode));

            // Aplica o quita la clase 'dark' en <html>
            document.documentElement.classList.toggle('dark', this.darkMode);
        }
    }));
});


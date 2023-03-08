/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {},
        fontFamily: {
            'sans': ['Inter', 'sans-serif'],
            'serif': ['Raleway', 'serif'],
            'mono': ['JetBrains Mono', 'monospace'],
        }
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
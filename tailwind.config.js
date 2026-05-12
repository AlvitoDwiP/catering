/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/View/Components/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                'nk-bg': '#F8F4EE',
                'nk-card': '#FFFDF9',
                'nk-alt': '#EEE4D8',
                'nk-text': '#2F2D29',
                'nk-muted': '#7C756D',
                'nk-primary': '#6F7F5B',
                'nk-primary-dark': '#536246',
                'nk-secondary': '#C97862',
                'nk-border': '#E5DACE',
                'nk-success': '#7E9A72',
                'nk-warning': '#D8A04D',
                'nk-error': '#B85C5C',
            },
            fontFamily: {
                heading: ['Georgia', 'Times New Roman', 'serif'],
                sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'sans-serif'],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};

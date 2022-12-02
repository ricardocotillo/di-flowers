const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './web/app/themes/di-flowers/templates/**/*.twig',
    './web/app/themes/di-flowers/views/**/*.twig',
    // './web/app/themes/di-flowers/blocks/**/*.php',
    './web/app/themes/di-flowers/templates/**/*.js',
    // "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary': colors.gray[500],
        'secondary': colors.gray[600],
        'dark': colors.gray[900],
        'light': colors.gray[100],
        'info': colors.blue[500],
        'warning': colors.amber[500],
        'success': colors.green[500],
        'error': colors.red[500],
        'rose-1': '#e0cdcb',
        'rose-2': '#bb9ba9',
        'rose-3': '#f8f4f2',
        'rose-alt': '#937885',
      },
      fontFamily: {
        'sans': ['Inter', ...defaultTheme.fontFamily.sans],
        'prata': ['Prata', ...defaultTheme.fontFamily.serif],
      },
      minHeight: {
        'article-content': `calc(100vh - ${defaultTheme.spacing[80]})`,
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

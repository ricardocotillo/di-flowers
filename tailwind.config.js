const defaultTheme = require('tailwindcss/defaultTheme')

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

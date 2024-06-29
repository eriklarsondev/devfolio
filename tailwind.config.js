const theme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
  content: ['./theme/**/*.php'],
  theme: {
    container: {
      center: true,
      padding: '30px'
    },
    extend: {
      colors: {
        accent: colors.emerald[400]
      },
      fontFamily: {
        serif: ['PT Serif', ...theme.fontFamily.serif],
        sans: ['Roboto Condensed', ...theme.fontFamily.sans]
      }
    }
  }
}

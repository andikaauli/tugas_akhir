/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    borderWidth: {
        DEFAULT: '1px',
        '0': '0',
        '2': '2px',
        '3': '3px',
        '4': '4px',
        '6': '6px',
        '8': '8px',
    },
    extend: {
        fontFamily: {
            quicksand : ['Quicksand']
        },
        height: {
            '18': '72px',
          },
        width: {
            '18': '72px',
            '42': '10.5rem',
            '46': '184px',
            '104': '26rem',
            '106': '26.5rem',
            '108': '27rem',
            '150': '37.5rem',
          },
        maxWidth: {
            'xxs': '10rem',
          },
        colors: {
            'teknik': '#020166',
          },
        margin: {
            '18': '4.5rem',
      },
        animation: {
        'move': 'moving .5s ease',
      }
    },
  },
  darkMode: 'class',
  plugins: [
    require('flowbite/plugin')
],
}


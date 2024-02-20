/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

  safelist: [
    'alert-error',
    'alert-success',
  ],

  theme: {
    extend: {
      colors: {
        transparent: 'transparent',
        current: 'currentColor',
        'text-light': '#1a1a1a',
        'text-dark' : '#ffffff',
        'bg-light' : '#ffffff',
        'bg-dark' : '#000000',
        'bg-alt-1': '#fbd34b',
        'sub-text' : '#808080',
        'input-border-light': '#4d4d4d',
        'input-border-dark': '#b3b3b3',
        'divider-light': '#cccccc',
        'divider-dark': '#ffffff',
        'placeholder': '#808080',
        'icon-light': '#4d4d4d',
        'icon-dark': '#ffffff',
        'card-bg-light' : '#bfbfbf',
        'card-bg-dark' : '#000000',
      },
    },
    
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}


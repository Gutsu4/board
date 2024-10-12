/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                inter: ['Inter', 'sans-serif'],
            },
            colors: {
                primary: {
                    DEFAULT: '#E27447',
                },
                gray: {
                    verypale: '#F5F5F5',
                    pale: '#EEEEEE',
                    light: '#d7d7d7',
                    DEFAULT: "#A5A5A5",
                    soft: '#969696',
                    dark: '#666666',
                    smoke: '#838383',
                    natural: '#F8F8F8'
                },

                red: {
                    pale: '#FDD1D1',
                    DEFAULT: '#F52929',
                    soft: '#DC3545'
                },

                blue: {
                    DEFAULT: '#61A7EB',
                },
                green: {
                    dark: '#166534',
                    light: '#dcfce7',

                }
            }
        },
    },
    plugins: [],
}

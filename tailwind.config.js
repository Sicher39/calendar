module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {

            colors: {
                'dark': '#042940',
                'primary': '#009EE2',
                'second-1': '#AEC90B',
                'second-2': '#005C53',
                'accent': '#AEC90B',
                'bg-2': '#D6D58E',
            },

            fontFamily: {
                'head': ['jaf-bernina-sans, sans-serif'],
                'main': ['jaf-bernina-sans, sans-serif']
            },

            fill: {
                current: 'currentColor',
            },

            screens: {
                'sm': '375px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
                '3xl': '1800px',
            },


        },
    },
};

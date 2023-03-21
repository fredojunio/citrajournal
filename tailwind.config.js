const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "./node_modules/boxicons/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Roboto", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // contoh kalo mau nambah warna
                // "example-blue": "#2484C6",
                citrablack: "#1B1212",

                citragreen: {
                    50: "#E3FBE0",
                    100: "#D6FAD6",
                    200: "#AEF6B5",
                    300: "#80E393",
                    400: "#5BC97B",
                    500: "#2DA55C",
                    600: "#208D56",
                    700: "#16764F",
                    800: "#0E5F46",
                    900: "#084F40",
                },

                citradark: {
                    50: "#E8F8F9",
                    100: "#DFF3F6",
                    200: "#C1E4EE",
                    300: "#93BDCC",
                    400: "#64889A",
                    500: "#2F4858",
                    600: "#22394B",
                    700: "#172B3F",
                    800: "#0E1E33",
                    900: "#09152A",
                },

                citrablue: {
                    50: "#DEEDFE",
                    100: "#D4E6FE",
                    200: "#A9CBFE",
                    300: "#7FADFE",
                    400: "#5E93FD",
                    500: "#2A69FC",
                    600: "#1E50D8",
                    700: "#153BB5",
                    800: "#0D2892",
                    900: "#081B78",
                },

                citrayellow: {
                    50: "#FFF8D8",
                    100: "#FFF5CC",
                    200: "#FFE999",
                    300: "#FFDA66",
                    400: "#FFCB3F",
                    500: "#FFB200",
                    600: "#DB9200",
                    700: "#B77400",
                    800: "#935900",
                    900: "#7A4600",
                },

                citrared: {
                    50: "#FDE5DE",
                    100: "#FDDAD4",
                    200: "#FBAFAA",
                    300: "#F57D81",
                    400: "#EC5C6E",
                    500: "#E02A52",
                    600: "#C01E51",
                    700: "#A1154E",
                    800: "#810D48",
                    900: "#6B0844",
                },
            },
        },
    },

    plugins: [require("@tailwindcss/forms"), require("flowbite/plugin")],
};

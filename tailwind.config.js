const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
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
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};

import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            gridTemplateRows: {
                "[auto,auto,1fr]": "auto auto 1fr",
            },
            zIndex: {
                "-1": "-1",
                "-10": "-10",
                "-50": "-50",
            },
        },
    },

    plugins: [
        forms,
        require("@tailwindcss/aspect-ratio"),
        require("@tailwindcss/forms"),
    ],
};

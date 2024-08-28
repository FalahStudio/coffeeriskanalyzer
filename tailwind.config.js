/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./public/assets/js/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.py",
    ],
    theme: {
        fontFamily: {
            manrope: ["Manrope", "sans-serif"],
        },
        fontSize: {
            // Regular Extra Small
            "xs-body-regular": [
                "0.75rem",
                {
                    lineHeight: "1.125rem",
                    fontWeight: 400,
                },
            ],
            "xs-body-medium": [
                "0.75rem",
                {
                    lineHeight: "1.125rem",
                    fontWeight: 500,
                },
            ],
            "xs-body-semibold": [
                "0.75rem",
                {
                    lineHeight: "1.125rem",
                    fontWeight: 600,
                },
            ],
            "xs-body-bold": [
                "0.75rem",
                {
                    lineHeight: "1.125rem",
                    fontWeight: 700,
                },
            ],

            // Regular Small
            "sm-body-regular": [
                "0.875rem",
                {
                    lineHeight: "1.25rem",
                    fontWeight: 400,
                },
            ],
            "sm-body-medium": [
                "0.875rem",
                {
                    lineHeight: "1.25rem",
                    fontWeight: 500,
                },
            ],
            "sm-body-semibold": [
                "0.875rem",
                {
                    lineHeight: "1.25rem",
                    fontWeight: 600,
                },
            ],
            "sm-body-bold": [
                "0.875rem",
                {
                    lineHeight: "1.25rem",
                    fontWeight: 700,
                },
            ],

            // Regular Medium
            "md-body-regular": [
                "1rem",
                {
                    lineHeight: "1.5rem",
                    fontWeight: 400,
                },
            ],
            "md-body-medium": [
                "1rem",
                {
                    lineHeight: "1.5rem",
                    fontWeight: 500,
                },
            ],
            "md-body-semibold": [
                "1rem",
                {
                    lineHeight: "1.5rem",
                    fontWeight: 600,
                },
            ],
            "md-body-bold": [
                "1rem",
                {
                    lineHeight: "1.5rem",
                    fontWeight: 700,
                },
            ],

            // Regular Large
            "lg-body-regular": [
                "1rem",
                {
                    lineHeight: "1.75rem",
                    fontWeight: 400,
                },
            ],
            "lg-body-medium": [
                "1rem",
                {
                    lineHeight: "1.75rem",
                    fontWeight: 500,
                },
            ],
            "lg-body-semibold": [
                "1rem",
                {
                    lineHeight: "1.75rem",
                    fontWeight: 600,
                },
            ],
            "lg-body-bold": [
                "1rem",
                {
                    lineHeight: "1.75rem",
                    fontWeight: 700,
                },
            ],

            // Regular Extra Large
            "xl-body-regular": [
                "1.25rem",
                {
                    lineHeight: "1.875rem",
                    fontWeight: 400,
                },
            ],
            "xl-body-medium": [
                "1.25rem",
                {
                    lineHeight: "1.875rem",
                    fontWeight: 500,
                },
            ],
            "xl-body-semibold": [
                "1.25rem",
                {
                    lineHeight: "1.875rem",
                    fontWeight: 600,
                },
            ],
            "xl-body-bold": [
                "1.25rem",
                {
                    lineHeight: "1.875rem",
                    fontWeight: 700,
                },
            ],

            // Display Extra Small
            "xs-display-regular": [
                "1.5rem",
                {
                    lineHeight: "2rem",
                    fontWeight: 400,
                },
            ],
            "xs-display-medium": [
                "1.5rem",
                {
                    lineHeight: "2rem",
                    fontWeight: 500,
                },
            ],
            "xs-display-semibold": [
                "1.5rem",
                {
                    lineHeight: "2rem",
                    fontWeight: 600,
                },
            ],
            "xs-display-bold": [
                "1.5rem",
                {
                    lineHeight: "2rem",
                    fontWeight: 700,
                },
            ],

            // Display Small
            "sm-display-regular": [
                "1.875rem",
                {
                    lineHeight: "2.375rem",
                    fontWeight: 400,
                },
            ],
            "sm-display-medium": [
                "1.875rem",
                {
                    lineHeight: "2.375rem",
                    fontWeight: 500,
                },
            ],
            "sm-display-semibold": [
                "1.875rem",
                {
                    lineHeight: "2.375rem",
                    fontWeight: 600,
                },
            ],
            "sm-display-bold": [
                "1.875rem",
                {
                    lineHeight: "2.375rem",
                    fontWeight: 700,
                },
            ],

            // Display Medium
            "md-display-regular": [
                "2.25rem",
                {
                    lineHeight: "2.75rem",
                    fontWeight: 400,
                    letterSpacing: "-2%",
                },
            ],
            "md-display-medium": [
                "2.25rem",
                {
                    lineHeight: "2.75rem",
                    fontWeight: 500,
                    letterSpacing: "-2%",
                },
            ],
            "md-display-semibold": [
                "2.25rem",
                {
                    lineHeight: "2.75rem",
                    fontWeight: 600,
                    letterSpacing: "-2%",
                },
            ],
            "md-display-bold": [
                "2.25rem",
                {
                    lineHeight: "2.75rem",
                    fontWeight: 700,
                    letterSpacing: "-2%",
                },
            ],

            // Display Large
            "lg-display-regular": [
                "3rem",
                {
                    lineHeight: "3.75rem",
                    fontWeight: 400,
                    letterSpacing: "-2%",
                },
            ],
            "lg-display-medium": [
                "3rem",
                {
                    lineHeight: "3.75rem",
                    fontWeight: 500,
                    letterSpacing: "-2%",
                },
            ],
            "lg-display-semibold": [
                "3rem",
                {
                    lineHeight: "3.75rem",
                    fontWeight: 600,
                    letterSpacing: "-2%",
                },
            ],
            "lg-display-bold": [
                "3rem",
                {
                    lineHeight: "3.75rem",
                    fontWeight: 700,
                    letterSpacing: "-2%",
                },
            ],

            // Display Extra Large
            "xl-display-regular": [
                "3.75rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 400,
                    letterSpacing: "-2%",
                },
            ],
            "xl-display-medium": [
                "3.75rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 500,
                    letterSpacing: "-2%",
                },
            ],
            "xl-display-semibold": [
                "3.75rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 600,
                    letterSpacing: "-2%",
                },
            ],
            "xl-display-bold": [
                "3.75rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 700,
                    letterSpacing: "-2%",
                },
            ],

            // Display 2 Extra Large
            "2xl-display-regular": [
                "4.5rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 400,
                    letterSpacing: "-2%",
                },
            ],
            "2xl-display-medium": [
                "4.5rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 500,
                    letterSpacing: "-2%",
                },
            ],
            "2xl-display-semibold": [
                "4.5rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 600,
                    letterSpacing: "-2%",
                },
            ],
            "2xl-display-bold": [
                "4.5rem",
                {
                    lineHeight: "4.5rem",
                    fontWeight: 700,
                    letterSpacing: "-2%",
                },
            ],
        },
        boxShadow: {
            xs: "0px 1px 2px 0px #0D101828",
            sm: "0px 1px 3px 0px #1A101828,0px 1px 2px 0px #0F101828",
            md: "0px 4px 8px -2px #1A101828,0px 2px 4px -2px #0F101828",
            lg: "0px 12px 16px -4px #1A101828,0px 4px 6px -2px #0D101828",
            xl: "0px 20px 24px -4px #1A101828,0px 8px 8px -4px #0A101828",
            "2xl": "0px 24px 48px -12px #40101828",
            "3xl": "0px 32px 64px -12px #33101828",
        },
        extend: {
            colors: {
                primary: {
                    50: "#F6FEF9",
                    100: "#ECFDF3",
                    200: "#D1FADF",
                    300: "#A6F4C5",
                    400: "#6CE9A6",
                    500: "#32D583",
                    600: "#12B76A",
                    700: "#039855",
                    800: "#027A48",
                    900: "#05603A",
                    950: "#054F31",
                },
                neutral: {
                    50: "#FCFCFD",
                    100: "#F9FAFB",
                    200: "#F2F4F7",
                    300: "#EAECF0",
                    400: "#D0D5DD",
                    500: "#98A2B3",
                    600: "#667085",
                    700: "#475467",
                    800: "#344054",
                    900: "#1D2939",
                    950: "#101828",
                },
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};

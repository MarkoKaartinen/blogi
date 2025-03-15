import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                brand: {
                    mastodon: '#6364FF',
                    pixelfed: '#6366F1',
                    lemmy: '#000000',
                    rss: '#FFA500',
                    igdb: '#9147FF',
                },
                theme: {
                    0: '#232730',
                },
                nord: {
                    0: '#2e3440',
                    1: '#3b4252',
                    2: '#434c5e',
                    3: '#4c566a',
                    4: '#d8dee9',
                    5: '#e5e9f0',
                    6: '#eceff4',
                    7: '#8fbcbb',
                    8: '#88c0d0',
                    9: '#81a1c1',
                    10: '#5e81ac',
                    11: '#bf616a',
                    12: '#d08770',
                    13: '#ebcb8b',
                    14: '#a3be8c',
                    15: '#b48ead',
                }
            },
            typography: ({ theme }) => ({
                nord: {
                    css: {
                        '--tw-prose-body': theme('colors.nord[6]'),
                        '--tw-prose-headings': theme('colors.nord[6]'),
                        '--tw-prose-lead': theme('colors.nord[7]'),
                        '--tw-prose-links': theme('colors.nord[14]'),
                        '--tw-prose-bold': theme('colors.nord[7]'),
                        '--tw-prose-counters': theme('colors.nord[9]'),
                        '--tw-prose-bullets': theme('colors.nord[9]'),
                        '--tw-prose-hr': theme('colors.nord[9]'),
                        '--tw-prose-quotes': theme('colors.nord[9]'),
                        '--tw-prose-quote-borders': theme('colors.nord[3]'),
                        '--tw-prose-captions': theme('colors.nord[9]'),
                        '--tw-prose-code': theme('colors.nord[12]'),
                        '--tw-prose-pre-code': theme('colors.nord[6]'),
                        '--tw-prose-pre-bg': theme('colors.nord[1]'),
                        '--tw-prose-th-borders': theme('colors.nord[10]'),
                        '--tw-prose-td-borders': theme('colors.nord[9]'),
                    },
                },
            }),
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};

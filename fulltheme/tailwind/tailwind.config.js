const plugin = require('tailwindcss/plugin');

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require( './tailwind-typography.config.js' ),
	],
	content: [
		// Ensure changes to theme.json and all PHP files rebuild your CSS.
		'./theme/theme.json',
		'./theme/**/*.php',
	],
	safelist: [
		// Prevent editor-specific styles from being purged.
		'editor-post-title__block',
		'editor-post-title__input',
	],
	theme: {
		screens: {
      'sm': '450px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1440px',
    },
		// Extend the default theme.
		extend: {

		},
	},
	plugins: [
		// Add Tailwind Typography.
		require( '@tailwindcss/typography' ),

		// Extract colors and widths from theme.json.
		require( '@_tw/themejson' )( require( '../theme/theme.json' ) ),

		// Uncomment below to add additionals first-party Tailwind plugins.
		// require( '@tailwindcss/aspect-ratio' ),
		require( '@tailwindcss/forms' ),
		require( '@tailwindcss/line-clamp' ),
		plugin(function ({addUtilities}) {
			addUtilities({
        '.top-center': {
          top: '50%',
					transform: 'translateY(-50%)',
        },
        '.left-center': {
          left: '50%',
					transform: 'translateX(-50%)',
        },
				'.center': {
					top: '50%',
					left: '50%',
					transform: 'translate(-50%,-50%)',
				}
      })
		}),
	],
};

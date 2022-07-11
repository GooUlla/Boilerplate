const plugin = require('tailwindcss/plugin');
const includePreflight = ( 'editor' === process.env._TW_TARGET ) ? false : true;

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
      'xs': '450px',
			'sm': '600',
      'md': '768px',
      'lg': '1024px',
			'content': '1188px',
      'xl': '1280px',
      '2xl': '1440px',
    },
		transitionDuration: {
      DEFAULT: '300ms'
    },
		// Extend the default theme.
		extend: {
			fontFamily: {
        'awesome': ['"Font Awesome 6 Free"'],
				'awesome-brands': ['"Font Awesome 6 Brands"']
      },
			spacing: {
        'content': '74rem',
      }
		},
	},
	corePlugins: {
		// Disable Preflight base styles in CSS targeting the editor.
		preflight: includePreflight,
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
      }),
			addComponents({
        '.overlay': {
					content: '""',
          position: 'absolute',
          top: '0',
          left: '0',
					width: '100%',
					height: '100%'
        },
      })
		}),
	],
};

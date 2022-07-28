const plugin = require( 'tailwindcss/plugin' );
const glob = require( 'glob' );

// Get arrays of all of the files.
const topLevelPhpFiles = glob.sync( './*.php' ),
	directoryFiles = [
		'./inc/**/*.php',
		'./index.php',
		'./template-parts/*.php',
		'./src/js/**/*.js',
	];

module.exports = {
	content: topLevelPhpFiles.concat( directoryFiles ),
	safelist: [
		{
			pattern: /^(p|m)(|y|x|b)-/,
			variants: [ 'md' ],
		},
		{
			pattern:
				/^(w|h|list|bg|text|flex|transform|translate|-translate|font)-/,
		},
		{
			pattern: /^gap-[0-9]/,
			variants: [ 'md' ],
		},
		{
			pattern: /^(order-|grid-|leading-)/,
			variants: [ 'md' ],
		},
	],
	theme: {
		colors: {
			black: '#000000',
			white: '#FFFFFF',
			transparent: 'transparent',
			current: 'currentColor',
			tan: '#F1EFE8',
			sky: '#6267E7',
			sun: '#F3F360',
			zinc: {
				600: '#52525A',
				500: '#717179',
				400: '#A1A1A9',
				300: '#D4D4D8',
				200: '#E4E4E7',
				100: '#F4F4F5',
				50: '#FAFAFA',
			},
		},
		fontSize: {
			'root-em': '16px',
			14: '0.875rem',
			16: '1rem',
			base: '1rem',
			18: '1.125rem',
			20: '1.25rem',
			24: '1.5rem',
			32: '2rem',
			48: '3rem',
			64: '4rem',
			90: '5.625rem',
		},
		spacing: {
			px: '1px',
			0: '0',
			1: '0.0625rem',
			2: '0.125rem',
			3: '0.1875rem',
			4: '0.25rem',
			5: '0.3125rem',
			6: '0.375rem',
			8: '0.5rem',
			10: '0.625rem',
			12: '0.75rem',
			14: '0.875rem',
			16: '1rem',
			18: '1.125rem',
			20: '1.25rem',
			24: '1.5rem',
			28: '1.75rem',
			30: '1.875rem',
			32: '2rem',
			40: '2.5rem',
			46: '2.875rem',
			48: '3rem',
			50: '3.125rem',
			56: '3.5rem',
			60: '3.75rem',
			64: '4rem',
			68: '4.25rem',
			70: '4.375rem',
			72: '4.5rem',
			74: '4.625rem',
			76: '4.75rem',
			80: '5rem',
			90: '5.625rem',
			100: '6.25rem',
			110: '6.875rem',
			120: '7.5rem',
			130: '8.125rem',
			140: '8.75rem',
			150: '9.375rem',
			160: '10rem',
			170: '10.625rem',
			180: '11.25rem',
			190: '11.875rem',
			192: '12rem',
			200: '12.5rem',
		},
		boxShadow: {
			default:
				'0 0.0625rem 0.1875rem 0 rgba(0, 0, 0, 0.1), 0 0.0625rem 0.125rem 0 rgba(0, 0, 0, 0.06)',
			md: '0 0.25rem 0.375rem -0.0625rem rgba(0, 0, 0, 0.1), 0 0.125rem 0.25rem -0.0625rem rgba(0, 0, 0, 0.06)',
			lg: '0 0.625rem 0.9375 -0.1875rem rgba(0, 0, 0, 0.1), 0 0.25rem 0.375rem -0.125rem rgba(0, 0, 0, 0.05)',
			inner: 'inset 0 0.125rem 0.25rem 0 rgba(0, 0, 0, 0.06)',
			outline: '0 0 0 0.1875rem rgba(66, 153, 225, 0.5)',
			focus: '0 0 0 0.1875rem rgba(66, 153, 225, 0.5)',
			none: 'none',
		},
		screens: {
			sm: '601px',
			md: '783px',
			lg: '1024px',
			xl: '1280px',
		},
		container: ( theme ) => ( {
			center: true,
			screens: {
				phone: '100%',
				desktop: '1200px',
			},
			padding: {
				DEFAULT: theme( 'spacing.16' ),
				'desktop-large': '0',
			},
		} ),
		extend: {
			backgroundOpacity: {
				10: '0.1',
			},
			lineHeight: {
				105: '1.05',
				130: '1.30',
				140: '1.40',
				150: '1.50',
				156: '1.56',
				165: '1.65',
				100: '1.00',
			},
		},
		fontFamily: {
			sans: [ 'Poppins', 'sans-serif' ],
			serif: [ 'Shrikhand', 'serif' ],
		},
	},
	variants: {},
	plugins: [
		plugin( function ( { addBase, config } ) {
			addBase( {
				html: {
					fontSize: '100%',
				},
				'h1,.h1': {
					fontSize: config( 'theme.fontSize.48' ),
				},
				'h2,.h2': {
					fontSize: config( 'theme.fontSize.32' ),
				},
				'h3,.h3': {
					fontSize: config( 'theme.fontSize.32' ),
				},
				'h4,.h4': {
					fontSize: config( 'theme.fontSize.20' ),
				},
				'h5,.h5': {
					fontSize: config( 'theme.fontSize.16' ),
				},
				'h6,.h6': {
					fontSize: config( 'theme.fontSize.16' ),
				},
				'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6': {
					marginBottom: config( 'theme.spacing.16' ),
				},
				a: {
					textDecoration: 'underline',
				},
				p: {
					marginBottom: config( 'theme.spacing.16' ),
					'&:last-child': {
						marginBottom: '0',
					},
				},
				'.button': {
					padding: config( 'theme.spacing.16' ),
				},
				'table,dl,ol,ul,address,pre,blockquote,iframe': {
					marginBottom: config( 'theme.spacing.16' ),
				},
				pre: {
					overflow: 'auto',
				},
			} );
		} ),
		plugin( function ( { addComponents, config } ) {
			const screenReaderText = {
				'.screen-reader-text': {
					clip: 'rect(1px, 1px, 1px, 1px)',
					height: '1px',
					overflow: 'hidden',
					position: 'absolute',
					whiteSpace: 'nowrap',
					width: '1px',
					'&:hover,&:active,&:focus': {
						backgroundColor: config( 'theme.colors.black' ),
						clip: 'auto',
						color: config( 'theme.colors.white' ),
						display: 'block',
						fontSize: config( 'theme.fontSize.base' ),
						fontWeight: config( 'theme.fontWeight.medium' ),
						height: 'auto',
						left: '5px',
						lineHeight: 'normal',
						padding: config( 'theme.spacing.8' ),
						textDecoration: 'none',
						top: '5px',
						width: 'auto',
						zIndex: '100000',
					},
				},
			};

			addComponents( screenReaderText, {
				variants: [ 'hover', 'active', 'focus' ],
			} );
		} ),
	],
};

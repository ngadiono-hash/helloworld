
CKEDITOR.stylesSet.add( 'default', [
	/* Inline styles */
	{ 
		name: 'HTML', 
		element: 'code', 
		attributes: { 'class': 'language-html' }
	},
	{ name: 'Keyboard',	element: 'kbd' },
	
	/* Block styles */
	{
		name: 'wrapper',
		element: 'div',
		attributes: { class:'wrapper-content' }
	},
	{
		name: 'note',
		element: 'p',
		attributes: { class:'note' },
		styles: {
			'font-weight': 'bold'
		}
	},
  {
		name: 'reff',
		element: 'p',
		attributes: { class:'reff' }
	},
	/* Object styles */

	{
		name: 'Styled Image (left)',
		element: 'img',
		attributes: { 'class': 'left' }
	},

	{
		name: 'Styled Image (right)',
		element: 'img',
		attributes: { 'class': 'right' }
	},

	{
		name: 'Compact Table',
		element: 'table',
		attributes: {
			class: 'table table-bordered table-striped'
		},
		styles: {
			'border-collapse': 'collapse'
		}
	},

	{ name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
	{ name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } },

	/* Widget styles */

	{ name: 'Clean Image', type: 'widget', widget: 'image', attributes: { 'class': 'image-clean' } },
	{ name: 'Grayscale Image', type: 'widget', widget: 'image', attributes: { 'class': 'image-grayscale' } },

	{ name: 'Featured Snippet', type: 'widget', widget: 'codeSnippet', attributes: { 'class': 'code-featured' } },

	{ name: 'Featured Formula', type: 'widget', widget: 'mathjax', attributes: { 'class': 'math-featured' } },

	{ name: '240p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-240p' }, group: 'size' },
	{ name: '360p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-360p' }, group: 'size' },
	{ name: '480p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-480p' }, group: 'size' },
	{ name: '720p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-720p' }, group: 'size' },
	{ name: '1080p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-1080p' }, group: 'size' },

	// Adding space after the style name is an intended workaround. For now, there
	// is no option to create two styles with the same name for different widget types. See https://dev.ckeditor.com/ticket/16664.
	{ name: '240p ', type: 'widget', widget: 'embed', attributes: { 'class': 'embed-240p' }, group: 'size' },
	{ name: '360p ', type: 'widget', widget: 'embed', attributes: { 'class': 'embed-360p' }, group: 'size' },
	{ name: '480p ', type: 'widget', widget: 'embed', attributes: { 'class': 'embed-480p' }, group: 'size' },
	{ name: '720p ', type: 'widget', widget: 'embed', attributes: { 'class': 'embed-720p' }, group: 'size' },
	{ name: '1080p ', type: 'widget', widget: 'embed', attributes: { 'class': 'embed-1080p' }, group: 'size' }

] );
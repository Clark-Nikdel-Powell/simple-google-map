(function (wp) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var Components = wp.components;

	wp.blocks.registerBlockType(
		'simple-google-map/sgm-block', {
			title: __('Map'),
			icon: 'location-alt',
			category: 'common',
			attributes: {
				lat: {type: 'string'},
				lng: {type: 'string'},
				zoom: {type: 'string'},
				type: {type: 'string'},
				directionsto: {type: 'string'},
				content: {type: 'string'},
				icon: {type: 'string'}
			},
			edit: function (props) {
				var focus = props.focus;
				var lat = props.attributes.lat || '';
				var lng = props.attributes.lng || '';
				var zoom = props.attributes.zoom || '13';
				var type = props.attributes.type || 'ROADMAP';
				var directionsto = props.attributes.directionsto || '';
				var content = props.attributes.content || '';
				var icon = props.attributes.icon || '';

				var retVal = [];

				if (!!focus || !lat.length) {
					retVal.push(el(Components.TextControl, {
						label: __('Latitude'),
						value: lat,
						placeholder: 'Latitude',
						onChange: function (newVal) {
							props.setAttributes({
								lat: newVal
							});
						}
					}));
				}
				if (!!focus || !lng.length) {
					retVal.push(el(Components.TextControl, {
						value: lng,
						placeholder: 'Longitude',
						onChange: function (newVal) {
							props.setAttributes({
								lng: newVal
							});
						}
					}));
				}
				if (!!focus || !zoom.length) {
					retVal.push(el(Components.TextControl, {
						value: zoom,
						placeholder: 'Zoom',
						onChange: function (newVal) {
							props.setAttributes({
								zoom: newVal
							});
						}
					}));
				}
				if (!!focus || !type.length) {
					retVal.push(el(Components.TextControl, {
						value: type,
						placeholder: 'Map Type',
						onChange: function (newVal) {
							props.setAttributes({
								type: newVal
							});
						}
					}));
				}
				if (!!focus || !directionsto.length) {
					retVal.push(el(Components.TextControl, {
						value: directionsto,
						placeholder: 'Directions',
						onChange: function (newVal) {
							props.setAttributes({
								directionsto: newVal
							});
						}
					}));
				}
				if (!!focus || !content.length) {
					retVal.push(el(Components.TextControl, {
						value: content,
						placeholder: 'Info Window Content',
						onChange: function (newVal) {
							props.setAttributes({
								content: newVal
							});
						}
					}));
				}
				if (!!focus || !icon.length) {
					retVal.push(el(Components.TextControl, {
						value: icon,
						placeholder: 'Icon',
						onChange: function (newVal) {
							props.setAttributes({
								icon: newVal
							});
						}
					}));
				}
				if (lat.length && lng.length) {
					retVal.push(el('div', {id: 'id-yo'}, 'Map! ' + lat.toString() + ',' + lng.toString() + ',' + zoom.toString() + ',' + type.toString()));
				}
				return retVal;
			},
			save: function (props) {
				var lat = props.attributes.lat || '';
				var lng = props.attributes.lng || '';
				var zoom = props.attributes.zoom || '13';
				var type = props.attributes.type || 'ROADMAP';
				var directionsto = props.attributes.directionsto || '';
				var content = props.attributes.content || '';
				var icon = props.attributes.icon || '';

				if (!lat.length || !lng.length) {
					return null;
				}

				return el('div', {id: 'id-yo'}, 'A map should be here!');
			}
		}
	);
})(window.wp);

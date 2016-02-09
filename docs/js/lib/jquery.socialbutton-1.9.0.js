(function($) {

$.fn.socialbutton = function(service, options) {

	options = options || {};

	var defaults = {
		facebook_like: {
			button: 'standard', // standard / button_count / box_count
			url: 'http://www.tagknight.jp',

			show_faces: true,
			width: 0, // auto
			height: 0, // auto

			width_standard_default: 450, // orig: 450
			width_standard_minimum: 225,
			height_standard_without_photo: 35,
			height_standard_with_photo: 80,

			width_button_count_default: 120, // orig: 90, jp_min: 114
			width_button_count_minimum: 90,
			height_button_count: 22, // orig:20, jp_min: 21

			width_box_count_default: 80, // orig:55, jp_min: 75
			width_box_count_minimum: 55,
			height_box_count: 70, // orig: 65, jp_min: 66

			action: 'like', // like / recommend
			locale: '', // auto
			font: '',
			colorscheme: 'light' // light / dark
		},
		twitter: {
			button: 'vertical', // vertical / horizontal / none
			url: '', // document.URL
			text: '',
			lang: 'ja', // ja / en /de / fr / es
			via: '',
			related: ''
		},
	};

	var max_index = this.size() - 1;

	return this.each(function(index) {

		switch (service) {
			case 'facebook_like':
				socialbutton_facebook_like(this, options, defaults.facebook_like, index, max_index);
				break;

			case 'twitter':
				socialbutton_twitter(this, options, defaults.twitter, index, max_index);
				break;


			default:
				break;
		}

		return true;
	});
}

function socialbutton_facebook_like(target, options, defaults, index, max_index)
{
	var layout = options.layout || options.button || defaults.button;
	var url = options.url || defaults.url;

	var show_faces = options.show_faces != undefined ? options.show_faces : defaults.show_faces;
	var width = options.width != undefined ? options.width : defaults.width;
	var height = options.height != undefined ? options.height : defaults.height;
	var action = options.action || defaults.action;
	var locale = options.locale || defaults.locale;
	var font = options.font || defaults.font;
	var colorscheme = options.colorscheme || defaults.colorscheme;

	if (options.url) {
		url = decodeURIComponent(url);
	}
	url = url_encode_rfc3986(url);

	switch (layout) {
		case 'standard':
			if (width == 0) {
				width = defaults.width_standard_default;
			} else if (width < defaults.width_standard_minimum) {
				width = defaults.width_standard_minimum;
			}
			if (height == 0) {
				height = show_faces ? defaults.height_standard_with_photo : defaults.height_standard_without_photo;
			} else if (height < defaults.height_standard_without_photo) {
				height = defaults.height_standard_without_photo;
			}
			break;
		case 'button_count':
			if (width == 0) {
				width = defaults.width_button_count_default;
			} else if (width < defaults.width_button_count_minimum) {
				width = defaults.width_button_count_minimum;
			}
			if (height == 0) {
				height = defaults.height_button_count;
			} else if (height < defaults.height_button_count) {
				height = defaults.height_button_count;
			}
			break;
		case 'box_count':
			if (width == 0) {
				width = defaults.width_box_count_default;
			} else if (width < defaults.width_box_count_minimum) {
				width = defaults.width_box_count_minimum;
			}
			if (height == 0) {
				height = defaults.height_box_count;
			} else if (height < defaults.height_box_count) {
				height = defaults.height_box_count;
			}
			break;
	}

	var params = merge_parameters({
		'href': url,
		'layout': layout,
		'show_faces': show_faces ? 'true' : 'false',
		'width': width,
		'action': action,
		'locale': locale,
		'font': font,
		'colorscheme': colorscheme,
		'height': height
	});

	var tag = '<iframe src="http://www.facebook.com/plugins/like.php?' + params + '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:' + width + 'px; height:' + height + 'px;" allowTransparency="true"></iframe>';

	$(target).html(tag);
}


function socialbutton_twitter(target, options, defaults, index, max_index)
{
	var count = options.count || options.button || defaults.button;
	var url = options.url || defaults.url;

	var text = options.text || defaults.text;
	var lang = options.lang || defaults.lang;
	var via = options.via || defaults.via;
	var related = options.related || defaults.related;

	var attr = merge_attributes({
		'data-count': count,
		'data-url': 'http://www.tagknight.jp/',
		'data-text': text,
		'data-lang': lang,
		'data-via': via,
		'data-related': related
	});

	var tag = '<a href="http://twitter.com/share" class="twitter-share-button"' + attr + '>Tweet</a>';

	$(target).html(tag);

	if (index == max_index) {
		$('body').append('<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>');
	}
}



function merge_attributes(attr)
{
	var merged = '';

	for (var i in attr) {
		if (attr[i] == '') {
			continue;
		}
		merged += ' ' + i + '="' + attr[i] + '"';
	}

	return merged;
}

function merge_parameters(params)
{
	var merged = '';

	for (var i in params) {
		if (params[i] == '') {
			continue;
		}
		merged += merged != '' ? '&amp;' : '';
		merged += i + '=' + params[i] + '';
	}

	return merged;
}

function htmlspecialchars(string)
{
	var table = [
		[/&/g, '&amp;'],
		[/</g, '&lt;'],
		[/>/g, '&gt;'],
		[/"/g, '&quot;'],
		[/'/g, '&#039;']
	];

	for (var i in table) {
		string = string.replace(table[i][0], table[i][1]);
	}

	return string;
}

function url_encode_rfc3986(url)
{
	return encodeURIComponent(url).replace(/[!*'()]/g, function(p) {
		return "%" + p.charCodeAt(0).toString(16);
	});
}

})(jQuery);

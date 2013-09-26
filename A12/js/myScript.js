$(document).ready(function(){
	var tags_Array = [
		'a',
		'abbr',
		'acronym',
		'address',
		'applet',
		'area',
		'article',
		'aside',
		'audio',
		'b',
		'base',
		'basefont',
		'bdi',
		'bdo',
		'bgsound',
		'big',
		'blink',
		'blockquote',
		'body',
		'br',
		'button',
		'canvas',
		'caption',
		'center',
		'cite',
		'code',
		'col',
		'colgroup',
		'data',
		'datalist',
		'dd',
		'del',
		'details',
		'dfn',
		'dir',
		'div',
		'dl',
		'dt',
		'em',
		'embed',
		'fieldset',
		'figcaption',
		'figure',
		'font',
		'footer',
		'form',
		'frame',
		'frameset',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'head',
		'header',
		'hgroup',
		'hr',
		'html',
		'i',
		'iframe',
		'img',
		'input',
		'ins',
		'isindex',
		'kbd',
		'keygen',
		'label',
		'legend',
		'li',
		'link',
		'listing',
		'main',
		'map',
		'mark',
		'marquee',
		'menu',
		'menuitem',
		'meta',
		'meter',
		'nav',
		'nobr',
		'noframes',
		'noscript',
		'object',
		'ol',
		'optgroup',
		'option',
		'output',
		'p',
		'param',
		'plaintext',
		'pre',
		'progress',
		'q',
		'rp',
		'rt',
		'ruby',
		's',
		'samp',
		'script',
		'section',
		'select',
		'small',
		'source',
		'spacer',
		'span',
		'strike',
		'strong',
		'style',
		'sub',
		'summary',
		'sup',
		'table',
		'tbody',
		'td',
		'textarea',
		'tfoot',
		'th',
		'thead',
		'time',
		'title',
		'tr',
		'track',
		'tt',
		'u',
		'ul',
		'var',
		'video',
		'wbr',
		'xmp'
	];
	
	//Getting Each Tag Count In Body
	$("#getTags").click( function() {
		var url = $("#myURL").val(); //Get The Value of URL
		$.get(url, function(data) {
			var response = $('<div/>').append(data); //Puts bodys content into a container for length
			
			for (var i = 0; i < tags_Array.length; i++) { //Prints the Counts of the Tags Found
				var count = response.find(tags_Array[i]).length;
				if (count > 0) {
					var row = $("<tr><td>"+ tags_Array[i] +"</td><td>"+ count +"</td></tr>");
					$("#tagsTable").append(row);
	
				}
			}
			
		});
	});
	
	//Getting External JavaScripts
	$("#getScript").click( function() {
		var url = $("#myURL").val(); //Get The Value of URL
		$.get(url, function(data) {
			var response = $('<div/>').append(data);//Puts bodys content into a container for length
			
			var $tag = response.find('script');
			var count = response.find('script').length;
			var headtext = $("<h1>External Java Scripts</h1>");
			$(".container").append(headtext);
			
			if (count > 0) { //If There Are Scripts Print them
				for (var i = 0; i < count; i++) {
					if ($($tag[i]).attr('src') != ' ') {
						$(".container").append((i+1)+": ",$($tag[i]).attr('src'),"<br>");
					}
				}
			}
			else {
				var text = $("<h3>NO SCRIPTS WERE FOUND!</h3>");
				$(".container").append(text);
			}
		});
	});
});
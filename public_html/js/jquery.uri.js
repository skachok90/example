/*
 * URI 2.0
 *
 * jQuery Plugin for URI parse and change
 *
 * Copyright (c) 2011 AndreO
 * MIT style license, FREE to use, alter, copy, sell, and especially ENHANCE
 *
 */
(function($) {
	$.uri = function(uri) {
		
		var obj = {
			re1: /^(((https?:)\/\/)?(([\w\.-]+)\.([a-z]{2,6}\.?)))?([\/\w \.-]*)\/?(\?([^#]*))*(#(.*))*$/ig,
			re2: /([^&=]+)=([^&]*)/g,
			re3: /\[([^\[\]]+)\]/g,
			uri: uri || window.location.href
		};
		
		var matches = obj.re1.exec(obj.uri);
		
		$.extend(obj, {
			protocol: matches[3] || '',
			host: matches[4] || '',
			tld: matches[6] || '',
			path: matches[7] || '',
			query: matches[9] || '',
			anchor: matches[11] || '',
			
			// methods for protocol
			getProtocol: function() {
				return obj.protocol;
			},
			setProtocol: function(protocol) {
				obj.protocol = protocol;
				return obj;
			},
			
			// methods for host
			getHost: function() {
				return obj.host;
			},
			setHost: function(host) {
				obj.host = host;
				return obj;
			},
			
			// methods for TLD
			getTLD: function() {
				return obj.tld;
			},
			
			// methods for path
			getPath: function() {
				return obj.path;
			},
			setPath: function(path) {
				obj.path = path;
				return obj;
			},
			removePath: function() {
				obj.path = '/';
				return obj;
			},
			
			// methods for anchor
			getAnchor: function() {
				return obj.anchor;
			},
			removeAnchor: function() {
				obj.anchor = '';
				return obj;
			},
			setAnchor: function(anchor) {
				obj.anchor = anchor;
				return obj;
			},
			
			// alias for anchor
			getHash: function() {
				return obj.getAnchor();
			},
			setHash: function(hash) {
				obj.setAnchor(hash);
				return obj;
			},
			removeHash: function() {
				obj.removeAnchor();
				return obj;
			},
			
			// methods for query (as string)
			getQuery: function() {
				return obj.query;
			},
			setQuery: function(query) {
				obj.query = query;
				return obj;
			},
			removeQuery: function() {
				obj.query = '';
				return obj;
			},
			
			// methods for query (as object)
			getParams: function() {
				if (!obj.query) {
					return {};
				}
				
				var m, params = {};
				
				while (m = obj.re2.exec(obj.query)) {
					
					var name = decodeURIComponent(m[1]);
					var val = decodeURIComponent(m[2]);
					var array = [];
					
					while (n = obj.re3.exec(name)) {
						
						array.push(decodeURIComponent(n[1]));
					}
					
					if (array.length) {
						
						name = name.replace(/\[.*\]/, '');
						var a = [];
						var n = "params['" + name + "']";
						
						eval("if (typeof(" + n + ") == 'undefined') " + n + " = {};");
						
						for (var i = 0; i < array.length; i++) {
							a.push(array[i]);
							n = "params['" + name + "']['" + a.join("']['") + "']";
							eval("if (typeof(" + n + ") == 'undefined') " + n + " = {};");
						};
						
						eval("params['" + name + "']['" + array.join("']['") + "']='" + val + "';");
					} else {
						
						params[name] = val;
					}
				}
				
				return params;
			},
			setParams: function(params) {
				obj.query = $.param(params);
				return obj;
			},
			addParams: function(params) {
				params = $.extend(obj.getParams(), params);
				obj.setParams(params);
				return obj;
			},
			removeParams: function() {
				obj.setParams({});
				return obj;
			},
			getParam: function(name) {
				var params = obj.getParams();
				return params[name];
			},
			setParam: function(name, value) {
				var params = obj.getParams();
				params[name] = value;
				obj.setParams(params);
				return obj;
			},
			removeParam: function(name) {
				var params = obj.getParams();
				delete(params[name]);
				obj.setParams(params);
				return obj;
			},
			
			// build uri
			build: function() {
				var uri = '';
				
				if (obj.host) {
					uri += (obj.protocol ? obj.protocol : 'http:') + '//' + obj.host;
				}
				
				uri += obj.path ? obj.path : '/';
				
				if (obj.query) {
					uri += '?' + obj.query;
				}
				
				if (obj.anchor) {
					uri += '#' + obj.anchor;
				}
				
				return uri;
			},
			
			// change window location
			go: function() {
				window.location.href = obj.build();
			}
		});
		
		return obj;
	};
})(jQuery);
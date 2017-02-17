var CSTruter = CSTruter || {};

(function () {
	
	CSTruter.Elements = {};
	
	CSTruter.Elements.DropDownList = function(id) { 
		var element = getElementById(id);
		if (element.tagName !== 'SELECT') {
			throw 'Element ' + id + ' expected to be a SELECT element, instead ' + element.tagName + ' element';
		}
		return {
			_element : element,
			AttachAutoPostBack : attachAutoPostBack,
			Clear: clear,
			On : on,
			Off : off
		};
	};
	
	function clear() {
		this._element.length = 0;
	}
	
	function attachAutoPostBack() {
		var listener = function(e) {
			var form = e.srcElement.form;
			if (form === null) {
				throw 'Element ' + id + ' parent form not found, context of element likely changed';
			}
			form.submit();
		};
		if (this._element.form === null) {
			throw 'Element ' + id + ' parent form not found, element likely not contained within a form';
		}
		addEventListener(this._element, 'change', listener);
	}
	
	function on(type, listener) {
		if (typeof listener !== 'function') {
			throw 'Element ' + id + ' invalid listener, function expected';
		}
		addEventListener(this._element, type, listener);
	}
	
	function off(type, listener) {
		removeEventListener(this._element, type, listener);
	}
	
	function addEventListener(element, type, listener) {
		if (element.addEventListener) {
			element.addEventListener(type, listener, false);
		} else {
			element.attachEvent('on' + type, listener);
		}	
	}

	function removeEventListener(element, type, listener) {
		if (element.removeEventListener) {
			element.removeEventListener(type, listener, false);
		} else {
			element.detachEvent('on' + type, listener);
		}	
	}				
	function getElementById(id) {
		var element = document.getElementById(id);
		if (element === null) {
			throw 'Element ' + id + ' not found';
		}
		return element;
	}
	
})();
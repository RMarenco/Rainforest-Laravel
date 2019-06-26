<<<<<<< HEAD
/*FUNCIONES PARA COMPARE BASKET*/
(function() {

	var viewEl = document.querySelector('.view'),
		gridEl = viewEl.querySelector('.grid'),
		items = [].slice.call(gridEl.querySelectorAll('.product')),
		basket;

	// the compare basket
	function CompareBasket() {
		this.el = document.querySelector('.compare-basket');
		this.compareCtrl = this.el.querySelector('.action--compare');
		this.compareWrapper = document.querySelector('.compare'),
		this.closeCompareCtrl = this.compareWrapper.querySelector('.action--close')
		
		this.itemsAllowed = 3;
		this.totalItems = 0;
		this.items = [];

		// compares items in the compare basket: opens the compare products wrapper
		this.compareCtrl.addEventListener('click', this._compareItems.bind(this));
		// close the compare products wrapper
		var self = this;
		this.closeCompareCtrl.addEventListener('click', function() {
			// toggle compare basket
			classie.add(self.el, 'compare-basket--active');
			// animate..
			classie.remove(viewEl, 'view--compare');
		});
	}

	CompareBasket.prototype.add = function(item) {
		// check limit
		if( this.isFull() ) {
			return false;
		}

		classie.add(item, 'product--selected');

		// create item preview element
		var preview = this._createItemPreview(item);
		// prepend it to the basket
		this.el.insertBefore(preview, this.el.childNodes[0]);
		// insert item
		this.items.push(preview);

		this.totalItems++;
		if( this.isFull() ) {
			classie.add(this.el, 'compare-basket--full');
		}

		classie.add(this.el, 'compare-basket--active');
	};

	CompareBasket.prototype._createItemPreview = function(item) {
		var self = this;

		var preview = document.createElement('div');
		preview.className = 'product-icon';
		preview.setAttribute('data-idx', items.indexOf(item));
		
		var removeCtrl = document.createElement('button');
		removeCtrl.className = 'cross action action--remove';
		removeCtrl.innerHTML = '<i class="fa fa-2x fa-times"></i><span class="action__text action__text--invisible">Remove product</span>';
		removeCtrl.addEventListener('click', function() {
			self.remove(item);
		});
		
		var productImageEl = item.querySelector('img.product__image').cloneNode(true);
		productImageEl.style='min-width:2.8em;'+'max-width:2.8em;'+'min-height:2.8em;'+'max-height:2.8em;'+'padding-top:20%;';
		preview.appendChild(productImageEl);
		preview.appendChild(removeCtrl);
		var productInfo = item.querySelector('.product__info').innerHTML;
		preview.setAttribute('data-info', productInfo);

		return preview;
	};

	CompareBasket.prototype.remove = function(item) {
		classie.remove(this.el, 'compare-basket--full');
		classie.remove(item, 'product--selected');
		var preview = this.el.querySelector('[data-idx = "' + items.indexOf(item) + '"]');
		this.el.removeChild(preview);
		this.totalItems--;

		var indexRemove = this.items.indexOf(preview);
		this.items.splice(indexRemove, 1);

		if( this.totalItems === 0 ) {
			classie.remove(this.el, 'compare-basket--active');
		}

		// checkbox
		var checkbox = item.querySelector('.action--compare-add > input[type = "checkbox"]');
		if( checkbox.checked ) {
			checkbox.checked = false;
		}
	};

	CompareBasket.prototype._compareItems = function() {
		var self = this;

		// remove all previous items inside the compareWrapper element
		[].slice.call(this.compareWrapper.querySelectorAll('div.compare__item')).forEach(function(item) {
			self.compareWrapper.removeChild(item);
		});

		for(var i = 0; i < this.totalItems; ++i) {
			var compareItemWrapper = document.createElement('div');
			compareItemWrapper.className = 'compare__item';

			var compareItemEffectEl = document.createElement('div');
			compareItemEffectEl.className = 'compare__effect';

			compareItemEffectEl.innerHTML = this.items[i].getAttribute('data-info');
			compareItemWrapper.appendChild(compareItemEffectEl);

			this.compareWrapper.insertBefore(compareItemWrapper, this.compareWrapper.childNodes[0]);
		}

		setTimeout(function() {
			// toggle compare basket
			classie.remove(self.el, 'compare-basket--active');
			// animate..
			classie.add(viewEl, 'view--compare');
		}, 25);
	};

	CompareBasket.prototype.isFull = function() {
		return this.totalItems === this.itemsAllowed;
	};

	function init() {
		// initialize an empty basket
		basket = new CompareBasket();
		initEvents();
	}

	function initEvents() {
		items.forEach(function(item) {
			var checkbox = item.querySelector('.action--compare-add > input[type = "checkbox"]');
			checkbox.checked = false;

			// ctrl to add to the "compare basket"
			checkbox.addEventListener('click', function(ev) {
				if( ev.target.checked ) {
					if( basket.isFull() ) {
						ev.preventDefault();
						return false;
					}
					basket.add(item);
				}
				else {
					basket.remove(item);
				}
			});
		});
	}

	init();

})();

/*Classie Compare Basket*/
( function( window ) {

	'use strict';
	function classReg( className ) {
	  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
	}
	
	var hasClass, addClass, removeClass;
	
	if ( 'classList' in document.documentElement ) {
	  hasClass = function( elem, c ) {
		return elem.classList.contains( c );
	  };
	  addClass = function( elem, c ) {
		elem.classList.add( c );
	  };
	  removeClass = function( elem, c ) {
		elem.classList.remove( c );
	  };
	}
	else {
	  hasClass = function( elem, c ) {
		return classReg( c ).test( elem.className );
	  };
	  addClass = function( elem, c ) {
		if ( !hasClass( elem, c ) ) {
		  elem.className = elem.className + ' ' + c;
		}
	  };
	  removeClass = function( elem, c ) {
		elem.className = elem.className.replace( classReg( c ), ' ' );
	  };
	}
	
	function toggleClass( elem, c ) {
	  var fn = hasClass( elem, c ) ? removeClass : addClass;
	  fn( elem, c );
	}
	
	var classie = {
	  // Nombres completos
	  hasClass: hasClass,
	  addClass: addClass,
	  removeClass: removeClass,
	  toggleClass: toggleClass,
	  // Nombres recortados
	  has: hasClass,
	  add: addClass,
	  remove: removeClass,
	  toggle: toggleClass
	};
	
	// Transportar
	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( classie );
	} else if ( typeof exports === 'object' ) {
	  // JavaScript común
	  module.exports = classie;
	} else {
	  // Navegadores globales
	  window.classie = classie;
	}
	
=======
/*FUNCIONES PARA COMPARE BASKET*/
(function() {

	var viewEl = document.querySelector('.view'),
		gridEl = viewEl.querySelector('.grid'),
		items = [].slice.call(gridEl.querySelectorAll('.product')),
		basket;

	// the compare basket
	function CompareBasket() {
		this.el = document.querySelector('.compare-basket');
		this.compareCtrl = this.el.querySelector('.action--compare');
		this.compareWrapper = document.querySelector('.compare'),
		this.closeCompareCtrl = this.compareWrapper.querySelector('.action--close')
		
		this.itemsAllowed = 3;
		this.totalItems = 0;
		this.items = [];

		// compares items in the compare basket: opens the compare products wrapper
		this.compareCtrl.addEventListener('click', this._compareItems.bind(this));
		// close the compare products wrapper
		var self = this;
		this.closeCompareCtrl.addEventListener('click', function() {
			// toggle compare basket
			classie.add(self.el, 'compare-basket--active');
			// animate..
			classie.remove(viewEl, 'view--compare');
		});
	}

	CompareBasket.prototype.add = function(item) {
		// check limit
		if( this.isFull() ) {
			return false;
		}

		classie.add(item, 'product--selected');

		// create item preview element
		var preview = this._createItemPreview(item);
		// prepend it to the basket
		this.el.insertBefore(preview, this.el.childNodes[0]);
		// insert item
		this.items.push(preview);

		this.totalItems++;
		if( this.isFull() ) {
			classie.add(this.el, 'compare-basket--full');
		}

		classie.add(this.el, 'compare-basket--active');
	};

	CompareBasket.prototype._createItemPreview = function(item) {
		var self = this;

		var preview = document.createElement('div');
		preview.className = 'product-icon';
		preview.setAttribute('data-idx', items.indexOf(item));
		
		var removeCtrl = document.createElement('button');
		removeCtrl.className = 'cross action action--remove';
		removeCtrl.innerHTML = '<i class="fa fa-2x fa-times"></i><span class="action__text action__text--invisible">Remove product</span>';
		removeCtrl.addEventListener('click', function() {
			self.remove(item);
		});
		
		var productImageEl = item.querySelector('img.product__image').cloneNode(true);
		productImageEl.style='min-width:2.8em;'+'max-width:2.8em;'+'min-height:2.8em;'+'max-height:2.8em;'+'padding-top:20%;';
		preview.appendChild(productImageEl);
		preview.appendChild(removeCtrl);
		var productInfo = item.querySelector('.product__info').innerHTML;
		preview.setAttribute('data-info', productInfo);

		return preview;
	};

	CompareBasket.prototype.remove = function(item) {
		classie.remove(this.el, 'compare-basket--full');
		classie.remove(item, 'product--selected');
		var preview = this.el.querySelector('[data-idx = "' + items.indexOf(item) + '"]');
		this.el.removeChild(preview);
		this.totalItems--;

		var indexRemove = this.items.indexOf(preview);
		this.items.splice(indexRemove, 1);

		if( this.totalItems === 0 ) {
			classie.remove(this.el, 'compare-basket--active');
		}

		// checkbox
		var checkbox = item.querySelector('.action--compare-add > input[type = "checkbox"]');
		if( checkbox.checked ) {
			checkbox.checked = false;
		}
	};

	CompareBasket.prototype._compareItems = function() {
		var self = this;

		// remove all previous items inside the compareWrapper element
		[].slice.call(this.compareWrapper.querySelectorAll('div.compare__item')).forEach(function(item) {
			self.compareWrapper.removeChild(item);
		});

		for(var i = 0; i < this.totalItems; ++i) {
			var compareItemWrapper = document.createElement('div');
			compareItemWrapper.className = 'compare__item';

			var compareItemEffectEl = document.createElement('div');
			compareItemEffectEl.className = 'compare__effect';

			compareItemEffectEl.innerHTML = this.items[i].getAttribute('data-info');
			compareItemWrapper.appendChild(compareItemEffectEl);

			this.compareWrapper.insertBefore(compareItemWrapper, this.compareWrapper.childNodes[0]);
		}

		setTimeout(function() {
			// toggle compare basket
			classie.remove(self.el, 'compare-basket--active');
			// animate..
			classie.add(viewEl, 'view--compare');
		}, 25);
	};

	CompareBasket.prototype.isFull = function() {
		return this.totalItems === this.itemsAllowed;
	};

	function init() {
		// initialize an empty basket
		basket = new CompareBasket();
		initEvents();
	}

	function initEvents() {
		items.forEach(function(item) {
			var checkbox = item.querySelector('.action--compare-add > input[type = "checkbox"]');
			checkbox.checked = false;

			// ctrl to add to the "compare basket"
			checkbox.addEventListener('click', function(ev) {
				if( ev.target.checked ) {
					if( basket.isFull() ) {
						ev.preventDefault();
						return false;
					}
					basket.add(item);
				}
				else {
					basket.remove(item);
				}
			});
		});
	}

	init();

})();

/*Classie Compare Basket*/
( function( window ) {

	'use strict';
	function classReg( className ) {
	  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
	}
	
	var hasClass, addClass, removeClass;
	
	if ( 'classList' in document.documentElement ) {
	  hasClass = function( elem, c ) {
		return elem.classList.contains( c );
	  };
	  addClass = function( elem, c ) {
		elem.classList.add( c );
	  };
	  removeClass = function( elem, c ) {
		elem.classList.remove( c );
	  };
	}
	else {
	  hasClass = function( elem, c ) {
		return classReg( c ).test( elem.className );
	  };
	  addClass = function( elem, c ) {
		if ( !hasClass( elem, c ) ) {
		  elem.className = elem.className + ' ' + c;
		}
	  };
	  removeClass = function( elem, c ) {
		elem.className = elem.className.replace( classReg( c ), ' ' );
	  };
	}
	
	function toggleClass( elem, c ) {
	  var fn = hasClass( elem, c ) ? removeClass : addClass;
	  fn( elem, c );
	}
	
	var classie = {
	  // Nombres completos
	  hasClass: hasClass,
	  addClass: addClass,
	  removeClass: removeClass,
	  toggleClass: toggleClass,
	  // Nombres recortados
	  has: hasClass,
	  add: addClass,
	  remove: removeClass,
	  toggle: toggleClass
	};
	
	// Transportar
	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( classie );
	} else if ( typeof exports === 'object' ) {
	  // JavaScript común
	  module.exports = classie;
	} else {
	  // Navegadores globales
	  window.classie = classie;
	}
	
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
	})( window );
;(function($, window, document, undefined) {
  function Rippleria(element, options) {
    var base = this;

    this.$element = $(element);
    this.options = $.extend({}, Rippleria.Defaults, this._getOptionsFromElementAttributes(), options);

    this._prepare();
    this._bind();
  };

  Rippleria.prototype._bind = function() {
    var elem = this.$element,
      options = this.options,
      ink, d, x, y, isTouchSupported, eventType;

    isTouchSupported = 'ontouchend' in window || window.DocumentTouch && document instanceof DocumentTouch;

    eventType = isTouchSupported == true ? 'touchend.rippleria' : 'click.rippleria';

    this.$element.bind(eventType, function(e) {
      var ink = $("<div class='rippleria-ink'></div>");
      elem.append(ink);

      if (options.color != undefined) {
        ink.css('background-color', options.color);
      }

      ink.css('animation', 'rippleria ' + options.duration / 1000 + 's ' + options.easing);

      setTimeout(function() {
        ink.remove();
      }, parseFloat(options.duration));
      
      if(!ink.height() && !ink.width()) {
        d = Math.max(elem.outerWidth(), elem.outerHeight());
        ink.css({height: d, width: d});
      }

      if (isTouchSupported == true) {
        var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
        x = touch.pageX - elem.offset().left - ink.width() / 2;
        y = touch.pageY - elem.offset().top - ink.height() / 2;
      } else {
        x = e.pageX - elem.offset().left - ink.width() / 2;
        y = e.pageY - elem.offset().top - ink.height() / 2;
      }
      
      ink.css({top: y + 'px', left: x + 'px'});
    });
  }

  Rippleria.prototype._prepare = function() {
    var elem = this.$element;

    if (elem.css('position') == 'static') {
      elem.css('position', 'relative');
    }

    elem.css('overflow', 'hidden');

    if(elem.find('img')[0] != undefined) {
      elem.on('dragstart', function(e) { e.preventDefault(); });
    }
  };

  Rippleria.prototype._getOptionsFromElementAttributes = function() {
    var base = this;
      attrs = {};

    $.each(Rippleria.Defaults, function(option, val) {
      var attr = base.$element.attr('data-rippleria-' + option);
      if (attr != null) {
        attrs[option] = attr;
      }
    });

    return attrs;
  };

  Rippleria.prototype.changeColor = function(color) {
    this.options.color = color;
  }

  Rippleria.prototype.changeEasing = function(easing) {
    this.options.easing = easing;
  }

  Rippleria.prototype.changeDuration = function(duration) {
    this.options.duration = duration;
  }

  Rippleria.Defaults = {
    duration: 750,
    easing: 'linear',
    color: undefined
  };

  $.fn.rippleria = function(option) {
    var args = Array.prototype.slice.call(arguments, 1);

    return this.each(function() {
      var $this = $(this),
        data = $this.data('rippleria');

      if (!data) {
        data = new Rippleria(this, typeof option == 'object' && option);
        $this.data('rippleria', data);
      }

      if (typeof option == 'string' && option.charAt(0) !== '_') {
        data[option].apply(data, args);
      }
    });
  };

  $(function() {
    $('[data-rippleria]').rippleria();
  });
})(window.jQuery, window, document);

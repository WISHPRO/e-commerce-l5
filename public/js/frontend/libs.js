// bootstrap-rating - v1.0.2 - (c) 2015 dreyescat 
// https://github.com/dreyescat/bootstrap-rating MIT
!function (a, b) {
    "use strict";
    var c = 5;
    a.fn.rating = function (d) {
        return this.each(function () {
            var e = a(this), f = a.extend({}, e.data(), d);
            f.start = parseInt(f.start, 10), f.start = isNaN(f.start) ? b : f.start, f.stop = parseInt(f.stop, 10), f.stop = isNaN(f.stop) ? f.start + c || b : f.stop, f.step = parseInt(f.step, 10) || b, f.fractions = Math.abs(parseInt(f.fractions, 10)) || b, f.scale = Math.abs(parseInt(f.scale, 10)) || b, f = a.extend({}, a.fn.rating.defaults, f);
            for (var g = function (a) {
                var b = Math.floor(a);
                n.find(".rating-symbol-background").css("visibility", "visible").slice(0, b).css("visibility", "hidden");
                var c = n.find(".rating-symbol-foreground");
                c.width(0), c.slice(0, b).width("auto"), c.eq(b).width(a % 1 * 100 + "%")
            }, h = function (a) {
                return f.start + Math.floor(a) * f.step + f.step * j(a % 1)
            }, i = function (a) {
                return (a - f.start) / f.step
            }, j = function (a) {
                var b = Math.ceil(a % 1 * f.fractions) / f.fractions, c = Math.pow(10, f.scale);
                return Math.floor(a) + Math.floor(b * c) / c
            }, k = function (a) {
                var b = f.step > 0 ? f.start : f.stop, c = f.step > 0 ? f.stop : f.start;
                return a >= b && c >= a
            }, l = function (a) {
                var b = parseFloat(a);
                k(b) && g(i(b))
            }, m = function (a) {
                return function (b) {
                    e.prop("disabled") || e.prop("readonly") || a.call(this, b)
                }
            }, n = a("<span></span>").insertBefore(e), o = 1; o <= i(f.stop); o++) {
                var p = a('<div class="rating-symbol"></div>').css({display: "inline-block", position: "relative"});
                a('<div class="rating-symbol-background ' + f.empty + '"></div>').appendTo(p), a('<div class="rating-symbol-foreground"></div>').append('<span class="' + f.filled + '"></span>').css({
                    display: "inline-block",
                    position: "absolute",
                    overflow: "hidden",
                    left: 0,
                    width: 0
                }).appendTo(p), n.append(p), f.extendSymbol.call(p, h(o))
            }
            l(e.val()), e.on("change", function () {
                l(a(this).val())
            });
            var q = function (b) {
                var c = a(b.currentTarget), d = (b.pageX || b.originalEvent.touches[0].pageX) - c.offset().left;
                return c.index() + d / c.width()
            };
            n.on("mousedown touchstart", ".rating-symbol", m(function (a) {
                e.val(h(q(a))).change()
            })).on("mousemove touchmove", ".rating-symbol", m(function (a) {
                g(j(q(a)))
            })).on("mouseleave touchend", ".rating-symbol", m(function () {
                g(i(parseFloat(e.val())))
            }))
        })
    }, a.fn.rating.defaults = {
        filled: "glyphicon glyphicon-star",
        empty: "glyphicon glyphicon-star-empty",
        start: 0,
        stop: c,
        step: 1,
        fractions: 1,
        scale: 3,
        extendSymbol: function () {
        }
    }, a(function () {
        a("input.rating").rating()
    })
}(jQuery);
/**
 * bootstrap-strength-meter.js
 * https://github.com/davidstutz/bootstrap-strength-meter
 *
 * Copyright 2013 David Stutz
 */
!function ($) {

    "use strict";// jshint ;_;

    var StrengthMeter = {

        progressBar: function (input, options) {

            var defaults = {
                container: input.parent(),
                base: 80,
                hierarchy: {
                    '0': 'progress-bar-danger',
                    '25': 'progress-bar-warning',
                    '50': 'progress-bar-success'
                },
                passwordScore: {
                    options: [],
                    append: true
                }
            };

            var settings = $.extend(true, {}, defaults, options);

            if (typeof options === 'object' && 'hierarchy' in options) {
                settings.hierarchy = options.hierarchy;
            }

            var template = '<div class="progress"><div class="progress-bar" role="progressbar"></div></div>';
            var progress;
            var progressBar;

            var core = {

                /**
                 * Initialize the plugin.
                 */
                init: function () {
                    progress = settings.container.append($(template));
                    progressBar = $('.progress-bar', progress);

                    progressBar.attr('aria-valuemin', 0)
                        .attr('aria-valuemay', 100);

                    input.on('keyup', core.keyup)
                        .keyup();
                },

                /**
                 * Update progress bar.
                 *
                 * @param {string} value
                 */
                update: function (value) {
                    var width = Math.floor((value / settings.base) * 100);

                    if (width > 100) {
                        width = 100;
                    }

                    progressBar
                        .attr('area-valuenow', width)
                        .css('width', width + '%');

                    for (var value in settings.hierarchy) {
                        if (width > value) {
                            progressBar
                                .removeClass()
                                .addClass('progress-bar')
                                .addClass(settings.hierarchy[value]);
                        }
                    }
                },

                /**
                 * Event binding on password input.
                 *
                 * @param {Object} event
                 */
                keyup: function (event) {
                    var password = $(event.target).val();
                    var value = 0;

                    if (password.length > 0) {
                        var score = new Score(password);
                        value = score.calculateEntropyScore(settings.passwordScore.options, settings.passwordScore.append);
                    }

                    core.update(value);
                }
            };

            core.init();
        },

        text: function (input, options) {

            var defaults = {
                container: input.parent(),
                hierarchy: {
                    '0': ['text-danger', 'ridiculus'],
                    '10': ['text-danger', 'very weak'],
                    '20': ['text-warning', 'weak'],
                    '30': ['text-warning', 'good'],
                    '40': ['text-success', 'strong'],
                    '50': ['text-success', 'very strong']
                },
                passwordScore: {
                    options: [],
                    append: true
                }
            };

            var settings = $.extend(true, {}, defaults, options);

            if (typeof options === 'object' && 'hierarchy' in options) {
                settings.hierarchy = options.hierarchy;
            }

            var core = {

                /**
                 * Initialize the plugin.
                 */
                init: function () {
                    input.on('keyup', core.keyup)
                        .keyup();
                },

                /**
                 * Update text element.
                 *
                 * @param {string} value
                 */
                update: function (value) {
                    for (var border in settings.hierarchy) {
                        if (value >= border) {
                            var text = settings.hierarchy[border][1];
                            var color = settings.hierarchy[border][0];

                            settings.container.text(text)
                                .removeClass()
                                .addClass(color);
                        }
                    }
                },

                /**
                 * Event binding on input element.
                 *
                 * @param {Object} event
                 */
                keyup: function (event) {
                    var password = $(event.target).val();
                    var value = 0;

                    if (password.length > 0) {
                        var score = new Score(password);
                        value = score.calculateEntropyScore(settings.passwordScore.options, settings.passwordScore.append);
                    }

                    core.update(value);
                }
            };

            core.init();
        },

        tooltip: function (input, options) {

            var defaults = {
                hierarchy: {
                    '0': 'ridiculus',
                    '10': 'very weak',
                    '20': 'weak',
                    '30': 'good',
                    '40': 'string',
                    '50': 'very strong'
                },
                tooltip: {
                    placement: 'right'
                },
                passwordScore: {
                    options: [],
                    append: true
                }
            };

            var settings = $.extend(true, {}, defaults, options);

            if (typeof options === 'object' && 'hierarchy' in options) {
                settings.hierarchy = options.hierarchy;
            }

            var core = {

                /**
                 * Initialize the plugin.
                 */
                init: function () {
                    input.tooltip(settings.tooltip);

                    input.on('keyup', core.keyup)
                        .keyup();
                },

                /**
                 * Update tooltip.
                 *
                 * @param {string} value
                 */
                update: function (value) {
                    for (var border in settings.hierarchy) {
                        if (value >= border) {
                            var text = settings.hierarchy[border];

                            input.attr('data-original-title', text)
                                .tooltip('show');
                        }
                    }
                },

                /**
                 * Event binding on input element.
                 *
                 * @param {Object} event
                 */
                keyup: function (event) {
                    var password = $(event.target).val();
                    var value = 0;

                    if (password.length > 0) {
                        var score = new Score(password);
                        value = score.calculateEntropyScore(settings.passwordScore.options, settings.passwordScore.append);
                    }

                    core.update(value);
                }
            };

            core.init();
        }
    };

    $.fn.strengthMeter = function (type, options) {
        type = (type === undefined) ? 'tooltip' : type;

        if (!type in StrengthMeter) {
            return;
        }

        var instance = this.data('strengthMeter');
        var elem = this;

        return elem.each(function () {
            var strengthMeter;

            if (instance) {
                return;
            }

            strengthMeter = StrengthMeter[type](elem, options);
            elem.data('strengthMeter', strengthMeter);
        });
    };

}(window.jQuery);

/*!
 * Bootstrap v3.3.1 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
if ("undefined" == typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");
+function (a) {
    var b = a.fn.jquery.split(" ")[0].split(".");
    if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")
}(jQuery), +function (a) {
    "use strict";
    function b() {
        var a = document.createElement("bootstrap"), b = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var c in b)if (void 0 !== a.style[c])return {end: b[c]};
        return !1
    }

    a.fn.emulateTransitionEnd = function (b) {
        var c = !1, d = this;
        a(this).one("bsTransitionEnd", function () {
            c = !0
        });
        var e = function () {
            c || a(d).trigger(a.support.transition.end)
        };
        return setTimeout(e, b), this
    }, a(function () {
        a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
            bindType: a.support.transition.end,
            delegateType: a.support.transition.end,
            handle: function (b) {
                return a(b.target).is(this) ? b.handleObj.handler.apply(this, arguments) : void 0
            }
        })
    })
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        return this.each(function () {
            var c = a(this), e = c.data("bs.alert");
            e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c)
        })
    }

    var c = '[data-dismiss="alert"]', d = function (b) {
        a(b).on("click", c, this.close)
    };
    d.VERSION = "3.3.1", d.TRANSITION_DURATION = 150, d.prototype.close = function (b) {
        function c() {
            g.detach().trigger("closed.bs.alert").remove()
        }

        var e = a(this), f = e.attr("data-target");
        f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
        var g = a(f);
        b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c())
    };
    var e = a.fn.alert;
    a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function () {
        return a.fn.alert = e, this
    }, a(document).on("click.bs.alert.data-api", c, d.prototype.close)
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.button"), f = "object" == typeof b && b;
            e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b)
        })
    }

    var c = function (b, d) {
        this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1
    };
    c.VERSION = "3.3.1", c.DEFAULTS = {loadingText: "loading..."}, c.prototype.setState = function (b) {
        var c = "disabled", d = this.$element, e = d.is("input") ? "val" : "html", f = d.data();
        b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function () {
            d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c))
        }, this), 0)
    }, c.prototype.toggle = function () {
        var a = !0, b = this.$element.closest('[data-toggle="buttons"]');
        if (b.length) {
            var c = this.$element.find("input");
            "radio" == c.prop("type") && (c.prop("checked") && this.$element.hasClass("active") ? a = !1 : b.find(".active").removeClass("active")), a && c.prop("checked", !this.$element.hasClass("active")).trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active"));
        a && this.$element.toggleClass("active")
    };
    var d = a.fn.button;
    a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function () {
        return a.fn.button = d, this
    }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (c) {
        var d = a(c.target);
        d.hasClass("btn") || (d = d.closest(".btn")), b.call(d, "toggle"), c.preventDefault()
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (b) {
        a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type))
    })
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.carousel"), f = a.extend({}, c.DEFAULTS, d.data(), "object" == typeof b && b), g = "string" == typeof b ? b : f.slide;
            e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(b) : g ? e[g]() : f.interval && e.pause().cycle()
        })
    }

    var c = function (b, c) {
        this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = this.sliding = this.interval = this.$active = this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart"in document.documentElement) && this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on("mouseleave.bs.carousel", a.proxy(this.cycle, this))
    };
    c.VERSION = "3.3.1", c.TRANSITION_DURATION = 600, c.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, c.prototype.keydown = function (a) {
        if (!/input|textarea/i.test(a.target.tagName)) {
            switch (a.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return
            }
            a.preventDefault()
        }
    }, c.prototype.cycle = function (b) {
        return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this
    }, c.prototype.getItemIndex = function (a) {
        return this.$items = a.parent().children(".item"), this.$items.index(a || this.$active)
    }, c.prototype.getItemForDirection = function (a, b) {
        var c = "prev" == a ? -1 : 1, d = this.getItemIndex(b), e = (d + c) % this.$items.length;
        return this.$items.eq(e)
    }, c.prototype.to = function (a) {
        var b = this, c = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        return a > this.$items.length - 1 || 0 > a ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
            b.to(a)
        }) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev", this.$items.eq(a))
    }, c.prototype.pause = function (b) {
        return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, c.prototype.next = function () {
        return this.sliding ? void 0 : this.slide("next")
    }, c.prototype.prev = function () {
        return this.sliding ? void 0 : this.slide("prev")
    }, c.prototype.slide = function (b, d) {
        var e = this.$element.find(".item.active"), f = d || this.getItemForDirection(b, e), g = this.interval, h = "next" == b ? "left" : "right", i = "next" == b ? "first" : "last", j = this;
        if (!f.length) {
            if (!this.options.wrap)return;
            f = this.$element.find(".item")[i]()
        }
        if (f.hasClass("active"))return this.sliding = !1;
        var k = f[0], l = a.Event("slide.bs.carousel", {relatedTarget: k, direction: h});
        if (this.$element.trigger(l), !l.isDefaultPrevented()) {
            if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var m = a(this.$indicators.children()[this.getItemIndex(f)]);
                m && m.addClass("active")
            }
            var n = a.Event("slid.bs.carousel", {relatedTarget: k, direction: h});
            return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one("bsTransitionEnd", function () {
                f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass(["active", h].join(" ")), j.sliding = !1, setTimeout(function () {
                    j.$element.trigger(n)
                }, 0)
            }).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"), f.addClass("active"), this.sliding = !1, this.$element.trigger(n)), g && this.cycle(), this
        }
    };
    var d = a.fn.carousel;
    a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict = function () {
        return a.fn.carousel = d, this
    };
    var e = function (c) {
        var d, e = a(this), f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""));
        if (f.hasClass("carousel")) {
            var g = a.extend({}, f.data(), e.data()), h = e.attr("data-slide-to");
            h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault()
        }
    };
    a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on("click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load", function () {
        a('[data-ride="carousel"]').each(function () {
            var c = a(this);
            b.call(c, c.data())
        })
    })
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        var c, d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");
        return a(d)
    }

    function c(b) {
        return this.each(function () {
            var c = a(this), e = c.data("bs.collapse"), f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
            !e && f.toggle && "show" == b && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]()
        })
    }

    var d = function (b, c) {
        this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a(this.options.trigger).filter('[href="#' + b.id + '"], [data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    d.VERSION = "3.3.1", d.TRANSITION_DURATION = 350, d.DEFAULTS = {
        toggle: !0,
        trigger: '[data-toggle="collapse"]'
    }, d.prototype.dimension = function () {
        var a = this.$element.hasClass("width");
        return a ? "width" : "height"
    }, d.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var b, e = this.$parent && this.$parent.find("> .panel").children(".in, .collapsing");
            if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
                var f = a.Event("show.bs.collapse");
                if (this.$element.trigger(f), !f.isDefaultPrevented()) {
                    e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));
                    var g = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var h = function () {
                        this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!a.support.transition)return h.call(this);
                    var i = a.camelCase(["scroll", g].join("-"));
                    this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])
                }
            }
        }
    }, d.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var b = a.Event("hide.bs.collapse");
            if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                var c = this.dimension();
                this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var e = function () {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this)
            }
        }
    }, d.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, d.prototype.getParent = function () {
        return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function (c, d) {
            var e = a(d);
            this.addAriaAndCollapsedClass(b(e), e)
        }, this)).end()
    }, d.prototype.addAriaAndCollapsedClass = function (a, b) {
        var c = a.hasClass("in");
        a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c)
    };
    var e = a.fn.collapse;
    a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function () {
        return a.fn.collapse = e, this
    }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (d) {
        var e = a(this);
        e.attr("data-target") || d.preventDefault();
        var f = b(e), g = f.data("bs.collapse"), h = g ? "toggle" : a.extend({}, e.data(), {trigger: this});
        c.call(f, h)
    })
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        b && 3 === b.which || (a(e).remove(), a(f).each(function () {
            var d = a(this), e = c(d), f = {relatedTarget: this};
            e.hasClass("open") && (e.trigger(b = a.Event("hide.bs.dropdown", f)), b.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger("hidden.bs.dropdown", f)))
        }))
    }

    function c(b) {
        var c = b.attr("data-target");
        c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));
        var d = c && a(c);
        return d && d.length ? d : b.parent()
    }

    function d(b) {
        return this.each(function () {
            var c = a(this), d = c.data("bs.dropdown");
            d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c)
        })
    }

    var e = ".dropdown-backdrop", f = '[data-toggle="dropdown"]', g = function (b) {
        a(b).on("click.bs.dropdown", this.toggle)
    };
    g.VERSION = "3.3.1", g.prototype.toggle = function (d) {
        var e = a(this);
        if (!e.is(".disabled, :disabled")) {
            var f = c(e), g = f.hasClass("open");
            if (b(), !g) {
                "ontouchstart"in document.documentElement && !f.closest(".navbar-nav").length && a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click", b);
                var h = {relatedTarget: this};
                if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented())return;
                e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger("shown.bs.dropdown", h)
            }
            return !1
        }
    }, g.prototype.keydown = function (b) {
        if (/(38|40|27|32)/.test(b.which) && !/input|textarea/i.test(b.target.tagName)) {
            var d = a(this);
            if (b.preventDefault(), b.stopPropagation(), !d.is(".disabled, :disabled")) {
                var e = c(d), g = e.hasClass("open");
                if (!g && 27 != b.which || g && 27 == b.which)return 27 == b.which && e.find(f).trigger("focus"), d.trigger("click");
                var h = " li:not(.divider):visible a", i = e.find('[role="menu"]' + h + ', [role="listbox"]' + h);
                if (i.length) {
                    var j = i.index(b.target);
                    38 == b.which && j > 0 && j--, 40 == b.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus")
                }
            }
        }
    };
    var h = a.fn.dropdown;
    a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function () {
        return a.fn.dropdown = h, this
    }, a(document).on("click.bs.dropdown.data-api", b).on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
        a.stopPropagation()
    }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="menu"]', g.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="listbox"]', g.prototype.keydown)
}(jQuery), +function (a) {
    "use strict";
    function b(b, d) {
        return this.each(function () {
            var e = a(this), f = e.data("bs.modal"), g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof b && b);
            f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) : g.show && f.show(d)
        })
    }

    var c = function (b, c) {
        this.options = c, this.$body = a(document.body), this.$element = a(b), this.$backdrop = this.isShown = null, this.scrollbarWidth = 0, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    c.VERSION = "3.3.1", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION = 150, c.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, c.prototype.toggle = function (a) {
        return this.isShown ? this.hide() : this.show(a)
    }, c.prototype.show = function (b) {
        var d = this, e = a.Event("show.bs.modal", {relatedTarget: b});
        this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.backdrop(function () {
            var e = a.support.transition && d.$element.hasClass("fade");
            d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show().scrollTop(0), d.options.backdrop && d.adjustBackdrop(), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element.addClass("in").attr("aria-hidden", !1), d.enforceFocus();
            var f = a.Event("shown.bs.modal", {relatedTarget: b});
            e ? d.$element.find(".modal-dialog").one("bsTransitionEnd", function () {
                d.$element.trigger("focus").trigger(f)
            }).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger("focus").trigger(f)
        }))
    }, c.prototype.hide = function (b) {
        b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal())
    }, c.prototype.enforceFocus = function () {
        a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function (a) {
            this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus")
        }, this))
    }, c.prototype.escape = function () {
        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", a.proxy(function (a) {
            27 == a.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
    }, c.prototype.resize = function () {
        this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this)) : a(window).off("resize.bs.modal")
    }, c.prototype.hideModal = function () {
        var a = this;
        this.$element.hide(), this.backdrop(function () {
            a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(), a.$element.trigger("hidden.bs.modal")
        })
    }, c.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, c.prototype.backdrop = function (b) {
        var d = this, e = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var f = a.support.transition && e;
            if (this.$backdrop = a('<div class="modal-backdrop ' + e + '" />').prependTo(this.$element).on("click.dismiss.bs.modal", a.proxy(function (a) {
                    a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
                }, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b)return;
            f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : b()
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass("in");
            var g = function () {
                d.removeBackdrop(), b && b()
            };
            a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : g()
        } else b && b()
    }, c.prototype.handleUpdate = function () {
        this.options.backdrop && this.adjustBackdrop(), this.adjustDialog()
    }, c.prototype.adjustBackdrop = function () {
        this.$backdrop.css("height", 0).css("height", this.$element[0].scrollHeight)
    }, c.prototype.adjustDialog = function () {
        var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "",
            paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : ""
        })
    }, c.prototype.resetAdjustments = function () {
        this.$element.css({paddingLeft: "", paddingRight: ""})
    }, c.prototype.checkScrollbar = function () {
        this.bodyIsOverflowing = document.body.scrollHeight > document.documentElement.clientHeight, this.scrollbarWidth = this.measureScrollbar()
    }, c.prototype.setScrollbar = function () {
        var a = parseInt(this.$body.css("padding-right") || 0, 10);
        this.bodyIsOverflowing && this.$body.css("padding-right", a + this.scrollbarWidth)
    }, c.prototype.resetScrollbar = function () {
        this.$body.css("padding-right", "")
    }, c.prototype.measureScrollbar = function () {
        var a = document.createElement("div");
        a.className = "modal-scrollbar-measure", this.$body.append(a);
        var b = a.offsetWidth - a.clientWidth;
        return this.$body[0].removeChild(a), b
    };
    var d = a.fn.modal;
    a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function () {
        return a.fn.modal = d, this
    }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
        var d = a(this), e = d.attr("href"), f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")), g = f.data("bs.modal") ? "toggle" : a.extend({remote: !/#/.test(e) && e}, f.data(), d.data());
        d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
            a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
                d.is(":visible") && d.trigger("focus")
            })
        }), b.call(f, g, this)
    })
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.tooltip"), f = "object" == typeof b && b, g = f && f.selector;
            (e || "destroy" != b) && (g ? (e || d.data("bs.tooltip", e = {}), e[g] || (e[g] = new c(this, f))) : e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }

    var c = function (a, b) {
        this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", a, b)
    };
    c.VERSION = "3.3.1", c.TRANSITION_DURATION = 150, c.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {selector: "body", padding: 0}
    }, c.prototype.init = function (b, c, d) {
        this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(this.options.viewport.selector || this.options.viewport);
        for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
            var g = e[f];
            if ("click" == g)this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this)); else if ("manual" != g) {
                var h = "hover" == g ? "mouseenter" : "focusin", i = "hover" == g ? "mouseleave" : "focusout";
                this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = a.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, c.prototype.getDefaults = function () {
        return c.DEFAULTS
    }, c.prototype.getOptions = function (b) {
        return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
            show: b.delay,
            hide: b.delay
        }), b
    }, c.prototype.getDelegateOptions = function () {
        var b = {}, c = this.getDefaults();
        return this._options && a.each(this._options, function (a, d) {
            c[a] != d && (b[a] = d)
        }), b
    }, c.prototype.enter = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c && c.$tip && c.$tip.is(":visible") ? void(c.hoverState = "in") : (c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void(c.timeout = setTimeout(function () {
            "in" == c.hoverState && c.show()
        }, c.options.delay.show)) : c.show())
    }, c.prototype.leave = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void(c.timeout = setTimeout(function () {
            "out" == c.hoverState && c.hide()
        }, c.options.delay.hide)) : c.hide()
    }, c.prototype.show = function () {
        var b = a.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(b);
            var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (b.isDefaultPrevented() || !d)return;
            var e = this, f = this.tip(), g = this.getUID(this.type);
            this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");
            var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement, i = /\s?auto?\s?/i, j = i.test(h);
            j && (h = h.replace(i, "") || "top"), f.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element);
            var k = this.getPosition(), l = f[0].offsetWidth, m = f[0].offsetHeight;
            if (j) {
                var n = h, o = this.options.container ? a(this.options.container) : this.$element.parent(), p = this.getPosition(o);
                h = "bottom" == h && k.bottom + m > p.bottom ? "top" : "top" == h && k.top - m < p.top ? "bottom" : "right" == h && k.right + l > p.width ? "left" : "left" == h && k.left - l < p.left ? "right" : h, f.removeClass(n).addClass(h)
            }
            var q = this.getCalculatedOffset(h, k, l, m);
            this.applyPlacement(q, h);
            var r = function () {
                var a = e.hoverState;
                e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e)
            };
            a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", r).emulateTransitionEnd(c.TRANSITION_DURATION) : r()
        }
    }, c.prototype.applyPlacement = function (b, c) {
        var d = this.tip(), e = d[0].offsetWidth, f = d[0].offsetHeight, g = parseInt(d.css("margin-top"), 10), h = parseInt(d.css("margin-left"), 10);
        isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top = b.top + g, b.left = b.left + h, a.offset.setOffset(d[0], a.extend({
            using: function (a) {
                d.css({top: Math.round(a.top), left: Math.round(a.left)})
            }
        }, b), 0), d.addClass("in");
        var i = d[0].offsetWidth, j = d[0].offsetHeight;
        "top" == c && j != f && (b.top = b.top + f - j);
        var k = this.getViewportAdjustedDelta(c, b, i, j);
        k.left ? b.left += k.left : b.top += k.top;
        var l = /top|bottom/.test(c), m = l ? 2 * k.left - e + i : 2 * k.top - f + j, n = l ? "offsetWidth" : "offsetHeight";
        d.offset(b), this.replaceArrow(m, d[0][n], l)
    }, c.prototype.replaceArrow = function (a, b, c) {
        this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "")
    }, c.prototype.setContent = function () {
        var a = this.tip(), b = this.getTitle();
        a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right")
    }, c.prototype.hide = function (b) {
        function d() {
            "in" != e.hoverState && f.detach(), e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b()
        }

        var e = this, f = this.tip(), g = a.Event("hide.bs." + this.type);
        return this.$element.trigger(g), g.isDefaultPrevented() ? void 0 : (f.removeClass("in"), a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this)
    }, c.prototype.fixTitle = function () {
        var a = this.$element;
        (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
    }, c.prototype.hasContent = function () {
        return this.getTitle()
    }, c.prototype.getPosition = function (b) {
        b = b || this.$element;
        var c = b[0], d = "BODY" == c.tagName, e = c.getBoundingClientRect();
        null == e.width && (e = a.extend({}, e, {width: e.right - e.left, height: e.bottom - e.top}));
        var f = d ? {
            top: 0,
            left: 0
        } : b.offset(), g = {scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop()}, h = d ? {
            width: a(window).width(),
            height: a(window).height()
        } : null;
        return a.extend({}, e, g, h, f)
    }, c.prototype.getCalculatedOffset = function (a, b, c, d) {
        return "bottom" == a ? {
            top: b.top + b.height,
            left: b.left + b.width / 2 - c / 2
        } : "top" == a ? {
            top: b.top - d,
            left: b.left + b.width / 2 - c / 2
        } : "left" == a ? {top: b.top + b.height / 2 - d / 2, left: b.left - c} : {
            top: b.top + b.height / 2 - d / 2,
            left: b.left + b.width
        }
    }, c.prototype.getViewportAdjustedDelta = function (a, b, c, d) {
        var e = {top: 0, left: 0};
        if (!this.$viewport)return e;
        var f = this.options.viewport && this.options.viewport.padding || 0, g = this.getPosition(this.$viewport);
        if (/right|left/.test(a)) {
            var h = b.top - f - g.scroll, i = b.top + f - g.scroll + d;
            h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i)
        } else {
            var j = b.left - f, k = b.left + f + c;
            j < g.left ? e.left = g.left - j : k > g.width && (e.left = g.left + g.width - k)
        }
        return e
    }, c.prototype.getTitle = function () {
        var a, b = this.$element, c = this.options;
        return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title)
    }, c.prototype.getUID = function (a) {
        do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
        return a
    }, c.prototype.tip = function () {
        return this.$tip = this.$tip || a(this.options.template)
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, c.prototype.enable = function () {
        this.enabled = !0
    }, c.prototype.disable = function () {
        this.enabled = !1
    }, c.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled
    }, c.prototype.toggle = function (b) {
        var c = this;
        b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
    }, c.prototype.destroy = function () {
        var a = this;
        clearTimeout(this.timeout), this.hide(function () {
            a.$element.off("." + a.type).removeData("bs." + a.type)
        })
    };
    var d = a.fn.tooltip;
    a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function () {
        return a.fn.tooltip = d, this
    }
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.popover"), f = "object" == typeof b && b, g = f && f.selector;
            (e || "destroy" != b) && (g ? (e || d.data("bs.popover", e = {}), e[g] || (e[g] = new c(this, f))) : e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }

    var c = function (a, b) {
        this.init("popover", a, b)
    };
    if (!a.fn.tooltip)throw new Error("Popover requires tooltip.js");
    c.VERSION = "3.3.1", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function () {
        return c.DEFAULTS
    }, c.prototype.setContent = function () {
        var a = this.tip(), b = this.getTitle(), c = this.getContent();
        a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide()
    }, c.prototype.hasContent = function () {
        return this.getTitle() || this.getContent()
    }, c.prototype.getContent = function () {
        var a = this.$element, b = this.options;
        return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    }, c.prototype.tip = function () {
        return this.$tip || (this.$tip = a(this.options.template)), this.$tip
    };
    var d = a.fn.popover;
    a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function () {
        return a.fn.popover = d, this
    }
}(jQuery), +function (a) {
    "use strict";
    function b(c, d) {
        var e = a.proxy(this.process, this);
        this.$body = a("body"), this.$scrollElement = a(a(c).is("body") ? window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", e), this.refresh(), this.process()
    }

    function c(c) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.scrollspy"), f = "object" == typeof c && c;
            e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }

    b.VERSION = "3.3.1", b.DEFAULTS = {offset: 10}, b.prototype.getScrollHeight = function () {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, b.prototype.refresh = function () {
        var b = "offset", c = 0;
        a.isWindow(this.$scrollElement[0]) || (b = "position", c = this.$scrollElement.scrollTop()), this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight();
        var d = this;
        this.$body.find(this.selector).map(function () {
            var d = a(this), e = d.data("target") || d.attr("href"), f = /^#./.test(e) && a(e);
            return f && f.length && f.is(":visible") && [[f[b]().top + c, e]] || null
        }).sort(function (a, b) {
            return a[0] - b[0]
        }).each(function () {
            d.offsets.push(this[0]), d.targets.push(this[1])
        })
    }, b.prototype.process = function () {
        var a, b = this.$scrollElement.scrollTop() + this.options.offset, c = this.getScrollHeight(), d = this.options.offset + c - this.$scrollElement.height(), e = this.offsets, f = this.targets, g = this.activeTarget;
        if (this.scrollHeight != c && this.refresh(), b >= d)return g != (a = f[f.length - 1]) && this.activate(a);
        if (g && b < e[0])return this.activeTarget = null, this.clear();
        for (a = e.length; a--;)g != f[a] && b >= e[a] && (!e[a + 1] || b <= e[a + 1]) && this.activate(f[a])
    }, b.prototype.activate = function (b) {
        this.activeTarget = b, this.clear();
        var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]', d = a(c).parents("li").addClass("active");
        d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy")
    }, b.prototype.clear = function () {
        a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var d = a.fn.scrollspy;
    a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
        return a.fn.scrollspy = d, this
    }, a(window).on("load.bs.scrollspy.data-api", function () {
        a('[data-spy="scroll"]').each(function () {
            var b = a(this);
            c.call(b, b.data())
        })
    })
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.tab");
            e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]()
        })
    }

    var c = function (b) {
        this.element = a(b)
    };
    c.VERSION = "3.3.1", c.TRANSITION_DURATION = 150, c.prototype.show = function () {
        var b = this.element, c = b.closest("ul:not(.dropdown-menu)"), d = b.data("target");
        if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
            var e = c.find(".active:last a"), f = a.Event("hide.bs.tab", {relatedTarget: b[0]}), g = a.Event("show.bs.tab", {relatedTarget: e[0]});
            if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
                var h = a(d);
                this.activate(b.closest("li"), c), this.activate(h, h.parent(), function () {
                    e.trigger({type: "hidden.bs.tab", relatedTarget: b[0]}), b.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: e[0]
                    })
                })
            }
        }
    }, c.prototype.activate = function (b, d, e) {
        function f() {
            g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu") && b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), e && e()
        }

        var g = d.find("> .active"), h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find("> .fade").length);
        g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) : f(), g.removeClass("in")
    };
    var d = a.fn.tab;
    a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function () {
        return a.fn.tab = d, this
    };
    var e = function (c) {
        c.preventDefault(), b.call(a(this), "show")
    };
    a(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', e).on("click.bs.tab.data-api", '[data-toggle="pill"]', e)
}(jQuery), +function (a) {
    "use strict";
    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.affix"), f = "object" == typeof b && b;
            e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]()
        })
    }

    var c = function (b, d) {
        this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(b), this.affixed = this.unpin = this.pinnedOffset = null, this.checkPosition()
    };
    c.VERSION = "3.3.1", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = {
        offset: 0,
        target: window
    }, c.prototype.getState = function (a, b, c, d) {
        var e = this.$target.scrollTop(), f = this.$element.offset(), g = this.$target.height();
        if (null != c && "top" == this.affixed)return c > e ? "top" : !1;
        if ("bottom" == this.affixed)return null != c ? e + this.unpin <= f.top ? !1 : "bottom" : a - d >= e + g ? !1 : "bottom";
        var h = null == this.affixed, i = h ? e : f.top, j = h ? g : b;
        return null != c && c >= i ? "top" : null != d && i + j >= a - d ? "bottom" : !1
    }, c.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset)return this.pinnedOffset;
        this.$element.removeClass(c.RESET).addClass("affix");
        var a = this.$target.scrollTop(), b = this.$element.offset();
        return this.pinnedOffset = b.top - a
    }, c.prototype.checkPositionWithEventLoop = function () {
        setTimeout(a.proxy(this.checkPosition, this), 1)
    }, c.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
            var b = this.$element.height(), d = this.options.offset, e = d.top, f = d.bottom, g = a("body").height();
            "object" != typeof d && (f = e = d), "function" == typeof e && (e = d.top(this.$element)), "function" == typeof f && (f = d.bottom(this.$element));
            var h = this.getState(g, b, e, f);
            if (this.affixed != h) {
                null != this.unpin && this.$element.css("top", "");
                var i = "affix" + (h ? "-" + h : ""), j = a.Event(i + ".bs.affix");
                if (this.$element.trigger(j), j.isDefaultPrevented())return;
                this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix", "affixed") + ".bs.affix")
            }
            "bottom" == h && this.$element.offset({top: g - b - f})
        }
    };
    var d = a.fn.affix;
    a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function () {
        return a.fn.affix = d, this
    }, a(window).on("load", function () {
        a('[data-spy="affix"]').each(function () {
            var c = a(this), d = c.data();
            d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom = d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop), b.call(c, d)
        })
    })
}(jQuery);
/*! echo.js v1.6.0 | (c) 2014 @toddmotto | https://github.com/toddmotto/echo */
!function (t, e) {
    "function" == typeof define && define.amd ? define(function () {
        return e(t)
    }) : "object" == typeof exports ? module.exports = e : t.echo = e(t)
}(this, function (t) {
    "use strict";
    var e, n, o, r, c, i = {}, l = function () {
    }, a = function (t, e) {
        var n = t.getBoundingClientRect();
        return n.right >= e.l && n.bottom >= e.t && n.left <= e.r && n.top <= e.b
    }, d = function () {
        (r || !n) && (clearTimeout(n), n = setTimeout(function () {
            i.render(), n = null
        }, o))
    };
    return i.init = function (n) {
        n = n || {};
        var a = n.offset || 0, u = n.offsetVertical || a, f = n.offsetHorizontal || a, s = function (t, e) {
            return parseInt(t || e, 10)
        };
        e = {
            t: s(n.offsetTop, u),
            b: s(n.offsetBottom, u),
            l: s(n.offsetLeft, f),
            r: s(n.offsetRight, f)
        }, o = s(n.throttle, 250), r = n.debounce !== !1, c = !!n.unload, l = n.callback || l, i.render(), document.addEventListener ? (t.addEventListener("scroll", d, !1), t.addEventListener("load", d, !1)) : (t.attachEvent("onscroll", d), t.attachEvent("onload", d))
    }, i.render = function () {
        for (var n, o, r = document.querySelectorAll("img[data-echo]"), d = r.length, u = {
            l: 0 - e.l,
            t: 0 - e.t,
            b: (t.innerHeight || document.documentElement.clientHeight) + e.b,
            r: (t.innerWidth || document.documentElement.clientWidth) + e.r
        }, f = 0; d > f; f++)o = r[f], a(o, u) ? (c && o.setAttribute("data-echo-placeholder", o.src), o.src = o.getAttribute("data-echo"), c || o.removeAttribute("data-echo"), l(o, "load")) : c && (n = o.getAttribute("data-echo-placeholder")) && (o.src = n, o.removeAttribute("data-echo-placeholder"), l(o, "unload"));
        d || i.detach()
    }, i.detach = function () {
        document.removeEventListener ? t.removeEventListener("scroll", d) : t.detachEvent("onscroll", d), clearTimeout(n)
    }, i
});
/*
 *	jQuery elevateZoom 3.0.8
 *	Demo's and documentation:
 *	www.elevateweb.co.uk/image-zoom
 *
 *	Copyright (c) 2012 Andrew Eades
 *	www.elevateweb.co.uk
 *
 *	Dual licensed under the GPL and MIT licenses.
 *	http://en.wikipedia.org/wiki/MIT_License
 *	http://en.wikipedia.org/wiki/GNU_General_Public_License
 *

 /*
 *	jQuery elevateZoom 3.0.3
 *	Demo's and documentation:
 *	www.elevateweb.co.uk/image-zoom
 *
 *	Copyright (c) 2012 Andrew Eades
 *	www.elevateweb.co.uk
 *
 *	Dual licensed under the GPL and MIT licenses.
 *	http://en.wikipedia.org/wiki/MIT_License
 *	http://en.wikipedia.org/wiki/GNU_General_Public_License
 */


if (typeof Object.create !== 'function') {
    Object.create = function (obj) {
        function F() {
        };
        F.prototype = obj;
        return new F();
    };
}

(function ($, window, document, undefined) {
    var ElevateZoom = {
        init: function (options, elem) {
            var self = this;

            self.elem = elem;
            self.$elem = $(elem);

            self.imageSrc = self.$elem.data("zoom-image") ? self.$elem.data("zoom-image") : self.$elem.attr("src");

            self.options = $.extend({}, $.fn.elevateZoom.options, options);

            //TINT OVERRIDE SETTINGS
            if (self.options.tint) {
                self.options.lensColour = "none", //colour of the lens background
                    self.options.lensOpacity = "1" //opacity of the lens
            }
            //INNER OVERRIDE SETTINGS
            if (self.options.zoomType == "inner") {
                self.options.showLens = false;
            }


            //Remove alt on hover

            self.$elem.parent().removeAttr('title').removeAttr('alt');

            self.zoomImage = self.imageSrc;

            self.refresh(1);


            //Create the image swap from the gallery
            $('#' + self.options.gallery + ' a').click(function (e) {

                //Set a class on the currently active gallery image
                if (self.options.galleryActiveClass) {
                    $('#' + self.options.gallery + ' a').removeClass(self.options.galleryActiveClass);
                    $(this).addClass(self.options.galleryActiveClass);
                }
                //stop any link on the a tag from working
                e.preventDefault();

                //call the swap image function
                if ($(this).data("zoom-image")) {
                    self.zoomImagePre = $(this).data("zoom-image")
                }
                else {
                    self.zoomImagePre = $(this).data("image");
                }
                self.swaptheimage($(this).data("image"), self.zoomImagePre);
                return false;
            });

        },

        refresh: function (length) {
            var self = this;

            setTimeout(function () {
                self.fetch(self.imageSrc);

            }, length || self.options.refresh);
        },

        fetch: function (imgsrc) {
            //get the image
            var self = this;
            var newImg = new Image();
            newImg.onload = function () {
                //set the large image dimensions - used to calculte ratio's
                self.largeWidth = newImg.width;
                self.largeHeight = newImg.height;
                //once image is loaded start the calls
                self.startZoom();
                self.currentImage = self.imageSrc;
                //let caller know image has been loaded
                self.options.onZoomedImageLoaded(self.$elem);
            }
            newImg.src = imgsrc; // this must be done AFTER setting onload

            return;

        },

        startZoom: function () {
            var self = this;
            //get dimensions of the non zoomed image
            self.nzWidth = self.$elem.width();
            self.nzHeight = self.$elem.height();

            //activated elements
            self.isWindowActive = false;
            self.isLensActive = false;
            self.isTintActive = false;
            self.overWindow = false;

            //CrossFade Wrappe
            if (self.options.imageCrossfade) {
                self.zoomWrap = self.$elem.wrap('<div style="height:' + self.nzHeight + 'px;width:' + self.nzWidth + 'px;" class="zoomWrapper" />');
                self.$elem.css('position', 'absolute');
            }

            self.zoomLock = 1;
            self.scrollingLock = false;
            self.changeBgSize = false;
            self.currentZoomLevel = self.options.zoomLevel;


            //get offset of the non zoomed image
            self.nzOffset = self.$elem.offset();
            //calculate the width ratio of the large/small image
            self.widthRatio = (self.largeWidth / self.currentZoomLevel) / self.nzWidth;
            self.heightRatio = (self.largeHeight / self.currentZoomLevel) / self.nzHeight;


            //if window zoom
            if (self.options.zoomType == "window") {
                self.zoomWindowStyle = "overflow: hidden;"
                + "background-position: 0px 0px;text-align:center;"
                + "background-color: " + String(self.options.zoomWindowBgColour)
                + ";width: " + String(self.options.zoomWindowWidth) + "px;"
                + "height: " + String(self.options.zoomWindowHeight)
                + "px;float: left;"
                + "background-size: " + self.largeWidth / self.currentZoomLevel + "px " + self.largeHeight / self.currentZoomLevel + "px;"
                + "display: none;z-index:100;"
                + "border: " + String(self.options.borderSize)
                + "px solid " + self.options.borderColour
                + ";background-repeat: no-repeat;"
                + "position: absolute;";
            }


            //if inner  zoom
            if (self.options.zoomType == "inner") {
                //has a border been put on the image? Lets cater for this

                var borderWidth = self.$elem.css("border-left-width");

                self.zoomWindowStyle = "overflow: hidden;"
                + "margin-left: " + String(borderWidth) + ";"
                + "margin-top: " + String(borderWidth) + ";"
                + "background-position: 0px 0px;"
                + "width: " + String(self.nzWidth) + "px;"
                + "height: " + String(self.nzHeight)
                + "px;float: left;"
                + "display: none;"
                + "cursor:" + (self.options.cursor) + ";"
                + "px solid " + self.options.borderColour
                + ";background-repeat: no-repeat;"
                + "position: absolute;";
            }


            //lens style for window zoom
            if (self.options.zoomType == "window") {


                // adjust images less than the window height

                if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                    lensHeight = self.nzHeight;
                }
                else {
                    lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                }
                if (self.largeWidth < self.options.zoomWindowWidth) {
                    lensWidth = self.nzWidth;
                }
                else {
                    lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                }


                self.lensStyle = "background-position: 0px 0px;width: " + String((self.options.zoomWindowWidth) / self.widthRatio) + "px;height: " + String((self.options.zoomWindowHeight) / self.heightRatio)
                + "px;float: right;display: none;"
                + "overflow: hidden;"
                + "z-index: 999;"
                + "-webkit-transform: translateZ(0);"
                + "opacity:" + (self.options.lensOpacity) + ";filter: alpha(opacity = " + (self.options.lensOpacity * 100) + "); zoom:1;"
                + "width:" + lensWidth + "px;"
                + "height:" + lensHeight + "px;"
                + "background-color:" + (self.options.lensColour) + ";"
                + "cursor:" + (self.options.cursor) + ";"
                + "border: " + (self.options.lensBorderSize) + "px" +
                " solid " + (self.options.lensBorderColour) + ";background-repeat: no-repeat;position: absolute;";
            }


            //tint style
            self.tintStyle = "display: block;"
            + "position: absolute;"
            + "background-color: " + self.options.tintColour + ";"
            + "filter:alpha(opacity=0);"
            + "opacity: 0;"
            + "width: " + self.nzWidth + "px;"
            + "height: " + self.nzHeight + "px;"

            ;

            //lens style for lens zoom with optional round for modern browsers
            self.lensRound = '';

            if (self.options.zoomType == "lens") {

                self.lensStyle = "background-position: 0px 0px;"
                + "float: left;display: none;"
                + "border: " + String(self.options.borderSize) + "px solid " + self.options.borderColour + ";"
                + "width:" + String(self.options.lensSize) + "px;"
                + "height:" + String(self.options.lensSize) + "px;"
                + "background-repeat: no-repeat;position: absolute;";


            }


            //does not round in all browsers
            if (self.options.lensShape == "round") {
                self.lensRound = "border-top-left-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;"
                + "border-top-right-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;"
                + "border-bottom-left-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;"
                + "border-bottom-right-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;";

            }

            //create the div's                                                + ""
            //self.zoomContainer = $('<div/>').addClass('zoomContainer').css({"position":"relative", "height":self.nzHeight, "width":self.nzWidth});

            self.zoomContainer = $('<div class="zoomContainer" style="-webkit-transform: translateZ(0);position:absolute;left:' + self.nzOffset.left + 'px;top:' + self.nzOffset.top + 'px;height:' + self.nzHeight + 'px;width:' + self.nzWidth + 'px;"></div>');
            $('body').append(self.zoomContainer);


            //this will add overflow hidden and contrain the lens on lens mode
            if (self.options.containLensZoom && self.options.zoomType == "lens") {
                self.zoomContainer.css("overflow", "hidden");
            }
            if (self.options.zoomType != "inner") {
                self.zoomLens = $("<div class='zoomLens' style='" + self.lensStyle + self.lensRound + "'>&nbsp;</div>")
                    .appendTo(self.zoomContainer)
                    .click(function () {
                        self.$elem.trigger('click');
                    });


                if (self.options.tint) {
                    self.tintContainer = $('<div/>').addClass('tintContainer');
                    self.zoomTint = $("<div class='zoomTint' style='" + self.tintStyle + "'></div>");


                    self.zoomLens.wrap(self.tintContainer);


                    self.zoomTintcss = self.zoomLens.after(self.zoomTint);

                    //if tint enabled - set an image to show over the tint

                    self.zoomTintImage = $('<img style="position: absolute; left: 0px; top: 0px; max-width: none; width: ' + self.nzWidth + 'px; height: ' + self.nzHeight + 'px;" src="' + self.imageSrc + '">')
                        .appendTo(self.zoomLens)
                        .click(function () {

                            self.$elem.trigger('click');
                        });

                }

            }


            //create zoom window
            if (isNaN(self.options.zoomWindowPosition)) {
                self.zoomWindow = $("<div style='z-index:999;left:" + (self.windowOffsetLeft) + "px;top:" + (self.windowOffsetTop) + "px;" + self.zoomWindowStyle + "' class='zoomWindow'>&nbsp;</div>")
                    .appendTo('body')
                    .click(function () {
                        self.$elem.trigger('click');
                    });
            } else {
                self.zoomWindow = $("<div style='z-index:999;left:" + (self.windowOffsetLeft) + "px;top:" + (self.windowOffsetTop) + "px;" + self.zoomWindowStyle + "' class='zoomWindow'>&nbsp;</div>")
                    .appendTo(self.zoomContainer)
                    .click(function () {
                        self.$elem.trigger('click');
                    });
            }
            self.zoomWindowContainer = $('<div/>').addClass('zoomWindowContainer').css("width", self.options.zoomWindowWidth);
            self.zoomWindow.wrap(self.zoomWindowContainer);


            //  self.captionStyle = "text-align: left;background-color: black;color: white;font-weight: bold;padding: 10px;font-family: sans-serif;font-size: 11px";
            // self.zoomCaption = $('<div class="elevatezoom-caption" style="'+self.captionStyle+'display: block; width: 280px;">INSERT ALT TAG</div>').appendTo(self.zoomWindow.parent());

            if (self.options.zoomType == "lens") {
                self.zoomLens.css({backgroundImage: "url('" + self.imageSrc + "')"});
            }
            if (self.options.zoomType == "window") {
                self.zoomWindow.css({backgroundImage: "url('" + self.imageSrc + "')"});
            }
            if (self.options.zoomType == "inner") {
                self.zoomWindow.css({backgroundImage: "url('" + self.imageSrc + "')"});
            }
            /*-------------------END THE ZOOM WINDOW AND LENS----------------------------------*/
            //touch events
            self.$elem.bind('touchmove', function (e) {
                e.preventDefault();
                var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                self.setPosition(touch);

            });
            self.zoomContainer.bind('touchmove', function (e) {
                if (self.options.zoomType == "inner") {
                    self.showHideWindow("show");

                }
                e.preventDefault();
                var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                self.setPosition(touch);

            });
            self.zoomContainer.bind('touchend', function (e) {
                self.showHideWindow("hide");
                if (self.options.showLens) {
                    self.showHideLens("hide");
                }
                if (self.options.tint && self.options.zoomType != "inner") {
                    self.showHideTint("hide");
                }
            });

            self.$elem.bind('touchend', function (e) {
                self.showHideWindow("hide");
                if (self.options.showLens) {
                    self.showHideLens("hide");
                }
                if (self.options.tint && self.options.zoomType != "inner") {
                    self.showHideTint("hide");
                }
            });
            if (self.options.showLens) {
                self.zoomLens.bind('touchmove', function (e) {

                    e.preventDefault();
                    var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                    self.setPosition(touch);
                });


                self.zoomLens.bind('touchend', function (e) {
                    self.showHideWindow("hide");
                    if (self.options.showLens) {
                        self.showHideLens("hide");
                    }
                    if (self.options.tint && self.options.zoomType != "inner") {
                        self.showHideTint("hide");
                    }
                });
            }
            //Needed to work in IE
            self.$elem.bind('mousemove', function (e) {
                if (self.overWindow == false) {
                    self.setElements("show");
                }
                //make sure on orientation change the setposition is not fired
                if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                    self.setPosition(e);
                    self.currentLoc = e;
                }
                self.lastX = e.clientX;
                self.lastY = e.clientY;

            });

            self.zoomContainer.bind('mousemove', function (e) {

                if (self.overWindow == false) {
                    self.setElements("show");
                }

                //make sure on orientation change the setposition is not fired
                if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                    self.setPosition(e);
                    self.currentLoc = e;
                }
                self.lastX = e.clientX;
                self.lastY = e.clientY;
            });
            if (self.options.zoomType != "inner") {
                self.zoomLens.bind('mousemove', function (e) {
                    //make sure on orientation change the setposition is not fired
                    if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                        self.setPosition(e);
                        self.currentLoc = e;
                    }
                    self.lastX = e.clientX;
                    self.lastY = e.clientY;
                });
            }
            if (self.options.tint && self.options.zoomType != "inner") {
                self.zoomTint.bind('mousemove', function (e) {
                    //make sure on orientation change the setposition is not fired
                    if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                        self.setPosition(e);
                        self.currentLoc = e;
                    }
                    self.lastX = e.clientX;
                    self.lastY = e.clientY;
                });

            }
            if (self.options.zoomType == "inner") {
                self.zoomWindow.bind('mousemove', function (e) {
                    //self.overWindow = true;
                    //make sure on orientation change the setposition is not fired
                    if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                        self.setPosition(e);
                        self.currentLoc = e;
                    }
                    self.lastX = e.clientX;
                    self.lastY = e.clientY;
                });

            }


            //  lensFadeOut: 500,  zoomTintFadeIn
            self.zoomContainer.add(self.$elem).mouseenter(function () {

                if (self.overWindow == false) {
                    self.setElements("show");
                }


            }).mouseleave(function () {
                if (!self.scrollLock) {
                    self.setElements("hide");
                }
            });
            //end ove image


            if (self.options.zoomType != "inner") {
                self.zoomWindow.mouseenter(function () {
                    self.overWindow = true;
                    self.setElements("hide");
                }).mouseleave(function () {

                    self.overWindow = false;
                });
            }
            //end ove image


//				var delta = parseInt(e.originalEvent.wheelDelta || -e.originalEvent.detail);

            //      $(this).empty();
            //    return false;

            //fix for initial zoom setting
            if (self.options.zoomLevel != 1) {
                //	self.changeZoomLevel(self.currentZoomLevel);
            }
            //set the min zoomlevel
            if (self.options.minZoomLevel) {
                self.minZoomLevel = self.options.minZoomLevel;
            }
            else {
                self.minZoomLevel = self.options.scrollZoomIncrement * 2;
            }


            if (self.options.scrollZoom) {


                self.zoomContainer.add(self.$elem).bind('mousewheel DOMMouseScroll MozMousePixelScroll', function (e) {


//						in IE there is issue with firing of mouseleave - So check whether still scrolling
//						and on mouseleave check if scrolllock          
                    self.scrollLock = true;
                    clearTimeout($.data(this, 'timer'));
                    $.data(this, 'timer', setTimeout(function () {
                        self.scrollLock = false;
                        //do something
                    }, 250));

                    var theEvent = e.originalEvent.wheelDelta || e.originalEvent.detail * -1


                    //this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                    //   e.preventDefault();


                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();


                    if (theEvent / 120 > 0) {
                        //scrolling up
                        if (self.currentZoomLevel >= self.minZoomLevel) {
                            self.changeZoomLevel(self.currentZoomLevel - self.options.scrollZoomIncrement);
                        }

                    }
                    else {
                        //scrolling down


                        if (self.options.maxZoomLevel) {
                            if (self.currentZoomLevel <= self.options.maxZoomLevel) {
                                self.changeZoomLevel(parseFloat(self.currentZoomLevel) + self.options.scrollZoomIncrement);
                            }
                        }
                        else {
                            //andy

                            self.changeZoomLevel(parseFloat(self.currentZoomLevel) + self.options.scrollZoomIncrement);
                        }

                    }
                    return false;
                });
            }


        },
        setElements: function (type) {
            var self = this;
            if (!self.options.zoomEnabled) {
                return false;
            }
            if (type == "show") {
                if (self.isWindowSet) {
                    if (self.options.zoomType == "inner") {
                        self.showHideWindow("show");
                    }
                    if (self.options.zoomType == "window") {
                        self.showHideWindow("show");
                    }
                    if (self.options.showLens) {
                        self.showHideLens("show");
                    }
                    if (self.options.tint && self.options.zoomType != "inner") {
                        self.showHideTint("show");
                    }
                }
            }

            if (type == "hide") {
                if (self.options.zoomType == "window") {
                    self.showHideWindow("hide");
                }
                if (!self.options.tint) {
                    self.showHideWindow("hide");
                }
                if (self.options.showLens) {
                    self.showHideLens("hide");
                }
                if (self.options.tint) {
                    self.showHideTint("hide");
                }
            }
        },
        setPosition: function (e) {

            var self = this;

            if (!self.options.zoomEnabled) {
                return false;
            }

            //recaclc offset each time in case the image moves
            //this can be caused by other on page elements
            self.nzHeight = self.$elem.height();
            self.nzWidth = self.$elem.width();
            self.nzOffset = self.$elem.offset();

            if (self.options.tint && self.options.zoomType != "inner") {
                self.zoomTint.css({top: 0});
                self.zoomTint.css({left: 0});
            }
            //set responsive
            //will checking if the image needs changing before running this code work faster?
            if (self.options.responsive && !self.options.scrollZoom) {
                if (self.options.showLens) {
                    if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                        lensHeight = self.nzHeight;
                    }
                    else {
                        lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                    }
                    if (self.largeWidth < self.options.zoomWindowWidth) {
                        lensWidth = self.nzWidth;
                    }
                    else {
                        lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                    }
                    self.widthRatio = self.largeWidth / self.nzWidth;
                    self.heightRatio = self.largeHeight / self.nzHeight;
                    if (self.options.zoomType != "lens") {


                        //possibly dont need to keep recalcalculating
                        //if the lens is heigher than the image, then set lens size to image size
                        if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                            lensHeight = self.nzHeight;

                        }
                        else {
                            lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                        }

                        if (self.options.zoomWindowWidth < self.options.zoomWindowWidth) {
                            lensWidth = self.nzWidth;
                        }
                        else {
                            lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                        }

                        self.zoomLens.css('width', lensWidth);
                        self.zoomLens.css('height', lensHeight);

                        if (self.options.tint) {
                            self.zoomTintImage.css('width', self.nzWidth);
                            self.zoomTintImage.css('height', self.nzHeight);
                        }

                    }
                    if (self.options.zoomType == "lens") {

                        self.zoomLens.css({
                            width: String(self.options.lensSize) + 'px',
                            height: String(self.options.lensSize) + 'px'
                        })


                    }
                    //end responsive image change
                }
            }

            //container fix
            self.zoomContainer.css({top: self.nzOffset.top});
            self.zoomContainer.css({left: self.nzOffset.left});
            self.mouseLeft = parseInt(e.pageX - self.nzOffset.left);
            self.mouseTop = parseInt(e.pageY - self.nzOffset.top);
            //calculate the Location of the Lens

            //calculate the bound regions - but only if zoom window
            if (self.options.zoomType == "window") {
                self.Etoppos = (self.mouseTop < (self.zoomLens.height() / 2));
                self.Eboppos = (self.mouseTop > self.nzHeight - (self.zoomLens.height() / 2) - (self.options.lensBorderSize * 2));
                self.Eloppos = (self.mouseLeft < 0 + ((self.zoomLens.width() / 2)));
                self.Eroppos = (self.mouseLeft > (self.nzWidth - (self.zoomLens.width() / 2) - (self.options.lensBorderSize * 2)));
            }
            //calculate the bound regions - but only for inner zoom
            if (self.options.zoomType == "inner") {
                self.Etoppos = (self.mouseTop < ((self.nzHeight / 2) / self.heightRatio) );
                self.Eboppos = (self.mouseTop > (self.nzHeight - ((self.nzHeight / 2) / self.heightRatio)));
                self.Eloppos = (self.mouseLeft < 0 + (((self.nzWidth / 2) / self.widthRatio)));
                self.Eroppos = (self.mouseLeft > (self.nzWidth - (self.nzWidth / 2) / self.widthRatio - (self.options.lensBorderSize * 2)));
            }

            // if the mouse position of the slider is one of the outerbounds, then hide  window and lens
            if (self.mouseLeft <= 0 || self.mouseTop < 0 || self.mouseLeft > self.nzWidth || self.mouseTop > self.nzHeight) {
                self.setElements("hide");
                return;
            }
            //else continue with operations
            else {


                //lens options
                if (self.options.showLens) {
                    //		self.showHideLens("show");
                    //set background position of lens
                    self.lensLeftPos = String(self.mouseLeft - self.zoomLens.width() / 2);
                    self.lensTopPos = String(self.mouseTop - self.zoomLens.height() / 2);


                }
                //adjust the background position if the mouse is in one of the outer regions

                //Top region
                if (self.Etoppos) {
                    self.lensTopPos = 0;
                }
                //Left Region
                if (self.Eloppos) {
                    self.windowLeftPos = 0;
                    self.lensLeftPos = 0;
                    self.tintpos = 0;
                }
                //Set bottom and right region for window mode
                if (self.options.zoomType == "window") {
                    if (self.Eboppos) {
                        self.lensTopPos = Math.max((self.nzHeight) - self.zoomLens.height() - (self.options.lensBorderSize * 2), 0);
                    }
                    if (self.Eroppos) {
                        self.lensLeftPos = (self.nzWidth - (self.zoomLens.width()) - (self.options.lensBorderSize * 2));
                    }
                }
                //Set bottom and right region for inner mode
                if (self.options.zoomType == "inner") {
                    if (self.Eboppos) {
                        self.lensTopPos = Math.max(((self.nzHeight) - (self.options.lensBorderSize * 2)), 0);
                    }
                    if (self.Eroppos) {
                        self.lensLeftPos = (self.nzWidth - (self.nzWidth) - (self.options.lensBorderSize * 2));
                    }

                }
                //if lens zoom
                if (self.options.zoomType == "lens") {
                    self.windowLeftPos = String(((e.pageX - self.nzOffset.left) * self.widthRatio - self.zoomLens.width() / 2) * (-1));
                    self.windowTopPos = String(((e.pageY - self.nzOffset.top) * self.heightRatio - self.zoomLens.height() / 2) * (-1));

                    self.zoomLens.css({backgroundPosition: self.windowLeftPos + 'px ' + self.windowTopPos + 'px'});

                    if (self.changeBgSize) {

                        if (self.nzHeight > self.nzWidth) {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                            }

                            self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                        }
                        else {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                            }
                            self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                        }
                        self.changeBgSize = false;
                    }

                    self.setWindowPostition(e);
                }
                //if tint zoom
                if (self.options.tint && self.options.zoomType != "inner") {
                    self.setTintPosition(e);

                }
                //set the css background position
                if (self.options.zoomType == "window") {
                    self.setWindowPostition(e);
                }
                if (self.options.zoomType == "inner") {
                    self.setWindowPostition(e);
                }
                if (self.options.showLens) {

                    if (self.fullwidth && self.options.zoomType != "lens") {
                        self.lensLeftPos = 0;

                    }
                    self.zoomLens.css({left: self.lensLeftPos + 'px', top: self.lensTopPos + 'px'})
                }

            } //end else


        },
        showHideWindow: function (change) {
            var self = this;
            if (change == "show") {
                if (!self.isWindowActive) {
                    if (self.options.zoomWindowFadeIn) {
                        self.zoomWindow.stop(true, true, false).fadeIn(self.options.zoomWindowFadeIn);
                    }
                    else {
                        self.zoomWindow.show();
                    }
                    self.isWindowActive = true;
                }
            }
            if (change == "hide") {
                if (self.isWindowActive) {
                    if (self.options.zoomWindowFadeOut) {
                        self.zoomWindow.stop(true, true).fadeOut(self.options.zoomWindowFadeOut);
                    }
                    else {
                        self.zoomWindow.hide();
                    }
                    self.isWindowActive = false;
                }
            }
        },
        showHideLens: function (change) {
            var self = this;
            if (change == "show") {
                if (!self.isLensActive) {
                    if (self.options.lensFadeIn) {
                        self.zoomLens.stop(true, true, false).fadeIn(self.options.lensFadeIn);
                    }
                    else {
                        self.zoomLens.show();
                    }
                    self.isLensActive = true;
                }
            }
            if (change == "hide") {
                if (self.isLensActive) {
                    if (self.options.lensFadeOut) {
                        self.zoomLens.stop(true, true).fadeOut(self.options.lensFadeOut);
                    }
                    else {
                        self.zoomLens.hide();
                    }
                    self.isLensActive = false;
                }
            }
        },
        showHideTint: function (change) {
            var self = this;
            if (change == "show") {
                if (!self.isTintActive) {

                    if (self.options.zoomTintFadeIn) {
                        self.zoomTint.css({opacity: self.options.tintOpacity}).animate().stop(true, true).fadeIn("slow");
                    }
                    else {
                        self.zoomTint.css({opacity: self.options.tintOpacity}).animate();
                        self.zoomTint.show();


                    }
                    self.isTintActive = true;
                }
            }
            if (change == "hide") {
                if (self.isTintActive) {

                    if (self.options.zoomTintFadeOut) {
                        self.zoomTint.stop(true, true).fadeOut(self.options.zoomTintFadeOut);
                    }
                    else {
                        self.zoomTint.hide();
                    }
                    self.isTintActive = false;
                }
            }
        },
        setLensPostition: function (e) {


        },
        setWindowPostition: function (e) {
            //return obj.slice( 0, count );
            var self = this;

            if (!isNaN(self.options.zoomWindowPosition)) {

                switch (self.options.zoomWindowPosition) {
                    case 1: //done
                        self.windowOffsetTop = (self.options.zoomWindowOffety);//DONE - 1
                        self.windowOffsetLeft = (+self.nzWidth); //DONE 1, 2, 3, 4, 16
                        break;
                    case 2:
                        if (self.options.zoomWindowHeight > self.nzHeight) { //positive margin

                            self.windowOffsetTop = ((self.options.zoomWindowHeight / 2) - (self.nzHeight / 2)) * (-1);
                            self.windowOffsetLeft = (self.nzWidth); //DONE 1, 2, 3, 4, 16
                        }
                        else { //negative margin

                        }
                        break;
                    case 3: //done
                        self.windowOffsetTop = (self.nzHeight - self.zoomWindow.height() - (self.options.borderSize * 2)); //DONE 3,9
                        self.windowOffsetLeft = (self.nzWidth); //DONE 1, 2, 3, 4, 16
                        break;
                    case 4: //done
                        self.windowOffsetTop = (self.nzHeight); //DONE - 4,5,6,7,8
                        self.windowOffsetLeft = (self.nzWidth); //DONE 1, 2, 3, 4, 16
                        break;
                    case 5: //done
                        self.windowOffsetTop = (self.nzHeight); //DONE - 4,5,6,7,8
                        self.windowOffsetLeft = (self.nzWidth - self.zoomWindow.width() - (self.options.borderSize * 2)); //DONE - 5,15
                        break;
                    case 6:
                        if (self.options.zoomWindowHeight > self.nzHeight) { //positive margin
                            self.windowOffsetTop = (self.nzHeight);  //DONE - 4,5,6,7,8

                            self.windowOffsetLeft = ((self.options.zoomWindowWidth / 2) - (self.nzWidth / 2) + (self.options.borderSize * 2)) * (-1);
                        }
                        else { //negative margin

                        }


                        break;
                    case 7: //done
                        self.windowOffsetTop = (self.nzHeight);  //DONE - 4,5,6,7,8
                        self.windowOffsetLeft = 0; //DONE 7, 13
                        break;
                    case 8: //done
                        self.windowOffsetTop = (self.nzHeight); //DONE - 4,5,6,7,8
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2) ) * (-1);  //DONE 8,9,10,11,12
                        break;
                    case 9:  //done
                        self.windowOffsetTop = (self.nzHeight - self.zoomWindow.height() - (self.options.borderSize * 2)); //DONE 3,9
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2) ) * (-1);  //DONE 8,9,10,11,12
                        break;
                    case 10:
                        if (self.options.zoomWindowHeight > self.nzHeight) { //positive margin

                            self.windowOffsetTop = ((self.options.zoomWindowHeight / 2) - (self.nzHeight / 2)) * (-1);
                            self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2) ) * (-1);  //DONE 8,9,10,11,12
                        }
                        else { //negative margin

                        }
                        break;
                    case 11:
                        self.windowOffsetTop = (self.options.zoomWindowOffety);
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2) ) * (-1);  //DONE 8,9,10,11,12
                        break;
                    case 12: //done
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1); //DONE 12,13,14,15,16
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2) ) * (-1);  //DONE 8,9,10,11,12
                        break;
                    case 13: //done
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1); //DONE 12,13,14,15,16
                        self.windowOffsetLeft = (0); //DONE 7, 13
                        break;
                    case 14:
                        if (self.options.zoomWindowHeight > self.nzHeight) { //positive margin
                            self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1); //DONE 12,13,14,15,16

                            self.windowOffsetLeft = ((self.options.zoomWindowWidth / 2) - (self.nzWidth / 2) + (self.options.borderSize * 2)) * (-1);
                        }
                        else { //negative margin

                        }

                        break;
                    case 15://done
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1); //DONE 12,13,14,15,16
                        self.windowOffsetLeft = (self.nzWidth - self.zoomWindow.width() - (self.options.borderSize * 2)); //DONE - 5,15
                        break;
                    case 16:  //done
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1); //DONE 12,13,14,15,16
                        self.windowOffsetLeft = (self.nzWidth); //DONE 1, 2, 3, 4, 16
                        break;
                    default: //done
                        self.windowOffsetTop = (self.options.zoomWindowOffety);//DONE - 1
                        self.windowOffsetLeft = (self.nzWidth); //DONE 1, 2, 3, 4, 16
                }
            } //end isNAN
            else {
                //WE CAN POSITION IN A CLASS - ASSUME THAT ANY STRING PASSED IS
                self.externalContainer = $('#' + self.options.zoomWindowPosition);
                self.externalContainerWidth = self.externalContainer.width();
                self.externalContainerHeight = self.externalContainer.height();
                self.externalContainerOffset = self.externalContainer.offset();

                self.windowOffsetTop = self.externalContainerOffset.top;//DONE - 1
                self.windowOffsetLeft = self.externalContainerOffset.left; //DONE 1, 2, 3, 4, 16

            }
            self.isWindowSet = true;
            self.windowOffsetTop = self.windowOffsetTop + self.options.zoomWindowOffety;
            self.windowOffsetLeft = self.windowOffsetLeft + self.options.zoomWindowOffetx;

            self.zoomWindow.css({top: self.windowOffsetTop});
            self.zoomWindow.css({left: self.windowOffsetLeft});

            if (self.options.zoomType == "inner") {
                self.zoomWindow.css({top: 0});
                self.zoomWindow.css({left: 0});

            }


            self.windowLeftPos = String(((e.pageX - self.nzOffset.left) * self.widthRatio - self.zoomWindow.width() / 2) * (-1));
            self.windowTopPos = String(((e.pageY - self.nzOffset.top) * self.heightRatio - self.zoomWindow.height() / 2) * (-1));
            if (self.Etoppos) {
                self.windowTopPos = 0;
            }
            if (self.Eloppos) {
                self.windowLeftPos = 0;
            }
            if (self.Eboppos) {
                self.windowTopPos = (self.largeHeight / self.currentZoomLevel - self.zoomWindow.height()) * (-1);
            }
            if (self.Eroppos) {
                self.windowLeftPos = ((self.largeWidth / self.currentZoomLevel - self.zoomWindow.width()) * (-1));
            }

            //stops micro movements
            if (self.fullheight) {
                self.windowTopPos = 0;

            }
            if (self.fullwidth) {
                self.windowLeftPos = 0;

            }
            //set the css background position


            if (self.options.zoomType == "window" || self.options.zoomType == "inner") {

                if (self.zoomLock == 1) {
                    //overrides for images not zoomable
                    if (self.widthRatio <= 1) {

                        self.windowLeftPos = 0;
                    }
                    if (self.heightRatio <= 1) {
                        self.windowTopPos = 0;
                    }
                }
                // adjust images less than the window height

                if (self.largeHeight < self.options.zoomWindowHeight) {

                    self.windowTopPos = 0;
                }
                if (self.largeWidth < self.options.zoomWindowWidth) {
                    self.windowLeftPos = 0;
                }

                //set the zoomwindow background position
                if (self.options.easing) {

                    //     if(self.changeZoom){
                    //           clearInterval(self.loop);
                    //           self.changeZoom = false;
                    //           self.loop = false;

                    //            }
                    //set the pos to 0 if not set
                    if (!self.xp) {
                        self.xp = 0;
                    }
                    if (!self.yp) {
                        self.yp = 0;
                    }
                    //if loop not already started, then run it
                    if (!self.loop) {
                        self.loop = setInterval(function () {
                            //using zeno's paradox

                            self.xp += (self.windowLeftPos - self.xp) / self.options.easingAmount;
                            self.yp += (self.windowTopPos - self.yp) / self.options.easingAmount;
                            if (self.scrollingLock) {


                                clearInterval(self.loop);
                                self.xp = self.windowLeftPos;
                                self.yp = self.windowTopPos

                                self.xp = ((e.pageX - self.nzOffset.left) * self.widthRatio - self.zoomWindow.width() / 2) * (-1);
                                self.yp = (((e.pageY - self.nzOffset.top) * self.heightRatio - self.zoomWindow.height() / 2) * (-1));

                                if (self.changeBgSize) {
                                    if (self.nzHeight > self.nzWidth) {
                                        if (self.options.zoomType == "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                    }
                                    else {
                                        if (self.options.zoomType != "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});

                                    }

                                    /*
                                     if(!self.bgxp){self.bgxp = self.largeWidth/self.newvalue;}
                                     if(!self.bgyp){self.bgyp = self.largeHeight/self.newvalue ;}
                                     if (!self.bgloop){
                                     self.bgloop = setInterval(function(){

                                     self.bgxp += (self.largeWidth/self.newvalue  - self.bgxp) / self.options.easingAmount;
                                     self.bgyp += (self.largeHeight/self.newvalue  - self.bgyp) / self.options.easingAmount;

                                     self.zoomWindow.css({ "background-size": self.bgxp + 'px ' + self.bgyp + 'px' });


                                     }, 16);

                                     }
                                     */
                                    self.changeBgSize = false;
                                }

                                self.zoomWindow.css({backgroundPosition: self.windowLeftPos + 'px ' + self.windowTopPos + 'px'});
                                self.scrollingLock = false;
                                self.loop = false;

                            }
                            else {
                                if (self.changeBgSize) {
                                    if (self.nzHeight > self.nzWidth) {
                                        if (self.options.zoomType == "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                    }
                                    else {
                                        if (self.options.zoomType != "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                                    }
                                    self.changeBgSize = false;
                                }

                                self.zoomWindow.css({backgroundPosition: self.xp + 'px ' + self.yp + 'px'});
                            }
                        }, 16);
                    }
                }
                else {
                    if (self.changeBgSize) {
                        if (self.nzHeight > self.nzWidth) {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                            }

                            self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                        }
                        else {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                            }
                            if ((self.largeHeight / self.newvaluewidth) < self.options.zoomWindowHeight) {

                                self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                            }
                            else {

                                self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                            }

                        }
                        self.changeBgSize = false;
                    }

                    self.zoomWindow.css({backgroundPosition: self.windowLeftPos + 'px ' + self.windowTopPos + 'px'});
                }
            }
        },
        setTintPosition: function (e) {
            var self = this;
            self.nzOffset = self.$elem.offset();
            self.tintpos = String(((e.pageX - self.nzOffset.left) - (self.zoomLens.width() / 2)) * (-1));
            self.tintposy = String(((e.pageY - self.nzOffset.top) - self.zoomLens.height() / 2) * (-1));
            if (self.Etoppos) {
                self.tintposy = 0;
            }
            if (self.Eloppos) {
                self.tintpos = 0;
            }
            if (self.Eboppos) {
                self.tintposy = (self.nzHeight - self.zoomLens.height() - (self.options.lensBorderSize * 2)) * (-1);
            }
            if (self.Eroppos) {
                self.tintpos = ((self.nzWidth - self.zoomLens.width() - (self.options.lensBorderSize * 2)) * (-1));
            }
            if (self.options.tint) {
                //stops micro movements
                if (self.fullheight) {
                    self.tintposy = 0;

                }
                if (self.fullwidth) {
                    self.tintpos = 0;

                }
                self.zoomTintImage.css({'left': self.tintpos + 'px'});
                self.zoomTintImage.css({'top': self.tintposy + 'px'});
            }
        },

        swaptheimage: function (smallimage, largeimage) {
            var self = this;
            var newImg = new Image();

            if (self.options.loadingIcon) {
                self.spinner = $('<div style="background: url(\'' + self.options.loadingIcon + '\') no-repeat center;height:' + self.nzHeight + 'px;width:' + self.nzWidth + 'px;z-index: 2000;position: absolute; background-position: center center;"></div>');
                self.$elem.after(self.spinner);
            }

            self.options.onImageSwap(self.$elem);

            newImg.onload = function () {
                self.largeWidth = newImg.width;
                self.largeHeight = newImg.height;
                self.zoomImage = largeimage;
                self.zoomWindow.css({"background-size": self.largeWidth + 'px ' + self.largeHeight + 'px'});
                self.zoomWindow.css({"background-size": self.largeWidth + 'px ' + self.largeHeight + 'px'});


                self.swapAction(smallimage, largeimage);
                return;
            }
            newImg.src = largeimage; // this must be done AFTER setting onload

        },
        swapAction: function (smallimage, largeimage) {


            var self = this;

            var newImg2 = new Image();
            newImg2.onload = function () {
                //re-calculate values
                self.nzHeight = newImg2.height;
                self.nzWidth = newImg2.width;
                self.options.onImageSwapComplete(self.$elem);

                self.doneCallback();
                return;
            }
            newImg2.src = smallimage;

            //reset the zoomlevel to that initially set in options
            self.currentZoomLevel = self.options.zoomLevel;
            self.options.maxZoomLevel = false;

            //swaps the main image
            //self.$elem.attr("src",smallimage);
            //swaps the zoom image
            if (self.options.zoomType == "lens") {
                self.zoomLens.css({backgroundImage: "url('" + largeimage + "')"});
            }
            if (self.options.zoomType == "window") {
                self.zoomWindow.css({backgroundImage: "url('" + largeimage + "')"});
            }
            if (self.options.zoomType == "inner") {
                self.zoomWindow.css({backgroundImage: "url('" + largeimage + "')"});
            }


            self.currentImage = largeimage;

            if (self.options.imageCrossfade) {
                var oldImg = self.$elem;
                var newImg = oldImg.clone();
                self.$elem.attr("src", smallimage)
                self.$elem.after(newImg);
                newImg.stop(true).fadeOut(self.options.imageCrossfade, function () {
                    $(this).remove();
                });

                //       				if(self.options.zoomType == "inner"){
                //remove any attributes on the cloned image so we can resize later
                self.$elem.width("auto").removeAttr("width");
                self.$elem.height("auto").removeAttr("height");
                //   }

                oldImg.fadeIn(self.options.imageCrossfade);

                if (self.options.tint && self.options.zoomType != "inner") {

                    var oldImgTint = self.zoomTintImage;
                    var newImgTint = oldImgTint.clone();
                    self.zoomTintImage.attr("src", largeimage)
                    self.zoomTintImage.after(newImgTint);
                    newImgTint.stop(true).fadeOut(self.options.imageCrossfade, function () {
                        $(this).remove();
                    });


                    oldImgTint.fadeIn(self.options.imageCrossfade);


                    //self.zoomTintImage.attr("width",elem.data("image"));

                    //resize the tint window
                    self.zoomTint.css({height: self.$elem.height()});
                    self.zoomTint.css({width: self.$elem.width()});
                }

                self.zoomContainer.css("height", self.$elem.height());
                self.zoomContainer.css("width", self.$elem.width());

                if (self.options.zoomType == "inner") {
                    if (!self.options.constrainType) {
                        self.zoomWrap.parent().css("height", self.$elem.height());
                        self.zoomWrap.parent().css("width", self.$elem.width());

                        self.zoomWindow.css("height", self.$elem.height());
                        self.zoomWindow.css("width", self.$elem.width());
                    }
                }

                if (self.options.imageCrossfade) {
                    self.zoomWrap.css("height", self.$elem.height());
                    self.zoomWrap.css("width", self.$elem.width());
                }
            }
            else {
                self.$elem.attr("src", smallimage);
                if (self.options.tint) {
                    self.zoomTintImage.attr("src", largeimage);
                    //self.zoomTintImage.attr("width",elem.data("image"));
                    self.zoomTintImage.attr("height", self.$elem.height());
                    //self.zoomTintImage.attr('src') = elem.data("image");
                    self.zoomTintImage.css({height: self.$elem.height()});
                    self.zoomTint.css({height: self.$elem.height()});

                }
                self.zoomContainer.css("height", self.$elem.height());
                self.zoomContainer.css("width", self.$elem.width());

                if (self.options.imageCrossfade) {
                    self.zoomWrap.css("height", self.$elem.height());
                    self.zoomWrap.css("width", self.$elem.width());
                }
            }
            if (self.options.constrainType) {

                //This will contrain the image proportions
                if (self.options.constrainType == "height") {

                    self.zoomContainer.css("height", self.options.constrainSize);
                    self.zoomContainer.css("width", "auto");

                    if (self.options.imageCrossfade) {
                        self.zoomWrap.css("height", self.options.constrainSize);
                        self.zoomWrap.css("width", "auto");
                        self.constwidth = self.zoomWrap.width();


                    }
                    else {
                        self.$elem.css("height", self.options.constrainSize);
                        self.$elem.css("width", "auto");
                        self.constwidth = self.$elem.width();
                    }

                    if (self.options.zoomType == "inner") {

                        self.zoomWrap.parent().css("height", self.options.constrainSize);
                        self.zoomWrap.parent().css("width", self.constwidth);
                        self.zoomWindow.css("height", self.options.constrainSize);
                        self.zoomWindow.css("width", self.constwidth);
                    }
                    if (self.options.tint) {
                        self.tintContainer.css("height", self.options.constrainSize);
                        self.tintContainer.css("width", self.constwidth);
                        self.zoomTint.css("height", self.options.constrainSize);
                        self.zoomTint.css("width", self.constwidth);
                        self.zoomTintImage.css("height", self.options.constrainSize);
                        self.zoomTintImage.css("width", self.constwidth);
                    }

                }
                if (self.options.constrainType == "width") {
                    self.zoomContainer.css("height", "auto");
                    self.zoomContainer.css("width", self.options.constrainSize);

                    if (self.options.imageCrossfade) {
                        self.zoomWrap.css("height", "auto");
                        self.zoomWrap.css("width", self.options.constrainSize);
                        self.constheight = self.zoomWrap.height();
                    }
                    else {
                        self.$elem.css("height", "auto");
                        self.$elem.css("width", self.options.constrainSize);
                        self.constheight = self.$elem.height();
                    }
                    if (self.options.zoomType == "inner") {
                        self.zoomWrap.parent().css("height", self.constheight);
                        self.zoomWrap.parent().css("width", self.options.constrainSize);
                        self.zoomWindow.css("height", self.constheight);
                        self.zoomWindow.css("width", self.options.constrainSize);
                    }
                    if (self.options.tint) {
                        self.tintContainer.css("height", self.constheight);
                        self.tintContainer.css("width", self.options.constrainSize);
                        self.zoomTint.css("height", self.constheight);
                        self.zoomTint.css("width", self.options.constrainSize);
                        self.zoomTintImage.css("height", self.constheight);
                        self.zoomTintImage.css("width", self.options.constrainSize);
                    }

                }


            }

        },
        doneCallback: function () {

            var self = this;
            if (self.options.loadingIcon) {
                self.spinner.hide();
            }

            self.nzOffset = self.$elem.offset();
            self.nzWidth = self.$elem.width();
            self.nzHeight = self.$elem.height();

            // reset the zoomlevel back to default
            self.currentZoomLevel = self.options.zoomLevel;

            //ratio of the large to small image
            self.widthRatio = self.largeWidth / self.nzWidth;
            self.heightRatio = self.largeHeight / self.nzHeight;

            //NEED TO ADD THE LENS SIZE FOR ROUND
            // adjust images less than the window height
            if (self.options.zoomType == "window") {

                if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                    lensHeight = self.nzHeight;

                }
                else {
                    lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                }

                if (self.options.zoomWindowWidth < self.options.zoomWindowWidth) {
                    lensWidth = self.nzWidth;
                }
                else {
                    lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                }


                if (self.zoomLens) {

                    self.zoomLens.css('width', lensWidth);
                    self.zoomLens.css('height', lensHeight);


                }
            }
        },
        getCurrentImage: function () {
            var self = this;
            return self.zoomImage;
        },
        getGalleryList: function () {
            var self = this;
            //loop through the gallery options and set them in list for fancybox
            self.gallerylist = [];
            if (self.options.gallery) {


                $('#' + self.options.gallery + ' a').each(function () {

                    var img_src = '';
                    if ($(this).data("zoom-image")) {
                        img_src = $(this).data("zoom-image");
                    }
                    else if ($(this).data("image")) {
                        img_src = $(this).data("image");
                    }
                    //put the current image at the start
                    if (img_src == self.zoomImage) {
                        self.gallerylist.unshift({
                            href: '' + img_src + '',
                            title: $(this).find('img').attr("title")
                        });
                    }
                    else {
                        self.gallerylist.push({
                            href: '' + img_src + '',
                            title: $(this).find('img').attr("title")
                        });
                    }


                });
            }
            //if no gallery - return current image
            else {
                self.gallerylist.push({
                    href: '' + self.zoomImage + '',
                    title: $(this).find('img').attr("title")
                });
            }
            return self.gallerylist;

        },
        changeZoomLevel: function (value) {
            var self = this;

            //flag a zoom, so can adjust the easing during setPosition
            self.scrollingLock = true;

            //round to two decimal places
            self.newvalue = parseFloat(value).toFixed(2);
            newvalue = parseFloat(value).toFixed(2);


            //maxwidth & Maxheight of the image
            maxheightnewvalue = self.largeHeight / ((self.options.zoomWindowHeight / self.nzHeight) * self.nzHeight);
            maxwidthtnewvalue = self.largeWidth / ((self.options.zoomWindowWidth / self.nzWidth) * self.nzWidth);


            //calculate new heightratio
            if (self.options.zoomType != "inner") {
                if (maxheightnewvalue <= newvalue) {
                    self.heightRatio = (self.largeHeight / maxheightnewvalue) / self.nzHeight;
                    self.newvalueheight = maxheightnewvalue;
                    self.fullheight = true;

                }
                else {
                    self.heightRatio = (self.largeHeight / newvalue) / self.nzHeight;
                    self.newvalueheight = newvalue;
                    self.fullheight = false;

                }


//					calculate new width ratio

                if (maxwidthtnewvalue <= newvalue) {
                    self.widthRatio = (self.largeWidth / maxwidthtnewvalue) / self.nzWidth;
                    self.newvaluewidth = maxwidthtnewvalue;
                    self.fullwidth = true;

                }
                else {
                    self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                    self.newvaluewidth = newvalue;
                    self.fullwidth = false;

                }
                if (self.options.zoomType == "lens") {
                    if (maxheightnewvalue <= newvalue) {
                        self.fullwidth = true;
                        self.newvaluewidth = maxheightnewvalue;

                    } else {
                        self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                        self.newvaluewidth = newvalue;

                        self.fullwidth = false;
                    }
                }
            }


            if (self.options.zoomType == "inner") {
                maxheightnewvalue = parseFloat(self.largeHeight / self.nzHeight).toFixed(2);
                maxwidthtnewvalue = parseFloat(self.largeWidth / self.nzWidth).toFixed(2);
                if (newvalue > maxheightnewvalue) {
                    newvalue = maxheightnewvalue;
                }
                if (newvalue > maxwidthtnewvalue) {
                    newvalue = maxwidthtnewvalue;
                }


                if (maxheightnewvalue <= newvalue) {


                    self.heightRatio = (self.largeHeight / newvalue) / self.nzHeight;
                    if (newvalue > maxheightnewvalue) {
                        self.newvalueheight = maxheightnewvalue;
                    } else {
                        self.newvalueheight = newvalue;
                    }
                    self.fullheight = true;


                }
                else {


                    self.heightRatio = (self.largeHeight / newvalue) / self.nzHeight;

                    if (newvalue > maxheightnewvalue) {

                        self.newvalueheight = maxheightnewvalue;
                    } else {
                        self.newvalueheight = newvalue;
                    }
                    self.fullheight = false;
                }


                if (maxwidthtnewvalue <= newvalue) {

                    self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                    if (newvalue > maxwidthtnewvalue) {

                        self.newvaluewidth = maxwidthtnewvalue;
                    } else {
                        self.newvaluewidth = newvalue;
                    }

                    self.fullwidth = true;


                }
                else {

                    self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                    self.newvaluewidth = newvalue;
                    self.fullwidth = false;
                }


            } //end inner
            scrcontinue = false;

            if (self.options.zoomType == "inner") {

                if (self.nzWidth >= self.nzHeight) {
                    if (self.newvaluewidth <= maxwidthtnewvalue) {
                        scrcontinue = true;
                    }
                    else {

                        scrcontinue = false;
                        self.fullheight = true;
                        self.fullwidth = true;
                    }
                }
                if (self.nzHeight > self.nzWidth) {
                    if (self.newvaluewidth <= maxwidthtnewvalue) {
                        scrcontinue = true;
                    }
                    else {
                        scrcontinue = false;

                        self.fullheight = true;
                        self.fullwidth = true;
                    }
                }
            }

            if (self.options.zoomType != "inner") {
                scrcontinue = true;
            }

            if (scrcontinue) {


                self.zoomLock = 0;
                self.changeZoom = true;

                //if lens height is less than image height


                if (((self.options.zoomWindowHeight) / self.heightRatio) <= self.nzHeight) {


                    self.currentZoomLevel = self.newvalueheight;
                    if (self.options.zoomType != "lens" && self.options.zoomType != "inner") {
                        self.changeBgSize = true;

                        self.zoomLens.css({height: String((self.options.zoomWindowHeight) / self.heightRatio) + 'px'})
                    }
                    if (self.options.zoomType == "lens" || self.options.zoomType == "inner") {
                        self.changeBgSize = true;
                    }


                }


                if ((self.options.zoomWindowWidth / self.widthRatio) <= self.nzWidth) {


                    if (self.options.zoomType != "inner") {
                        if (self.newvaluewidth > self.newvalueheight) {
                            self.currentZoomLevel = self.newvaluewidth;

                        }
                    }

                    if (self.options.zoomType != "lens" && self.options.zoomType != "inner") {
                        self.changeBgSize = true;

                        self.zoomLens.css({width: String((self.options.zoomWindowWidth) / self.widthRatio) + 'px'})
                    }
                    if (self.options.zoomType == "lens" || self.options.zoomType == "inner") {
                        self.changeBgSize = true;
                    }

                }
                if (self.options.zoomType == "inner") {
                    self.changeBgSize = true;

                    if (self.nzWidth > self.nzHeight) {
                        self.currentZoomLevel = self.newvaluewidth;
                    }
                    if (self.nzHeight > self.nzWidth) {
                        self.currentZoomLevel = self.newvaluewidth;
                    }
                }

            }      //under

            //sets the boundry change, called in setWindowPos
            self.setPosition(self.currentLoc);
            //
        },
        closeAll: function () {
            if (self.zoomWindow) {
                self.zoomWindow.hide();
            }
            if (self.zoomLens) {
                self.zoomLens.hide();
            }
            if (self.zoomTint) {
                self.zoomTint.hide();
            }
        },
        changeState: function (value) {
            var self = this;
            if (value == 'enable') {
                self.options.zoomEnabled = true;
            }
            if (value == 'disable') {
                self.options.zoomEnabled = false;
            }

        }

    };


    $.fn.elevateZoom = function (options) {
        return this.each(function () {
            var elevate = Object.create(ElevateZoom);

            elevate.init(options, this);

            $.data(this, 'elevateZoom', elevate);

        });
    };

    $.fn.elevateZoom.options = {
        zoomActivation: "hover", // Can also be click (PLACEHOLDER FOR NEXT VERSION)
        zoomEnabled: true, //false disables zoomwindow from showing
        preloading: 1, //by default, load all the images, if 0, then only load images after activated (PLACEHOLDER FOR NEXT VERSION)
        zoomLevel: 1, //default zoom level of image
        scrollZoom: false, //allow zoom on mousewheel, true to activate
        scrollZoomIncrement: 0.1,  //steps of the scrollzoom
        minZoomLevel: false,
        maxZoomLevel: false,
        easing: false,
        easingAmount: 12,
        lensSize: 200,
        zoomWindowWidth: 400,
        zoomWindowHeight: 400,
        zoomWindowOffetx: 0,
        zoomWindowOffety: 0,
        zoomWindowPosition: 1,
        zoomWindowBgColour: "#fff",
        lensFadeIn: false,
        lensFadeOut: false,
        debug: false,
        zoomWindowFadeIn: false,
        zoomWindowFadeOut: false,
        zoomWindowAlwaysShow: false,
        zoomTintFadeIn: false,
        zoomTintFadeOut: false,
        borderSize: 4,
        showLens: true,
        borderColour: "#888",
        lensBorderSize: 1,
        lensBorderColour: "#000",
        lensShape: "square", //can be "round"
        zoomType: "window", //window is default,  also "lens" available -
        containLensZoom: false,
        lensColour: "white", //colour of the lens background
        lensOpacity: 0.4, //opacity of the lens
        lenszoom: false,
        tint: false, //enable the tinting
        tintColour: "#333", //default tint color, can be anything, red, #ccc, rgb(0,0,0)
        tintOpacity: 0.4, //opacity of the tint
        gallery: false,
        galleryActiveClass: "zoomGalleryActive",
        imageCrossfade: false,
        constrainType: false,  //width or height
        constrainSize: false,  //in pixels the dimensions you want to constrain on
        loadingIcon: false, //http://www.example.com/spinner.gif
        cursor: "default", // user should set to what they want the cursor as, if they have set a click function
        responsive: true,
        onComplete: $.noop,
        onZoomedImageLoaded: function () {
        },
        onImageSwap: $.noop,
        onImageSwapComplete: $.noop
    };

})(jQuery, window, document);
/*!
 * FormValidation (http://formvalidation.io)
 * The best jQuery plugin to validate form fields. Support Bootstrap, Foundation, Pure, SemanticUI, UIKit frameworks
 *
 * @version     v0.6.1-dev, built on 2015-01-15 10:41:32 AM
 * @author      https://twitter.com/nghuuphuoc
 * @copyright   (c) 2013 - 2015 Nguyen Huu Phuoc
 * @license     http://formvalidation.io/license/
 */
if (window.FormValidation = {
        AddOn: {},
        Framework: {},
        I18n: {},
        Validator: {}
    }, "undefined" == typeof jQuery)throw new Error("FormValidation requires jQuery");
!function (a) {
    var b = a.fn.jquery.split(" ")[0].split(".");
    if (+b[0] < 2 && +b[1] < 9 || 1 === +b[0] && 9 === +b[1] && +b[2] < 1)throw new Error("FormValidation requires jQuery version 1.9.1 or higher")
}(jQuery), function (a) {
    FormValidation.Base = function (b, c, d) {
        this.$form = a(b), this.options = a.extend({}, a.fn.formValidation.DEFAULT_OPTIONS, c), this._namespace = d || "fv", this.$invalidFields = a([]), this.$submitButton = null, this.$hiddenButton = null, this.STATUS_NOT_VALIDATED = "NOT_VALIDATED", this.STATUS_VALIDATING = "VALIDATING", this.STATUS_INVALID = "INVALID", this.STATUS_VALID = "VALID";
        var e = function () {
            for (var a = 3, b = document.createElement("div"), c = b.all || []; b.innerHTML = "<!--[if gt IE " + ++a + "]><br><![endif]-->", c[0];);
            return a > 4 ? a : !a
        }(), f = document.createElement("div");
        this._changeEvent = 9 !== e && "oninput"in f ? "input" : "keyup", this._submitIfValid = null, this._cacheFields = {}, this._init()
    }, FormValidation.Base.prototype = {
        constructor: FormValidation.Base, _exceedThreshold: function (b) {
            var c = this._namespace, d = b.attr("data-" + c + "-field"), e = this.options.fields[d].threshold || this.options.threshold;
            if (!e)return !0;
            var f = -1 !== a.inArray(b.attr("type"), ["button", "checkbox", "file", "hidden", "image", "radio", "reset", "submit"]);
            return f || b.val().length >= e
        }, _init: function () {
            var b = this, c = this._namespace, d = {
                addOns: {},
                autoFocus: this.$form.attr("data-" + c + "-autofocus"),
                button: {
                    selector: this.$form.attr("data-" + c + "-button-selector") || this.$form.attr("data-" + c + "-submitbuttons"),
                    disabled: this.$form.attr("data-" + c + "-button-disabled")
                },
                control: {
                    valid: this.$form.attr("data-" + c + "-control-valid"),
                    invalid: this.$form.attr("data-" + c + "-control-invalid")
                },
                err: {
                    clazz: this.$form.attr("data-" + c + "-err-clazz"),
                    container: this.$form.attr("data-" + c + "-err-container") || this.$form.attr("data-" + c + "-container"),
                    parent: this.$form.attr("data-" + c + "-err-parent")
                },
                events: {
                    formInit: this.$form.attr("data-" + c + "-events-form-init"),
                    formError: this.$form.attr("data-" + c + "-events-form-error"),
                    formSuccess: this.$form.attr("data-" + c + "-events-form-success"),
                    fieldAdded: this.$form.attr("data-" + c + "-events-field-added"),
                    fieldRemoved: this.$form.attr("data-" + c + "-events-field-removed"),
                    fieldInit: this.$form.attr("data-" + c + "-events-field-init"),
                    fieldError: this.$form.attr("data-" + c + "-events-field-error"),
                    fieldSuccess: this.$form.attr("data-" + c + "-events-field-success"),
                    fieldStatus: this.$form.attr("data-" + c + "-events-field-status"),
                    localeChanged: this.$form.attr("data-" + c + "-events-locale-changed"),
                    validatorError: this.$form.attr("data-" + c + "-events-validator-error"),
                    validatorSuccess: this.$form.attr("data-" + c + "-events-validator-success")
                },
                excluded: this.$form.attr("data-" + c + "-excluded"),
                icon: {
                    valid: this.$form.attr("data-" + c + "-icon-valid") || this.$form.attr("data-" + c + "-feedbackicons-valid"),
                    invalid: this.$form.attr("data-" + c + "-icon-invalid") || this.$form.attr("data-" + c + "-feedbackicons-invalid"),
                    validating: this.$form.attr("data-" + c + "-icon-validating") || this.$form.attr("data-" + c + "-feedbackicons-validating"),
                    feedback: this.$form.attr("data-" + c + "-icon-feedback")
                },
                live: this.$form.attr("data-" + c + "-live"),
                locale: this.$form.attr("data-" + c + "-locale"),
                message: this.$form.attr("data-" + c + "-message"),
                onError: this.$form.attr("data-" + c + "-onerror"),
                onSuccess: this.$form.attr("data-" + c + "-onsuccess"),
                row: {
                    selector: this.$form.attr("data-" + c + "-row-selector") || this.$form.attr("data-" + c + "-group"),
                    valid: this.$form.attr("data-" + c + "-row-valid"),
                    invalid: this.$form.attr("data-" + c + "-row-invalid"),
                    feedback: this.$form.attr("data-" + c + "-row-feedback")
                },
                threshold: this.$form.attr("data-" + c + "-threshold"),
                trigger: this.$form.attr("data-" + c + "-trigger"),
                verbose: this.$form.attr("data-" + c + "-verbose"),
                fields: {}
            };
            this.$form.attr("novalidate", "novalidate").addClass(this.options.elementClass).on("submit." + c, function (a) {
                a.preventDefault(), b.validate()
            }).on("click." + c, this.options.button.selector, function () {
                b.$submitButton = a(this), b._submitIfValid = !0
            }).find("[name], [data-" + c + "-field]").each(function () {
                var e = a(this), f = e.attr("name") || e.attr("data-" + c + "-field"), g = b._parseOptions(e);
                g && (e.attr("data-" + c + "-field", f), d.fields[f] = a.extend({}, g, d.fields[f]))
            }), this.options = a.extend(!0, this.options, d), "string" == typeof this.options.err.parent && (this.options.err.parent = new RegExp(this.options.err.parent)), this.options.container && (this.options.err.container = this.options.container, delete this.options.container), this.options.feedbackIcons && (this.options.icon = a.extend(!0, this.options.icon, this.options.feedbackIcons), delete this.options.feedbackIcons), this.options.group && (this.options.row.selector = this.options.group, delete this.options.group), this.options.submitButtons && (this.options.button.selector = this.options.submitButtons, delete this.options.submitButtons), FormValidation.I18n[this.options.locale] || (this.options.locale = a.fn.formValidation.DEFAULT_OPTIONS.locale), this.options = a.extend(!0, this.options, {addOns: this._parseAddOnOptions()}), this.$hiddenButton = a("<button/>").attr("type", "submit").prependTo(this.$form).addClass("fv-hidden-submit").css({
                display: "none",
                width: 0,
                height: 0
            }), this.$form.on("click." + this._namespace, '[type="submit"]', function (c) {
                if (!c.isDefaultPrevented()) {
                    var d = a(c.target), e = d.is('[type="submit"]') ? d.eq(0) : d.parent('[type="submit"]').eq(0);
                    !b.options.button.selector || e.is(b.options.button.selector) || e.is(b.$hiddenButton) || b.$form.off("submit." + b._namespace).submit()
                }
            });
            for (var e in this.options.fields)this._initField(e);
            for (var f in this.options.addOns)"function" == typeof FormValidation.AddOn[f].init && FormValidation.AddOn[f].init(this, this.options.addOns[f]);
            this.$form.trigger(a.Event(this.options.events.formInit), {
                bv: this,
                fv: this,
                options: this.options
            }), this.options.onSuccess && this.$form.on(this.options.events.formSuccess, function (a) {
                FormValidation.Helper.call(b.options.onSuccess, [a])
            }), this.options.onError && this.$form.on(this.options.events.formError, function (a) {
                FormValidation.Helper.call(b.options.onError, [a])
            })
        }, _initField: function (b) {
            var c = this._namespace, d = a([]);
            switch (typeof b) {
                case"object":
                    d = b, b = b.attr("data-" + c + "-field");
                    break;
                case"string":
                    d = this.getFieldElements(b), d.attr("data-" + c + "-field", b)
            }
            if (0 !== d.length && null !== this.options.fields[b] && null !== this.options.fields[b].validators) {
                var e;
                for (e in this.options.fields[b].validators)FormValidation.Validator[e] || delete this.options.fields[b].validators[e];
                null === this.options.fields[b].enabled && (this.options.fields[b].enabled = !0);
                for (var f = this, g = d.length, h = d.attr("type"), i = 1 === g || "radio" === h || "checkbox" === h, j = this._getFieldTrigger(d.eq(0)), k = a.map(j, function (a) {
                    return a + ".update." + c
                }).join(" "), l = 0; g > l; l++) {
                    var m = d.eq(l), n = this.options.fields[b].row || this.options.row.selector, o = m.closest(n), p = "function" == typeof(this.options.fields[b].container || this.options.fields[b].err || this.options.err.container) ? (this.options.fields[b].container || this.options.fields[b].err || this.options.err.container).call(this, m, this) : this.options.fields[b].container || this.options.fields[b].err || this.options.err.container, q = p && "tooltip" !== p && "popover" !== p ? a(p) : this._getMessageContainer(m, n);
                    p && "tooltip" !== p && "popover" !== p && q.addClass(this.options.err.clazz), q.find("." + this.options.err.clazz.split(" ").join(".") + "[data-" + c + "-validator][data-" + c + '-for="' + b + '"]').remove(), o.find("i[data-" + c + '-icon-for="' + b + '"]').remove(), m.off(k).on(k, function () {
                        f.updateStatus(a(this), f.STATUS_NOT_VALIDATED)
                    }), m.data(c + ".messages", q);
                    for (e in this.options.fields[b].validators)m.data(c + ".result." + e, this.STATUS_NOT_VALIDATED), i && l !== g - 1 || a("<small/>").css("display", "none").addClass(this.options.err.clazz).attr("data-" + c + "-validator", e).attr("data-" + c + "-for", b).attr("data-" + c + "-result", this.STATUS_NOT_VALIDATED).html(this._getMessage(b, e)).appendTo(q), "function" == typeof FormValidation.Validator[e].init && FormValidation.Validator[e].init(this, m, this.options.fields[b].validators[e]);
                    if (this.options.fields[b].icon !== !1 && "false" !== this.options.fields[b].icon && this.options.icon && this.options.icon.valid && this.options.icon.invalid && this.options.icon.validating && (!i || l === g - 1)) {
                        o.addClass(this.options.row.feedback);
                        var r = a("<i/>").css("display", "none").addClass(this.options.icon.feedback).attr("data-" + c + "-icon-for", b).insertAfter(m);
                        (i ? d : m).data(c + ".icon", r), ("tooltip" === p || "popover" === p) && ((i ? d : m).on(this.options.events.fieldError, function () {
                            o.addClass("fv-has-tooltip")
                        }).on(this.options.events.fieldSuccess, function () {
                            o.removeClass("fv-has-tooltip")
                        }), m.off("focus.container." + c).on("focus.container." + c, function () {
                            f._showTooltip(m, p)
                        }).off("blur.container." + c).on("blur.container." + c, function () {
                            f._hideTooltip(m, p)
                        })), "string" == typeof this.options.fields[b].icon && "true" !== this.options.fields[b].icon ? r.appendTo(a(this.options.fields[b].icon)) : this._fixIcon(m, r)
                    }
                }
                d.on(this.options.events.fieldSuccess, function (a, b) {
                    var c = f.getOptions(b.field, null, "onSuccess");
                    c && FormValidation.Helper.call(c, [a, b])
                }).on(this.options.events.fieldError, function (a, b) {
                    var c = f.getOptions(b.field, null, "onError");
                    c && FormValidation.Helper.call(c, [a, b])
                }).on(this.options.events.fieldStatus, function (a, b) {
                    var c = f.getOptions(b.field, null, "onStatus");
                    c && FormValidation.Helper.call(c, [a, b])
                }).on(this.options.events.validatorError, function (a, b) {
                    var c = f.getOptions(b.field, b.validator, "onError");
                    c && FormValidation.Helper.call(c, [a, b])
                }).on(this.options.events.validatorSuccess, function (a, b) {
                    var c = f.getOptions(b.field, b.validator, "onSuccess");
                    c && FormValidation.Helper.call(c, [a, b])
                }), this.onLiveChange(d, "live", function () {
                    f._exceedThreshold(a(this)) && f.validateField(a(this))
                }), d.trigger(a.Event(this.options.events.fieldInit), {bv: this, fv: this, field: b, element: d})
            }
        }, _isExcluded: function (b) {
            var c = this._namespace, d = b.attr("data-" + c + "-excluded"), e = b.attr("data-" + c + "-field") || b.attr("name");
            switch (!0) {
                case!!e && this.options.fields && this.options.fields[e] && ("true" === this.options.fields[e].excluded || this.options.fields[e].excluded === !0):
                case"true" === d:
                case"" === d:
                    return !0;
                case!!e && this.options.fields && this.options.fields[e] && ("false" === this.options.fields[e].excluded || this.options.fields[e].excluded === !1):
                case"false" === d:
                    return !1;
                default:
                    if (this.options.excluded) {
                        "string" == typeof this.options.excluded && (this.options.excluded = a.map(this.options.excluded.split(","), function (b) {
                            return a.trim(b)
                        }));
                        for (var f = this.options.excluded.length, g = 0; f > g; g++)if ("string" == typeof this.options.excluded[g] && b.is(this.options.excluded[g]) || "function" == typeof this.options.excluded[g] && this.options.excluded[g].call(this, b, this) === !0)return !0
                    }
                    return !1
            }
        }, _getFieldTrigger: function (a) {
            var b = this._namespace, c = a.data(b + ".trigger");
            if (c)return c;
            var d = a.attr("type"), e = a.attr("data-" + b + "-field"), f = "radio" === d || "checkbox" === d || "file" === d || "SELECT" === a.get(0).tagName ? "change" : this._changeEvent;
            return c = ((this.options.fields[e] ? this.options.fields[e].trigger : null) || this.options.trigger || f).split(" "), a.data(b + ".trigger", c), c
        }, _getMessage: function (a, b) {
            if (!(this.options.fields[a] && FormValidation.Validator[b] && this.options.fields[a].validators && this.options.fields[a].validators[b]))return "";
            switch (!0) {
                case!!this.options.fields[a].validators[b].message:
                    return this.options.fields[a].validators[b].message;
                case!!this.options.fields[a].message:
                    return this.options.fields[a].message;
                case!!FormValidation.I18n[this.options.locale][b]["default"]:
                    return FormValidation.I18n[this.options.locale][b]["default"];
                default:
                    return this.options.message
            }
        }, _getMessageContainer: function (a, b) {
            if (!this.options.err.parent)throw new Error("The err.parent option is not defined");
            var c = a.parent();
            if (c.is(b))return c;
            var d = c.attr("class");
            return d && this.options.err.parent.test(d) ? c : this._getMessageContainer(c, b)
        }, _parseAddOnOptions: function () {
            var a = this._namespace, b = this.$form.attr("data-" + a + "-addons"), c = this.options.addOns || {};
            if (b) {
                b = b.replace(/\s/g, "").split(",");
                for (var d = 0; d < b.length; d++)c[b[d]] || (c[b[d]] = {})
            }
            var e, f, g, h;
            for (e in c)if (FormValidation.AddOn[e]) {
                if (f = FormValidation.AddOn[e].html5Attributes)for (g in f)h = this.$form.attr("data-" + a + "-addons-" + e.toLowerCase() + "-" + g.toLowerCase()), h && (c[e][f[g]] = h)
            } else delete c[e];
            return c
        }, _parseOptions: function (b) {
            var c, d, e, f, g, h, i, j, k, l = this._namespace, m = b.attr("name") || b.attr("data-" + l + "-field"), n = {};
            for (d in FormValidation.Validator)if (c = FormValidation.Validator[d], e = "data-" + l + "-" + d.toLowerCase(), f = b.attr(e) + "", k = "function" == typeof c.enableByHtml5 ? c.enableByHtml5(b) : null, k && "false" !== f || k !== !0 && ("" === f || "true" === f || e === f.toLowerCase())) {
                c.html5Attributes = a.extend({}, {
                    message: "message",
                    onerror: "onError",
                    onsuccess: "onSuccess",
                    transformer: "transformer"
                }, c.html5Attributes), n[d] = a.extend({}, k === !0 ? {} : k, n[d]);
                for (j in c.html5Attributes)g = c.html5Attributes[j], h = "data-" + l + "-" + d.toLowerCase() + "-" + j, i = b.attr(h), i && ("true" === i || h === i.toLowerCase() ? i = !0 : "false" === i && (i = !1), n[d][g] = i)
            }
            var o = {
                autoFocus: b.attr("data-" + l + "-autofocus"),
                err: b.attr("data-" + l + "-err-container") || b.attr("data-" + l + "-container"),
                excluded: b.attr("data-" + l + "-excluded"),
                icon: b.attr("data-" + l + "-icon") || b.attr("data-" + l + "-feedbackicons") || (this.options.fields && this.options.fields[m] ? this.options.fields[m].feedbackIcons : null),
                message: b.attr("data-" + l + "-message"),
                onError: b.attr("data-" + l + "-onerror"),
                onStatus: b.attr("data-" + l + "-onstatus"),
                onSuccess: b.attr("data-" + l + "-onsuccess"),
                row: b.attr("data-" + l + "-row") || b.attr("data-" + l + "-group") || (this.options.fields && this.options.fields[m] ? this.options.fields[m].group : null),
                selector: b.attr("data-" + l + "-selector"),
                threshold: b.attr("data-" + l + "-threshold"),
                transformer: b.attr("data-" + l + "-transformer"),
                trigger: b.attr("data-" + l + "-trigger"),
                verbose: b.attr("data-" + l + "-verbose"),
                validators: n
            }, p = a.isEmptyObject(o), q = a.isEmptyObject(n);
            return !q || !p && this.options.fields && this.options.fields[m] ? (o.validators = n, o) : null
        }, _submit: function () {
            var b = this.isValid(), c = b ? this.options.events.formSuccess : this.options.events.formError, d = a.Event(c);
            this.$form.trigger(d), this.$submitButton && (b ? this._onSuccess(d) : this._onError(d))
        }, _onError: function (b) {
            if (!b.isDefaultPrevented()) {
                if ("submitted" === this.options.live) {
                    this.options.live = "enabled";
                    var c = this;
                    for (var d in this.options.fields)!function (b) {
                        var d = c.getFieldElements(b);
                        d.length && c.onLiveChange(d, "live", function () {
                            c._exceedThreshold(a(this)) && c.validateField(a(this))
                        })
                    }(d)
                }
                for (var e = this._namespace, f = 0; f < this.$invalidFields.length; f++) {
                    var g = this.$invalidFields.eq(f), h = this.isOptionEnabled(g.attr("data-" + e + "-field"), "autoFocus");
                    if (h) {
                        g.focus();
                        break
                    }
                }
            }
        }, _onFieldValidated: function (b, c) {
            var d = this._namespace, e = b.attr("data-" + d + "-field"), f = this.options.fields[e].validators, g = {}, h = 0, i = {
                bv: this,
                fv: this,
                field: e,
                element: b,
                validator: c,
                result: b.data(d + ".response." + c)
            };
            if (c)switch (b.data(d + ".result." + c)) {
                case this.STATUS_INVALID:
                    b.trigger(a.Event(this.options.events.validatorError), i);
                    break;
                case this.STATUS_VALID:
                    b.trigger(a.Event(this.options.events.validatorSuccess), i)
            }
            g[this.STATUS_NOT_VALIDATED] = 0, g[this.STATUS_VALIDATING] = 0, g[this.STATUS_INVALID] = 0, g[this.STATUS_VALID] = 0;
            for (var j in f)if (f[j].enabled !== !1) {
                h++;
                var k = b.data(d + ".result." + j);
                k && g[k]++
            }
            g[this.STATUS_VALID] === h ? (this.$invalidFields = this.$invalidFields.not(b), b.trigger(a.Event(this.options.events.fieldSuccess), i)) : (0 === g[this.STATUS_NOT_VALIDATED] || !this.isOptionEnabled(e, "verbose")) && 0 === g[this.STATUS_VALIDATING] && g[this.STATUS_INVALID] > 0 && (this.$invalidFields = this.$invalidFields.add(b), b.trigger(a.Event(this.options.events.fieldError), i))
        }, _onSuccess: function (a) {
            a.isDefaultPrevented() || this.disableSubmitButtons(!0).defaultSubmit()
        }, _fixIcon: function () {
        }, _createTooltip: function () {
        }, _destroyTooltip: function () {
        }, _hideTooltip: function () {
        }, _showTooltip: function () {
        }, defaultSubmit: function () {
            var b = this._namespace;
            this.$submitButton && a("<input/>").attr({
                type: "hidden",
                name: this.$submitButton.attr("name")
            }).attr("data-" + b + "-submit-hidden", "").val(this.$submitButton.val()).appendTo(this.$form), this.$form.off("submit." + b).submit()
        }, disableSubmitButtons: function (a) {
            return a ? "disabled" !== this.options.live && this.$form.find(this.options.button.selector).attr("disabled", "disabled").addClass(this.options.button.disabled) : this.$form.find(this.options.button.selector).removeAttr("disabled").removeClass(this.options.button.disabled), this
        }, getFieldElements: function (b) {
            if (!this._cacheFields[b])if (this.options.fields[b] && this.options.fields[b].selector) {
                var c = this.$form.find(this.options.fields[b].selector);
                this._cacheFields[b] = c.length ? c : a(this.options.fields[b].selector)
            } else this._cacheFields[b] = this.$form.find('[name="' + b + '"]');
            return this._cacheFields[b]
        }, getFieldValue: function (a, b) {
            var c, d = this._namespace;
            if ("string" == typeof a) {
                if (c = this.getFieldElements(a), 0 === c.length)return null
            } else c = a, a = c.attr("data-" + d + "-field");
            if (!a || !this.options.fields[a])return c.val();
            var e = (this.options.fields[a].validators && this.options.fields[a].validators[b] ? this.options.fields[a].validators[b].transformer : null) || this.options.fields[a].transformer;
            return e ? FormValidation.Helper.call(e, [c, b]) : c.val()
        }, getNamespace: function () {
            return this._namespace
        }, getOptions: function (a, b, c) {
            var d = this._namespace;
            if (!a)return c ? this.options[c] : this.options;
            if ("object" == typeof a && (a = a.attr("data-" + d + "-field")), !this.options.fields[a])return null;
            var e = this.options.fields[a];
            return b ? e.validators && e.validators[b] ? c ? e.validators[b][c] : e.validators[b] : null : c ? e[c] : e
        }, getStatus: function (a, b) {
            var c = this._namespace;
            switch (typeof a) {
                case"object":
                    return a.data(c + ".result." + b);
                case"string":
                default:
                    return this.getFieldElements(a).eq(0).data(c + ".result." + b)
            }
        }, isOptionEnabled: function (a, b) {
            return !this.options.fields[a] || "true" !== this.options.fields[a][b] && this.options.fields[a][b] !== !0 ? !this.options.fields[a] || "false" !== this.options.fields[a][b] && this.options.fields[a][b] !== !1 ? "true" === this.options[b] || this.options[b] === !0 : !1 : !0
        }, isValid: function () {
            for (var a in this.options.fields)if (!this.isValidField(a))return !1;
            return !0
        }, isValidContainer: function (b) {
            var c = this, d = this._namespace, e = {}, f = "string" == typeof b ? a(b) : b;
            if (0 === f.length)return !0;
            f.find("[data-" + d + "-field]").each(function () {
                var b = a(this), f = b.attr("data-" + d + "-field");
                c._isExcluded(b) || e[f] || (e[f] = b)
            });
            for (var g in e) {
                var h = e[g], i = h.data(d + ".messages").find("." + this.options.err.clazz.split(" ").join(".") + "[data-" + d + "-validator][data-" + d + '-for="' + g + '"]');
                if (i.filter("[data-" + d + '-result="' + this.STATUS_INVALID + '"]').length > 0)return !1;
                if (i.filter("[data-" + d + '-result="' + this.STATUS_NOT_VALIDATED + '"]').length > 0 || i.filter("[data-" + d + '-result="' + this.STATUS_VALIDATING + '"]').length > 0)return null
            }
            return !0
        }, isValidField: function (b) {
            var c = this._namespace, d = a([]);
            switch (typeof b) {
                case"object":
                    d = b, b = b.attr("data-" + c + "-field");
                    break;
                case"string":
                    d = this.getFieldElements(b)
            }
            if (0 === d.length || !this.options.fields[b] || this.options.fields[b].enabled === !1)return !0;
            for (var e, f, g, h = d.attr("type"), i = "radio" === h || "checkbox" === h ? 1 : d.length, j = 0; i > j; j++)if (e = d.eq(j), !this._isExcluded(e))for (f in this.options.fields[b].validators)if (this.options.fields[b].validators[f].enabled !== !1 && (g = e.data(c + ".result." + f), g !== this.STATUS_VALID))return !1;
            return !0
        }, offLiveChange: function (b, c) {
            if (null === b || 0 === b.length)return this;
            var d = this._namespace, e = this._getFieldTrigger(b.eq(0)), f = a.map(e, function (a) {
                return a + "." + c + "." + d
            }).join(" ");
            return b.off(f), this
        }, onLiveChange: function (b, c, d) {
            if (null === b || 0 === b.length)return this;
            var e = this._namespace, f = this._getFieldTrigger(b.eq(0)), g = a.map(f, function (a) {
                return a + "." + c + "." + e
            }).join(" ");
            switch (this.options.live) {
                case"submitted":
                    break;
                case"disabled":
                    b.off(g);
                    break;
                case"enabled":
                default:
                    b.off(g).on(g, function () {
                        d.apply(this, arguments)
                    })
            }
            return this
        }, updateMessage: function (b, c, d) {
            var e = this, f = this._namespace, g = a([]);
            switch (typeof b) {
                case"object":
                    g = b, b = b.attr("data-" + f + "-field");
                    break;
                case"string":
                    g = this.getFieldElements(b)
            }
            g.each(function () {
                a(this).data(f + ".messages").find("." + e.options.err.clazz + "[data-" + f + '-validator="' + c + '"][data-' + f + '-for="' + b + '"]').html(d)
            })
        }, updateStatus: function (b, c, d) {
            var e = this._namespace, f = a([]);
            switch (typeof b) {
                case"object":
                    f = b, b = b.attr("data-" + e + "-field");
                    break;
                case"string":
                    f = this.getFieldElements(b)
            }
            if (!b || !this.options.fields[b])return this;
            c === this.STATUS_NOT_VALIDATED && (this._submitIfValid = !1);
            for (var g = this, h = f.attr("type"), i = this.options.fields[b].row || this.options.row.selector, j = "radio" === h || "checkbox" === h ? 1 : f.length, k = 0; j > k; k++) {
                var l = f.eq(k);
                if (!this._isExcluded(l)) {
                    var m = l.closest(i), n = l.data(e + ".messages"), o = n.find("." + this.options.err.clazz.split(" ").join(".") + "[data-" + e + "-validator][data-" + e + '-for="' + b + '"]'), p = d ? o.filter("[data-" + e + '-validator="' + d + '"]') : o, q = l.data(e + ".icon"), r = "function" == typeof(this.options.fields[b].container || this.options.fields[b].err || this.options.err.container) ? (this.options.fields[b].container || this.options.fields[b].err || this.options.err.container).call(this, l, this) : this.options.fields[b].container || this.options.fields[b].err || this.options.err.container, s = null;
                    if (d)l.data(e + ".result." + d, c); else for (var t in this.options.fields[b].validators)l.data(e + ".result." + t, c);
                    switch (p.attr("data-" + e + "-result", c), c) {
                        case this.STATUS_VALIDATING:
                            s = null, this.disableSubmitButtons(!0), l.removeClass(this.options.control.valid).removeClass(this.options.control.invalid), m.removeClass(this.options.row.valid).removeClass(this.options.row.invalid), q && q.removeClass(this.options.icon.valid).removeClass(this.options.icon.invalid).addClass(this.options.icon.validating).show();
                            break;
                        case this.STATUS_INVALID:
                            s = !1, this.disableSubmitButtons(!0), l.removeClass(this.options.control.valid).addClass(this.options.control.invalid), m.removeClass(this.options.row.valid).addClass(this.options.row.invalid), q && q.removeClass(this.options.icon.valid).removeClass(this.options.icon.validating).addClass(this.options.icon.invalid).show();
                            break;
                        case this.STATUS_VALID:
                            if (s = 0 === o.filter("[data-" + e + '-result="' + this.STATUS_NOT_VALIDATED + '"]').length ? o.filter("[data-" + e + '-result="' + this.STATUS_VALID + '"]').length === o.length : null, l.removeClass(this.options.control.valid).removeClass(this.options.control.invalid), null !== s && (this.disableSubmitButtons(this.$submitButton ? !this.isValid() : !s), l.addClass(s ? this.options.control.valid : this.options.control.invalid), q)) {
                                var u = o.filter("[data-" + e + '-result="' + this.STATUS_VALIDATING + '"]').length > 0;
                                q.removeClass(this.options.icon.invalid).removeClass(this.options.icon.validating).removeClass(this.options.icon.valid).addClass(s ? this.options.icon.valid : u ? this.options.icon.validating : this.options.icon.invalid).show()
                            }
                            var v = this.isValidContainer(m);
                            null !== v && m.removeClass(this.options.row.valid).removeClass(this.options.row.invalid).addClass(v ? this.options.row.valid : this.options.row.invalid);
                            break;
                        case this.STATUS_NOT_VALIDATED:
                        default:
                            s = null, this.disableSubmitButtons(!1), l.removeClass(this.options.control.valid).removeClass(this.options.control.invalid), m.removeClass(this.options.row.valid).removeClass(this.options.row.invalid), q && q.removeClass(this.options.icon.valid).removeClass(this.options.icon.invalid).removeClass(this.options.icon.validating).hide()
                    }
                    !q || "tooltip" !== r && "popover" !== r ? c === this.STATUS_INVALID ? p.show() : p.hide() : s === !1 ? this._createTooltip(l, o.filter("[data-" + e + '-result="' + g.STATUS_INVALID + '"]').eq(0).html(), r) : this._destroyTooltip(l, r), l.trigger(a.Event(this.options.events.fieldStatus), {
                        bv: this,
                        fv: this,
                        field: b,
                        element: l,
                        status: c
                    }), this._onFieldValidated(l, d)
                }
            }
            return this
        }, validate: function () {
            if (!this.options.fields)return this;
            this.disableSubmitButtons(!0), this._submitIfValid = !1;
            for (var a in this.options.fields)this.validateField(a);
            return this._submit(), this._submitIfValid = !0, this
        }, validateField: function (b) {
            var c = this._namespace, d = a([]);
            switch (typeof b) {
                case"object":
                    d = b, b = b.attr("data-" + c + "-field");
                    break;
                case"string":
                    d = this.getFieldElements(b)
            }
            if (0 === d.length || !this.options.fields[b] || this.options.fields[b].enabled === !1)return this;
            for (var e, f, g = this, h = d.attr("type"), i = "radio" === h || "checkbox" === h ? 1 : d.length, j = "radio" === h || "checkbox" === h, k = this.options.fields[b].validators, l = this.isOptionEnabled(b, "verbose"), m = 0; i > m; m++) {
                var n = d.eq(m);
                if (!this._isExcluded(n)) {
                    var o = !1;
                    for (e in k) {
                        if (n.data(c + ".dfs." + e) && n.data(c + ".dfs." + e).reject(), o)break;
                        var p = n.data(c + ".result." + e);
                        if (p !== this.STATUS_VALID && p !== this.STATUS_INVALID)if (k[e].enabled !== !1) {
                            if (n.data(c + ".result." + e, this.STATUS_VALIDATING), f = FormValidation.Validator[e].validate(this, n, k[e]), "object" == typeof f && f.resolve)this.updateStatus(j ? b : n, this.STATUS_VALIDATING, e), n.data(c + ".dfs." + e, f), f.done(function (a, b, d) {
                                a.removeData(c + ".dfs." + b).data(c + ".response." + b, d), d.message && g.updateMessage(a, b, d.message), g.updateStatus(j ? a.attr("data-" + c + "-field") : a, d.valid ? g.STATUS_VALID : g.STATUS_INVALID, b), d.valid && g._submitIfValid === !0 ? g._submit() : d.valid || l || (o = !0)
                            }); else if ("object" == typeof f && void 0 !== f.valid) {
                                if (n.data(c + ".response." + e, f), f.message && this.updateMessage(j ? b : n, e, f.message), this.updateStatus(j ? b : n, f.valid ? this.STATUS_VALID : this.STATUS_INVALID, e), !f.valid && !l)break
                            } else if ("boolean" == typeof f && (n.data(c + ".response." + e, f), this.updateStatus(j ? b : n, f ? this.STATUS_VALID : this.STATUS_INVALID, e), !f && !l))break
                        } else this.updateStatus(j ? b : n, this.STATUS_VALID, e); else this._onFieldValidated(n, e)
                    }
                }
            }
            return this
        }, addField: function (b, c) {
            var d = this._namespace, e = a([]);
            switch (typeof b) {
                case"object":
                    e = b, b = b.attr("data-" + d + "-field") || b.attr("name");
                    break;
                case"string":
                    delete this._cacheFields[b], e = this.getFieldElements(b)
            }
            e.attr("data-" + d + "-field", b);
            for (var f = e.attr("type"), g = "radio" === f || "checkbox" === f ? 1 : e.length, h = 0; g > h; h++) {
                var i = e.eq(h), j = this._parseOptions(i);
                j = null === j ? c : a.extend(!0, c, j), this.options.fields[b] = a.extend(!0, this.options.fields[b], j), this._cacheFields[b] = this._cacheFields[b] ? this._cacheFields[b].add(i) : i, this._initField("checkbox" === f || "radio" === f ? b : i)
            }
            return this.disableSubmitButtons(!1), this.$form.trigger(a.Event(this.options.events.fieldAdded), {
                field: b,
                element: e,
                options: this.options.fields[b]
            }), this
        }, destroy: function () {
            var a, b, c, d, e, f, g, h = this._namespace;
            for (b in this.options.fields)for (c = this.getFieldElements(b), a = 0; a < c.length; a++) {
                d = c.eq(a);
                for (e in this.options.fields[b].validators)d.data(h + ".dfs." + e) && d.data(h + ".dfs." + e).reject(), d.removeData(h + ".result." + e).removeData(h + ".response." + e).removeData(h + ".dfs." + e), "function" == typeof FormValidation.Validator[e].destroy && FormValidation.Validator[e].destroy(this, d, this.options.fields[b].validators[e])
            }
            for (b in this.options.fields)for (c = this.getFieldElements(b), g = this.options.fields[b].row || this.options.row.selector, a = 0; a < c.length; a++) {
                d = c.eq(a), d.data(h + ".messages").find("." + this.options.err.clazz.split(" ").join(".") + "[data-" + h + "-validator][data-" + h + '-for="' + b + '"]').remove().end().end().removeData(h + ".messages").closest(g).removeClass(this.options.row.valid).removeClass(this.options.row.invalid).removeClass(this.options.row.feedback).end().off("." + h).removeAttr("data-" + h + "-field");
                var i = "function" == typeof(this.options.fields[b].container || this.options.fields[b].err || this.options.err.container) ? (this.options.fields[b].container || this.options.fields[b].err || this.options.err.container).call(this, d, this) : this.options.fields[b].container || this.options.fields[b].err || this.options.err.container;
                ("tooltip" === i || "popover" === i) && this._destroyTooltip(d, i), f = d.data(h + ".icon"), f && f.remove(), d.removeData(h + ".icon").removeData(h + ".trigger")
            }
            for (var j in this.options.addOns)"function" == typeof FormValidation.AddOn[j].destroy && FormValidation.AddOn[j].destroy(this, this.options.addOns[j]);
            this.disableSubmitButtons(!1), this.$hiddenButton.remove(), this.$form.removeClass(this.options.elementClass).off("." + h).removeData("bootstrapValidator").removeData("formValidation").find("[data-" + h + "-submit-hidden]").remove().end().find('[type="submit"]').off("click." + h)
        }, enableFieldValidators: function (a, b, c) {
            var d = this.options.fields[a].validators;
            if (c && d && d[c] && d[c].enabled !== b)this.options.fields[a].validators[c].enabled = b, this.updateStatus(a, this.STATUS_NOT_VALIDATED, c); else if (!c && this.options.fields[a].enabled !== b) {
                this.options.fields[a].enabled = b;
                for (var e in d)this.enableFieldValidators(a, b, e)
            }
            return this
        }, getDynamicOption: function (a, b) {
            var c = "string" == typeof a ? this.getFieldElements(a) : a, d = c.val();
            if ("function" == typeof b)return FormValidation.Helper.call(b, [d, this, c]);
            if ("string" == typeof b) {
                var e = this.getFieldElements(b);
                return e.length ? e.val() : FormValidation.Helper.call(b, [d, this, c]) || b
            }
            return null
        }, getForm: function () {
            return this.$form
        }, getInvalidFields: function () {
            return this.$invalidFields
        }, getLocale: function () {
            return this.options.locale
        }, getMessages: function (b, c) {
            var d = this, e = this._namespace, f = [], g = a([]);
            switch (!0) {
                case b && "object" == typeof b:
                    g = b;
                    break;
                case b && "string" == typeof b:
                    var h = this.getFieldElements(b);
                    if (h.length > 0) {
                        var i = h.attr("type");
                        g = "radio" === i || "checkbox" === i ? h.eq(0) : h
                    }
                    break;
                default:
                    g = this.$invalidFields
            }
            var j = c ? "[data-" + e + '-validator="' + c + '"]' : "";
            return g.each(function () {
                f = f.concat(a(this).data(e + ".messages").find("." + d.options.err.clazz + "[data-" + e + '-for="' + a(this).attr("data-" + e + "-field") + '"][data-' + e + '-result="' + d.STATUS_INVALID + '"]' + j).map(function () {
                    var b = a(this).attr("data-" + e + "-validator"), c = a(this).attr("data-" + e + "-for");
                    return d.options.fields[c].validators[b].enabled === !1 ? "" : a(this).html()
                }).get())
            }), f
        }, getSubmitButton: function () {
            return this.$submitButton
        }, removeField: function (b) {
            var c = this._namespace, d = a([]);
            switch (typeof b) {
                case"object":
                    d = b, b = b.attr("data-" + c + "-field") || b.attr("name"), d.attr("data-" + c + "-field", b);
                    break;
                case"string":
                    d = this.getFieldElements(b)
            }
            if (0 === d.length)return this;
            for (var e = d.attr("type"), f = "radio" === e || "checkbox" === e ? 1 : d.length, g = 0; f > g; g++) {
                var h = d.eq(g);
                this.$invalidFields = this.$invalidFields.not(h), this._cacheFields[b] = this._cacheFields[b].not(h)
            }
            return this._cacheFields[b] && 0 !== this._cacheFields[b].length || delete this.options.fields[b], ("checkbox" === e || "radio" === e) && this._initField(b), this.disableSubmitButtons(!1), this.$form.trigger(a.Event(this.options.events.fieldRemoved), {
                field: b,
                element: d
            }), this
        }, resetField: function (b, c) {
            var d = this._namespace, e = a([]);
            switch (typeof b) {
                case"object":
                    e = b, b = b.attr("data-" + d + "-field");
                    break;
                case"string":
                    e = this.getFieldElements(b)
            }
            var f = e.length;
            if (this.options.fields[b])for (var g = 0; f > g; g++)for (var h in this.options.fields[b].validators)e.eq(g).removeData(d + ".dfs." + h);
            if (this.updateStatus(b, this.STATUS_NOT_VALIDATED), c) {
                var i = e.attr("type");
                "radio" === i || "checkbox" === i ? e.removeAttr("checked").removeAttr("selected") : e.val("")
            }
            return this
        }, resetForm: function (b) {
            for (var c in this.options.fields)this.resetField(c, b);
            return this.$invalidFields = a([]), this.$submitButton = null, this.disableSubmitButtons(!1), this
        }, revalidateField: function (a) {
            return this.updateStatus(a, this.STATUS_NOT_VALIDATED).validateField(a), this
        }, setLocale: function (b) {
            return this.options.locale = b, this.$form.trigger(a.Event(this.options.events.localeChanged), {
                locale: b,
                bv: this,
                fv: this
            }), this
        }, updateOption: function (a, b, c, d) {
            var e = this._namespace;
            return "object" == typeof a && (a = a.attr("data-" + e + "-field")), this.options.fields[a] && this.options.fields[a].validators[b] && (this.options.fields[a].validators[b][c] = d, this.updateStatus(a, this.STATUS_NOT_VALIDATED, b)), this
        }, validateContainer: function (b) {
            var c = this, d = this._namespace, e = {}, f = "string" == typeof b ? a(b) : b;
            if (0 === f.length)return this;
            f.find("[data-" + d + "-field]").each(function () {
                var b = a(this), f = b.attr("data-" + d + "-field");
                c._isExcluded(b) || e[f] || (e[f] = b)
            });
            for (var g in e)this.validateField(e[g]);
            return this
        }
    }, a.fn.formValidation = function (b) {
        var c = arguments;
        return this.each(function () {
            var d = a(this), e = d.data("formValidation"), f = "object" == typeof b && b;
            if (!e) {
                var g = (f.framework || d.attr("data-fv-framework") || "bootstrap").toLowerCase();
                switch (g) {
                    case"foundation":
                        e = new FormValidation.Framework.Foundation(this, f);
                        break;
                    case"pure":
                        e = new FormValidation.Framework.Pure(this, f);
                        break;
                    case"semantic":
                        e = new FormValidation.Framework.Semantic(this, f);
                        break;
                    case"uikit":
                        e = new FormValidation.Framework.UIKit(this, f);
                        break;
                    case"bootstrap":
                    default:
                        e = new FormValidation.Framework.Bootstrap(this, f)
                }
                d.addClass("fv-form-" + g).data("formValidation", e)
            }
            "string" == typeof b && e[b].apply(e, Array.prototype.slice.call(c, 1))
        })
    }, a.fn.formValidation.Constructor = FormValidation.Base, a.fn.formValidation.DEFAULT_OPTIONS = {
        autoFocus: !0,
        elementClass: "fv-form",
        events: {
            formInit: "init.form.fv",
            formError: "err.form.fv",
            formSuccess: "success.form.fv",
            fieldAdded: "added.field.fv",
            fieldRemoved: "removed.field.fv",
            fieldInit: "init.field.fv",
            fieldError: "err.field.fv",
            fieldSuccess: "success.field.fv",
            fieldStatus: "status.field.fv",
            localeChanged: "changed.locale.fv",
            validatorError: "err.validator.fv",
            validatorSuccess: "success.validator.fv"
        },
        excluded: [":disabled", ":hidden", ":not(:visible)"],
        fields: null,
        live: "enabled",
        locale: "en_US",
        message: "This value is not valid",
        threshold: null,
        verbose: !0,
        button: {selector: '[type="submit"]', disabled: ""},
        control: {valid: "", invalid: ""},
        err: {clazz: "", container: null, parent: null},
        icon: {valid: null, invalid: null, validating: null, feedback: ""},
        row: {selector: null, valid: "", invalid: "", feedback: ""}
    }
}(jQuery), function (a) {
    FormValidation.Helper = {
        call: function (a, b) {
            if ("function" == typeof a)return a.apply(this, b);
            if ("string" == typeof a) {
                "()" === a.substring(a.length - 2) && (a = a.substring(0, a.length - 2));
                for (var c = a.split("."), d = c.pop(), e = window, f = 0; f < c.length; f++)e = e[c[f]];
                return "undefined" == typeof e[d] ? null : e[d].apply(this, b)
            }
        }, date: function (a, b, c, d) {
            if (isNaN(a) || isNaN(b) || isNaN(c))return !1;
            if (c.length > 2 || b.length > 2 || a.length > 4)return !1;
            if (c = parseInt(c, 10), b = parseInt(b, 10), a = parseInt(a, 10), 1e3 > a || a > 9999 || 0 >= b || b > 12)return !1;
            var e = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            if ((a % 400 === 0 || a % 100 !== 0 && a % 4 === 0) && (e[1] = 29), 0 >= c || c > e[b - 1])return !1;
            if (d === !0) {
                var f = new Date, g = f.getFullYear(), h = f.getMonth(), i = f.getDate();
                return g > a || a === g && h > b - 1 || a === g && b - 1 === h && i > c
            }
            return !0
        }, format: function (b, c) {
            a.isArray(c) || (c = [c]);
            for (var d in c)b = b.replace("%s", c[d]);
            return b
        }, luhn: function (a) {
            for (var b = a.length, c = 0, d = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [0, 2, 4, 6, 8, 1, 3, 5, 7, 9]], e = 0; b--;)e += d[c][parseInt(a.charAt(b), 10)], c ^= 1;
            return e % 10 === 0 && e > 0
        }, mod11And10: function (a) {
            for (var b = 5, c = a.length, d = 0; c > d; d++)b = (2 * (b || 10) % 11 + parseInt(a.charAt(d), 10)) % 10;
            return 1 === b
        }, mod37And36: function (a, b) {
            b = b || "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            for (var c = b.length, d = a.length, e = Math.floor(c / 2), f = 0; d > f; f++)e = (2 * (e || c) % (c + 1) + b.indexOf(a.charAt(f))) % c;
            return 1 === e
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {base64: {"default": "Please enter a valid base 64 encoded"}}}), FormValidation.Validator.base64 = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "base64");
            return "" === c ? !0 : /^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=|[A-Za-z0-9+/]{4})$/.test(c)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            between: {
                "default": "Please enter a value between %s and %s",
                notInclusive: "Please enter a value between %s and %s strictly"
            }
        }
    }), FormValidation.Validator.between = {
        html5Attributes: {
            message: "message",
            min: "min",
            max: "max",
            inclusive: "inclusive"
        }, enableByHtml5: function (a) {
            return "range" === a.attr("type") ? {min: a.attr("min"), max: a.attr("max")} : !1
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "between");
            if ("" === e)return !0;
            if (e = this._format(e), !a.isNumeric(e))return !1;
            var f = b.getLocale(), g = a.isNumeric(d.min) ? d.min : b.getDynamicOption(c, d.min), h = a.isNumeric(d.max) ? d.max : b.getDynamicOption(c, d.max), i = this._format(g), j = this._format(h);
            return e = parseFloat(e), d.inclusive === !0 || void 0 === d.inclusive ? {
                valid: e >= i && j >= e,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].between["default"], [g, h])
            } : {
                valid: e > i && j > e,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].between.notInclusive, [g, h])
            }
        }, _format: function (a) {
            return (a + "").replace(",", ".")
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {bic: {"default": "Please enter a valid BIC number"}}}), FormValidation.Validator.bic = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "bic");
            return "" === c ? !0 : /^[a-zA-Z]{6}[a-zA-Z0-9]{2}([a-zA-Z0-9]{3})?$/.test(c)
        }
    }
}(jQuery), function () {
    FormValidation.Validator.blank = {
        validate: function () {
            return !0
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {callback: {"default": "Please enter a valid value"}}}), FormValidation.Validator.callback = {
        html5Attributes: {
            message: "message",
            callback: "callback"
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "callback"), f = new a.Deferred, g = {valid: !0};
            if (d.callback) {
                var h = FormValidation.Helper.call(d.callback, [e, b, c]);
                g = "boolean" == typeof h ? {valid: h} : h
            }
            return f.resolve(c, "callback", g), f
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            choice: {
                "default": "Please enter a valid value",
                less: "Please choose %s options at minimum",
                more: "Please choose %s options at maximum",
                between: "Please choose %s - %s options"
            }
        }
    }), FormValidation.Validator.choice = {
        html5Attributes: {message: "message", min: "min", max: "max"},
        validate: function (b, c, d) {
            var e = b.getLocale(), f = b.getNamespace(), g = c.is("select") ? b.getFieldElements(c.attr("data-" + f + "-field")).find("option").filter(":selected").length : b.getFieldElements(c.attr("data-" + f + "-field")).filter(":checked").length, h = d.min ? a.isNumeric(d.min) ? d.min : b.getDynamicOption(c, d.min) : null, i = d.max ? a.isNumeric(d.max) ? d.max : b.getDynamicOption(c, d.max) : null, j = !0, k = d.message || FormValidation.I18n[e].choice["default"];
            switch ((h && g < parseInt(h, 10) || i && g > parseInt(i, 10)) && (j = !1), !0) {
                case!!h && !!i:
                    k = FormValidation.Helper.format(d.message || FormValidation.I18n[e].choice.between, [parseInt(h, 10), parseInt(i, 10)]);
                    break;
                case!!h:
                    k = FormValidation.Helper.format(d.message || FormValidation.I18n[e].choice.less, parseInt(h, 10));
                    break;
                case!!i:
                    k = FormValidation.Helper.format(d.message || FormValidation.I18n[e].choice.more, parseInt(i, 10))
            }
            return {valid: j, message: k}
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {color: {"default": "Please enter a valid color"}}}), FormValidation.Validator.color = {
        html5Attributes: {
            message: "message",
            type: "type"
        },
        enableByHtml5: function (a) {
            return "color" === a.attr("type")
        },
        SUPPORTED_TYPES: ["hex", "rgb", "rgba", "hsl", "hsla", "keyword"],
        KEYWORD_COLORS: ["aliceblue", "antiquewhite", "aqua", "aquamarine", "azure", "beige", "bisque", "black", "blanchedalmond", "blue", "blueviolet", "brown", "burlywood", "cadetblue", "chartreuse", "chocolate", "coral", "cornflowerblue", "cornsilk", "crimson", "cyan", "darkblue", "darkcyan", "darkgoldenrod", "darkgray", "darkgreen", "darkgrey", "darkkhaki", "darkmagenta", "darkolivegreen", "darkorange", "darkorchid", "darkred", "darksalmon", "darkseagreen", "darkslateblue", "darkslategray", "darkslategrey", "darkturquoise", "darkviolet", "deeppink", "deepskyblue", "dimgray", "dimgrey", "dodgerblue", "firebrick", "floralwhite", "forestgreen", "fuchsia", "gainsboro", "ghostwhite", "gold", "goldenrod", "gray", "green", "greenyellow", "grey", "honeydew", "hotpink", "indianred", "indigo", "ivory", "khaki", "lavender", "lavenderblush", "lawngreen", "lemonchiffon", "lightblue", "lightcoral", "lightcyan", "lightgoldenrodyellow", "lightgray", "lightgreen", "lightgrey", "lightpink", "lightsalmon", "lightseagreen", "lightskyblue", "lightslategray", "lightslategrey", "lightsteelblue", "lightyellow", "lime", "limegreen", "linen", "magenta", "maroon", "mediumaquamarine", "mediumblue", "mediumorchid", "mediumpurple", "mediumseagreen", "mediumslateblue", "mediumspringgreen", "mediumturquoise", "mediumvioletred", "midnightblue", "mintcream", "mistyrose", "moccasin", "navajowhite", "navy", "oldlace", "olive", "olivedrab", "orange", "orangered", "orchid", "palegoldenrod", "palegreen", "paleturquoise", "palevioletred", "papayawhip", "peachpuff", "peru", "pink", "plum", "powderblue", "purple", "red", "rosybrown", "royalblue", "saddlebrown", "salmon", "sandybrown", "seagreen", "seashell", "sienna", "silver", "skyblue", "slateblue", "slategray", "slategrey", "snow", "springgreen", "steelblue", "tan", "teal", "thistle", "tomato", "transparent", "turquoise", "violet", "wheat", "white", "whitesmoke", "yellow", "yellowgreen"],
        validate: function (b, c, d) {
            var e = b.getFieldValue(c, "color");
            if ("" === e)return !0;
            if (this.enableByHtml5(c))return /^#[0-9A-F]{6}$/i.test(e);
            var f = d.type || this.SUPPORTED_TYPES;
            a.isArray(f) || (f = f.replace(/s/g, "").split(","));
            for (var g, h, i = !1, j = 0; j < f.length; j++)if (h = f[j], g = "_" + h.toLowerCase(), i = i || this[g](e))return !0;
            return !1
        },
        _hex: function (a) {
            return /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a)
        },
        _hsl: function (a) {
            return /^hsl\((\s*(-?\d+)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*)\)$/.test(a)
        },
        _hsla: function (a) {
            return /^hsla\((\s*(-?\d+)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*,){2}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/.test(a)
        },
        _keyword: function (b) {
            return a.inArray(b, this.KEYWORD_COLORS) >= 0
        },
        _rgb: function (a) {
            var b = /^rgb\((\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*,){2}(\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*)\)$/, c = /^rgb\((\s*(\b(0?\d{1,2}|100)\b%)\s*,){2}(\s*(\b(0?\d{1,2}|100)\b%)\s*)\)$/;
            return b.test(a) || c.test(a)
        },
        _rgba: function (a) {
            var b = /^rgba\((\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*,){3}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/, c = /^rgba\((\s*(\b(0?\d{1,2}|100)\b%)\s*,){3}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/;
            return b.test(a) || c.test(a)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {creditCard: {"default": "Please enter a valid credit card number"}}}), FormValidation.Validator.creditCard = {
        validate: function (b, c) {
            var d = b.getFieldValue(c, "creditCard");
            if ("" === d)return !0;
            if (/[^0-9-\s]+/.test(d))return !1;
            if (d = d.replace(/\D/g, ""), !FormValidation.Helper.luhn(d))return !1;
            var e, f, g = {
                AMERICAN_EXPRESS: {length: [15], prefix: ["34", "37"]},
                DINERS_CLUB: {length: [14], prefix: ["300", "301", "302", "303", "304", "305", "36"]},
                DINERS_CLUB_US: {length: [16], prefix: ["54", "55"]},
                DISCOVER: {
                    length: [16],
                    prefix: ["6011", "622126", "622127", "622128", "622129", "62213", "62214", "62215", "62216", "62217", "62218", "62219", "6222", "6223", "6224", "6225", "6226", "6227", "6228", "62290", "62291", "622920", "622921", "622922", "622923", "622924", "622925", "644", "645", "646", "647", "648", "649", "65"]
                },
                JCB: {length: [16], prefix: ["3528", "3529", "353", "354", "355", "356", "357", "358"]},
                LASER: {length: [16, 17, 18, 19], prefix: ["6304", "6706", "6771", "6709"]},
                MAESTRO: {
                    length: [12, 13, 14, 15, 16, 17, 18, 19],
                    prefix: ["5018", "5020", "5038", "6304", "6759", "6761", "6762", "6763", "6764", "6765", "6766"]
                },
                MASTERCARD: {length: [16], prefix: ["51", "52", "53", "54", "55"]},
                SOLO: {length: [16, 18, 19], prefix: ["6334", "6767"]},
                UNIONPAY: {
                    length: [16, 17, 18, 19],
                    prefix: ["622126", "622127", "622128", "622129", "62213", "62214", "62215", "62216", "62217", "62218", "62219", "6222", "6223", "6224", "6225", "6226", "6227", "6228", "62290", "62291", "622920", "622921", "622922", "622923", "622924", "622925"]
                },
                VISA: {length: [16], prefix: ["4"]}
            };
            for (e in g)for (f in g[e].prefix)if (d.substr(0, g[e].prefix[f].length) === g[e].prefix[f] && -1 !== a.inArray(d.length, g[e].length))return {
                valid: !0,
                type: e
            };
            return !1
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {cusip: {"default": "Please enter a valid CUSIP number"}}}), FormValidation.Validator.cusip = {
        validate: function (b, c) {
            var d = b.getFieldValue(c, "cusip");
            if ("" === d)return !0;
            if (d = d.toUpperCase(), !/^[0-9A-Z]{9}$/.test(d))return !1;
            for (var e = a.map(d.split(""), function (a) {
                var b = a.charCodeAt(0);
                return b >= "A".charCodeAt(0) && b <= "Z".charCodeAt(0) ? b - "A".charCodeAt(0) + 10 : a
            }), f = e.length, g = 0, h = 0; f - 1 > h; h++) {
                var i = parseInt(e[h], 10);
                h % 2 !== 0 && (i *= 2), i > 9 && (i -= 9), g += i
            }
            return g = (10 - g % 10) % 10, g === parseInt(e[f - 1], 10)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {cvv: {"default": "Please enter a valid CVV number"}}}), FormValidation.Validator.cvv = {
        html5Attributes: {
            message: "message",
            ccfield: "creditCardField"
        }, init: function (a, b, c) {
            if (c.creditCardField) {
                var d = a.getFieldElements(c.creditCardField);
                a.onLiveChange(d, "live_cvv", function () {
                    var c = a.getStatus(b, "cvv");
                    c !== a.STATUS_NOT_VALIDATED && a.revalidateField(b)
                })
            }
        }, destroy: function (a, b, c) {
            if (c.creditCardField) {
                var d = a.getFieldElements(c.creditCardField);
                a.offLiveChange(d, "live_cvv")
            }
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "cvv");
            if ("" === e)return !0;
            if (!/^[0-9]{3,4}$/.test(e))return !1;
            if (!d.creditCardField)return !0;
            var f = b.getFieldElements(d.creditCardField).val();
            if ("" === f)return !0;
            f = f.replace(/\D/g, "");
            var g, h, i = {
                AMERICAN_EXPRESS: {length: [15], prefix: ["34", "37"]},
                DINERS_CLUB: {length: [14], prefix: ["300", "301", "302", "303", "304", "305", "36"]},
                DINERS_CLUB_US: {length: [16], prefix: ["54", "55"]},
                DISCOVER: {
                    length: [16],
                    prefix: ["6011", "622126", "622127", "622128", "622129", "62213", "62214", "62215", "62216", "62217", "62218", "62219", "6222", "6223", "6224", "6225", "6226", "6227", "6228", "62290", "62291", "622920", "622921", "622922", "622923", "622924", "622925", "644", "645", "646", "647", "648", "649", "65"]
                },
                JCB: {length: [16], prefix: ["3528", "3529", "353", "354", "355", "356", "357", "358"]},
                LASER: {length: [16, 17, 18, 19], prefix: ["6304", "6706", "6771", "6709"]},
                MAESTRO: {
                    length: [12, 13, 14, 15, 16, 17, 18, 19],
                    prefix: ["5018", "5020", "5038", "6304", "6759", "6761", "6762", "6763", "6764", "6765", "6766"]
                },
                MASTERCARD: {length: [16], prefix: ["51", "52", "53", "54", "55"]},
                SOLO: {length: [16, 18, 19], prefix: ["6334", "6767"]},
                UNIONPAY: {
                    length: [16, 17, 18, 19],
                    prefix: ["622126", "622127", "622128", "622129", "62213", "62214", "62215", "62216", "62217", "62218", "62219", "6222", "6223", "6224", "6225", "6226", "6227", "6228", "62290", "62291", "622920", "622921", "622922", "622923", "622924", "622925"]
                },
                VISA: {length: [16], prefix: ["4"]}
            }, j = null;
            for (g in i)for (h in i[g].prefix)if (f.substr(0, i[g].prefix[h].length) === i[g].prefix[h] && -1 !== a.inArray(f.length, i[g].length)) {
                j = g;
                break
            }
            return null === j ? !1 : "AMERICAN_EXPRESS" === j ? 4 === e.length : 3 === e.length
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            date: {
                "default": "Please enter a valid date",
                min: "Please enter a date after %s",
                max: "Please enter a date before %s",
                range: "Please enter a date in the range %s - %s"
            }
        }
    }), FormValidation.Validator.date = {
        html5Attributes: {
            message: "message",
            format: "format",
            min: "min",
            max: "max",
            separator: "separator"
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "date");
            if ("" === e)return !0;
            d.format = d.format || "MM/DD/YYYY", "date" === c.attr("type") && (d.format = "YYYY-MM-DD");
            var f = b.getLocale(), g = d.message || FormValidation.I18n[f].date["default"], h = d.format.split(" "), i = h[0], j = h.length > 1 ? h[1] : null, k = h.length > 2 ? h[2] : null, l = e.split(" "), m = l[0], n = l.length > 1 ? l[1] : null;
            if (h.length !== l.length)return {valid: !1, message: g};
            var o = d.separator;
            if (o || (o = -1 !== m.indexOf("/") ? "/" : -1 !== m.indexOf("-") ? "-" : null), null === o || -1 === m.indexOf(o))return {
                valid: !1,
                message: g
            };
            if (m = m.split(o), i = i.split(o), m.length !== i.length)return {valid: !1, message: g};
            var p = m[a.inArray("YYYY", i)], q = m[a.inArray("MM", i)], r = m[a.inArray("DD", i)];
            if (!p || !q || !r || 4 !== p.length)return {valid: !1, message: g};
            var s = null, t = null, u = null;
            if (j) {
                if (j = j.split(":"), n = n.split(":"), j.length !== n.length)return {valid: !1, message: g};
                if (t = n.length > 0 ? n[0] : null, s = n.length > 1 ? n[1] : null, u = n.length > 2 ? n[2] : null, "" === t || "" === s || "" === u)return {
                    valid: !1,
                    message: g
                };
                if (u) {
                    if (isNaN(u) || u.length > 2)return {valid: !1, message: g};
                    if (u = parseInt(u, 10), 0 > u || u > 60)return {valid: !1, message: g}
                }
                if (t) {
                    if (isNaN(t) || t.length > 2)return {valid: !1, message: g};
                    if (t = parseInt(t, 10), 0 > t || t >= 24 || k && t > 12)return {valid: !1, message: g}
                }
                if (s) {
                    if (isNaN(s) || s.length > 2)return {valid: !1, message: g};
                    if (s = parseInt(s, 10), 0 > s || s > 59)return {valid: !1, message: g}
                }
            }
            var v = FormValidation.Helper.date(p, q, r), w = null, x = null, y = d.min, z = d.max;
            switch (y && (isNaN(Date.parse(y)) && (y = b.getDynamicOption(c, y)), w = y instanceof Date ? y : this._parseDate(y, i, o), y = y instanceof Date ? this._formatDate(y, d.format) : y), z && (isNaN(Date.parse(z)) && (z = b.getDynamicOption(c, z)), x = z instanceof Date ? z : this._parseDate(z, i, o), z = z instanceof Date ? this._formatDate(z, d.format) : z), m = new Date(p, q - 1, r, t, s, u), !0) {
                case y && !z && v:
                    v = m.getTime() >= w.getTime(), g = d.message || FormValidation.Helper.format(FormValidation.I18n[f].date.min, y);
                    break;
                case z && !y && v:
                    v = m.getTime() <= x.getTime(), g = d.message || FormValidation.Helper.format(FormValidation.I18n[f].date.max, z);
                    break;
                case z && y && v:
                    v = m.getTime() <= x.getTime() && m.getTime() >= w.getTime(), g = d.message || FormValidation.Helper.format(FormValidation.I18n[f].date.range, [y, z])
            }
            return {valid: v, message: g}
        }, _parseDate: function (b, c, d) {
            var e = 0, f = 0, g = 0, h = b.split(" "), i = h[0], j = h.length > 1 ? h[1] : null;
            i = i.split(d);
            var k = i[a.inArray("YYYY", c)], l = i[a.inArray("MM", c)], m = i[a.inArray("DD", c)];
            return j && (j = j.split(":"), f = j.length > 0 ? j[0] : null, e = j.length > 1 ? j[1] : null, g = j.length > 2 ? j[2] : null), new Date(k, l - 1, m, f, e, g)
        }, _formatDate: function (a, b) {
            b = b.replace(/Y/g, "y").replace(/M/g, "m").replace(/D/g, "d").replace(/:m/g, ":M").replace(/:mm/g, ":MM").replace(/:S/, ":s").replace(/:SS/, ":ss");
            var c = {
                d: function (a) {
                    return a.getDate()
                }, dd: function (a) {
                    var b = a.getDate();
                    return 10 > b ? "0" + b : b
                }, m: function (a) {
                    return a.getMonth() + 1
                }, mm: function (a) {
                    var b = a.getMonth() + 1;
                    return 10 > b ? "0" + b : b
                }, yy: function (a) {
                    return ("" + a.getFullYear()).substr(2)
                }, yyyy: function (a) {
                    return a.getFullYear()
                }, h: function (a) {
                    return a.getHours() % 12 || 12
                }, hh: function (a) {
                    var b = a.getHours() % 12 || 12;
                    return 10 > b ? "0" + b : b
                }, H: function (a) {
                    return a.getHours()
                }, HH: function (a) {
                    var b = a.getHours();
                    return 10 > b ? "0" + b : b
                }, M: function (a) {
                    return a.getMinutes()
                }, MM: function (a) {
                    var b = a.getMinutes();
                    return 10 > b ? "0" + b : b
                }, s: function (a) {
                    return a.getSeconds()
                }, ss: function (a) {
                    var b = a.getSeconds();
                    return 10 > b ? "0" + b : b
                }
            };
            return b.replace(/d{1,4}|m{1,4}|yy(?:yy)?|([HhMs])\1?|"[^"]*"|'[^']*'/g, function (b) {
                return c[b] ? c[b](a) : b.slice(1, b.length - 1)
            })
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {different: {"default": "Please enter a different value"}}}), FormValidation.Validator.different = {
        html5Attributes: {
            message: "message",
            field: "field"
        }, init: function (a, b, c) {
            for (var d = c.field.split(","), e = 0; e < d.length; e++) {
                var f = a.getFieldElements(d[e]);
                a.onLiveChange(f, "live_different", function () {
                    var c = a.getStatus(b, "different");
                    c !== a.STATUS_NOT_VALIDATED && a.revalidateField(b)
                })
            }
        }, destroy: function (a, b, c) {
            for (var d = c.field.split(","), e = 0; e < d.length; e++) {
                var f = a.getFieldElements(d[e]);
                a.offLiveChange(f, "live_different")
            }
        }, validate: function (a, b, c) {
            var d = a.getFieldValue(b, "different");
            if ("" === d)return !0;
            for (var e = c.field.split(","), f = !0, g = 0; g < e.length; g++) {
                var h = a.getFieldElements(e[g]);
                if (null != h && 0 !== h.length) {
                    var i = a.getFieldValue(h, "different");
                    d === i ? f = !1 : "" !== i && a.updateStatus(h, a.STATUS_VALID, "different")
                }
            }
            return f
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {digits: {"default": "Please enter only digits"}}}), FormValidation.Validator.digits = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "digits");
            return "" === c ? !0 : /^\d+$/.test(c)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {ean: {"default": "Please enter a valid EAN number"}}}), FormValidation.Validator.ean = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "ean");
            if ("" === c)return !0;
            if (!/^(\d{8}|\d{12}|\d{13})$/.test(c))return !1;
            for (var d = c.length, e = 0, f = 8 === d ? [3, 1] : [1, 3], g = 0; d - 1 > g; g++)e += parseInt(c.charAt(g), 10) * f[g % 2];
            return e = (10 - e % 10) % 10, e + "" === c.charAt(d - 1)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {ein: {"default": "Please enter a valid EIN number"}}}), FormValidation.Validator.ein = {
        CAMPUS: {
            ANDOVER: ["10", "12"],
            ATLANTA: ["60", "67"],
            AUSTIN: ["50", "53"],
            BROOKHAVEN: ["01", "02", "03", "04", "05", "06", "11", "13", "14", "16", "21", "22", "23", "25", "34", "51", "52", "54", "55", "56", "57", "58", "59", "65"],
            CINCINNATI: ["30", "32", "35", "36", "37", "38", "61"],
            FRESNO: ["15", "24"],
            KANSAS_CITY: ["40", "44"],
            MEMPHIS: ["94", "95"],
            OGDEN: ["80", "90"],
            PHILADELPHIA: ["33", "39", "41", "42", "43", "46", "48", "62", "63", "64", "66", "68", "71", "72", "73", "74", "75", "76", "77", "81", "82", "83", "84", "85", "86", "87", "88", "91", "92", "93", "98", "99"],
            INTERNET: ["20", "26", "27", "45", "46"],
            SMALL_BUSINESS_ADMINISTRATION: ["31"]
        }, validate: function (b, c) {
            var d = b.getFieldValue(c, "ein");
            if ("" === d)return !0;
            if (!/^[0-9]{2}-?[0-9]{7}$/.test(d))return !1;
            var e = d.substr(0, 2) + "";
            for (var f in this.CAMPUS)if (-1 !== a.inArray(e, this.CAMPUS[f]))return {valid: !0, campus: f};
            return !1
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {emailAddress: {"default": "Please enter a valid email address"}}}), FormValidation.Validator.emailAddress = {
        html5Attributes: {
            message: "message",
            multiple: "multiple",
            separator: "separator"
        }, enableByHtml5: function (a) {
            return "email" === a.attr("type")
        }, validate: function (a, b, c) {
            var d = a.getFieldValue(b, "emailAddress");
            if ("" === d)return !0;
            var e = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/, f = c.multiple === !0 || "true" === c.multiple;
            if (f) {
                for (var g = c.separator || /[,;]/, h = this._splitEmailAddresses(d, g), i = 0; i < h.length; i++)if (!e.test(h[i]))return !1;
                return !0
            }
            return e.test(d)
        }, _splitEmailAddresses: function (a, b) {
            for (var c = a.split(/"/), d = c.length, e = [], f = "", g = 0; d > g; g++)if (g % 2 === 0) {
                var h = c[g].split(b), i = h.length;
                if (1 === i)f += h[0]; else {
                    e.push(f + h[0]);
                    for (var j = 1; i - 1 > j; j++)e.push(h[j]);
                    f = h[i - 1]
                }
            } else f += '"' + c[g], d - 1 > g && (f += '"');
            return e.push(f), e
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {file: {"default": "Please choose a valid file"}}}), FormValidation.Validator.file = {
        html5Attributes: {
            extension: "extension",
            maxfiles: "maxFiles",
            minfiles: "minFiles",
            maxsize: "maxSize",
            minsize: "minSize",
            maxtotalsize: "maxTotalSize",
            mintotalsize: "minTotalSize",
            message: "message",
            type: "type"
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "file");
            if ("" === e)return !0;
            var f, g = d.extension ? d.extension.toLowerCase().split(",") : null, h = d.type ? d.type.toLowerCase().split(",") : null, i = window.File && window.FileList && window.FileReader;
            if (i) {
                var j = c.get(0).files, k = j.length, l = 0;
                if (d.maxFiles && k > parseInt(d.maxFiles, 10) || d.minFiles && k < parseInt(d.minFiles, 10))return !1;
                for (var m = 0; k > m; m++)if (l += j[m].size, f = j[m].name.substr(j[m].name.lastIndexOf(".") + 1), d.minSize && j[m].size < parseInt(d.minSize, 10) || d.maxSize && j[m].size > parseInt(d.maxSize, 10) || g && -1 === a.inArray(f.toLowerCase(), g) || j[m].type && h && -1 === a.inArray(j[m].type.toLowerCase(), h))return !1;
                if (d.maxTotalSize && l > parseInt(d.maxTotalSize, 10) || d.minTotalSize && l < parseInt(d.minTotalSize, 10))return !1
            } else if (f = e.substr(e.lastIndexOf(".") + 1), g && -1 === a.inArray(f.toLowerCase(), g))return !1;
            return !0
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            greaterThan: {
                "default": "Please enter a value greater than or equal to %s",
                notInclusive: "Please enter a value greater than %s"
            }
        }
    }), FormValidation.Validator.greaterThan = {
        html5Attributes: {
            message: "message",
            value: "value",
            inclusive: "inclusive"
        }, enableByHtml5: function (a) {
            var b = a.attr("type"), c = a.attr("min");
            return c && "date" !== b ? {value: c} : !1
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "greaterThan");
            if ("" === e)return !0;
            if (e = this._format(e), !a.isNumeric(e))return !1;
            var f = b.getLocale(), g = a.isNumeric(d.value) ? d.value : b.getDynamicOption(c, d.value), h = this._format(g);
            return e = parseFloat(e), d.inclusive === !0 || void 0 === d.inclusive ? {
                valid: e >= h,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].greaterThan["default"], g)
            } : {
                valid: e > h,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].greaterThan.notInclusive, g)
            }
        }, _format: function (a) {
            return (a + "").replace(",", ".")
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {grid: {"default": "Please enter a valid GRId number"}}}), FormValidation.Validator.grid = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "grid");
            return "" === c ? !0 : (c = c.toUpperCase(), /^[GRID:]*([0-9A-Z]{2})[-\s]*([0-9A-Z]{5})[-\s]*([0-9A-Z]{10})[-\s]*([0-9A-Z]{1})$/g.test(c) ? (c = c.replace(/\s/g, "").replace(/-/g, ""), "GRID:" === c.substr(0, 5) && (c = c.substr(5)), FormValidation.Helper.mod37And36(c)) : !1)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {hex: {"default": "Please enter a valid hexadecimal number"}}}), FormValidation.Validator.hex = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "hex");
            return "" === c ? !0 : /^[0-9a-fA-F]+$/.test(c)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            iban: {
                "default": "Please enter a valid IBAN number",
                country: "Please enter a valid IBAN number in %s",
                countries: {
                    AD: "Andorra",
                    AE: "United Arab Emirates",
                    AL: "Albania",
                    AO: "Angola",
                    AT: "Austria",
                    AZ: "Azerbaijan",
                    BA: "Bosnia and Herzegovina",
                    BE: "Belgium",
                    BF: "Burkina Faso",
                    BG: "Bulgaria",
                    BH: "Bahrain",
                    BI: "Burundi",
                    BJ: "Benin",
                    BR: "Brazil",
                    CH: "Switzerland",
                    CI: "Ivory Coast",
                    CM: "Cameroon",
                    CR: "Costa Rica",
                    CV: "Cape Verde",
                    CY: "Cyprus",
                    CZ: "Czech Republic",
                    DE: "Germany",
                    DK: "Denmark",
                    DO: "Dominican Republic",
                    DZ: "Algeria",
                    EE: "Estonia",
                    ES: "Spain",
                    FI: "Finland",
                    FO: "Faroe Islands",
                    FR: "France",
                    GB: "United Kingdom",
                    GE: "Georgia",
                    GI: "Gibraltar",
                    GL: "Greenland",
                    GR: "Greece",
                    GT: "Guatemala",
                    HR: "Croatia",
                    HU: "Hungary",
                    IE: "Ireland",
                    IL: "Israel",
                    IR: "Iran",
                    IS: "Iceland",
                    IT: "Italy",
                    JO: "Jordan",
                    KW: "Kuwait",
                    KZ: "Kazakhstan",
                    LB: "Lebanon",
                    LI: "Liechtenstein",
                    LT: "Lithuania",
                    LU: "Luxembourg",
                    LV: "Latvia",
                    MC: "Monaco",
                    MD: "Moldova",
                    ME: "Montenegro",
                    MG: "Madagascar",
                    MK: "Macedonia",
                    ML: "Mali",
                    MR: "Mauritania",
                    MT: "Malta",
                    MU: "Mauritius",
                    MZ: "Mozambique",
                    NL: "Netherlands",
                    NO: "Norway",
                    PK: "Pakistan",
                    PL: "Poland",
                    PS: "Palestine",
                    PT: "Portugal",
                    QA: "Qatar",
                    RO: "Romania",
                    RS: "Serbia",
                    SA: "Saudi Arabia",
                    SE: "Sweden",
                    SI: "Slovenia",
                    SK: "Slovakia",
                    SM: "San Marino",
                    SN: "Senegal",
                    TN: "Tunisia",
                    TR: "Turkey",
                    VG: "Virgin Islands, British"
                }
            }
        }
    }), FormValidation.Validator.iban = {
        html5Attributes: {message: "message", country: "country"},
        REGEX: {
            AD: "AD[0-9]{2}[0-9]{4}[0-9]{4}[A-Z0-9]{12}",
            AE: "AE[0-9]{2}[0-9]{3}[0-9]{16}",
            AL: "AL[0-9]{2}[0-9]{8}[A-Z0-9]{16}",
            AO: "AO[0-9]{2}[0-9]{21}",
            AT: "AT[0-9]{2}[0-9]{5}[0-9]{11}",
            AZ: "AZ[0-9]{2}[A-Z]{4}[A-Z0-9]{20}",
            BA: "BA[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{8}[0-9]{2}",
            BE: "BE[0-9]{2}[0-9]{3}[0-9]{7}[0-9]{2}",
            BF: "BF[0-9]{2}[0-9]{23}",
            BG: "BG[0-9]{2}[A-Z]{4}[0-9]{4}[0-9]{2}[A-Z0-9]{8}",
            BH: "BH[0-9]{2}[A-Z]{4}[A-Z0-9]{14}",
            BI: "BI[0-9]{2}[0-9]{12}",
            BJ: "BJ[0-9]{2}[A-Z]{1}[0-9]{23}",
            BR: "BR[0-9]{2}[0-9]{8}[0-9]{5}[0-9]{10}[A-Z][A-Z0-9]",
            CH: "CH[0-9]{2}[0-9]{5}[A-Z0-9]{12}",
            CI: "CI[0-9]{2}[A-Z]{1}[0-9]{23}",
            CM: "CM[0-9]{2}[0-9]{23}",
            CR: "CR[0-9]{2}[0-9]{3}[0-9]{14}",
            CV: "CV[0-9]{2}[0-9]{21}",
            CY: "CY[0-9]{2}[0-9]{3}[0-9]{5}[A-Z0-9]{16}",
            CZ: "CZ[0-9]{2}[0-9]{20}",
            DE: "DE[0-9]{2}[0-9]{8}[0-9]{10}",
            DK: "DK[0-9]{2}[0-9]{14}",
            DO: "DO[0-9]{2}[A-Z0-9]{4}[0-9]{20}",
            DZ: "DZ[0-9]{2}[0-9]{20}",
            EE: "EE[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{11}[0-9]{1}",
            ES: "ES[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{1}[0-9]{1}[0-9]{10}",
            FI: "FI[0-9]{2}[0-9]{6}[0-9]{7}[0-9]{1}",
            FO: "FO[0-9]{2}[0-9]{4}[0-9]{9}[0-9]{1}",
            FR: "FR[0-9]{2}[0-9]{5}[0-9]{5}[A-Z0-9]{11}[0-9]{2}",
            GB: "GB[0-9]{2}[A-Z]{4}[0-9]{6}[0-9]{8}",
            GE: "GE[0-9]{2}[A-Z]{2}[0-9]{16}",
            GI: "GI[0-9]{2}[A-Z]{4}[A-Z0-9]{15}",
            GL: "GL[0-9]{2}[0-9]{4}[0-9]{9}[0-9]{1}",
            GR: "GR[0-9]{2}[0-9]{3}[0-9]{4}[A-Z0-9]{16}",
            GT: "GT[0-9]{2}[A-Z0-9]{4}[A-Z0-9]{20}",
            HR: "HR[0-9]{2}[0-9]{7}[0-9]{10}",
            HU: "HU[0-9]{2}[0-9]{3}[0-9]{4}[0-9]{1}[0-9]{15}[0-9]{1}",
            IE: "IE[0-9]{2}[A-Z]{4}[0-9]{6}[0-9]{8}",
            IL: "IL[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{13}",
            IR: "IR[0-9]{2}[0-9]{22}",
            IS: "IS[0-9]{2}[0-9]{4}[0-9]{2}[0-9]{6}[0-9]{10}",
            IT: "IT[0-9]{2}[A-Z]{1}[0-9]{5}[0-9]{5}[A-Z0-9]{12}",
            JO: "JO[0-9]{2}[A-Z]{4}[0-9]{4}[0]{8}[A-Z0-9]{10}",
            KW: "KW[0-9]{2}[A-Z]{4}[0-9]{22}",
            KZ: "KZ[0-9]{2}[0-9]{3}[A-Z0-9]{13}",
            LB: "LB[0-9]{2}[0-9]{4}[A-Z0-9]{20}",
            LI: "LI[0-9]{2}[0-9]{5}[A-Z0-9]{12}",
            LT: "LT[0-9]{2}[0-9]{5}[0-9]{11}",
            LU: "LU[0-9]{2}[0-9]{3}[A-Z0-9]{13}",
            LV: "LV[0-9]{2}[A-Z]{4}[A-Z0-9]{13}",
            MC: "MC[0-9]{2}[0-9]{5}[0-9]{5}[A-Z0-9]{11}[0-9]{2}",
            MD: "MD[0-9]{2}[A-Z0-9]{20}",
            ME: "ME[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}",
            MG: "MG[0-9]{2}[0-9]{23}",
            MK: "MK[0-9]{2}[0-9]{3}[A-Z0-9]{10}[0-9]{2}",
            ML: "ML[0-9]{2}[A-Z]{1}[0-9]{23}",
            MR: "MR13[0-9]{5}[0-9]{5}[0-9]{11}[0-9]{2}",
            MT: "MT[0-9]{2}[A-Z]{4}[0-9]{5}[A-Z0-9]{18}",
            MU: "MU[0-9]{2}[A-Z]{4}[0-9]{2}[0-9]{2}[0-9]{12}[0-9]{3}[A-Z]{3}",
            MZ: "MZ[0-9]{2}[0-9]{21}",
            NL: "NL[0-9]{2}[A-Z]{4}[0-9]{10}",
            NO: "NO[0-9]{2}[0-9]{4}[0-9]{6}[0-9]{1}",
            PK: "PK[0-9]{2}[A-Z]{4}[A-Z0-9]{16}",
            PL: "PL[0-9]{2}[0-9]{8}[0-9]{16}",
            PS: "PS[0-9]{2}[A-Z]{4}[A-Z0-9]{21}",
            PT: "PT[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{11}[0-9]{2}",
            QA: "QA[0-9]{2}[A-Z]{4}[A-Z0-9]{21}",
            RO: "RO[0-9]{2}[A-Z]{4}[A-Z0-9]{16}",
            RS: "RS[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}",
            SA: "SA[0-9]{2}[0-9]{2}[A-Z0-9]{18}",
            SE: "SE[0-9]{2}[0-9]{3}[0-9]{16}[0-9]{1}",
            SI: "SI[0-9]{2}[0-9]{5}[0-9]{8}[0-9]{2}",
            SK: "SK[0-9]{2}[0-9]{4}[0-9]{6}[0-9]{10}",
            SM: "SM[0-9]{2}[A-Z]{1}[0-9]{5}[0-9]{5}[A-Z0-9]{12}",
            SN: "SN[0-9]{2}[A-Z]{1}[0-9]{23}",
            TN: "TN59[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}",
            TR: "TR[0-9]{2}[0-9]{5}[A-Z0-9]{1}[A-Z0-9]{16}",
            VG: "VG[0-9]{2}[A-Z]{4}[0-9]{16}"
        },
        validate: function (b, c, d) {
            var e = b.getFieldValue(c, "iban");
            if ("" === e)return !0;
            e = e.replace(/[^a-zA-Z0-9]/g, "").toUpperCase();
            var f = d.country;
            f ? "string" == typeof f && this.REGEX[f] || (f = b.getDynamicOption(c, f)) : f = e.substr(0, 2);
            var g = b.getLocale();
            if (!this.REGEX[f])return !0;
            if (!new RegExp("^" + this.REGEX[f] + "$").test(e))return {
                valid: !1,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[g].iban.country, FormValidation.I18n[g].iban.countries[f])
            };
            e = e.substr(4) + e.substr(0, 4), e = a.map(e.split(""), function (a) {
                var b = a.charCodeAt(0);
                return b >= "A".charCodeAt(0) && b <= "Z".charCodeAt(0) ? b - "A".charCodeAt(0) + 10 : a
            }), e = e.join("");
            for (var h = parseInt(e.substr(0, 1), 10), i = e.length, j = 1; i > j; ++j)h = (10 * h + parseInt(e.substr(j, 1), 10)) % 97;
            return {
                valid: 1 === h,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[g].iban.country, FormValidation.I18n[g].iban.countries[f])
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            id: {
                "default": "Please enter a valid identification number",
                country: "Please enter a valid identification number in %s",
                countries: {
                    BA: "Bosnia and Herzegovina",
                    BG: "Bulgaria",
                    BR: "Brazil",
                    CH: "Switzerland",
                    CL: "Chile",
                    CN: "China",
                    CZ: "Czech Republic",
                    DK: "Denmark",
                    EE: "Estonia",
                    ES: "Spain",
                    FI: "Finland",
                    HR: "Croatia",
                    IE: "Ireland",
                    IS: "Iceland",
                    LT: "Lithuania",
                    LV: "Latvia",
                    ME: "Montenegro",
                    MK: "Macedonia",
                    NL: "Netherlands",
                    RO: "Romania",
                    RS: "Serbia",
                    SE: "Sweden",
                    SI: "Slovenia",
                    SK: "Slovakia",
                    SM: "San Marino",
                    TH: "Thailand",
                    ZA: "South Africa"
                }
            }
        }
    }), FormValidation.Validator.id = {
        html5Attributes: {message: "message", country: "country"},
        COUNTRY_CODES: ["BA", "BG", "BR", "CH", "CL", "CN", "CZ", "DK", "EE", "ES", "FI", "HR", "IE", "IS", "LT", "LV", "ME", "MK", "NL", "RO", "RS", "SE", "SI", "SK", "SM", "TH", "ZA"],
        validate: function (b, c, d) {
            var e = b.getFieldValue(c, "id");
            if ("" === e)return !0;
            var f = b.getLocale(), g = d.country;
            if (g ? ("string" != typeof g || -1 === a.inArray(g.toUpperCase(), this.COUNTRY_CODES)) && (g = b.getDynamicOption(c, g)) : g = e.substr(0, 2), -1 === a.inArray(g, this.COUNTRY_CODES))return !0;
            var h = ["_", g.toLowerCase()].join("");
            return this[h](e) ? !0 : {
                valid: !1,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].id.country, FormValidation.I18n[f].id.countries[g.toUpperCase()])
            }
        },
        _validateJMBG: function (a, b) {
            if (!/^\d{13}$/.test(a))return !1;
            var c = parseInt(a.substr(0, 2), 10), d = parseInt(a.substr(2, 2), 10), e = (parseInt(a.substr(4, 3), 10), parseInt(a.substr(7, 2), 10)), f = parseInt(a.substr(12, 1), 10);
            if (c > 31 || d > 12)return !1;
            for (var g = 0, h = 0; 6 > h; h++)g += (7 - h) * (parseInt(a.charAt(h), 10) + parseInt(a.charAt(h + 6), 10));
            if (g = 11 - g % 11, (10 === g || 11 === g) && (g = 0), g !== f)return !1;
            switch (b.toUpperCase()) {
                case"BA":
                    return e >= 10 && 19 >= e;
                case"MK":
                    return e >= 41 && 49 >= e;
                case"ME":
                    return e >= 20 && 29 >= e;
                case"RS":
                    return e >= 70 && 99 >= e;
                case"SI":
                    return e >= 50 && 59 >= e;
                default:
                    return !0
            }
        },
        _ba: function (a) {
            return this._validateJMBG(a, "BA")
        },
        _mk: function (a) {
            return this._validateJMBG(a, "MK")
        },
        _me: function (a) {
            return this._validateJMBG(a, "ME")
        },
        _rs: function (a) {
            return this._validateJMBG(a, "RS")
        },
        _si: function (a) {
            return this._validateJMBG(a, "SI")
        },
        _bg: function (a) {
            if (!/^\d{10}$/.test(a) && !/^\d{6}\s\d{3}\s\d{1}$/.test(a))return !1;
            a = a.replace(/\s/g, "");
            var b = parseInt(a.substr(0, 2), 10) + 1900, c = parseInt(a.substr(2, 2), 10), d = parseInt(a.substr(4, 2), 10);
            if (c > 40 ? (b += 100, c -= 40) : c > 20 && (b -= 100, c -= 20), !FormValidation.Helper.date(b, c, d))return !1;
            for (var e = 0, f = [2, 4, 8, 5, 10, 9, 7, 3, 6], g = 0; 9 > g; g++)e += parseInt(a.charAt(g), 10) * f[g];
            return e = e % 11 % 10, e + "" === a.substr(9, 1)
        },
        _br: function (a) {
            if (a = a.replace(/\D/g, ""), /^1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}|0{11}$/.test(a))return !1;
            for (var b = 0, c = 0; 9 > c; c++)b += (10 - c) * parseInt(a.charAt(c), 10);
            if (b = 11 - b % 11, (10 === b || 11 === b) && (b = 0), b + "" !== a.charAt(9))return !1;
            var d = 0;
            for (c = 0; 10 > c; c++)d += (11 - c) * parseInt(a.charAt(c), 10);
            return d = 11 - d % 11, (10 === d || 11 === d) && (d = 0), d + "" === a.charAt(10)
        },
        _ch: function (a) {
            if (!/^756[\.]{0,1}[0-9]{4}[\.]{0,1}[0-9]{4}[\.]{0,1}[0-9]{2}$/.test(a))return !1;
            a = a.replace(/\D/g, "").substr(3);
            for (var b = a.length, c = 0, d = 8 === b ? [3, 1] : [1, 3], e = 0; b - 1 > e; e++)c += parseInt(a.charAt(e), 10) * d[e % 2];
            return c = 10 - c % 10, c + "" === a.charAt(b - 1)
        },
        _cl: function (a) {
            if (!/^\d{7,8}[-]{0,1}[0-9K]$/i.test(a))return !1;
            for (a = a.replace(/\-/g, ""); a.length < 9;)a = "0" + a;
            for (var b = 0, c = [3, 2, 7, 6, 5, 4, 3, 2], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b = 11 - b % 11, 11 === b ? b = 0 : 10 === b && (b = "K"), b + "" === a.charAt(8).toUpperCase()
        },
        _cn: function (b) {
            if (b = b.trim(), !/^\d{15}$/.test(b) && !/^\d{17}[\dXx]{1}$/.test(b))return !1;
            var c = {
                11: {0: [0], 1: [[0, 9], [11, 17]], 2: [0, 28, 29]},
                12: {0: [0], 1: [[0, 16]], 2: [0, 21, 23, 25]},
                13: {
                    0: [0],
                    1: [[0, 5], 7, 8, 21, [23, 33], [81, 85]],
                    2: [[0, 5], [7, 9], [23, 25], 27, 29, 30, 81, 83],
                    3: [[0, 4], [21, 24]],
                    4: [[0, 4], 6, 21, [23, 35], 81],
                    5: [[0, 3], [21, 35], 81, 82],
                    6: [[0, 4], [21, 38], [81, 84]],
                    7: [[0, 3], 5, 6, [21, 33]],
                    8: [[0, 4], [21, 28]],
                    9: [[0, 3], [21, 30], [81, 84]],
                    10: [[0, 3], [22, 26], 28, 81, 82],
                    11: [[0, 2], [21, 28], 81, 82]
                },
                14: {
                    0: [0],
                    1: [0, 1, [5, 10], [21, 23], 81],
                    2: [[0, 3], 11, 12, [21, 27]],
                    3: [[0, 3], 11, 21, 22],
                    4: [[0, 2], 11, 21, [23, 31], 81],
                    5: [[0, 2], 21, 22, 24, 25, 81],
                    6: [[0, 3], [21, 24]],
                    7: [[0, 2], [21, 29], 81],
                    8: [[0, 2], [21, 30], 81, 82],
                    9: [[0, 2], [21, 32], 81],
                    10: [[0, 2], [21, 34], 81, 82],
                    11: [[0, 2], [21, 30], 81, 82],
                    23: [[0, 3], 22, 23, [25, 30], 32, 33]
                },
                15: {
                    0: [0],
                    1: [[0, 5], [21, 25]],
                    2: [[0, 7], [21, 23]],
                    3: [[0, 4]],
                    4: [[0, 4], [21, 26], [28, 30]],
                    5: [[0, 2], [21, 26], 81],
                    6: [[0, 2], [21, 27]],
                    7: [[0, 3], [21, 27], [81, 85]],
                    8: [[0, 2], [21, 26]],
                    9: [[0, 2], [21, 29], 81],
                    22: [[0, 2], [21, 24]],
                    25: [[0, 2], [22, 31]],
                    26: [[0, 2], [24, 27], [29, 32], 34],
                    28: [0, 1, [22, 27]],
                    29: [0, [21, 23]]
                },
                21: {
                    0: [0],
                    1: [[0, 6], [11, 14], [22, 24], 81],
                    2: [[0, 4], [11, 13], 24, [81, 83]],
                    3: [[0, 4], 11, 21, 23, 81],
                    4: [[0, 4], 11, [21, 23]],
                    5: [[0, 5], 21, 22],
                    6: [[0, 4], 24, 81, 82],
                    7: [[0, 3], 11, 26, 27, 81, 82],
                    8: [[0, 4], 11, 81, 82],
                    9: [[0, 5], 11, 21, 22],
                    10: [[0, 5], 11, 21, 81],
                    11: [[0, 3], 21, 22],
                    12: [[0, 2], 4, 21, 23, 24, 81, 82],
                    13: [[0, 3], 21, 22, 24, 81, 82],
                    14: [[0, 4], 21, 22, 81]
                },
                22: {
                    0: [0],
                    1: [[0, 6], 12, 22, [81, 83]],
                    2: [[0, 4], 11, 21, [81, 84]],
                    3: [[0, 3], 22, 23, 81, 82],
                    4: [[0, 3], 21, 22],
                    5: [[0, 3], 21, 23, 24, 81, 82],
                    6: [[0, 2], 4, 5, [21, 23], 25, 81],
                    7: [[0, 2], [21, 24], 81],
                    8: [[0, 2], 21, 22, 81, 82],
                    24: [[0, 6], 24, 26]
                },
                23: {
                    0: [0],
                    1: [[0, 12], 21, [23, 29], [81, 84]],
                    2: [[0, 8], 21, [23, 25], 27, [29, 31], 81],
                    3: [[0, 7], 21, 81, 82],
                    4: [[0, 7], 21, 22],
                    5: [[0, 3], 5, 6, [21, 24]],
                    6: [[0, 6], [21, 24]],
                    7: [[0, 16], 22, 81],
                    8: [[0, 5], 11, 22, 26, 28, 33, 81, 82],
                    9: [[0, 4], 21],
                    10: [[0, 5], 24, 25, 81, [83, 85]],
                    11: [[0, 2], 21, 23, 24, 81, 82],
                    12: [[0, 2], [21, 26], [81, 83]],
                    27: [[0, 4], [21, 23]]
                },
                31: {0: [0], 1: [0, 1, [3, 10], [12, 20]], 2: [0, 30]},
                32: {
                    0: [0],
                    1: [[0, 7], 11, [13, 18], 24, 25],
                    2: [[0, 6], 11, 81, 82],
                    3: [[0, 5], 11, 12, [21, 24], 81, 82],
                    4: [[0, 2], 4, 5, 11, 12, 81, 82],
                    5: [[0, 9], [81, 85]],
                    6: [[0, 2], 11, 12, 21, 23, [81, 84]],
                    7: [0, 1, 3, 5, 6, [21, 24]],
                    8: [[0, 4], 11, 26, [29, 31]],
                    9: [[0, 3], [21, 25], 28, 81, 82],
                    10: [[0, 3], 11, 12, 23, 81, 84, 88],
                    11: [[0, 2], 11, 12, [81, 83]],
                    12: [[0, 4], [81, 84]],
                    13: [[0, 2], 11, [21, 24]]
                },
                33: {
                    0: [0],
                    1: [[0, 6], [8, 10], 22, 27, 82, 83, 85],
                    2: [0, 1, [3, 6], 11, 12, 25, 26, [81, 83]],
                    3: [[0, 4], 22, 24, [26, 29], 81, 82],
                    4: [[0, 2], 11, 21, 24, [81, 83]],
                    5: [[0, 3], [21, 23]],
                    6: [[0, 2], 21, 24, [81, 83]],
                    7: [[0, 3], 23, 26, 27, [81, 84]],
                    8: [[0, 3], 22, 24, 25, 81],
                    9: [[0, 3], 21, 22],
                    10: [[0, 4], [21, 24], 81, 82],
                    11: [[0, 2], [21, 27], 81]
                },
                34: {
                    0: [0],
                    1: [[0, 4], 11, [21, 24], 81],
                    2: [[0, 4], 7, 8, [21, 23], 25],
                    3: [[0, 4], 11, [21, 23]],
                    4: [[0, 6], 21],
                    5: [[0, 4], 6, [21, 23]],
                    6: [[0, 4], 21],
                    7: [[0, 3], 11, 21],
                    8: [[0, 3], 11, [22, 28], 81],
                    10: [[0, 4], [21, 24]],
                    11: [[0, 3], 22, [24, 26], 81, 82],
                    12: [[0, 4], 21, 22, 25, 26, 82],
                    13: [[0, 2], [21, 24]],
                    14: [[0, 2], [21, 24]],
                    15: [[0, 3], [21, 25]],
                    16: [[0, 2], [21, 23]],
                    17: [[0, 2], [21, 23]],
                    18: [[0, 2], [21, 25], 81]
                },
                35: {
                    0: [0],
                    1: [[0, 5], 11, [21, 25], 28, 81, 82],
                    2: [[0, 6], [11, 13]],
                    3: [[0, 5], 22],
                    4: [[0, 3], 21, [23, 30], 81],
                    5: [[0, 5], 21, [24, 27], [81, 83]],
                    6: [[0, 3], [22, 29], 81],
                    7: [[0, 2], [21, 25], [81, 84]],
                    8: [[0, 2], [21, 25], 81],
                    9: [[0, 2], [21, 26], 81, 82]
                },
                36: {
                    0: [0],
                    1: [[0, 5], 11, [21, 24]],
                    2: [[0, 3], 22, 81],
                    3: [[0, 2], 13, [21, 23]],
                    4: [[0, 3], 21, [23, 30], 81, 82],
                    5: [[0, 2], 21],
                    6: [[0, 2], 22, 81],
                    7: [[0, 2], [21, 35], 81, 82],
                    8: [[0, 3], [21, 30], 81],
                    9: [[0, 2], [21, 26], [81, 83]],
                    10: [[0, 2], [21, 30]],
                    11: [[0, 2], [21, 30], 81]
                },
                37: {
                    0: [0],
                    1: [[0, 5], 12, 13, [24, 26], 81],
                    2: [[0, 3], 5, [11, 14], [81, 85]],
                    3: [[0, 6], [21, 23]],
                    4: [[0, 6], 81],
                    5: [[0, 3], [21, 23]],
                    6: [[0, 2], [11, 13], 34, [81, 87]],
                    7: [[0, 5], 24, 25, [81, 86]],
                    8: [[0, 2], 11, [26, 32], [81, 83]],
                    9: [[0, 3], 11, 21, 23, 82, 83],
                    10: [[0, 2], [81, 83]],
                    11: [[0, 3], 21, 22],
                    12: [[0, 3]],
                    13: [[0, 2], 11, 12, [21, 29]],
                    14: [[0, 2], [21, 28], 81, 82],
                    15: [[0, 2], [21, 26], 81],
                    16: [[0, 2], [21, 26]],
                    17: [[0, 2], [21, 28]]
                },
                41: {
                    0: [0],
                    1: [[0, 6], 8, 22, [81, 85]],
                    2: [[0, 5], 11, [21, 25]],
                    3: [[0, 7], 11, [22, 29], 81],
                    4: [[0, 4], 11, [21, 23], 25, 81, 82],
                    5: [[0, 3], 5, 6, 22, 23, 26, 27, 81],
                    6: [[0, 3], 11, 21, 22],
                    7: [[0, 4], 11, 21, [24, 28], 81, 82],
                    8: [[0, 4], 11, [21, 23], 25, [81, 83]],
                    9: [[0, 2], 22, 23, [26, 28]],
                    10: [[0, 2], [23, 25], 81, 82],
                    11: [[0, 4], [21, 23]],
                    12: [[0, 2], 21, 22, 24, 81, 82],
                    13: [[0, 3], [21, 30], 81],
                    14: [[0, 3], [21, 26], 81],
                    15: [[0, 3], [21, 28]],
                    16: [[0, 2], [21, 28], 81],
                    17: [[0, 2], [21, 29]],
                    90: [0, 1]
                },
                42: {
                    0: [0],
                    1: [[0, 7], [11, 17]],
                    2: [[0, 5], 22, 81],
                    3: [[0, 3], [21, 25], 81],
                    5: [[0, 6], [25, 29], [81, 83]],
                    6: [[0, 2], 6, 7, [24, 26], [82, 84]],
                    7: [[0, 4]],
                    8: [[0, 2], 4, 21, 22, 81],
                    9: [[0, 2], [21, 23], 81, 82, 84],
                    10: [[0, 3], [22, 24], 81, 83, 87],
                    11: [[0, 2], [21, 27], 81, 82],
                    12: [[0, 2], [21, 24], 81],
                    13: [[0, 3], 21, 81],
                    28: [[0, 2], 22, 23, [25, 28]],
                    90: [0, [4, 6], 21]
                },
                43: {
                    0: [0],
                    1: [[0, 5], 11, 12, 21, 22, 24, 81],
                    2: [[0, 4], 11, 21, [23, 25], 81],
                    3: [[0, 2], 4, 21, 81, 82],
                    4: [0, 1, [5, 8], 12, [21, 24], 26, 81, 82],
                    5: [[0, 3], 11, [21, 25], [27, 29], 81],
                    6: [[0, 3], 11, 21, 23, 24, 26, 81, 82],
                    7: [[0, 3], [21, 26], 81],
                    8: [[0, 2], 11, 21, 22],
                    9: [[0, 3], [21, 23], 81],
                    10: [[0, 3], [21, 28], 81],
                    11: [[0, 3], [21, 29]],
                    12: [[0, 2], [21, 30], 81],
                    13: [[0, 2], 21, 22, 81, 82],
                    31: [0, 1, [22, 27], 30]
                },
                44: {
                    0: [0],
                    1: [[0, 7], [11, 16], 83, 84],
                    2: [[0, 5], 21, 22, 24, 29, 32, 33, 81, 82],
                    3: [0, 1, [3, 8]],
                    4: [[0, 4]],
                    5: [0, 1, [6, 15], 23, 82, 83],
                    6: [0, 1, [4, 8]],
                    7: [0, 1, [3, 5], 81, [83, 85]],
                    8: [[0, 4], 11, 23, 25, [81, 83]],
                    9: [[0, 3], 23, [81, 83]],
                    12: [[0, 3], [23, 26], 83, 84],
                    13: [[0, 3], [22, 24], 81],
                    14: [[0, 2], [21, 24], 26, 27, 81],
                    15: [[0, 2], 21, 23, 81],
                    16: [[0, 2], [21, 25]],
                    17: [[0, 2], 21, 23, 81],
                    18: [[0, 3], 21, 23, [25, 27], 81, 82],
                    19: [0],
                    20: [0],
                    51: [[0, 3], 21, 22],
                    52: [[0, 3], 21, 22, 24, 81],
                    53: [[0, 2], [21, 23], 81]
                },
                45: {
                    0: [0],
                    1: [[0, 9], [21, 27]],
                    2: [[0, 5], [21, 26]],
                    3: [[0, 5], 11, 12, [21, 32]],
                    4: [0, 1, [3, 6], 11, [21, 23], 81],
                    5: [[0, 3], 12, 21],
                    6: [[0, 3], 21, 81],
                    7: [[0, 3], 21, 22],
                    8: [[0, 4], 21, 81],
                    9: [[0, 3], [21, 24], 81],
                    10: [[0, 2], [21, 31]],
                    11: [[0, 2], [21, 23]],
                    12: [[0, 2], [21, 29], 81],
                    13: [[0, 2], [21, 24], 81],
                    14: [[0, 2], [21, 25], 81]
                },
                46: {0: [0], 1: [0, 1, [5, 8]], 2: [0, 1], 3: [0, [21, 23]], 90: [[0, 3], [5, 7], [21, 39]]},
                50: {0: [0], 1: [[0, 19]], 2: [0, [22, 38], [40, 43]], 3: [0, [81, 84]]},
                51: {
                    0: [0],
                    1: [0, 1, [4, 8], [12, 15], [21, 24], 29, 31, 32, [81, 84]],
                    3: [[0, 4], 11, 21, 22],
                    4: [[0, 3], 11, 21, 22],
                    5: [[0, 4], 21, 22, 24, 25],
                    6: [0, 1, 3, 23, 26, [81, 83]],
                    7: [0, 1, 3, 4, [22, 27], 81],
                    8: [[0, 2], 11, 12, [21, 24]],
                    9: [[0, 4], [21, 23]],
                    10: [[0, 2], 11, 24, 25, 28],
                    11: [[0, 2], [11, 13], 23, 24, 26, 29, 32, 33, 81],
                    13: [[0, 4], [21, 25], 81],
                    14: [[0, 2], [21, 25]],
                    15: [[0, 3], [21, 29]],
                    16: [[0, 3], [21, 23], 81],
                    17: [[0, 3], [21, 25], 81],
                    18: [[0, 3], [21, 27]],
                    19: [[0, 3], [21, 23]],
                    20: [[0, 2], 21, 22, 81],
                    32: [0, [21, 33]],
                    33: [0, [21, 38]],
                    34: [0, 1, [22, 37]]
                },
                52: {
                    0: [0],
                    1: [[0, 3], [11, 15], [21, 23], 81],
                    2: [0, 1, 3, 21, 22],
                    3: [[0, 3], [21, 30], 81, 82],
                    4: [[0, 2], [21, 25]],
                    5: [[0, 2], [21, 27]],
                    6: [[0, 3], [21, 28]],
                    22: [0, 1, [22, 30]],
                    23: [0, 1, [22, 28]],
                    24: [0, 1, [22, 28]],
                    26: [0, 1, [22, 36]],
                    27: [[0, 2], 22, 23, [25, 32]]
                },
                53: {
                    0: [0],
                    1: [[0, 3], [11, 14], 21, 22, [24, 29], 81],
                    3: [[0, 2], [21, 26], 28, 81],
                    4: [[0, 2], [21, 28]],
                    5: [[0, 2], [21, 24]],
                    6: [[0, 2], [21, 30]],
                    7: [[0, 2], [21, 24]],
                    8: [[0, 2], [21, 29]],
                    9: [[0, 2], [21, 27]],
                    23: [0, 1, [22, 29], 31],
                    25: [[0, 4], [22, 32]],
                    26: [0, 1, [21, 28]],
                    27: [0, 1, [22, 30]],
                    28: [0, 1, 22, 23],
                    29: [0, 1, [22, 32]],
                    31: [0, 2, 3, [22, 24]],
                    34: [0, [21, 23]],
                    33: [0, 21, [23, 25]],
                    35: [0, [21, 28]]
                },
                54: {
                    0: [0],
                    1: [[0, 2], [21, 27]],
                    21: [0, [21, 29], 32, 33],
                    22: [0, [21, 29], [31, 33]],
                    23: [0, 1, [22, 38]],
                    24: [0, [21, 31]],
                    25: [0, [21, 27]],
                    26: [0, [21, 27]]
                },
                61: {
                    0: [0],
                    1: [[0, 4], [11, 16], 22, [24, 26]],
                    2: [[0, 4], 22],
                    3: [[0, 4], [21, 24], [26, 31]],
                    4: [[0, 4], [22, 31], 81],
                    5: [[0, 2], [21, 28], 81, 82],
                    6: [[0, 2], [21, 32]],
                    7: [[0, 2], [21, 30]],
                    8: [[0, 2], [21, 31]],
                    9: [[0, 2], [21, 29]],
                    10: [[0, 2], [21, 26]]
                },
                62: {
                    0: [0],
                    1: [[0, 5], 11, [21, 23]],
                    2: [0, 1],
                    3: [[0, 2], 21],
                    4: [[0, 3], [21, 23]],
                    5: [[0, 3], [21, 25]],
                    6: [[0, 2], [21, 23]],
                    7: [[0, 2], [21, 25]],
                    8: [[0, 2], [21, 26]],
                    9: [[0, 2], [21, 24], 81, 82],
                    10: [[0, 2], [21, 27]],
                    11: [[0, 2], [21, 26]],
                    12: [[0, 2], [21, 28]],
                    24: [0, 21, [24, 29]],
                    26: [0, 21, [23, 30]],
                    29: [0, 1, [21, 27]],
                    30: [0, 1, [21, 27]]
                },
                63: {
                    0: [0],
                    1: [[0, 5], [21, 23]],
                    2: [0, 2, [21, 25]],
                    21: [0, [21, 23], [26, 28]],
                    22: [0, [21, 24]],
                    23: [0, [21, 24]],
                    25: [0, [21, 25]],
                    26: [0, [21, 26]],
                    27: [0, 1, [21, 26]],
                    28: [[0, 2], [21, 23]]
                },
                64: {
                    0: [0],
                    1: [0, 1, [4, 6], 21, 22, 81],
                    2: [[0, 3], 5, [21, 23]],
                    3: [[0, 3], [21, 24], 81],
                    4: [[0, 2], [21, 25]],
                    5: [[0, 2], 21, 22]
                },
                65: {
                    0: [0],
                    1: [[0, 9], 21],
                    2: [[0, 5]],
                    21: [0, 1, 22, 23],
                    22: [0, 1, 22, 23],
                    23: [[0, 3], [23, 25], 27, 28],
                    28: [0, 1, [22, 29]],
                    29: [0, 1, [22, 29]],
                    30: [0, 1, [22, 24]],
                    31: [0, 1, [21, 31]],
                    32: [0, 1, [21, 27]],
                    40: [0, 2, 3, [21, 28]],
                    42: [[0, 2], 21, [23, 26]],
                    43: [0, 1, [21, 26]],
                    90: [[0, 4]],
                    27: [[0, 2], 22, 23]
                },
                71: {0: [0]},
                81: {0: [0]},
                82: {0: [0]}
            }, d = parseInt(b.substr(0, 2), 10), e = parseInt(b.substr(2, 2), 10), f = parseInt(b.substr(4, 2), 10);
            if (!c[d] || !c[d][e])return !1;
            for (var g = !1, h = c[d][e], i = 0; i < h.length; i++)if (a.isArray(h[i]) && h[i][0] <= f && f <= h[i][1] || !a.isArray(h[i]) && f === h[i]) {
                g = !0;
                break
            }
            if (!g)return !1;
            var j;
            j = 18 === b.length ? b.substr(6, 8) : "19" + b.substr(6, 6);
            var k = parseInt(j.substr(0, 4), 10), l = parseInt(j.substr(4, 2), 10), m = parseInt(j.substr(6, 2), 10);
            if (!FormValidation.Helper.date(k, l, m))return !1;
            if (18 === b.length) {
                var n = 0, o = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
                for (i = 0; 17 > i; i++)n += parseInt(b.charAt(i), 10) * o[i];
                n = (12 - n % 11) % 11;
                var p = "X" !== b.charAt(17).toUpperCase() ? parseInt(b.charAt(17), 10) : 10;
                return p === n
            }
            return !0
        },
        _cz: function (a) {
            if (!/^\d{9,10}$/.test(a))return !1;
            var b = 1900 + parseInt(a.substr(0, 2), 10), c = parseInt(a.substr(2, 2), 10) % 50 % 20, d = parseInt(a.substr(4, 2), 10);
            if (9 === a.length) {
                if (b >= 1980 && (b -= 100), b > 1953)return !1
            } else 1954 > b && (b += 100);
            if (!FormValidation.Helper.date(b, c, d))return !1;
            if (10 === a.length) {
                var e = parseInt(a.substr(0, 9), 10) % 11;
                return 1985 > b && (e %= 10), e + "" === a.substr(9, 1)
            }
            return !0
        },
        _dk: function (a) {
            if (!/^[0-9]{6}[-]{0,1}[0-9]{4}$/.test(a))return !1;
            a = a.replace(/-/g, "");
            var b = parseInt(a.substr(0, 2), 10), c = parseInt(a.substr(2, 2), 10), d = parseInt(a.substr(4, 2), 10);
            switch (!0) {
                case-1 !== "5678".indexOf(a.charAt(6)) && d >= 58:
                    d += 1800;
                    break;
                case-1 !== "0123".indexOf(a.charAt(6)):
                case-1 !== "49".indexOf(a.charAt(6)) && d >= 37:
                    d += 1900;
                    break;
                default:
                    d += 2e3
            }
            return FormValidation.Helper.date(d, c, b)
        },
        _ee: function (a) {
            return this._lt(a)
        },
        _es: function (a) {
            var b = /^[0-9]{8}[-]{0,1}[A-HJ-NP-TV-Z]$/.test(a), c = /^[XYZ][-]{0,1}[0-9]{7}[-]{0,1}[A-HJ-NP-TV-Z]$/.test(a), d = /^[A-HNPQS][-]{0,1}[0-9]{7}[-]{0,1}[0-9A-J]$/.test(a);
            if (!b && !c && !d)return !1;
            a = a.replace(/-/g, "");
            var e;
            if (b || c) {
                var f = "XYZ".indexOf(a.charAt(0));
                return -1 !== f && (a = f + a.substr(1) + ""), e = parseInt(a.substr(0, 8), 10), e = "TRWAGMYFPDXBNJZSQVHLCKE"[e % 23], e === a.substr(8, 1)
            }
            e = a.substr(1, 7);
            for (var g = a[0], h = a.substr(-1), i = 0, j = 0; j < e.length; j++)if (j % 2 !== 0)i += parseInt(e[j], 10); else {
                var k = "" + 2 * parseInt(e[j], 10);
                i += parseInt(k[0], 10), 2 === k.length && (i += parseInt(k[1], 10))
            }
            var l = i - 10 * Math.floor(i / 10);
            return 0 !== l && (l = 10 - l), -1 !== "KQS".indexOf(g) ? h === "JABCDEFGHI"[l] : -1 !== "ABEH".indexOf(g) ? h === "" + l : h === "" + l || h === "JABCDEFGHI"[l]
        },
        _fi: function (a) {
            if (!/^[0-9]{6}[-+A][0-9]{3}[0-9ABCDEFHJKLMNPRSTUVWXY]$/.test(a))return !1;
            var b = parseInt(a.substr(0, 2), 10), c = parseInt(a.substr(2, 2), 10), d = parseInt(a.substr(4, 2), 10), e = {
                "+": 1800,
                "-": 1900,
                A: 2e3
            };
            if (d = e[a.charAt(6)] + d, !FormValidation.Helper.date(d, c, b))return !1;
            var f = parseInt(a.substr(7, 3), 10);
            if (2 > f)return !1;
            var g = a.substr(0, 6) + a.substr(7, 3) + "";
            return g = parseInt(g, 10), "0123456789ABCDEFHJKLMNPRSTUVWXY".charAt(g % 31) === a.charAt(10)
        },
        _hr: function (a) {
            return /^[0-9]{11}$/.test(a) ? FormValidation.Helper.mod11And10(a) : !1
        },
        _ie: function (a) {
            if (!/^\d{7}[A-W][AHWTX]?$/.test(a))return !1;
            var b = function (a) {
                for (; a.length < 7;)a = "0" + a;
                for (var b = "WABCDEFGHIJKLMNOPQRSTUV", c = 0, d = 0; 7 > d; d++)c += parseInt(a.charAt(d), 10) * (8 - d);
                return c += 9 * b.indexOf(a.substr(7)), b[c % 23]
            };
            return 9 !== a.length || "A" !== a.charAt(8) && "H" !== a.charAt(8) ? a.charAt(7) === b(a.substr(0, 7)) : a.charAt(7) === b(a.substr(0, 7) + a.substr(8) + "")
        },
        _is: function (a) {
            if (!/^[0-9]{6}[-]{0,1}[0-9]{4}$/.test(a))return !1;
            a = a.replace(/-/g, "");
            var b = parseInt(a.substr(0, 2), 10), c = parseInt(a.substr(2, 2), 10), d = parseInt(a.substr(4, 2), 10), e = parseInt(a.charAt(9), 10);
            if (d = 9 === e ? 1900 + d : 100 * (20 + e) + d, !FormValidation.Helper.date(d, c, b, !0))return !1;
            for (var f = 0, g = [3, 2, 7, 6, 5, 4, 3, 2], h = 0; 8 > h; h++)f += parseInt(a.charAt(h), 10) * g[h];
            return f = 11 - f % 11, f + "" === a.charAt(8)
        },
        _lt: function (a) {
            if (!/^[0-9]{11}$/.test(a))return !1;
            var b = parseInt(a.charAt(0), 10), c = parseInt(a.substr(1, 2), 10), d = parseInt(a.substr(3, 2), 10), e = parseInt(a.substr(5, 2), 10), f = b % 2 === 0 ? 17 + b / 2 : 17 + (b + 1) / 2;
            if (c = 100 * f + c, !FormValidation.Helper.date(c, d, e, !0))return !1;
            for (var g = 0, h = [1, 2, 3, 4, 5, 6, 7, 8, 9, 1], i = 0; 10 > i; i++)g += parseInt(a.charAt(i), 10) * h[i];
            if (g %= 11, 10 !== g)return g + "" === a.charAt(10);
            for (g = 0, h = [3, 4, 5, 6, 7, 8, 9, 1, 2, 3], i = 0; 10 > i; i++)g += parseInt(a.charAt(i), 10) * h[i];
            return g %= 11, 10 === g && (g = 0), g + "" === a.charAt(10)
        },
        _lv: function (a) {
            if (!/^[0-9]{6}[-]{0,1}[0-9]{5}$/.test(a))return !1;
            a = a.replace(/\D/g, "");
            var b = parseInt(a.substr(0, 2), 10), c = parseInt(a.substr(2, 2), 10), d = parseInt(a.substr(4, 2), 10);
            if (d = d + 1800 + 100 * parseInt(a.charAt(6), 10), !FormValidation.Helper.date(d, c, b, !0))return !1;
            for (var e = 0, f = [10, 5, 8, 4, 2, 1, 6, 3, 7, 9], g = 0; 10 > g; g++)e += parseInt(a.charAt(g), 10) * f[g];
            return e = (e + 1) % 11 % 10, e + "" === a.charAt(10)
        },
        _nl: function (a) {
            for (; a.length < 9;)a = "0" + a;
            if (!/^[0-9]{4}[.]{0,1}[0-9]{2}[.]{0,1}[0-9]{3}$/.test(a))return !1;
            if (a = a.replace(/\./g, ""), 0 === parseInt(a, 10))return !1;
            for (var b = 0, c = a.length, d = 0; c - 1 > d; d++)b += (9 - d) * parseInt(a.charAt(d), 10);
            return b %= 11, 10 === b && (b = 0), b + "" === a.charAt(c - 1)
        },
        _ro: function (a) {
            if (!/^[0-9]{13}$/.test(a))return !1;
            var b = parseInt(a.charAt(0), 10);
            if (0 === b || 7 === b || 8 === b)return !1;
            var c = parseInt(a.substr(1, 2), 10), d = parseInt(a.substr(3, 2), 10), e = parseInt(a.substr(5, 2), 10), f = {
                1: 1900,
                2: 1900,
                3: 1800,
                4: 1800,
                5: 2e3,
                6: 2e3
            };
            if (e > 31 && d > 12)return !1;
            if (9 !== b && (c = f[b + ""] + c, !FormValidation.Helper.date(c, d, e)))return !1;
            for (var g = 0, h = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9], i = a.length, j = 0; i - 1 > j; j++)g += parseInt(a.charAt(j), 10) * h[j];
            return g %= 11, 10 === g && (g = 1), g + "" === a.charAt(i - 1)
        },
        _se: function (a) {
            if (!/^[0-9]{10}$/.test(a) && !/^[0-9]{6}[-|+][0-9]{4}$/.test(a))return !1;
            a = a.replace(/[^0-9]/g, "");
            var b = parseInt(a.substr(0, 2), 10) + 1900, c = parseInt(a.substr(2, 2), 10), d = parseInt(a.substr(4, 2), 10);
            return FormValidation.Helper.date(b, c, d) ? FormValidation.Helper.luhn(a) : !1
        },
        _sk: function (a) {
            return this._cz(a)
        },
        _sm: function (a) {
            return /^\d{5}$/.test(a)
        },
        _th: function (a) {
            if (13 !== a.length)return !1;
            for (var b = 0, c = 0; 12 > c; c++)b += parseInt(a.charAt(c), 10) * (13 - c);
            return (11 - b % 11) % 10 === parseInt(a.charAt(12), 10)
        },
        _za: function (a) {
            if (!/^[0-9]{10}[0|1][8|9][0-9]$/.test(a))return !1;
            var b = parseInt(a.substr(0, 2), 10), c = (new Date).getFullYear() % 100, d = parseInt(a.substr(2, 2), 10), e = parseInt(a.substr(4, 2), 10);
            return b = b >= c ? b + 1900 : b + 2e3, FormValidation.Helper.date(b, d, e) ? FormValidation.Helper.luhn(a) : !1
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {identical: {"default": "Please enter the same value"}}}), FormValidation.Validator.identical = {
        html5Attributes: {
            message: "message",
            field: "field"
        }, init: function (a, b, c) {
            var d = a.getFieldElements(c.field);
            a.onLiveChange(d, "live_identical", function () {
                var c = a.getStatus(b, "identical");
                c !== a.STATUS_NOT_VALIDATED && a.revalidateField(b)
            })
        }, destroy: function (a, b, c) {
            var d = a.getFieldElements(c.field);
            a.offLiveChange(d, "live_identical")
        }, validate: function (a, b, c) {
            var d = a.getFieldValue(b, "identical"), e = a.getFieldElements(c.field);
            if (null === e || 0 === e.length)return !0;
            var f = a.getFieldValue(e, "identical");
            return d === f ? (a.updateStatus(e, a.STATUS_VALID, "identical"), !0) : !1
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {imei: {"default": "Please enter a valid IMEI number"}}}), FormValidation.Validator.imei = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "imei");
            if ("" === c)return !0;
            switch (!0) {
                case/^\d{15}$/.test(c):
                case/^\d{2}-\d{6}-\d{6}-\d{1}$/.test(c):
                case/^\d{2}\s\d{6}\s\d{6}\s\d{1}$/.test(c):
                    return c = c.replace(/[^0-9]/g, ""), FormValidation.Helper.luhn(c);
                case/^\d{14}$/.test(c):
                case/^\d{16}$/.test(c):
                case/^\d{2}-\d{6}-\d{6}(|-\d{2})$/.test(c):
                case/^\d{2}\s\d{6}\s\d{6}(|\s\d{2})$/.test(c):
                    return !0;
                default:
                    return !1
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {imo: {"default": "Please enter a valid IMO number"}}}), FormValidation.Validator.imo = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "imo");
            if ("" === c)return !0;
            if (!/^IMO \d{7}$/i.test(c))return !1;
            for (var d = 0, e = c.replace(/^.*(\d{7})$/, "$1"), f = 6; f >= 1; f--)d += e.slice(6 - f, -f) * (f + 1);
            return d % 10 === parseInt(e.charAt(6), 10)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {integer: {"default": "Please enter a valid number"}}}), FormValidation.Validator.integer = {
        enableByHtml5: function (a) {
            return "number" === a.attr("type") && (void 0 === a.attr("step") || a.attr("step") % 1 === 0)
        }, validate: function (a, b) {
            if (this.enableByHtml5(b) && b.get(0).validity && b.get(0).validity.badInput === !0)return !1;
            var c = a.getFieldValue(b, "integer");
            return "" === c ? !0 : /^(?:-?(?:0|[1-9][0-9]*))$/.test(c)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            ip: {
                "default": "Please enter a valid IP address",
                ipv4: "Please enter a valid IPv4 address",
                ipv6: "Please enter a valid IPv6 address"
            }
        }
    }), FormValidation.Validator.ip = {
        html5Attributes: {message: "message", ipv4: "ipv4", ipv6: "ipv6"},
        validate: function (b, c, d) {
            var e = b.getFieldValue(c, "ip");
            if ("" === e)return !0;
            d = a.extend({}, {ipv4: !0, ipv6: !0}, d);
            var f, g = b.getLocale(), h = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/, i = /^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/, j = !1;
            switch (!0) {
                case d.ipv4 && !d.ipv6:
                    j = h.test(e), f = d.message || FormValidation.I18n[g].ip.ipv4;
                    break;
                case!d.ipv4 && d.ipv6:
                    j = i.test(e), f = d.message || FormValidation.I18n[g].ip.ipv6;
                    break;
                case d.ipv4 && d.ipv6:
                default:
                    j = h.test(e) || i.test(e), f = d.message || FormValidation.I18n[g].ip["default"]
            }
            return {valid: j, message: f}
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {isbn: {"default": "Please enter a valid ISBN number"}}}), FormValidation.Validator.isbn = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "isbn");
            if ("" === c)return !0;
            var d;
            switch (!0) {
                case/^\d{9}[\dX]$/.test(c):
                case 13 === c.length && /^(\d+)-(\d+)-(\d+)-([\dX])$/.test(c):
                case 13 === c.length && /^(\d+)\s(\d+)\s(\d+)\s([\dX])$/.test(c):
                    d = "ISBN10";
                    break;
                case/^(978|979)\d{9}[\dX]$/.test(c):
                case 17 === c.length && /^(978|979)-(\d+)-(\d+)-(\d+)-([\dX])$/.test(c):
                case 17 === c.length && /^(978|979)\s(\d+)\s(\d+)\s(\d+)\s([\dX])$/.test(c):
                    d = "ISBN13";
                    break;
                default:
                    return !1
            }
            c = c.replace(/[^0-9X]/gi, "");
            var e, f, g = c.split(""), h = g.length, i = 0;
            switch (d) {
                case"ISBN10":
                    for (i = 0, e = 0; h - 1 > e; e++)i += parseInt(g[e], 10) * (10 - e);
                    return f = 11 - i % 11, 11 === f ? f = 0 : 10 === f && (f = "X"), f + "" === g[h - 1];
                case"ISBN13":
                    for (i = 0, e = 0; h - 1 > e; e++)i += e % 2 === 0 ? parseInt(g[e], 10) : 3 * parseInt(g[e], 10);
                    return f = 10 - i % 10, 10 === f && (f = "0"), f + "" === g[h - 1];
                default:
                    return !1
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {isin: {"default": "Please enter a valid ISIN number"}}}), FormValidation.Validator.isin = {
        COUNTRY_CODES: "AF|AX|AL|DZ|AS|AD|AO|AI|AQ|AG|AR|AM|AW|AU|AT|AZ|BS|BH|BD|BB|BY|BE|BZ|BJ|BM|BT|BO|BQ|BA|BW|BV|BR|IO|BN|BG|BF|BI|KH|CM|CA|CV|KY|CF|TD|CL|CN|CX|CC|CO|KM|CG|CD|CK|CR|CI|HR|CU|CW|CY|CZ|DK|DJ|DM|DO|EC|EG|SV|GQ|ER|EE|ET|FK|FO|FJ|FI|FR|GF|PF|TF|GA|GM|GE|DE|GH|GI|GR|GL|GD|GP|GU|GT|GG|GN|GW|GY|HT|HM|VA|HN|HK|HU|IS|IN|ID|IR|IQ|IE|IM|IL|IT|JM|JP|JE|JO|KZ|KE|KI|KP|KR|KW|KG|LA|LV|LB|LS|LR|LY|LI|LT|LU|MO|MK|MG|MW|MY|MV|ML|MT|MH|MQ|MR|MU|YT|MX|FM|MD|MC|MN|ME|MS|MA|MZ|MM|NA|NR|NP|NL|NC|NZ|NI|NE|NG|NU|NF|MP|NO|OM|PK|PW|PS|PA|PG|PY|PE|PH|PN|PL|PT|PR|QA|RE|RO|RU|RW|BL|SH|KN|LC|MF|PM|VC|WS|SM|ST|SA|SN|RS|SC|SL|SG|SX|SK|SI|SB|SO|ZA|GS|SS|ES|LK|SD|SR|SJ|SZ|SE|CH|SY|TW|TJ|TZ|TH|TL|TG|TK|TO|TT|TN|TR|TM|TC|TV|UG|UA|AE|GB|US|UM|UY|UZ|VU|VE|VN|VG|VI|WF|EH|YE|ZM|ZW",
        validate: function (a, b) {
            var c = a.getFieldValue(b, "isin");
            if ("" === c)return !0;
            c = c.toUpperCase();
            var d = new RegExp("^(" + this.COUNTRY_CODES + ")[0-9A-Z]{10}$");
            if (!d.test(c))return !1;
            for (var e = "", f = c.length, g = 0; f - 1 > g; g++) {
                var h = c.charCodeAt(g);
                e += h > 57 ? (h - 55).toString() : c.charAt(g)
            }
            var i = "", j = e.length, k = j % 2 !== 0 ? 0 : 1;
            for (g = 0; j > g; g++)i += parseInt(e[g], 10) * (g % 2 === k ? 2 : 1) + "";
            var l = 0;
            for (g = 0; g < i.length; g++)l += parseInt(i.charAt(g), 10);
            return l = (10 - l % 10) % 10, l + "" === c.charAt(f - 1)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {ismn: {"default": "Please enter a valid ISMN number"}}}), FormValidation.Validator.ismn = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "ismn");
            if ("" === c)return !0;
            var d;
            switch (!0) {
                case/^M\d{9}$/.test(c):
                case/^M-\d{4}-\d{4}-\d{1}$/.test(c):
                case/^M\s\d{4}\s\d{4}\s\d{1}$/.test(c):
                    d = "ISMN10";
                    break;
                case/^9790\d{9}$/.test(c):
                case/^979-0-\d{4}-\d{4}-\d{1}$/.test(c):
                case/^979\s0\s\d{4}\s\d{4}\s\d{1}$/.test(c):
                    d = "ISMN13";
                    break;
                default:
                    return !1
            }
            "ISMN10" === d && (c = "9790" + c.substr(1)), c = c.replace(/[^0-9]/gi, "");
            for (var e = c.length, f = 0, g = [1, 3], h = 0; e - 1 > h; h++)f += parseInt(c.charAt(h), 10) * g[h % 2];
            return f = 10 - f % 10, f + "" === c.charAt(e - 1)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {issn: {"default": "Please enter a valid ISSN number"}}}), FormValidation.Validator.issn = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "issn");
            if ("" === c)return !0;
            if (!/^\d{4}\-\d{3}[\dX]$/.test(c))return !1;
            c = c.replace(/[^0-9X]/gi, "");
            var d = c.split(""), e = d.length, f = 0;
            "X" === d[7] && (d[7] = 10);
            for (var g = 0; e > g; g++)f += parseInt(d[g], 10) * (8 - g);
            return f % 11 === 0
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            lessThan: {
                "default": "Please enter a value less than or equal to %s",
                notInclusive: "Please enter a value less than %s"
            }
        }
    }), FormValidation.Validator.lessThan = {
        html5Attributes: {
            message: "message",
            value: "value",
            inclusive: "inclusive"
        }, enableByHtml5: function (a) {
            var b = a.attr("type"), c = a.attr("max");
            return c && "date" !== b ? {value: c} : !1
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "lessThan");
            if ("" === e)return !0;
            if (e = this._format(e), !a.isNumeric(e))return !1;
            var f = b.getLocale(), g = a.isNumeric(d.value) ? d.value : b.getDynamicOption(c, d.value), h = this._format(g);
            return e = parseFloat(e), d.inclusive === !0 || void 0 === d.inclusive ? {
                valid: h >= e,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].lessThan["default"], g)
            } : {
                valid: h > e,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].lessThan.notInclusive, g)
            }
        }, _format: function (a) {
            return (a + "").replace(",", ".")
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {mac: {"default": "Please enter a valid MAC address"}}}), FormValidation.Validator.mac = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "mac");
            return "" === c ? !0 : /^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/.test(c)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {meid: {"default": "Please enter a valid MEID number"}}}), FormValidation.Validator.meid = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "meid");
            if ("" === c)return !0;
            switch (!0) {
                case/^[0-9A-F]{15}$/i.test(c):
                case/^[0-9A-F]{2}[- ][0-9A-F]{6}[- ][0-9A-F]{6}[- ][0-9A-F]$/i.test(c):
                case/^\d{19}$/.test(c):
                case/^\d{5}[- ]\d{5}[- ]\d{4}[- ]\d{4}[- ]\d$/.test(c):
                    var d = c.charAt(c.length - 1);
                    if (c = c.replace(/[- ]/g, ""), c.match(/^\d*$/i))return FormValidation.Helper.luhn(c);
                    c = c.slice(0, -1);
                    for (var e = "", f = 1; 13 >= f; f += 2)e += (2 * parseInt(c.charAt(f), 16)).toString(16);
                    var g = 0;
                    for (f = 0; f < e.length; f++)g += parseInt(e.charAt(f), 16);
                    return g % 10 === 0 ? "0" === d : d === (2 * (10 * Math.floor((g + 10) / 10) - g)).toString(16);
                case/^[0-9A-F]{14}$/i.test(c):
                case/^[0-9A-F]{2}[- ][0-9A-F]{6}[- ][0-9A-F]{6}$/i.test(c):
                case/^\d{18}$/.test(c):
                case/^\d{5}[- ]\d{5}[- ]\d{4}[- ]\d{4}$/.test(c):
                    return !0;
                default:
                    return !1
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {notEmpty: {"default": "Please enter a value"}}}), FormValidation.Validator.notEmpty = {
        enableByHtml5: function (a) {
            var b = a.attr("required") + "";
            return "required" === b || "true" === b
        }, validate: function (b, c) {
            var d = c.attr("type");
            if ("radio" === d || "checkbox" === d) {
                var e = b.getNamespace();
                return b.getFieldElements(c.attr("data-" + e + "-field")).filter(":checked").length > 0
            }
            return "number" === d && c.get(0).validity && c.get(0).validity.badInput === !0 ? !0 : "" !== a.trim(c.val())
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {numeric: {"default": "Please enter a valid float number"}}}), FormValidation.Validator.numeric = {
        html5Attributes: {
            message: "message",
            separator: "separator"
        }, enableByHtml5: function (a) {
            return "number" === a.attr("type") && void 0 !== a.attr("step") && a.attr("step") % 1 !== 0
        }, validate: function (a, b, c) {
            if (this.enableByHtml5(b) && b.get(0).validity && b.get(0).validity.badInput === !0)return !1;
            var d = a.getFieldValue(b, "numeric");
            if ("" === d)return !0;
            var e = c.separator || ".";
            return "." !== e && (d = d.replace(e, ".")), !isNaN(parseFloat(d)) && isFinite(d)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            phone: {
                "default": "Please enter a valid phone number",
                country: "Please enter a valid phone number in %s",
                countries: {
                    AE: "United Arab Emirates",
                    BG: "Bulgaria",
                    BR: "Brazil",
                    CN: "China",
                    CZ: "Czech Republic",
                    DE: "Germany",
                    DK: "Denmark",
                    ES: "Spain",
                    FR: "France",
                    GB: "United Kingdom",
                    IN: "India",
                    MA: "Morocco",
                    NL: "Netherlands",
                    PK: "Pakistan",
                    RO: "Romania",
                    RU: "Russia",
                    SK: "Slovakia",
                    TH: "Thailand",
                    US: "USA",
                    VE: "Venezuela"
                }
            }
        }
    }), FormValidation.Validator.phone = {
        html5Attributes: {message: "message", country: "country"},
        COUNTRY_CODES: ["AE", "BG", "BR", "CN", "CZ", "DE", "DK", "ES", "FR", "GB", "IN", "MA", "NL", "PK", "RO", "RU", "SK", "TH", "US", "VE"],
        validate: function (b, c, d) {
            var e = b.getFieldValue(c, "phone");
            if ("" === e)return !0;
            var f = b.getLocale(), g = d.country;
            if (("string" != typeof g || -1 === a.inArray(g, this.COUNTRY_CODES)) && (g = b.getDynamicOption(c, g)), !g || -1 === a.inArray(g.toUpperCase(), this.COUNTRY_CODES))return !0;
            var h = !0;
            switch (g.toUpperCase()) {
                case"AE":
                    e = a.trim(e), h = /^(((\+|00)?971[\s\.-]?(\(0\)[\s\.-]?)?|0)(\(5(0|2|5|6)\)|5(0|2|5|6)|2|3|4|6|7|9)|60)([\s\.-]?[0-9]){7}$/.test(e);
                    break;
                case"BG":
                    e = e.replace(/\+|\s|-|\/|\(|\)/gi, ""), h = /^(0|359|00)(((700|900)[0-9]{5}|((800)[0-9]{5}|(800)[0-9]{4}))|(87|88|89)([0-9]{7})|((2[0-9]{7})|(([3-9][0-9])(([0-9]{6})|([0-9]{5})))))$/.test(e);
                    break;
                case"BR":
                    e = a.trim(e), h = /^(([\d]{4}[-.\s]{1}[\d]{2,3}[-.\s]{1}[\d]{2}[-.\s]{1}[\d]{2})|([\d]{4}[-.\s]{1}[\d]{3}[-.\s]{1}[\d]{4})|((\(?\+?[0-9]{2}\)?\s?)?(\(?\d{2}\)?\s?)?\d{4,5}[-.\s]?\d{4}))$/.test(e);
                    break;
                case"CN":
                    e = a.trim(e), h = /^((00|\+)?(86(?:-| )))?((\d{11})|(\d{3}[- ]{1}\d{4}[- ]{1}\d{4})|((\d{2,4}[- ]){1}(\d{7,8}|(\d{3,4}[- ]{1}\d{4}))([- ]{1}\d{1,4})?))$/.test(e);
                    break;
                case"CZ":
                    h = /^(((00)([- ]?)|\+)(420)([- ]?))?((\d{3})([- ]?)){2}(\d{3})$/.test(e);
                    break;
                case"DE":
                    e = a.trim(e), h = /^(((((((00|\+)49[ \-/]?)|0)[1-9][0-9]{1,4})[ \-/]?)|((((00|\+)49\()|\(0)[1-9][0-9]{1,4}\)[ \-/]?))[0-9]{1,7}([ \-/]?[0-9]{1,5})?)$/.test(e);
                    break;
                case"DK":
                    e = a.trim(e), h = /^(\+45|0045|\(45\))?\s?[2-9](\s?\d){7}$/.test(e);
                    break;
                case"ES":
                    e = a.trim(e), h = /^(?:(?:(?:\+|00)34\D?))?(?:5|6|7|8|9)(?:\d\D?){8}$/.test(e);
                    break;
                case"FR":
                    e = a.trim(e), h = /^(?:(?:(?:\+|00)33[ ]?(?:\(0\)[ ]?)?)|0){1}[1-9]{1}([ .-]?)(?:\d{2}\1?){3}\d{2}$/.test(e);
                    break;
                case"GB":
                    e = a.trim(e), h = /^\(?(?:(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?\(?(?:0\)?[\s-]?\(?)?|0)(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}|\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4}|\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3})|\d{5}\)?[\s-]?\d{4,5}|8(?:00[\s-]?11[\s-]?11|45[\s-]?46[\s-]?4\d))(?:(?:[\s-]?(?:x|ext\.?\s?|\#)\d+)?)$/.test(e);
                    break;
                case"IN":
                    e = a.trim(e), h = /((\+?)((0[ -]+)*|(91 )*)(\d{12}|\d{10}))|\d{5}([- ]*)\d{6}/.test(e);
                    break;
                case"MA":
                    e = a.trim(e), h = /^(?:(?:(?:\+|00)212[\s]?(?:[\s]?\(0\)[\s]?)?)|0){1}(?:5[\s.-]?[2-3]|6[\s.-]?[13-9]){1}[0-9]{1}(?:[\s.-]?\d{2}){3}$/.test(e);
                    break;
                case"NL":
                    e = a.trim(e), h = /(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)/.test(e);
                    break;
                case"PK":
                    e = a.trim(e), h = /^0?3[0-9]{2}[0-9]{7}$/.test(e);
                    break;
                case"RO":
                    h = /^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/g.test(e);
                    break;
                case"RU":
                    h = /^((8|\+7|007)[\-\.\/ ]?)?([\(\/\.]?\d{3}[\)\/\.]?[\-\.\/ ]?)?[\d\-\.\/ ]{7,10}$/g.test(e);
                    break;
                case"SK":
                    h = /^(((00)([- ]?)|\+)(420)([- ]?))?((\d{3})([- ]?)){2}(\d{3})$/.test(e);
                    break;
                case"TH":
                    h = /^0\(?([6|8-9]{2})*-([0-9]{3})*-([0-9]{4})$/.test(e);
                    break;
                case"VE":
                    e = a.trim(e), h = /^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$/.test(e);
                    break;
                case"US":
                default:
                    h = /^(?:(1\-?)|(\+1 ?))?\(?(\d{3})[\)\-\.]?(\d{3})[\-\.]?(\d{4})$/.test(e)
            }
            return {
                valid: h,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].phone.country, FormValidation.I18n[f].phone.countries[g])
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {regexp: {"default": "Please enter a value matching the pattern"}}}), FormValidation.Validator.regexp = {
        html5Attributes: {
            message: "message",
            regexp: "regexp"
        }, enableByHtml5: function (a) {
            var b = a.attr("pattern");
            return b ? {regexp: b} : !1
        }, validate: function (a, b, c) {
            var d = a.getFieldValue(b, "regexp");
            if ("" === d)return !0;
            var e = "string" == typeof c.regexp ? new RegExp(c.regexp) : c.regexp;
            return e.test(d)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {remote: {"default": "Please enter a valid value"}}}), FormValidation.Validator.remote = {
        html5Attributes: {
            message: "message",
            name: "name",
            type: "type",
            url: "url",
            data: "data",
            delay: "delay"
        }, destroy: function (a, b) {
            var c = a.getNamespace(), d = b.data(c + ".remote.timer");
            d && (clearTimeout(d), b.removeData(c + ".remote.timer"))
        }, validate: function (b, c, d) {
            function e() {
                var b = a.ajax({type: l, headers: m, url: k, dataType: "json", data: j});
                return b.success(function (a) {
                    a.valid = a.valid === !0 || "true" === a.valid, h.resolve(c, "remote", a)
                }).error(function () {
                    h.resolve(c, "remote", {valid: !1})
                }), h.fail(function () {
                    b.abort()
                }), h
            }

            var f = b.getNamespace(), g = b.getFieldValue(c, "remote"), h = new a.Deferred;
            if ("" === g)return h.resolve(c, "remote", {valid: !0}), h;
            var i = c.attr("data-" + f + "-field"), j = d.data || {}, k = d.url, l = d.type || "GET", m = d.headers || {};
            return "function" == typeof j && (j = j.call(this, b)), "string" == typeof j && (j = JSON.parse(j)), "function" == typeof k && (k = k.call(this, b)), j[d.name || i] = g, d.delay ? (c.data(f + ".remote.timer") && clearTimeout(c.data(f + ".remote.timer")), c.data(f + ".remote.timer", setTimeout(e, d.delay)), h) : e()
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {rtn: {"default": "Please enter a valid RTN number"}}}), FormValidation.Validator.rtn = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "rtn");
            if ("" === c)return !0;
            if (!/^\d{9}$/.test(c))return !1;
            for (var d = 0, e = 0; e < c.length; e += 3)d += 3 * parseInt(c.charAt(e), 10) + 7 * parseInt(c.charAt(e + 1), 10) + parseInt(c.charAt(e + 2), 10);
            return 0 !== d && d % 10 === 0
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {sedol: {"default": "Please enter a valid SEDOL number"}}}), FormValidation.Validator.sedol = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "sedol");
            if ("" === c)return !0;
            if (c = c.toUpperCase(), !/^[0-9A-Z]{7}$/.test(c))return !1;
            for (var d = 0, e = [1, 3, 1, 7, 3, 9, 1], f = c.length, g = 0; f - 1 > g; g++)d += e[g] * parseInt(c.charAt(g), 36);
            return d = (10 - d % 10) % 10, d + "" === c.charAt(f - 1)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {siren: {"default": "Please enter a valid SIREN number"}}}), FormValidation.Validator.siren = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "siren");
            return "" === c ? !0 : /^\d{9}$/.test(c) ? FormValidation.Helper.luhn(c) : !1
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {siret: {"default": "Please enter a valid SIRET number"}}}), FormValidation.Validator.siret = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "siret");
            if ("" === c)return !0;
            for (var d, e = 0, f = c.length, g = 0; f > g; g++)d = parseInt(c.charAt(g), 10), g % 2 === 0 && (d = 2 * d, d > 9 && (d -= 9)), e += d;
            return e % 10 === 0
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {step: {"default": "Please enter a valid step of %s"}}}), FormValidation.Validator.step = {
        html5Attributes: {
            message: "message",
            base: "baseValue",
            step: "step"
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "step");
            if ("" === e)return !0;
            if (d = a.extend({}, {baseValue: 0, step: 1}, d), e = parseFloat(e), !a.isNumeric(e))return !1;
            var f = function (a, b) {
                var c = Math.pow(10, b);
                a *= c;
                var d = a > 0 | -(0 > a), e = a % 1 === .5 * d;
                return e ? (Math.floor(a) + (d > 0)) / c : Math.round(a) / c
            }, g = function (a, b) {
                if (0 === b)return 1;
                var c = (a + "").split("."), d = (b + "").split("."), e = (1 === c.length ? 0 : c[1].length) + (1 === d.length ? 0 : d[1].length);
                return f(a - b * Math.floor(a / b), e)
            }, h = b.getLocale(), i = g(e - d.baseValue, d.step);
            return {
                valid: 0 === i || i === d.step,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[h].step["default"], [d.step])
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            stringCase: {
                "default": "Please enter only lowercase characters",
                upper: "Please enter only uppercase characters"
            }
        }
    }), FormValidation.Validator.stringCase = {
        html5Attributes: {message: "message", "case": "case"},
        validate: function (a, b, c) {
            var d = a.getFieldValue(b, "stringCase");
            if ("" === d)return !0;
            var e = a.getLocale(), f = (c["case"] || "lower").toLowerCase();
            return {
                valid: "upper" === f ? d === d.toUpperCase() : d === d.toLowerCase(),
                message: c.message || ("upper" === f ? FormValidation.I18n[e].stringCase.upper : FormValidation.I18n[e].stringCase["default"])
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            stringLength: {
                "default": "Please enter a value with valid length",
                less: "Please enter less than %s characters",
                more: "Please enter more than %s characters",
                between: "Please enter value between %s and %s characters long"
            }
        }
    }), FormValidation.Validator.stringLength = {
        html5Attributes: {
            message: "message",
            min: "min",
            max: "max",
            trim: "trim",
            utf8bytes: "utf8Bytes"
        }, enableByHtml5: function (b) {
            var c = {}, d = b.attr("maxlength"), e = b.attr("minlength");
            return d && (c.max = parseInt(d, 10)), e && (c.min = parseInt(e, 10)), a.isEmptyObject(c) ? !1 : c
        }, validate: function (b, c, d) {
            var e = b.getFieldValue(c, "stringLength");
            if ((d.trim === !0 || "true" === d.trim) && (e = a.trim(e)), "" === e)return !0;
            var f = b.getLocale(), g = a.isNumeric(d.min) ? d.min : b.getDynamicOption(c, d.min), h = a.isNumeric(d.max) ? d.max : b.getDynamicOption(c, d.max), i = function (a) {
                for (var b = a.length, c = a.length - 1; c >= 0; c--) {
                    var d = a.charCodeAt(c);
                    d > 127 && 2047 >= d ? b++ : d > 2047 && 65535 >= d && (b += 2), d >= 56320 && 57343 >= d && c--
                }
                return b
            }, j = d.utf8Bytes ? i(e) : e.length, k = !0, l = d.message || FormValidation.I18n[f].stringLength["default"];
            switch ((g && j < parseInt(g, 10) || h && j > parseInt(h, 10)) && (k = !1), !0) {
                case!!g && !!h:
                    l = FormValidation.Helper.format(d.message || FormValidation.I18n[f].stringLength.between, [parseInt(g, 10), parseInt(h, 10)]);
                    break;
                case!!g:
                    l = FormValidation.Helper.format(d.message || FormValidation.I18n[f].stringLength.more, parseInt(g, 10));
                    break;
                case!!h:
                    l = FormValidation.Helper.format(d.message || FormValidation.I18n[f].stringLength.less, parseInt(h, 10))
            }
            return {valid: k, message: l}
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {uri: {"default": "Please enter a valid URI"}}}), FormValidation.Validator.uri = {
        html5Attributes: {
            message: "message",
            allowlocal: "allowLocal",
            allowemptyprotocol: "allowEmptyProtocol",
            protocol: "protocol"
        }, enableByHtml5: function (a) {
            return "url" === a.attr("type")
        }, validate: function (a, b, c) {
            var d = a.getFieldValue(b, "uri");
            if ("" === d)return !0;
            var e = c.allowLocal === !0 || "true" === c.allowLocal, f = c.allowEmptyProtocol === !0 || "true" === c.allowEmptyProtocol, g = (c.protocol || "http, https, ftp").split(",").join("|").replace(/\s/g, ""), h = new RegExp("^(?:(?:" + g + ")://)" + (f ? "?" : "") + "(?:\\S+(?::\\S*)?@)?(?:" + (e ? "" : "(?!(?:10|127)(?:\\.\\d{1,3}){3})(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})") + "(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))|(?:(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9]+)(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9])*(?:\\.(?:[a-z\\u00a1-\\uffff]{2,}))" + (e ? "?" : "") + ")(?::\\d{2,5})?(?:/[^\\s]*)?$", "i");
            return h.test(d)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            uuid: {
                "default": "Please enter a valid UUID number",
                version: "Please enter a valid UUID version %s number"
            }
        }
    }), FormValidation.Validator.uuid = {
        html5Attributes: {message: "message", version: "version"},
        validate: function (a, b, c) {
            var d = a.getFieldValue(b, "uuid");
            if ("" === d)return !0;
            var e = a.getLocale(), f = {
                3: /^[0-9A-F]{8}-[0-9A-F]{4}-3[0-9A-F]{3}-[0-9A-F]{4}-[0-9A-F]{12}$/i,
                4: /^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,
                5: /^[0-9A-F]{8}-[0-9A-F]{4}-5[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,
                all: /^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i
            }, g = c.version ? c.version + "" : "all";
            return {
                valid: null === f[g] ? !0 : f[g].test(d),
                message: c.version ? FormValidation.Helper.format(c.message || FormValidation.I18n[e].uuid.version, c.version) : c.message || FormValidation.I18n[e].uuid["default"]
            }
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            vat: {
                "default": "Please enter a valid VAT number",
                country: "Please enter a valid VAT number in %s",
                countries: {
                    AT: "Austria",
                    BE: "Belgium",
                    BG: "Bulgaria",
                    BR: "Brazil",
                    CH: "Switzerland",
                    CY: "Cyprus",
                    CZ: "Czech Republic",
                    DE: "Germany",
                    DK: "Denmark",
                    EE: "Estonia",
                    ES: "Spain",
                    FI: "Finland",
                    FR: "France",
                    GB: "United Kingdom",
                    GR: "Greek",
                    EL: "Greek",
                    HU: "Hungary",
                    HR: "Croatia",
                    IE: "Ireland",
                    IS: "Iceland",
                    IT: "Italy",
                    LT: "Lithuania",
                    LU: "Luxembourg",
                    LV: "Latvia",
                    MT: "Malta",
                    NL: "Netherlands",
                    NO: "Norway",
                    PL: "Poland",
                    PT: "Portugal",
                    RO: "Romania",
                    RU: "Russia",
                    RS: "Serbia",
                    SE: "Sweden",
                    SI: "Slovenia",
                    SK: "Slovakia",
                    VE: "Venezuela",
                    ZA: "South Africa"
                }
            }
        }
    }), FormValidation.Validator.vat = {
        html5Attributes: {message: "message", country: "country"},
        COUNTRY_CODES: ["AT", "BE", "BG", "BR", "CH", "CY", "CZ", "DE", "DK", "EE", "EL", "ES", "FI", "FR", "GB", "GR", "HR", "HU", "IE", "IS", "IT", "LT", "LU", "LV", "MT", "NL", "NO", "PL", "PT", "RO", "RU", "RS", "SE", "SK", "SI", "VE", "ZA"],
        validate: function (b, c, d) {
            var e = b.getFieldValue(c, "vat");
            if ("" === e)return !0;
            var f = b.getLocale(), g = d.country;
            if (g ? ("string" != typeof g || -1 === a.inArray(g.toUpperCase(), this.COUNTRY_CODES)) && (g = b.getDynamicOption(c, g)) : g = e.substr(0, 2), -1 === a.inArray(g, this.COUNTRY_CODES))return !0;
            var h = ["_", g.toLowerCase()].join("");
            return this[h](e) ? !0 : {
                valid: !1,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].vat.country, FormValidation.I18n[f].vat.countries[g.toUpperCase()])
            }
        },
        _at: function (a) {
            if (/^ATU[0-9]{8}$/.test(a) && (a = a.substr(2)), !/^U[0-9]{8}$/.test(a))return !1;
            a = a.substr(1);
            for (var b = 0, c = [1, 2, 1, 2, 1, 2, 1], d = 0, e = 0; 7 > e; e++)d = parseInt(a.charAt(e), 10) * c[e], d > 9 && (d = Math.floor(d / 10) + d % 10), b += d;
            return b = 10 - (b + 4) % 10, 10 === b && (b = 0), b + "" === a.substr(7, 1)
        },
        _be: function (a) {
            if (/^BE[0]{0,1}[0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[0]{0,1}[0-9]{9}$/.test(a))return !1;
            if (9 === a.length && (a = "0" + a), "0" === a.substr(1, 1))return !1;
            var b = parseInt(a.substr(0, 8), 10) + parseInt(a.substr(8, 2), 10);
            return b % 97 === 0
        },
        _bg: function (a) {
            if (/^BG[0-9]{9,10}$/.test(a) && (a = a.substr(2)), !/^[0-9]{9,10}$/.test(a))return !1;
            var b = 0, c = 0;
            if (9 === a.length) {
                for (c = 0; 8 > c; c++)b += parseInt(a.charAt(c), 10) * (c + 1);
                if (b %= 11, 10 === b)for (b = 0, c = 0; 8 > c; c++)b += parseInt(a.charAt(c), 10) * (c + 3);
                return b %= 10, b + "" === a.substr(8)
            }
            if (10 === a.length) {
                var d = function (a) {
                    var b = parseInt(a.substr(0, 2), 10) + 1900, c = parseInt(a.substr(2, 2), 10), d = parseInt(a.substr(4, 2), 10);
                    if (c > 40 ? (b += 100, c -= 40) : c > 20 && (b -= 100, c -= 20), !FormValidation.Helper.date(b, c, d))return !1;
                    for (var e = 0, f = [2, 4, 8, 5, 10, 9, 7, 3, 6], g = 0; 9 > g; g++)e += parseInt(a.charAt(g), 10) * f[g];
                    return e = e % 11 % 10, e + "" === a.substr(9, 1)
                }, e = function (a) {
                    for (var b = 0, c = [21, 19, 17, 13, 11, 9, 7, 3, 1], d = 0; 9 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
                    return b %= 10, b + "" === a.substr(9, 1)
                }, f = function (a) {
                    for (var b = 0, c = [4, 3, 2, 7, 6, 5, 4, 3, 2], d = 0; 9 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
                    return b = 11 - b % 11, 10 === b ? !1 : (11 === b && (b = 0), b + "" === a.substr(9, 1))
                };
                return d(a) || e(a) || f(a)
            }
            return !1
        },
        _br: function (a) {
            if ("" === a)return !0;
            var b = a.replace(/[^\d]+/g, "");
            if ("" === b || 14 !== b.length)return !1;
            if ("00000000000000" === b || "11111111111111" === b || "22222222222222" === b || "33333333333333" === b || "44444444444444" === b || "55555555555555" === b || "66666666666666" === b || "77777777777777" === b || "88888888888888" === b || "99999999999999" === b)return !1;
            for (var c = b.length - 2, d = b.substring(0, c), e = b.substring(c), f = 0, g = c - 7, h = c; h >= 1; h--)f += parseInt(d.charAt(c - h), 10) * g--, 2 > g && (g = 9);
            var i = 2 > f % 11 ? 0 : 11 - f % 11;
            if (i !== parseInt(e.charAt(0), 10))return !1;
            for (c += 1, d = b.substring(0, c), f = 0, g = c - 7, h = c; h >= 1; h--)f += parseInt(d.charAt(c - h), 10) * g--, 2 > g && (g = 9);
            return i = 2 > f % 11 ? 0 : 11 - f % 11, i === parseInt(e.charAt(1), 10)
        },
        _ch: function (a) {
            if (/^CHE[0-9]{9}(MWST)?$/.test(a) && (a = a.substr(2)), !/^E[0-9]{9}(MWST)?$/.test(a))return !1;
            a = a.substr(1);
            for (var b = 0, c = [5, 4, 3, 2, 7, 6, 5, 4], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b = 11 - b % 11, 10 === b ? !1 : (11 === b && (b = 0), b + "" === a.substr(8, 1))
        },
        _cy: function (a) {
            if (/^CY[0-5|9]{1}[0-9]{7}[A-Z]{1}$/.test(a) && (a = a.substr(2)), !/^[0-5|9]{1}[0-9]{7}[A-Z]{1}$/.test(a))return !1;
            if ("12" === a.substr(0, 2))return !1;
            for (var b = 0, c = {0: 1, 1: 0, 2: 5, 3: 7, 4: 9, 5: 13, 6: 15, 7: 17, 8: 19, 9: 21}, d = 0; 8 > d; d++) {
                var e = parseInt(a.charAt(d), 10);
                d % 2 === 0 && (e = c[e + ""]), b += e
            }
            return b = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"[b % 26], b + "" === a.substr(8, 1)
        },
        _cz: function (a) {
            if (/^CZ[0-9]{8,10}$/.test(a) && (a = a.substr(2)), !/^[0-9]{8,10}$/.test(a))return !1;
            var b = 0, c = 0;
            if (8 === a.length) {
                if (a.charAt(0) + "" == "9")return !1;
                for (b = 0, c = 0; 7 > c; c++)b += parseInt(a.charAt(c), 10) * (8 - c);
                return b = 11 - b % 11, 10 === b && (b = 0), 11 === b && (b = 1), b + "" === a.substr(7, 1)
            }
            if (9 === a.length && a.charAt(0) + "" == "6") {
                for (b = 0, c = 0; 7 > c; c++)b += parseInt(a.charAt(c + 1), 10) * (8 - c);
                return b = 11 - b % 11, 10 === b && (b = 0), 11 === b && (b = 1), b = [8, 7, 6, 5, 4, 3, 2, 1, 0, 9, 10][b - 1], b + "" === a.substr(8, 1)
            }
            if (9 === a.length || 10 === a.length) {
                var d = 1900 + parseInt(a.substr(0, 2), 10), e = parseInt(a.substr(2, 2), 10) % 50 % 20, f = parseInt(a.substr(4, 2), 10);
                if (9 === a.length) {
                    if (d >= 1980 && (d -= 100), d > 1953)return !1
                } else 1954 > d && (d += 100);
                if (!FormValidation.Helper.date(d, e, f))return !1;
                if (10 === a.length) {
                    var g = parseInt(a.substr(0, 9), 10) % 11;
                    return 1985 > d && (g %= 10), g + "" === a.substr(9, 1)
                }
                return !0
            }
            return !1
        },
        _de: function (a) {
            return /^DE[0-9]{9}$/.test(a) && (a = a.substr(2)), /^[0-9]{9}$/.test(a) ? FormValidation.Helper.mod11And10(a) : !1
        },
        _dk: function (a) {
            if (/^DK[0-9]{8}$/.test(a) && (a = a.substr(2)), !/^[0-9]{8}$/.test(a))return !1;
            for (var b = 0, c = [2, 7, 6, 5, 4, 3, 2, 1], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b % 11 === 0
        },
        _ee: function (a) {
            if (/^EE[0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[0-9]{9}$/.test(a))return !1;
            for (var b = 0, c = [3, 7, 1, 3, 7, 1, 3, 7, 1], d = 0; 9 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b % 10 === 0
        },
        _es: function (a) {
            if (/^ES[0-9A-Z][0-9]{7}[0-9A-Z]$/.test(a) && (a = a.substr(2)), !/^[0-9A-Z][0-9]{7}[0-9A-Z]$/.test(a))return !1;
            var b = function (a) {
                var b = parseInt(a.substr(0, 8), 10);
                return b = "TRWAGMYFPDXBNJZSQVHLCKE"[b % 23], b + "" === a.substr(8, 1)
            }, c = function (a) {
                var b = ["XYZ".indexOf(a.charAt(0)), a.substr(1)].join("");
                return b = parseInt(b, 10), b = "TRWAGMYFPDXBNJZSQVHLCKE"[b % 23], b + "" === a.substr(8, 1)
            }, d = function (a) {
                var b, c = a.charAt(0);
                if (-1 !== "KLM".indexOf(c))return b = parseInt(a.substr(1, 8), 10), b = "TRWAGMYFPDXBNJZSQVHLCKE"[b % 23], b + "" === a.substr(8, 1);
                if (-1 !== "ABCDEFGHJNPQRSUVW".indexOf(c)) {
                    for (var d = 0, e = [2, 1, 2, 1, 2, 1, 2], f = 0, g = 0; 7 > g; g++)f = parseInt(a.charAt(g + 1), 10) * e[g], f > 9 && (f = Math.floor(f / 10) + f % 10), d += f;
                    return d = 10 - d % 10, d + "" === a.substr(8, 1) || "JABCDEFGHI"[d] === a.substr(8, 1)
                }
                return !1
            }, e = a.charAt(0);
            return /^[0-9]$/.test(e) ? b(a) : /^[XYZ]$/.test(e) ? c(a) : d(a)
        },
        _fi: function (a) {
            if (/^FI[0-9]{8}$/.test(a) && (a = a.substr(2)), !/^[0-9]{8}$/.test(a))return !1;
            for (var b = 0, c = [7, 9, 10, 5, 8, 4, 2, 1], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b % 11 === 0
        },
        _fr: function (a) {
            if (/^FR[0-9A-Z]{2}[0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[0-9A-Z]{2}[0-9]{9}$/.test(a))return !1;
            if (!FormValidation.Helper.luhn(a.substr(2)))return !1;
            if (/^[0-9]{2}$/.test(a.substr(0, 2)))return a.substr(0, 2) === parseInt(a.substr(2) + "12", 10) % 97 + "";
            var b, c = "0123456789ABCDEFGHJKLMNPQRSTUVWXYZ";
            return b = /^[0-9]{1}$/.test(a.charAt(0)) ? 24 * c.indexOf(a.charAt(0)) + c.indexOf(a.charAt(1)) - 10 : 34 * c.indexOf(a.charAt(0)) + c.indexOf(a.charAt(1)) - 100, (parseInt(a.substr(2), 10) + 1 + Math.floor(b / 11)) % 11 === b % 11
        },
        _gb: function (a) {
            if ((/^GB[0-9]{9}$/.test(a) || /^GB[0-9]{12}$/.test(a) || /^GBGD[0-9]{3}$/.test(a) || /^GBHA[0-9]{3}$/.test(a) || /^GB(GD|HA)8888[0-9]{5}$/.test(a)) && (a = a.substr(2)), !(/^[0-9]{9}$/.test(a) || /^[0-9]{12}$/.test(a) || /^GD[0-9]{3}$/.test(a) || /^HA[0-9]{3}$/.test(a) || /^(GD|HA)8888[0-9]{5}$/.test(a)))return !1;
            var b = a.length;
            if (5 === b) {
                var c = a.substr(0, 2), d = parseInt(a.substr(2), 10);
                return "GD" === c && 500 > d || "HA" === c && d >= 500
            }
            if (11 === b && ("GD8888" === a.substr(0, 6) || "HA8888" === a.substr(0, 6)))return "GD" === a.substr(0, 2) && parseInt(a.substr(6, 3), 10) >= 500 || "HA" === a.substr(0, 2) && parseInt(a.substr(6, 3), 10) < 500 ? !1 : parseInt(a.substr(6, 3), 10) % 97 === parseInt(a.substr(9, 2), 10);
            if (9 === b || 12 === b) {
                for (var e = 0, f = [8, 7, 6, 5, 4, 3, 2, 10, 1], g = 0; 9 > g; g++)e += parseInt(a.charAt(g), 10) * f[g];
                return e %= 97, parseInt(a.substr(0, 3), 10) >= 100 ? 0 === e || 42 === e || 55 === e : 0 === e
            }
            return !0
        },
        _gr: function (a) {
            if (/^(GR|EL)[0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[0-9]{9}$/.test(a))return !1;
            8 === a.length && (a = "0" + a);
            for (var b = 0, c = [256, 128, 64, 32, 16, 8, 4, 2], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b = b % 11 % 10, b + "" === a.substr(8, 1)
        },
        _el: function (a) {
            return this._gr(a)
        },
        _hu: function (a) {
            if (/^HU[0-9]{8}$/.test(a) && (a = a.substr(2)), !/^[0-9]{8}$/.test(a))return !1;
            for (var b = 0, c = [9, 7, 3, 1, 9, 7, 3, 1], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b % 10 === 0
        },
        _hr: function (a) {
            return /^HR[0-9]{11}$/.test(a) && (a = a.substr(2)), /^[0-9]{11}$/.test(a) ? FormValidation.Helper.mod11And10(a) : !1
        },
        _ie: function (a) {
            if (/^IE[0-9]{1}[0-9A-Z\*\+]{1}[0-9]{5}[A-Z]{1,2}$/.test(a) && (a = a.substr(2)), !/^[0-9]{1}[0-9A-Z\*\+]{1}[0-9]{5}[A-Z]{1,2}$/.test(a))return !1;
            var b = function (a) {
                for (; a.length < 7;)a = "0" + a;
                for (var b = "WABCDEFGHIJKLMNOPQRSTUV", c = 0, d = 0; 7 > d; d++)c += parseInt(a.charAt(d), 10) * (8 - d);
                return c += 9 * b.indexOf(a.substr(7)), b[c % 23]
            };
            return /^[0-9]+$/.test(a.substr(0, 7)) ? a.charAt(7) === b(a.substr(0, 7) + a.substr(8) + "") : -1 !== "ABCDEFGHIJKLMNOPQRSTUVWXYZ+*".indexOf(a.charAt(1)) ? a.charAt(7) === b(a.substr(2, 5) + a.substr(0, 1) + "") : !0
        },
        _is: function (a) {
            return /^IS[0-9]{5,6}$/.test(a) && (a = a.substr(2)), /^[0-9]{5,6}$/.test(a)
        },
        _it: function (a) {
            if (/^IT[0-9]{11}$/.test(a) && (a = a.substr(2)), !/^[0-9]{11}$/.test(a))return !1;
            if (0 === parseInt(a.substr(0, 7), 10))return !1;
            var b = parseInt(a.substr(7, 3), 10);
            return 1 > b || b > 201 && 999 !== b && 888 !== b ? !1 : FormValidation.Helper.luhn(a)
        },
        _lt: function (a) {
            if (/^LT([0-9]{7}1[0-9]{1}|[0-9]{10}1[0-9]{1})$/.test(a) && (a = a.substr(2)), !/^([0-9]{7}1[0-9]{1}|[0-9]{10}1[0-9]{1})$/.test(a))return !1;
            var b, c = a.length, d = 0;
            for (b = 0; c - 1 > b; b++)d += parseInt(a.charAt(b), 10) * (1 + b % 9);
            var e = d % 11;
            if (10 === e)for (d = 0, b = 0; c - 1 > b; b++)d += parseInt(a.charAt(b), 10) * (1 + (b + 2) % 9);
            return e = e % 11 % 10, e + "" === a.charAt(c - 1)
        },
        _lu: function (a) {
            return /^LU[0-9]{8}$/.test(a) && (a = a.substr(2)), /^[0-9]{8}$/.test(a) ? parseInt(a.substr(0, 6), 10) % 89 + "" === a.substr(6, 2) : !1
        },
        _lv: function (a) {
            if (/^LV[0-9]{11}$/.test(a) && (a = a.substr(2)), !/^[0-9]{11}$/.test(a))return !1;
            var b, c = parseInt(a.charAt(0), 10), d = 0, e = [], f = a.length;
            if (c > 3) {
                for (d = 0, e = [9, 1, 4, 8, 3, 10, 2, 5, 7, 6, 1], b = 0; f > b; b++)d += parseInt(a.charAt(b), 10) * e[b];
                return d %= 11, 3 === d
            }
            var g = parseInt(a.substr(0, 2), 10), h = parseInt(a.substr(2, 2), 10), i = parseInt(a.substr(4, 2), 10);
            if (i = i + 1800 + 100 * parseInt(a.charAt(6), 10), !FormValidation.Helper.date(i, h, g))return !1;
            for (d = 0, e = [10, 5, 8, 4, 2, 1, 6, 3, 7, 9], b = 0; f - 1 > b; b++)d += parseInt(a.charAt(b), 10) * e[b];
            return d = (d + 1) % 11 % 10, d + "" === a.charAt(f - 1)
        },
        _mt: function (a) {
            if (/^MT[0-9]{8}$/.test(a) && (a = a.substr(2)), !/^[0-9]{8}$/.test(a))return !1;
            for (var b = 0, c = [3, 4, 6, 7, 8, 9, 10, 1], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b % 37 === 0
        },
        _nl: function (a) {
            if (/^NL[0-9]{9}B[0-9]{2}$/.test(a) && (a = a.substr(2)), !/^[0-9]{9}B[0-9]{2}$/.test(a))return !1;
            for (var b = 0, c = [9, 8, 7, 6, 5, 4, 3, 2], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b %= 11, b > 9 && (b = 0), b + "" === a.substr(8, 1)
        },
        _no: function (a) {
            if (/^NO[0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[0-9]{9}$/.test(a))return !1;
            for (var b = 0, c = [3, 2, 7, 6, 5, 4, 3, 2], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b = 11 - b % 11, 11 === b && (b = 0), b + "" === a.substr(8, 1)
        },
        _pl: function (a) {
            if (/^PL[0-9]{10}$/.test(a) && (a = a.substr(2)), !/^[0-9]{10}$/.test(a))return !1;
            for (var b = 0, c = [6, 5, 7, 2, 3, 4, 5, 6, 7, -1], d = 0; 10 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b % 11 === 0
        },
        _pt: function (a) {
            if (/^PT[0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[0-9]{9}$/.test(a))return !1;
            for (var b = 0, c = [9, 8, 7, 6, 5, 4, 3, 2], d = 0; 8 > d; d++)b += parseInt(a.charAt(d), 10) * c[d];
            return b = 11 - b % 11, b > 9 && (b = 0), b + "" === a.substr(8, 1)
        },
        _ro: function (a) {
            if (/^RO[1-9][0-9]{1,9}$/.test(a) && (a = a.substr(2)), !/^[1-9][0-9]{1,9}$/.test(a))return !1;
            for (var b = a.length, c = [7, 5, 3, 2, 1, 7, 5, 3, 2].slice(10 - b), d = 0, e = 0; b - 1 > e; e++)d += parseInt(a.charAt(e), 10) * c[e];
            return d = 10 * d % 11 % 10, d + "" === a.substr(b - 1, 1)
        },
        _ru: function (a) {
            if (/^RU([0-9]{10}|[0-9]{12})$/.test(a) && (a = a.substr(2)), !/^([0-9]{10}|[0-9]{12})$/.test(a))return !1;
            var b = 0;
            if (10 === a.length) {
                var c = 0, d = [2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
                for (b = 0; 10 > b; b++)c += parseInt(a.charAt(b), 10) * d[b];
                return c %= 11, c > 9 && (c %= 10), c + "" === a.substr(9, 1)
            }
            if (12 === a.length) {
                var e = 0, f = [7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0], g = 0, h = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
                for (b = 0; 11 > b; b++)e += parseInt(a.charAt(b), 10) * f[b], g += parseInt(a.charAt(b), 10) * h[b];
                return e %= 11, e > 9 && (e %= 10), g %= 11, g > 9 && (g %= 10), e + "" === a.substr(10, 1) && g + "" === a.substr(11, 1)
            }
            return !1
        },
        _rs: function (a) {
            if (/^RS[0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[0-9]{9}$/.test(a))return !1;
            for (var b = 10, c = 0, d = 0; 8 > d; d++)c = (parseInt(a.charAt(d), 10) + b) % 10, 0 === c && (c = 10), b = 2 * c % 11;
            return (b + parseInt(a.substr(8, 1), 10)) % 10 === 1
        },
        _se: function (a) {
            return /^SE[0-9]{10}01$/.test(a) && (a = a.substr(2)), /^[0-9]{10}01$/.test(a) ? (a = a.substr(0, 10), FormValidation.Helper.luhn(a)) : !1
        },
        _si: function (a) {
            var b = a.match(/^(SI)?([1-9][0-9]{7})$/);
            if (!b)return !1;
            b[1] && (a = a.substr(2));
            for (var c = 0, d = [8, 7, 6, 5, 4, 3, 2], e = 0; 7 > e; e++)c += parseInt(a.charAt(e), 10) * d[e];
            return c = 11 - c % 11, 10 === c && (c = 0), c + "" === a.substr(7, 1)
        },
        _sk: function (a) {
            return /^SK[1-9][0-9][(2-4)|(6-9)][0-9]{7}$/.test(a) && (a = a.substr(2)), /^[1-9][0-9][(2-4)|(6-9)][0-9]{7}$/.test(a) ? parseInt(a, 10) % 11 === 0 : !1
        },
        _ve: function (a) {
            if (/^VE[VEJPG][0-9]{9}$/.test(a) && (a = a.substr(2)), !/^[VEJPG][0-9]{9}$/.test(a))return !1;
            for (var b = {
                V: 4,
                E: 8,
                J: 12,
                P: 16,
                G: 20
            }, c = b[a.charAt(0)], d = [3, 2, 7, 6, 5, 4, 3, 2], e = 0; 8 > e; e++)c += parseInt(a.charAt(e + 1), 10) * d[e];
            return c = 11 - c % 11, (11 === c || 10 === c) && (c = 0), c + "" === a.substr(9, 1)
        },
        _za: function (a) {
            return /^ZA4[0-9]{9}$/.test(a) && (a = a.substr(2)), /^4[0-9]{9}$/.test(a)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {en_US: {vin: {"default": "Please enter a valid VIN number"}}}), FormValidation.Validator.vin = {
        validate: function (a, b) {
            var c = a.getFieldValue(b, "vin");
            if ("" === c)return !0;
            if (!/^[a-hj-npr-z0-9]{8}[0-9xX][a-hj-npr-z0-9]{8}$/i.test(c))return !1;
            c = c.toUpperCase();
            for (var d = {
                A: 1,
                B: 2,
                C: 3,
                D: 4,
                E: 5,
                F: 6,
                G: 7,
                H: 8,
                J: 1,
                K: 2,
                L: 3,
                M: 4,
                N: 5,
                P: 7,
                R: 9,
                S: 2,
                T: 3,
                U: 4,
                V: 5,
                W: 6,
                X: 7,
                Y: 8,
                Z: 9,
                1: 1,
                2: 2,
                3: 3,
                4: 4,
                5: 5,
                6: 6,
                7: 7,
                8: 8,
                9: 9,
                0: 0
            }, e = [8, 7, 6, 5, 4, 3, 2, 10, 0, 9, 8, 7, 6, 5, 4, 3, 2], f = 0, g = c.length, h = 0; g > h; h++)f += d[c.charAt(h) + ""] * e[h];
            var i = f % 11;
            return 10 === i && (i = "X"), i + "" === c.charAt(8)
        }
    }
}(jQuery), function (a) {
    FormValidation.I18n = a.extend(!0, FormValidation.I18n || {}, {
        en_US: {
            zipCode: {
                "default": "Please enter a valid postal code",
                country: "Please enter a valid postal code in %s",
                countries: {
                    AT: "Austria",
                    BG: "Bulgaria",
                    BR: "Brazil",
                    CA: "Canada",
                    CH: "Switzerland",
                    CZ: "Czech Republic",
                    DE: "Germany",
                    DK: "Denmark",
                    ES: "Spain",
                    FR: "France",
                    GB: "United Kingdom",
                    IE: "Ireland",
                    IN: "India",
                    IT: "Italy",
                    MA: "Morocco",
                    NL: "Netherlands",
                    PT: "Portugal",
                    RO: "Romania",
                    RU: "Russia",
                    SE: "Sweden",
                    SG: "Singapore",
                    SK: "Slovakia",
                    US: "USA"
                }
            }
        }
    }), FormValidation.Validator.zipCode = {
        html5Attributes: {message: "message", country: "country"},
        COUNTRY_CODES: ["AT", "BG", "BR", "CA", "CH", "CZ", "DE", "DK", "ES", "FR", "GB", "IE", "IN", "IT", "MA", "NL", "PT", "RO", "RU", "SE", "SG", "SK", "US"],
        validate: function (b, c, d) {
            var e = b.getFieldValue(c, "zipCode");
            if ("" === e || !d.country)return !0;
            var f = b.getLocale(), g = d.country;
            if (("string" != typeof g || -1 === a.inArray(g, this.COUNTRY_CODES)) && (g = b.getDynamicOption(c, g)), !g || -1 === a.inArray(g.toUpperCase(), this.COUNTRY_CODES))return !0;
            var h = !1;
            switch (g = g.toUpperCase()) {
                case"AT":
                    h = /^([1-9]{1})(\d{3})$/.test(e);
                    break;
                case"BG":
                    h = /^([1-9]{1}[0-9]{3})$/.test(a.trim(e));
                    break;
                case"BR":
                    h = /^(\d{2})([\.]?)(\d{3})([\-]?)(\d{3})$/.test(e);
                    break;
                case"CA":
                    h = /^(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|X|Y){1}[0-9]{1}(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|W|X|Y|Z){1}\s?[0-9]{1}(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|W|X|Y|Z){1}[0-9]{1}$/i.test(e);
                    break;
                case"CH":
                    h = /^([1-9]{1})(\d{3})$/.test(e);
                    break;
                case"CZ":
                    h = /^(\d{3})([ ]?)(\d{2})$/.test(e);
                    break;
                case"DE":
                    h = /^(?!01000|99999)(0[1-9]\d{3}|[1-9]\d{4})$/.test(e);
                    break;
                case"DK":
                    h = /^(DK(-|\s)?)?\d{4}$/i.test(e);
                    break;
                case"ES":
                    h = /^(?:0[1-9]|[1-4][0-9]|5[0-2])\d{3}$/.test(e);
                    break;
                case"FR":
                    h = /^[0-9]{5}$/i.test(e);
                    break;
                case"GB":
                    h = this._gb(e);
                    break;
                case"IN":
                    h = /^\d{3}\s?\d{3}$/.test(e);
                    break;
                case"IE":
                    h = /^(D6W|[ACDEFHKNPRTVWXY]\d{2})\s[0-9ACDEFHKNPRTVWXY]{4}$/.test(e);
                    break;
                case"IT":
                    h = /^(I-|IT-)?\d{5}$/i.test(e);
                    break;
                case"MA":
                    h = /^[1-9][0-9]{4}$/i.test(e);
                    break;
                case"NL":
                    h = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i.test(e);
                    break;
                case"PT":
                    h = /^[1-9]\d{3}-\d{3}$/.test(e);
                    break;
                case"RO":
                    h = /^(0[1-8]{1}|[1-9]{1}[0-5]{1})?[0-9]{4}$/i.test(e);
                    break;
                case"RU":
                    h = /^[0-9]{6}$/i.test(e);
                    break;
                case"SE":
                    h = /^(S-)?\d{3}\s?\d{2}$/i.test(e);
                    break;
                case"SG":
                    h = /^([0][1-9]|[1-6][0-9]|[7]([0-3]|[5-9])|[8][0-2])(\d{4})$/i.test(e);
                    break;
                case"SK":
                    h = /^(\d{3})([ ]?)(\d{2})$/.test(e);
                    break;
                case"US":
                default:
                    h = /^\d{4,5}([\-]?\d{4})?$/.test(e)
            }
            return {
                valid: h,
                message: FormValidation.Helper.format(d.message || FormValidation.I18n[f].zipCode.country, FormValidation.I18n[f].zipCode.countries[g])
            }
        },
        _gb: function (a) {
            for (var b = "[ABCDEFGHIJKLMNOPRSTUWYZ]", c = "[ABCDEFGHKLMNOPQRSTUVWXY]", d = "[ABCDEFGHJKPMNRSTUVWXY]", e = "[ABEHMNPRVWXY]", f = "[ABDEFGHJLNPQRSTUWXYZ]", g = [new RegExp("^(" + b + "{1}" + c + "?[0-9]{1,2})(\\s*)([0-9]{1}" + f + "{2})$", "i"), new RegExp("^(" + b + "{1}[0-9]{1}" + d + "{1})(\\s*)([0-9]{1}" + f + "{2})$", "i"), new RegExp("^(" + b + "{1}" + c + "{1}?[0-9]{1}" + e + "{1})(\\s*)([0-9]{1}" + f + "{2})$", "i"), new RegExp("^(BF1)(\\s*)([0-6]{1}[ABDEFGHJLNPQRST]{1}[ABDEFGHJLNPQRSTUWZYZ]{1})$", "i"), /^(GIR)(\s*)(0AA)$/i, /^(BFPO)(\s*)([0-9]{1,4})$/i, /^(BFPO)(\s*)(c\/o\s*[0-9]{1,3})$/i, /^([A-Z]{4})(\s*)(1ZZ)$/i, /^(AI-2640)$/i], h = 0; h < g.length; h++)if (g[h].test(a))return !0;
            return !1
        }
    }
}(jQuery);
/**
 * Lightbox v2.7.1
 * by Lokesh Dhakar - http://lokeshdhakar.com/projects/lightbox2/
 *
 * @license http://creativecommons.org/licenses/by/2.5/
 * - Free for use in both personal and commercial projects
 * - Attribution requires leaving author name, author link, and the license info intact
 */
(function () {
    var a = jQuery, b = function () {
        function a() {
            this.fadeDuration = 500, this.fitImagesInViewport = !0, this.resizeDuration = 700, this.positionFromTop = 50, this.showImageNumberLabel = !0, this.alwaysShowNavOnTouchDevices = !1, this.wrapAround = !1
        }

        return a.prototype.albumLabel = function (a, b) {
            return "Image " + a + " of " + b
        }, a
    }(), c = function () {
        function b(a) {
            this.options = a, this.album = [], this.currentImageIndex = void 0, this.init()
        }

        return b.prototype.init = function () {
            this.enable(), this.build()
        }, b.prototype.enable = function () {
            var b = this;
            a("body").on("click", "a[rel^=lightbox], area[rel^=lightbox], a[data-lightbox], area[data-lightbox]", function (c) {
                return b.start(a(c.currentTarget)), !1
            })
        }, b.prototype.build = function () {
            var b = this;
            a("<div id='lightboxOverlay' class='lightboxOverlay'></div><div id='lightbox' class='lightbox'><div class='lb-outerContainer'><div class='lb-container'><img class='lb-image' src='' /><div class='lb-nav'><a class='lb-prev' href='' ></a><a class='lb-next' href='' ></a></div><div class='lb-loader'><a class='lb-cancel'></a></div></div></div><div class='lb-dataContainer'><div class='lb-data'><div class='lb-details'><span class='lb-caption'></span><span class='lb-number'></span></div><div class='lb-closeContainer'><a class='lb-close'></a></div></div></div></div>").appendTo(a("body")), this.$lightbox = a("#lightbox"), this.$overlay = a("#lightboxOverlay"), this.$outerContainer = this.$lightbox.find(".lb-outerContainer"), this.$container = this.$lightbox.find(".lb-container"), this.containerTopPadding = parseInt(this.$container.css("padding-top"), 10), this.containerRightPadding = parseInt(this.$container.css("padding-right"), 10), this.containerBottomPadding = parseInt(this.$container.css("padding-bottom"), 10), this.containerLeftPadding = parseInt(this.$container.css("padding-left"), 10), this.$overlay.hide().on("click", function () {
                return b.end(), !1
            }), this.$lightbox.hide().on("click", function (c) {
                return "lightbox" === a(c.target).attr("id") && b.end(), !1
            }), this.$outerContainer.on("click", function (c) {
                return "lightbox" === a(c.target).attr("id") && b.end(), !1
            }), this.$lightbox.find(".lb-prev").on("click", function () {
                return b.changeImage(0 === b.currentImageIndex ? b.album.length - 1 : b.currentImageIndex - 1), !1
            }), this.$lightbox.find(".lb-next").on("click", function () {
                return b.changeImage(b.currentImageIndex === b.album.length - 1 ? 0 : b.currentImageIndex + 1), !1
            }), this.$lightbox.find(".lb-loader, .lb-close").on("click", function () {
                return b.end(), !1
            })
        }, b.prototype.start = function (b) {
            function c(a) {
                d.album.push({link: a.attr("href"), title: a.attr("data-title") || a.attr("title")})
            }

            var d = this, e = a(window);
            e.on("resize", a.proxy(this.sizeOverlay, this)), a("select, object, embed").css({visibility: "hidden"}), this.sizeOverlay(), this.album = [];
            var f, g = 0, h = b.attr("data-lightbox");
            if (h) {
                f = a(b.prop("tagName") + '[data-lightbox="' + h + '"]');
                for (var i = 0; i < f.length; i = ++i)c(a(f[i])), f[i] === b[0] && (g = i)
            } else if ("lightbox" === b.attr("rel"))c(b); else {
                f = a(b.prop("tagName") + '[rel="' + b.attr("rel") + '"]');
                for (var j = 0; j < f.length; j = ++j)c(a(f[j])), f[j] === b[0] && (g = j)
            }
            var k = e.scrollTop() + this.options.positionFromTop, l = e.scrollLeft();
            this.$lightbox.css({top: k + "px", left: l + "px"}).fadeIn(this.options.fadeDuration), this.changeImage(g)
        }, b.prototype.changeImage = function (b) {
            var c = this;
            this.disableKeyboardNav();
            var d = this.$lightbox.find(".lb-image");
            this.$overlay.fadeIn(this.options.fadeDuration), a(".lb-loader").fadeIn("slow"), this.$lightbox.find(".lb-image, .lb-nav, .lb-prev, .lb-next, .lb-dataContainer, .lb-numbers, .lb-caption").hide(), this.$outerContainer.addClass("animating");
            var e = new Image;
            e.onload = function () {
                var f, g, h, i, j, k, l;
                d.attr("src", c.album[b].link), f = a(e), d.width(e.width), d.height(e.height), c.options.fitImagesInViewport && (l = a(window).width(), k = a(window).height(), j = l - c.containerLeftPadding - c.containerRightPadding - 20, i = k - c.containerTopPadding - c.containerBottomPadding - 120, (e.width > j || e.height > i) && (e.width / j > e.height / i ? (h = j, g = parseInt(e.height / (e.width / h), 10), d.width(h), d.height(g)) : (g = i, h = parseInt(e.width / (e.height / g), 10), d.width(h), d.height(g)))), c.sizeContainer(d.width(), d.height())
            }, e.src = this.album[b].link, this.currentImageIndex = b
        }, b.prototype.sizeOverlay = function () {
            this.$overlay.width(a(window).width()).height(a(document).height())
        }, b.prototype.sizeContainer = function (a, b) {
            function c() {
                d.$lightbox.find(".lb-dataContainer").width(g), d.$lightbox.find(".lb-prevLink").height(h), d.$lightbox.find(".lb-nextLink").height(h), d.showImage()
            }

            var d = this, e = this.$outerContainer.outerWidth(), f = this.$outerContainer.outerHeight(), g = a + this.containerLeftPadding + this.containerRightPadding, h = b + this.containerTopPadding + this.containerBottomPadding;
            e !== g || f !== h ? this.$outerContainer.animate({
                width: g,
                height: h
            }, this.options.resizeDuration, "swing", function () {
                c()
            }) : c()
        }, b.prototype.showImage = function () {
            this.$lightbox.find(".lb-loader").hide(), this.$lightbox.find(".lb-image").fadeIn("slow"), this.updateNav(), this.updateDetails(), this.preloadNeighboringImages(), this.enableKeyboardNav()
        }, b.prototype.updateNav = function () {
            var a = !1;
            try {
                document.createEvent("TouchEvent"), a = this.options.alwaysShowNavOnTouchDevices ? !0 : !1
            } catch (b) {
            }
            this.$lightbox.find(".lb-nav").show(), this.album.length > 1 && (this.options.wrapAround ? (a && this.$lightbox.find(".lb-prev, .lb-next").css("opacity", "1"), this.$lightbox.find(".lb-prev, .lb-next").show()) : (this.currentImageIndex > 0 && (this.$lightbox.find(".lb-prev").show(), a && this.$lightbox.find(".lb-prev").css("opacity", "1")), this.currentImageIndex < this.album.length - 1 && (this.$lightbox.find(".lb-next").show(), a && this.$lightbox.find(".lb-next").css("opacity", "1"))))
        }, b.prototype.updateDetails = function () {
            var b = this;
            "undefined" != typeof this.album[this.currentImageIndex].title && "" !== this.album[this.currentImageIndex].title && this.$lightbox.find(".lb-caption").html(this.album[this.currentImageIndex].title).fadeIn("fast").find("a").on("click", function () {
                location.href = a(this).attr("href")
            }), this.album.length > 1 && this.options.showImageNumberLabel ? this.$lightbox.find(".lb-number").text(this.options.albumLabel(this.currentImageIndex + 1, this.album.length)).fadeIn("fast") : this.$lightbox.find(".lb-number").hide(), this.$outerContainer.removeClass("animating"), this.$lightbox.find(".lb-dataContainer").fadeIn(this.options.resizeDuration, function () {
                return b.sizeOverlay()
            })
        }, b.prototype.preloadNeighboringImages = function () {
            if (this.album.length > this.currentImageIndex + 1) {
                var a = new Image;
                a.src = this.album[this.currentImageIndex + 1].link
            }
            if (this.currentImageIndex > 0) {
                var b = new Image;
                b.src = this.album[this.currentImageIndex - 1].link
            }
        }, b.prototype.enableKeyboardNav = function () {
            a(document).on("keyup.keyboard", a.proxy(this.keyboardAction, this))
        }, b.prototype.disableKeyboardNav = function () {
            a(document).off(".keyboard")
        }, b.prototype.keyboardAction = function (a) {
            var b = 27, c = 37, d = 39, e = a.keyCode, f = String.fromCharCode(e).toLowerCase();
            e === b || f.match(/x|o|c/) ? this.end() : "p" === f || e === c ? 0 !== this.currentImageIndex ? this.changeImage(this.currentImageIndex - 1) : this.options.wrapAround && this.album.length > 1 && this.changeImage(this.album.length - 1) : ("n" === f || e === d) && (this.currentImageIndex !== this.album.length - 1 ? this.changeImage(this.currentImageIndex + 1) : this.options.wrapAround && this.album.length > 1 && this.changeImage(0))
        }, b.prototype.end = function () {
            this.disableKeyboardNav(), a(window).off("resize", this.sizeOverlay), this.$lightbox.fadeOut(this.options.fadeDuration), this.$overlay.fadeOut(this.options.fadeDuration), a("select, object, embed").css({visibility: "visible"})
        }, b
    }();
    a(function () {
        {
            var a = new b;
            new c(a)
        }
    })
}).call(this);
//# sourceMappingURL=lightbox.min.map
(function(a){a.isScrollToFixed=function(b){return !!a(b).data("ScrollToFixed")};a.ScrollToFixed=function(d,i){var l=this;l.$el=a(d);l.el=d;l.$el.data("ScrollToFixed",l);var c=false;var G=l.$el;var H;var E;var e;var y;var D=0;var q=0;var j=-1;var f=-1;var t=null;var z;var g;function u(){G.trigger("preUnfixed.ScrollToFixed");k();G.trigger("unfixed.ScrollToFixed");f=-1;D=G.offset().top;q=G.offset().left;if(l.options.offsets){q+=(G.offset().left-G.position().left)}if(j==-1){j=q}H=G.css("position");c=true;if(l.options.bottom!=-1){G.trigger("preFixed.ScrollToFixed");w();G.trigger("fixed.ScrollToFixed")}}function n(){var I=l.options.limit;if(!I){return 0}if(typeof(I)==="function"){return I.apply(G)}return I}function p(){return H==="fixed"}function x(){return H==="absolute"}function h(){return !(p()||x())}function w(){if(!p()){t.css({display:G.css("display"),width:G.outerWidth(true),height:G.outerHeight(true),"float":G.css("float")});cssOptions={"z-index":l.options.zIndex,position:"fixed",top:l.options.bottom==-1?s():"",bottom:l.options.bottom==-1?"":l.options.bottom,"margin-left":"0px"};if(!l.options.dontSetWidth){cssOptions.width=G.width()}G.css(cssOptions);G.addClass(l.options.baseClassName);if(l.options.className){G.addClass(l.options.className)}H="fixed"}}function b(){var J=n();var I=q;if(l.options.removeOffsets){I="";J=J-D}cssOptions={position:"absolute",top:J,left:I,"margin-left":"0px",bottom:""};if(!l.options.dontSetWidth){cssOptions.width=G.width()}G.css(cssOptions);H="absolute"}function k(){if(!h()){f=-1;t.css("display","none");G.css({"z-index":y,width:"",position:E,left:"",top:e,"margin-left":""});G.removeClass("scroll-to-fixed-fixed");if(l.options.className){G.removeClass(l.options.className)}H=null}}function v(I){if(I!=f){G.css("left",q-I);f=I}}function s(){var I=l.options.marginTop;if(!I){return 0}if(typeof(I)==="function"){return I.apply(G)}return I}function A(){if(!a.isScrollToFixed(G)){return}var K=c;if(!c){u()}else{if(h()){D=G.offset().top;q=G.offset().left}}var I=a(window).scrollLeft();var L=a(window).scrollTop();var J=n();if(l.options.minWidth&&a(window).width()<l.options.minWidth){if(!h()||!K){o();G.trigger("preUnfixed.ScrollToFixed");k();G.trigger("unfixed.ScrollToFixed")}}else{if(l.options.maxWidth&&a(window).width()>l.options.maxWidth){if(!h()||!K){o();G.trigger("preUnfixed.ScrollToFixed");k();G.trigger("unfixed.ScrollToFixed")}}else{if(l.options.bottom==-1){if(J>0&&L>=J-s()){if(!x()||!K){o();G.trigger("preAbsolute.ScrollToFixed");b();G.trigger("unfixed.ScrollToFixed")}}else{if(L>=D-s()){if(!p()||!K){o();G.trigger("preFixed.ScrollToFixed");w();f=-1;G.trigger("fixed.ScrollToFixed")}v(I)}else{if(!h()||!K){o();G.trigger("preUnfixed.ScrollToFixed");k();G.trigger("unfixed.ScrollToFixed")}}}}else{if(J>0){if(L+a(window).height()-G.outerHeight(true)>=J-(s()||-m())){if(p()){o();G.trigger("preUnfixed.ScrollToFixed");if(E==="absolute"){b()}else{k()}G.trigger("unfixed.ScrollToFixed")}}else{if(!p()){o();G.trigger("preFixed.ScrollToFixed");w()}v(I);G.trigger("fixed.ScrollToFixed")}}else{v(I)}}}}}function m(){if(!l.options.bottom){return 0}return l.options.bottom}function o(){var I=G.css("position");if(I=="absolute"){G.trigger("postAbsolute.ScrollToFixed")}else{if(I=="fixed"){G.trigger("postFixed.ScrollToFixed")}else{G.trigger("postUnfixed.ScrollToFixed")}}}var C=function(I){if(G.is(":visible")){c=false;A()}};var F=function(I){(!!window.requestAnimationFrame)?requestAnimationFrame(A):A()};var B=function(){var J=document.body;if(document.createElement&&J&&J.appendChild&&J.removeChild){var L=document.createElement("div");if(!L.getBoundingClientRect){return null}L.innerHTML="x";L.style.cssText="position:fixed;top:100px;";J.appendChild(L);var M=J.style.height,N=J.scrollTop;J.style.height="3000px";J.scrollTop=500;var I=L.getBoundingClientRect().top;J.style.height=M;var K=(I===100);J.removeChild(L);J.scrollTop=N;return K}return null};var r=function(I){I=I||window.event;if(I.preventDefault){I.preventDefault()}I.returnValue=false};l.init=function(){l.options=a.extend({},a.ScrollToFixed.defaultOptions,i);y=G.css("z-index");l.$el.css("z-index",l.options.zIndex);t=a("<div />");H=G.css("position");E=G.css("position");e=G.css("top");if(h()){l.$el.after(t)}a(window).bind("resize.ScrollToFixed",C);a(window).bind("scroll.ScrollToFixed",F);if("ontouchmove" in window){a(window).bind("touchmove.ScrollToFixed",A)}if(l.options.preFixed){G.bind("preFixed.ScrollToFixed",l.options.preFixed)}if(l.options.postFixed){G.bind("postFixed.ScrollToFixed",l.options.postFixed)}if(l.options.preUnfixed){G.bind("preUnfixed.ScrollToFixed",l.options.preUnfixed)}if(l.options.postUnfixed){G.bind("postUnfixed.ScrollToFixed",l.options.postUnfixed)}if(l.options.preAbsolute){G.bind("preAbsolute.ScrollToFixed",l.options.preAbsolute)}if(l.options.postAbsolute){G.bind("postAbsolute.ScrollToFixed",l.options.postAbsolute)}if(l.options.fixed){G.bind("fixed.ScrollToFixed",l.options.fixed)}if(l.options.unfixed){G.bind("unfixed.ScrollToFixed",l.options.unfixed)}if(l.options.spacerClass){t.addClass(l.options.spacerClass)}G.bind("resize.ScrollToFixed",function(){t.height(G.height())});G.bind("scroll.ScrollToFixed",function(){G.trigger("preUnfixed.ScrollToFixed");k();G.trigger("unfixed.ScrollToFixed");A()});G.bind("detach.ScrollToFixed",function(I){r(I);G.trigger("preUnfixed.ScrollToFixed");k();G.trigger("unfixed.ScrollToFixed");a(window).unbind("resize.ScrollToFixed",C);a(window).unbind("scroll.ScrollToFixed",F);G.unbind(".ScrollToFixed");t.remove();l.$el.removeData("ScrollToFixed")});C()};l.init()};a.ScrollToFixed.defaultOptions={marginTop:0,limit:0,bottom:-1,zIndex:1000,baseClassName:"scroll-to-fixed-fixed"};a.fn.scrollToFixed=function(b){return this.each(function(){(new a.ScrollToFixed(this,b))})}})(jQuery);
/*!
 * FormValidation (http://formvalidation.io)
 * The best jQuery plugin to validate form fields. Support Bootstrap, Foundation, Pure, SemanticUI, UIKit frameworks
 *
 * @version     v0.6.1-dev, built on 2015-01-15 10:41:33 AM
 * @author      https://twitter.com/nghuuphuoc
 * @copyright   (c) 2013 - 2015 Nguyen Huu Phuoc
 * @license     http://formvalidation.io/license/
 */
!function (a) {
    FormValidation.Framework.Bootstrap = function (b, c, d) {
        c = a.extend(!0, {
            button: {selector: '[type="submit"]', disabled: "disabled"},
            err: {clazz: "help-block", parent: "^(.*)col-(xs|sm|md|lg)-(offset-){0,1}[0-9]+(.*)$"},
            icon: {valid: null, invalid: null, validating: null, feedback: "form-control-feedback"},
            row: {selector: ".form-group", valid: "has-success", invalid: "has-error", feedback: "has-feedback"}
        }, c), FormValidation.Base.apply(this, [b, c, d])
    }, FormValidation.Framework.Bootstrap.prototype = a.extend({}, FormValidation.Base.prototype, {
        _fixIcon: function (a, b) {
            var c = this._namespace, d = a.attr("type"), e = a.attr("data-" + c + "-field"), f = this.options.fields[e].row || this.options.row.selector, g = a.closest(f);
            if ("checkbox" === d || "radio" === d) {
                var h = a.parent();
                h.hasClass(d) ? b.insertAfter(h) : h.parent().hasClass(d) && b.insertAfter(h.parent())
            }
            0 === g.find("label").length && b.addClass("fv-icon-no-label"), 0 !== g.find(".input-group").length && b.addClass("fv-bootstrap-icon-input-group").insertAfter(g.find(".input-group").eq(0))
        }, _createTooltip: function (a, b, c) {
            var d = this._namespace, e = a.data(d + ".icon");
            if (e)switch (c) {
                case"popover":
                    e.css({cursor: "pointer", "pointer-events": "auto"}).popover("destroy").popover({
                        container: "body",
                        content: b,
                        html: !0,
                        placement: "auto top",
                        trigger: "hover click"
                    });
                    break;
                case"tooltip":
                default:
                    e.css({cursor: "pointer", "pointer-events": "auto"}).tooltip("destroy").tooltip({
                        container: "body",
                        html: !0,
                        placement: "auto top",
                        title: b
                    })
            }
        }, _destroyTooltip: function (a, b) {
            var c = this._namespace, d = a.data(c + ".icon");
            if (d)switch (b) {
                case"popover":
                    d.css({cursor: "", "pointer-events": "none"}).popover("destroy");
                    break;
                case"tooltip":
                default:
                    d.css({cursor: "", "pointer-events": "none"}).tooltip("destroy")
            }
        }, _hideTooltip: function (a, b) {
            var c = this._namespace, d = a.data(c + ".icon");
            if (d)switch (b) {
                case"popover":
                    d.popover("hide");
                    break;
                case"tooltip":
                default:
                    d.tooltip("hide")
            }
        }, _showTooltip: function (a, b) {
            var c = this._namespace, d = a.data(c + ".icon");
            if (d)switch (b) {
                case"popover":
                    d.popover("show");
                    break;
                case"tooltip":
                default:
                    d.tooltip("show")
            }
        }
    }), a.fn.bootstrapValidator = function (b) {
        var c = arguments;
        return this.each(function () {
            var d = a(this), e = d.data("formValidation") || d.data("bootstrapValidator"), f = "object" == typeof b && b;
            e || (e = new FormValidation.Framework.Bootstrap(this, a.extend({}, {
                events: {
                    formInit: "init.form.bv",
                    formError: "error.form.bv",
                    formSuccess: "success.form.bv",
                    fieldAdded: "added.field.bv",
                    fieldRemoved: "removed.field.bv",
                    fieldInit: "init.field.bv",
                    fieldError: "error.field.bv",
                    fieldSuccess: "success.field.bv",
                    fieldStatus: "status.field.bv",
                    localeChanged: "changed.locale.bv",
                    validatorError: "error.validator.bv",
                    validatorSuccess: "success.validator.bv"
                }
            }, f), "bv"), d.addClass("fv-form-bootstrap").data("formValidation", e).data("bootstrapValidator", e)), "string" == typeof b && e[b].apply(e, Array.prototype.slice.call(c, 1))
        })
    }, a.fn.bootstrapValidator.Constructor = FormValidation.Framework.Bootstrap
}(jQuery);
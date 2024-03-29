/*!
   Copyright 2009-2019 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license/mit

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net
 FixedHeader 3.1.6
 ©2009-2019 SpryMedia Ltd - datatables.net/license
*/
var $jscomp = $jscomp || {};
$jscomp.scope = {};
$jscomp.findInternal = function (c, f, g) {
    c instanceof String && (c = String(c));
    for (var l = c.length, h = 0; h < l; h++) {
        var n = c[h];
        if (f.call(g, n, h, c)) return { i: h, v: n };
    }
    return { i: -1, v: void 0 };
};
$jscomp.ASSUME_ES5 = !1;
$jscomp.ASSUME_NO_NATIVE_MAP = !1;
$jscomp.ASSUME_NO_NATIVE_SET = !1;
$jscomp.SIMPLE_FROUND_POLYFILL = !1;
$jscomp.defineProperty =
    $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties
        ? Object.defineProperty
        : function (c, f, g) {
              c != Array.prototype && c != Object.prototype && (c[f] = g.value);
          };
$jscomp.getGlobal = function (c) {
    return "undefined" != typeof window && window === c
        ? c
        : "undefined" != typeof global && null != global
        ? global
        : c;
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function (c, f, g, l) {
    if (f) {
        g = $jscomp.global;
        c = c.split(".");
        for (l = 0; l < c.length - 1; l++) {
            var h = c[l];
            h in g || (g[h] = {});
            g = g[h];
        }
        c = c[c.length - 1];
        l = g[c];
        f = f(l);
        f != l &&
            null != f &&
            $jscomp.defineProperty(g, c, {
                configurable: !0,
                writable: !0,
                value: f,
            });
    }
};
$jscomp.polyfill(
    "Array.prototype.find",
    function (c) {
        return c
            ? c
            : function (c, g) {
                  return $jscomp.findInternal(this, c, g).v;
              };
    },
    "es6",
    "es3"
);
(function (c) {
    "function" === typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (f) {
              return c(f, window, document);
          })
        : "object" === typeof exports
        ? (module.exports = function (f, g) {
              f || (f = window);
              (g && g.fn.dataTable) || (g = require("datatables.net")(f, g).$);
              return c(g, f, f.document);
          })
        : c(jQuery, window, document);
})(function (c, f, g, l) {
    var h = c.fn.dataTable,
        n = 0,
        m = function (a, b) {
            if (!(this instanceof m))
                throw "FixedHeader must be initialised with the 'new' keyword.";
            !0 === b && (b = {});
            a = new h.Api(a);
            this.c = c.extend(!0, {}, m.defaults, b);
            this.s = {
                dt: a,
                position: {
                    theadTop: 0,
                    tbodyTop: 0,
                    tfootTop: 0,
                    tfootBottom: 0,
                    width: 0,
                    left: 0,
                    tfootHeight: 0,
                    theadHeight: 0,
                    windowHeight: c(f).height(),
                    visible: !0,
                },
                headerMode: null,
                footerMode: null,
                autoWidth: a.settings()[0].oFeatures.bAutoWidth,
                namespace: ".dtfc" + n++,
                scrollLeft: { header: -1, footer: -1 },
                enable: !0,
            };
            this.dom = {
                floatingHeader: null,
                thead: c(a.table().header()),
                tbody: c(a.table().body()),
                tfoot: c(a.table().footer()),
                header: { host: null, floating: null, placeholder: null },
                footer: { host: null, floating: null, placeholder: null },
            };
            this.dom.header.host = this.dom.thead.parent();
            this.dom.footer.host = this.dom.tfoot.parent();
            a = a.settings()[0];
            if (a._fixedHeader)
                throw "FixedHeader already initialised on table " + a.nTable.id;
            a._fixedHeader = this;
            this._constructor();
        };
    c.extend(m.prototype, {
        destroy: function () {
            this.s.dt.off(".dtfc");
            c(f).off(this.s.namespace);
            this.c.header && this._modeChange("in-place", "header", !0);
            this.c.footer &&
                this.dom.tfoot.length &&
                this._modeChange("in-place", "footer", !0);
        },
        enable: function (a, b) {
            this.s.enable = a;
            if (b || b === l) this._positions(), this._scroll(!0);
        },
        enabled: function () {
            return this.s.enable;
        },
        headerOffset: function (a) {
            a !== l && ((this.c.headerOffset = a), this.update());
            return this.c.headerOffset;
        },
        footerOffset: function (a) {
            a !== l && ((this.c.footerOffset = a), this.update());
            return this.c.footerOffset;
        },
        update: function () {
            var a = this.s.dt.table().node();
            c(a).is(":visible") ? this.enable(!0, !1) : this.enable(!1, !1);
            this._positions();
            this._scroll(!0);
        },
        _constructor: function () {
            var a = this,
                b = this.s.dt;
            c(f)
                .on("scroll" + this.s.namespace, function () {
                    a._scroll();
                })
                .on(
                    "resize" + this.s.namespace,
                    h.util.throttle(function () {
                        a.s.position.windowHeight = c(f).height();
                        a.update();
                    }, 50)
                );
            var e = c(".fh-fixedHeader");
            !this.c.headerOffset &&
                e.length &&
                (this.c.headerOffset = e.outerHeight());
            e = c(".fh-fixedFooter");
            !this.c.footerOffset &&
                e.length &&
                (this.c.footerOffset = e.outerHeight());
            b.on(
                "column-reorder.dt.dtfc column-visibility.dt.dtfc draw.dt.dtfc column-sizing.dt.dtfc responsive-display.dt.dtfc",
                function () {
                    a.update();
                }
            );
            b.on("destroy.dtfc", function () {
                a.destroy();
            });
            this._positions();
            this._scroll();
        },
        _clone: function (a, b) {
            var e = this.s.dt,
                d = this.dom[a],
                k = "header" === a ? this.dom.thead : this.dom.tfoot;
            !b && d.floating
                ? d.floating.removeClass(
                      "fixedHeader-floating fixedHeader-locked"
                  )
                : (d.floating &&
                      (d.placeholder.remove(),
                      this._unsize(a),
                      d.floating.children().detach(),
                      d.floating.remove()),
                  (d.floating = c(e.table().node().cloneNode(!1))
                      .css("table-layout", "fixed")
                      .attr("aria-hidden", "true")
                      .removeAttr("id")
                      .append(k)
                      .appendTo("body")),
                  (d.placeholder = k.clone(!1)),
                  d.placeholder.find("*[id]").removeAttr("id"),
                  d.host.prepend(d.placeholder),
                  this._matchWidths(d.placeholder, d.floating));
        },
        _matchWidths: function (a, b) {
            var e = function (b) {
                    return c(b, a)
                        .map(function () {
                            return c(this).width();
                        })
                        .toArray();
                },
                d = function (a, d) {
                    c(a, b).each(function (a) {
                        c(this).css({ width: d[a], minWidth: d[a] });
                    });
                },
                k = e("th");
            e = e("td");
            d("th", k);
            d("td", e);
        },
        _unsize: function (a) {
            var b = this.dom[a].floating;
            b && ("footer" === a || ("header" === a && !this.s.autoWidth))
                ? c("th, td", b).css({ width: "", minWidth: "" })
                : b && "header" === a && c("th, td", b).css("min-width", "");
        },
        _horizontal: function (a, b) {
            var c = this.dom[a],
                d = this.s.position,
                k = this.s.scrollLeft;
            c.floating &&
                k[a] !== b &&
                (c.floating.css("left", d.left - b), (k[a] = b));
        },
        _modeChange: function (a, b, e) {
            var d = this.dom[b],
                k = this.s.position,
                f = this.dom["footer" === b ? "tfoot" : "thead"],
                h = c.contains(f[0], g.activeElement) ? g.activeElement : null;
            h && h.blur();
            "in-place" === a
                ? (d.placeholder &&
                      (d.placeholder.remove(), (d.placeholder = null)),
                  this._unsize(b),
                  "header" === b ? d.host.prepend(f) : d.host.append(f),
                  d.floating && (d.floating.remove(), (d.floating = null)))
                : "in" === a
                ? (this._clone(b, e),
                  d.floating
                      .addClass("fixedHeader-floating")
                      .css(
                          "header" === b ? "top" : "bottom",
                          this.c[b + "Offset"]
                      )
                      .css("left", k.left + "px")
                      .css("width", k.width + "px"),
                  "footer" === b && d.floating.css("top", ""))
                : "below" === a
                ? (this._clone(b, e),
                  d.floating
                      .addClass("fixedHeader-locked")
                      .css("top", k.tfootTop - k.theadHeight)
                      .css("left", k.left + "px")
                      .css("width", k.width + "px"))
                : "above" === a &&
                  (this._clone(b, e),
                  d.floating
                      .addClass("fixedHeader-locked")
                      .css("top", k.tbodyTop)
                      .css("left", k.left + "px")
                      .css("width", k.width + "px"));
            h &&
                h !== g.activeElement &&
                setTimeout(function () {
                    h.focus();
                }, 10);
            this.s.scrollLeft.header = -1;
            this.s.scrollLeft.footer = -1;
            this.s[b + "Mode"] = a;
        },
        _positions: function () {
            var a = this.s.dt.table(),
                b = this.s.position,
                e = this.dom;
            a = c(a.node());
            var d = a.children("thead"),
                k = a.children("tfoot");
            e = e.tbody;
            b.visible = a.is(":visible");
            b.width = a.outerWidth();
            b.left = a.offset().left;
            b.theadTop = d.offset().top;
            b.tbodyTop = e.offset().top;
            b.tbodyHeight = e.outerHeight();
            b.theadHeight = b.tbodyTop - b.theadTop;
            k.length
                ? ((b.tfootTop = k.offset().top),
                  (b.tfootBottom = b.tfootTop + k.outerHeight()),
                  (b.tfootHeight = b.tfootBottom - b.tfootTop))
                : ((b.tfootTop = b.tbodyTop + e.outerHeight()),
                  (b.tfootBottom = b.tfootTop),
                  (b.tfootHeight = b.tfootTop));
        },
        _scroll: function (a) {
            var b = c(g).scrollTop(),
                e = c(g).scrollLeft(),
                d = this.s.position,
                k;
            if (this.c.header) {
                var f = this.s.enable
                    ? !d.visible || b <= d.theadTop - this.c.headerOffset
                        ? "in-place"
                        : b <= d.tfootTop - d.theadHeight - this.c.headerOffset
                        ? "in"
                        : "below"
                    : "in-place";
                (a || f !== this.s.headerMode) &&
                    this._modeChange(f, "header", a);
                this._horizontal("header", e);
            }
            this.c.footer &&
                this.dom.tfoot.length &&
                (this.s.enable &&
                    (k =
                        !d.visible ||
                        b + d.windowHeight >=
                            d.tfootBottom + this.c.footerOffset
                            ? "in-place"
                            : d.windowHeight + b >
                              d.tbodyTop + d.tfootHeight + this.c.footerOffset
                            ? "in"
                            : "above"),
                (a || k !== this.s.footerMode) &&
                    this._modeChange(k, "footer", a),
                this._horizontal("footer", e));
        },
    });
    m.version = "3.1.6";
    m.defaults = { header: !0, footer: !1, headerOffset: 0, footerOffset: 0 };
    c.fn.dataTable.FixedHeader = m;
    c.fn.DataTable.FixedHeader = m;
    c(g).on("init.dt.dtfh", function (a, b, e) {
        "dt" === a.namespace &&
            ((a = b.oInit.fixedHeader),
            (e = h.defaults.fixedHeader),
            (!a && !e) ||
                b._fixedHeader ||
                ((e = c.extend({}, e, a)), !1 !== a && new m(b, e)));
    });
    h.Api.register("fixedHeader()", function () {});
    h.Api.register("fixedHeader.adjust()", function () {
        return this.iterator("table", function (a) {
            (a = a._fixedHeader) && a.update();
        });
    });
    h.Api.register("fixedHeader.enable()", function (a) {
        return this.iterator("table", function (b) {
            b = b._fixedHeader;
            a = a !== l ? a : !0;
            b && a !== b.enabled() && b.enable(a);
        });
    });
    h.Api.register("fixedHeader.enabled()", function () {
        return this.context.length && fh ? fh.enabled() : !1;
    });
    h.Api.register("fixedHeader.disable()", function () {
        return this.iterator("table", function (a) {
            (a = a._fixedHeader) && a.enabled() && a.enable(!1);
        });
    });
    c.each(["header", "footer"], function (a, b) {
        h.Api.register("fixedHeader." + b + "Offset()", function (a) {
            var c = this.context;
            return a === l
                ? c.length && c[0]._fixedHeader
                    ? c[0]._fixedHeader[b + "Offset"]()
                    : l
                : this.iterator("table", function (c) {
                      if ((c = c._fixedHeader)) c[b + "Offset"](a);
                  });
        });
    });
    return m;
});

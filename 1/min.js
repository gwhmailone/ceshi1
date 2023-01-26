function() {
    function getListener(a, b, c) {
        var d;
        return b = b.toLowerCase(), (d = a.__allListeners || c && (a.__allListeners = {})) && (d[b] || c && (d[b] = []))
    }

    function getDomNode(a, b, c, d, e, f) {
        var g, h = d && a[b];
        for (!h && (h = a[c]); !h && (g = (g || a).parentNode);) {
            if ("BODY" == g.tagName || f && !f(g)) return null;
            h = g[c]
        }
        return h && e && !e(h) ? getDomNode(h, b, c, !1, e) : h
    }
    UEDITOR_CONFIG = window.UEDITOR_CONFIG || {};
    var baidu = window.baidu || {};
    window.baidu = baidu, window.UE = baidu.editor = {
        plugins: {},
        commands: {},
        instants: {},
        I18N: {},
        _customizeUI: {},
        version: "1.5.0"
    };
    var dom = UE.dom = {},
        browser = UE.browser = function() {
            var a = navigator.userAgent.toLowerCase(),
                b = window.opera,
                c = {
                    ie: /(msie\s|trident.*rv:)([\w.]+)/i.test(a),
                    opera: !!b && b.version,
                    webkit: a.indexOf(" applewebkit/") > -1,
                    mac: a.indexOf("macintosh") > -1,
                    quirks: "BackCompat" == document.compatMode
                };
            c.gecko = "Gecko" == navigator.product && !c.webkit && !c.opera && !c.ie;
            var d = 0;
            if (c.ie) {
                var e = a.match(/(?:msie\s([\w.]+))/),
                    f = a.match(/(?:trident.*rv:([\w.]+))/);
                d = e && f && e[1] && f[1] ? Math.max(1 * e[1], 1 * f[1]) : e && e[1] ? 1 * e[1] : f && f[1] ? 1 * f[1] : 0, c.ie11Compat = 11 == document.documentMode, c.ie9Compat = 9 == document.documentMode, c.ie8 = !!document.documentMode, c.ie8Compat = 8 == document.documentMode, c.ie7Compat = 7 == d && !document.documentMode || 7 == document.documentMode, c.ie6Compat = d < 7 || c.quirks, c.ie9above = d > 8, c.ie9below = d < 9, c.ie11above = d > 10, c.ie11below = d < 11
            }
            if (c.gecko) {
                var g = a.match(/rv:([\d\.]+)/);
                g && (g = g[1].split("."), d = 1e4 * g[0] + 100 * (g[1] || 0) + 1 * (g[2] || 0))
            }
            return /chrome\/(\d+\.\d)/i.test(a) && (c.chrome = +RegExp.$1), /(\d+\.\d)?(?:\.\d)?\s+safari\/?(\d+\.\d+)?/i.test(a) && !/chrome/i.test(a) && (c.safari = +(RegExp.$1 || RegExp.$2)), c.opera && (d = parseFloat(b.version())), c.webkit && (d = parseFloat(a.match(/ applewebkit\/(\d+)/)[1])), c.version = d, c.isCompatible = !c.mobile && (c.ie && d >= 6 || c.gecko && d >= 10801 || c.opera && d >= 9.5 || c.air && d >= 1 || c.webkit && d >= 522 || !1), c
        }(),
        ie = browser.ie,
        webkit = browser.webkit,
        gecko = browser.gecko,
        opera = browser.opera,
        utils = UE.utils = {
            each: function(a, b, c) {
                if (null != a)
                    if (a.length === +a.length) {
                        for (var d = 0, e = a.length; d < e; d++)
                            if (b.call(c, a[d], d, a) === !1) return !1
                    } else
                        for (var f in a)
                            if (a.hasOwnProperty(f) && b.call(c, a[f], f, a) === !1) return !1
            },
            makeInstance: function(a) {
                var b = new Function;
                return b.prototype = a, a = new b, b.prototype = null, a
            },
            extend: function(a, b, c) {
                if (b)
                    for (var d in b) c && a.hasOwnProperty(d) || (a[d] = b[d]);
                return a
            },
            extend2: function(a) {
                for (var b = arguments, c = 1; c < b.length; c++) {
                    var d = b[c];
                    for (var e in d) a.hasOwnProperty(e) || (a[e] = d[e])
                }
                return a
            },
            inherits: function(a, b) {
                var c = a.prototype,
                    d = utils.makeInstance(b.prototype);
                return utils.extend(d, c, !0), a.prototype = d, d.constructor = a
            },
            bind: function(a, b) {
                return function() {
                    return a.apply(b, arguments)
                }
            },
            defer: function(a, b, c) {
                var d;
                return function() {
                    c && clearTimeout(d), d = setTimeout(a, b)
                }
            },
            indexOf: function(a, b, c) {
                var d = -1;
                return c = this.isNumber(c) ? c : 0, this.each(a, function(a, e) {
                    if (e >= c && a === b) return d = e, !1
                }), d
            },
            removeItem: function(a, b) {
                for (var c = 0, d = a.length; c < d; c++) a[c] === b && (a.splice(c, 1), c--)
            },
            trim: function(a) {
                return a.replace(/(^[ \t\n\r]+)|([ \t\n\r]+$)/g, "")
            },
            listToMap: function(a) {
                if (!a) return {};
                a = utils.isArray(a) ? a : a.split(",");
                for (var b, c = 0, d = {}; b = a[c++];) d[b.toUpperCase()] = d[b] = 1;
                return d
            },
            unhtml: function(a, b) {
                return a ? a.replace(b || /[&<">'](?:(amp|lt|ldquo|rdquo|quot|gt|#39|nbsp|#\d+);)?/g, function(a, b) {
                    return b ? a : {
                        "<": "&lt;",
                        "&": "&amp;",
                        '"': "&quot;",
                        "“": "&ldquo;",
                        "”": "&rdquo;",
                        ">": "&gt;",
                        "'": "&#39;"
                    }[a]
                }) : ""
            },
            html: function(a) {
                return a ? a.replace(/&((g|l|quo|ldquo|rdquo)t|amp|#39|nbsp);/g, function(a) {
                    return {
                        "&lt;": "<",
                        "&amp;": "&",
                        "&quot;": '"',
                        "&ldquo;": "“",
                        "&rdquo;": "”",
                        "&gt;": ">",
                        "&#39;": "'",
                        "&nbsp;": " "
                    }[a]
                }) : ""
            },
            cssStyleToDomStyle: function() {
                var a = document.createElement("div").style,
                    b = {
                        "float": void 0 != a.cssFloat ? "cssFloat" : void 0 != a.styleFloat ? "styleFloat" : "float"
                    };
                return function(a) {
                    return b[a] || (b[a] = a.toLowerCase().replace(/-./g, function(a) {
                        return a.charAt(1).toUpperCase()
                    }))
                }
            }(),
            loadFile: function() {
                function a(a, c) {
                    try {
                        for (var d, e = 0; d = b[e++];)
                            if (d.doc === a && d.url == (c.src || c.href)) return d
                    } catch (f) {
                        return null
                    }
                }
                var b = [];
                return function(c, d, e) {
                    var f = a(c, d);
                    if (f) return void(f.ready ? e && e() : f.funs.push(e));
                    if (b.push({
                        doc: c,
                        url: d.src || d.href,
                        funs: [e]
                    }), !c.body) {
                        var g = [];
                        for (var h in d) "tag" != h && g.push(h + '="' + d[h] + '"');
                        return void c.write("<" + d.tag + " " + g.join(" ") + " ></" + d.tag + ">")
                    }
                    if (!d.id || !c.getElementById(d.id)) {
                        var i = c.createElement(d.tag);
                        delete d.tag;
                        for (var h in d) i.setAttribute(h, d[h]);
                        i.onload = i.onreadystatechange = function() {
                            if (!this.readyState || /loaded|complete/.test(this.readyState)) {
                                if (f = a(c, d), f.funs.length > 0) {
                                    f.ready = 1;
                                    for (var b; b = f.funs.pop();) b()
                                }
                                i.onload = i.onreadystatechange = null
                            }
                        }, i.onerror = function() {
                            throw Error("The load " + (d.href || d.src) + " fails,check the url settings of file neditor.config.js ")
                        }, c.getElementsByTagName("head")[0].appendChild(i)
                    }
                }
            }(),
            isEmptyObject: function(a) {
                if (null == a) return !0;
                if (this.isArray(a) || this.isString(a)) return 0 === a.length;
                for (var b in a)
                    if (a.hasOwnProperty(b)) return !1;
                return !0
            },
            fixColor: function(a, b) {
                if (/color/i.test(a) && /rgba?/.test(b)) {
                    var c = b.split(",");
                    if (c.length > 3) return "";
                    b = "#";
                    for (var d, e = 0; d = c[e++];) d = parseInt(d.replace(/[^\d]/gi, ""), 10).toString(16), b += 1 == d.length ? "0" + d : d;
                    b = b.toUpperCase()
                }
                return b
            },
            optCss: function(a) {
                function b(a, b) {
                    if (!a) return "";
                    var c = a.top,
                        d = a.bottom,
                        e = a.left,
                        f = a.right,
                        g = "";
                    if (c && e && d && f) g += ";" + b + ":" + (c == d && d == e && e == f ? c : c == d && e == f ? c + " " + e : e == f ? c + " " + e + " " + d : c + " " + f + " " + d + " " + e) + ";";
                    else
                        for (var h in a) g += ";" + b + "-" + h + ":" + a[h] + ";";
                    return g
                }
                var c, d;
                return a = a.replace(/(padding|margin|border)\-([^:]+):([^;]+);?/gi, function(a, b, e, f) {
                    if (1 == f.split(" ").length) switch (b) {
                        case "padding":
                            return !c && (c = {}), c[e] = f, "";
                        case "margin":
                            return !d && (d = {}), d[e] = f, "";
                        case "border":
                            return "initial" == f ? "" : a
                    }
                    return a
                }), a += b(c, "padding") + b(d, "margin"), a.replace(/^[ \n\r\t;]*|[ \n\r\t]*$/, "").replace(/;([ \n\r\t]+)|\1;/g, ";").replace(/(&((l|g)t|quot|#39))?;{2,}/g, function(a, b) {
                    return b ? b + ";;" : ";"
                })
            },
            clone: function(a, b) {
                var c;
                b = b || {};
                for (var d in a) a.hasOwnProperty(d) && (c = a[d], "object" == typeof c ? (b[d] = utils.isArray(c) ? [] : {}, utils.clone(a[d], b[d])) : b[d] = c);
                return b
            },
            transUnitToPx: function(a) {
                if (!/(pt|cm)/.test(a)) return a;
                var b;
                switch (a.replace(/([\d.]+)(\w+)/, function(c, d, e) {
                    a = d, b = e
                }), b) {
                    case "cm":
                        a = 25 * parseFloat(a);
                        break;
                    case "pt":
                        a = Math.round(96 * parseFloat(a) / 72)
                }
                return a + (a ? "px" : "")
            },
            domReady: function() {
                function a(a) {
                    a.isReady = !0;
                    for (var c; c = b.pop(); c());
                }
                var b = [];
                return function(c, d) {
                    d = d || window;
                    var e = d.document;
                    c && b.push(c), "complete" === e.readyState ? a(e) : (e.isReady && a(e), browser.ie && 11 != browser.version ? (! function() {
                        if (!e.isReady) {
                            try {
                                e.documentElement.doScroll("left")
                            } catch (b) {
                                return void setTimeout(arguments.callee, 0)
                            }
                            a(e)
                        }
                    }(), d.attachEvent("onload", function() {
                        a(e)
                    })) : (e.addEventListener("DOMContentLoaded", function() {
                        e.removeEventListener("DOMContentLoaded", arguments.callee, !1), a(e)
                    }, !1), d.addEventListener("load", function() {
                        a(e)
                    }, !1)))
                }
            }(),
            cssRule: browser.ie && 11 != browser.version ? function(a, b, c) {
                var d, e;
                if (void 0 === b || b && b.nodeType && 9 == b.nodeType) {
                    if (c = b && b.nodeType && 9 == b.nodeType ? b : c || document, d = c.indexList || (c.indexList = {}), e = d[a], void 0 !== e) return c.styleSheets[e].cssText
                } else {
                    if (c = c || document, d = c.indexList || (c.indexList = {}), e = d[a], "" === b) return void 0 !== e && (c.styleSheets[e].cssText = "", delete d[a], !0);
                    void 0 !== e ? sheetStyle = c.styleSheets[e] : (sheetStyle = c.createStyleSheet("", e = c.styleSheets.length), d[a] = e), sheetStyle.cssText = b
                }
            } : function(a, b, c) {
                var d;
                return void 0 === b || b && b.nodeType && 9 == b.nodeType ? (c = b && b.nodeType && 9 == b.nodeType ? b : c || document, d = c.getElementById(a), d ? d.innerHTML : void 0) : (c = c || document, d = c.getElementById(a), "" === b ? !!d && (d.parentNode.removeChild(d), !0) : void(d ? d.innerHTML = b : (d = c.createElement("style"), d.id = a, d.innerHTML = b, c.getElementsByTagName("head")[0].appendChild(d))))
            },
            sort: function(a, b) {
                b = b || function(a, b) {
                    return a.localeCompare(b)
                };
                for (var c = 0, d = a.length; c < d; c++)
                    for (var e = c, f = a.length; e < f; e++)
                        if (b(a[c], a[e]) > 0) {
                            var g = a[c];
                            a[c] = a[e], a[e] = g
                        }
                return a
            },
            serializeParam: function(a) {
                var b = [];
                for (var c in a)
                    if ("method" != c && "timeout" != c && "async" != c)
                        if ("function" != (typeof a[c]).toLowerCase() && "object" != (typeof a[c]).toLowerCase()) b.push(encodeURIComponent(c) + "=" + encodeURIComponent(a[c]));
                        else if (utils.isArray(a[c]))
                    for (var d = 0; d < a[c].length; d++) b.push(encodeURIComponent(c) + "[]=" + encodeURIComponent(a[c][d]));
                return b.join("&")
            },
            formatUrl: function(a) {
                var b = a.replace(/&&/g, "&");
                return b = b.replace(/\?&/g, "?"), b = b.replace(/&$/g, ""), b = b.replace(/&#/g, "#"), b = b.replace(/&+/g, "&")
            },
            isCrossDomainUrl: function(a) {
                var b = document.createElement("a");
                return b.href = a, browser.ie && (b.href = b.href), !(b.protocol == location.protocol && b.hostname == location.hostname && (b.port == location.port || "80" == b.port && "" == location.port || "" == b.port && "80" == location.port))
            },
            clearEmptyAttrs: function(a) {
                for (var b in a) "" === a[b] && delete a[b];
                return a
            },
            str2json: function(a) {
                return utils.isString(a) ? window.JSON ? JSON.parse(a) : new Function("return " + utils.trim(a || ""))() : null
            },
            json2str: function() {
                function a(a) {
                    return /["\\
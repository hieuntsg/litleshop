
var matched, browser;

jQuery.uaMatch = function (ua) {
    ua = ua.toLowerCase();

    var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
        /(webkit)[ \/]([\w.]+)/.exec(ua) ||
        /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
        /(msie) ([\w.]+)/.exec(ua) ||
        ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
        [];

    return {
        browser: match[1] || "",
        version: match[2] || "0"
    };
};

matched = jQuery.uaMatch(navigator.userAgent);
browser = {};

if (matched.browser) {
    browser[matched.browser] = true;
    browser.version = matched.version;
}

// Chrome is Webkit, but Webkit is also Safari.
if (browser.chrome) {
    browser.webkit = true;
} else if (browser.webkit) {
    browser.safari = true;
}

jQuery.browser = browser;

$.isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
//Jquery position

(function (t, e) { function i(t, e, i) { return [parseFloat(t[0]) * (p.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (p.test(t[1]) ? i / 100 : 1)] } function s(e, i) { return parseInt(t.css(e, i), 10) || 0 } function n(e) { var i = e[0]; return 9 === i.nodeType ? { width: e.width(), height: e.height(), offset: { top: 0, left: 0}} : t.isWindow(i) ? { width: e.width(), height: e.height(), offset: { top: e.scrollTop(), left: e.scrollLeft()}} : i.preventDefault ? { width: 0, height: 0, offset: { top: i.pageY, left: i.pageX}} : { width: e.outerWidth(), height: e.outerHeight(), offset: e.offset()} } t.ui = t.ui || {}; var a, o = Math.max, r = Math.abs, l = Math.round, h = /left|center|right/, c = /top|center|bottom/, u = /[\+\-]\d+(\.[\d]+)?%?/, d = /^\w+/, p = /%$/, f = t.fn.position; t.position = { scrollbarWidth: function () { if (a !== e) return a; var i, s, n = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), o = n.children()[0]; return t("body").append(n), i = o.offsetWidth, n.css("overflow", "scroll"), s = o.offsetWidth, i === s && (s = n[0].clientWidth), n.remove(), a = i - s }, getScrollInfo: function (e) { var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"), s = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"), n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth, a = "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight; return { width: a ? t.position.scrollbarWidth() : 0, height: n ? t.position.scrollbarWidth() : 0} }, getWithinInfo: function (e) { var i = t(e || window), s = t.isWindow(i[0]), n = !!i[0] && 9 === i[0].nodeType; return { element: i, isWindow: s, isDocument: n, offset: i.offset() || { left: 0, top: 0 }, scrollLeft: i.scrollLeft(), scrollTop: i.scrollTop(), width: s ? i.width() : i.outerWidth(), height: s ? i.height() : i.outerHeight()} } }, t.fn.position = function (e) { if (!e || !e.of) return f.apply(this, arguments); e = t.extend({}, e); var a, p, g, m, v, _, b = t(e.of), y = t.position.getWithinInfo(e.within), k = t.position.getScrollInfo(y), w = (e.collision || "flip").split(" "), D = {}; return _ = n(b), b[0].preventDefault && (e.at = "left top"), p = _.width, g = _.height, m = _.offset, v = t.extend({}, m), t.each(["my", "at"], function () { var t, i, s = (e[this] || "").split(" "); 1 === s.length && (s = h.test(s[0]) ? s.concat(["center"]) : c.test(s[0]) ? ["center"].concat(s) : ["center", "center"]), s[0] = h.test(s[0]) ? s[0] : "center", s[1] = c.test(s[1]) ? s[1] : "center", t = u.exec(s[0]), i = u.exec(s[1]), D[this] = [t ? t[0] : 0, i ? i[0] : 0], e[this] = [d.exec(s[0])[0], d.exec(s[1])[0]] }), 1 === w.length && (w[1] = w[0]), "right" === e.at[0] ? v.left += p : "center" === e.at[0] && (v.left += p / 2), "bottom" === e.at[1] ? v.top += g : "center" === e.at[1] && (v.top += g / 2), a = i(D.at, p, g), v.left += a[0], v.top += a[1], this.each(function () { var n, h, c = t(this), u = c.outerWidth(), d = c.outerHeight(), f = s(this, "marginLeft"), _ = s(this, "marginTop"), x = u + f + s(this, "marginRight") + k.width, C = d + _ + s(this, "marginBottom") + k.height, M = t.extend({}, v), T = i(D.my, c.outerWidth(), c.outerHeight()); "right" === e.my[0] ? M.left -= u : "center" === e.my[0] && (M.left -= u / 2), "bottom" === e.my[1] ? M.top -= d : "center" === e.my[1] && (M.top -= d / 2), M.left += T[0], M.top += T[1], t.support.offsetFractions || (M.left = l(M.left), M.top = l(M.top)), n = { marginLeft: f, marginTop: _ }, t.each(["left", "top"], function (i, s) { t.ui.position[w[i]] && t.ui.position[w[i]][s](M, { targetWidth: p, targetHeight: g, elemWidth: u, elemHeight: d, collisionPosition: n, collisionWidth: x, collisionHeight: C, offset: [a[0] + T[0], a[1] + T[1]], my: e.my, at: e.at, within: y, elem: c }) }), e.using && (h = function (t) { var i = m.left - M.left, s = i + p - u, n = m.top - M.top, a = n + g - d, l = { target: { element: b, left: m.left, top: m.top, width: p, height: g }, element: { element: c, left: M.left, top: M.top, width: u, height: d }, horizontal: 0 > s ? "left" : i > 0 ? "right" : "center", vertical: 0 > a ? "top" : n > 0 ? "bottom" : "middle" }; u > p && p > r(i + s) && (l.horizontal = "center"), d > g && g > r(n + a) && (l.vertical = "middle"), l.important = o(r(i), r(s)) > o(r(n), r(a)) ? "horizontal" : "vertical", e.using.call(this, t, l) }), c.offset(t.extend(M, { using: h })) }) }, t.ui.position = { fit: { left: function (t, e) { var i, s = e.within, n = s.isWindow ? s.scrollLeft : s.offset.left, a = s.width, r = t.left - e.collisionPosition.marginLeft, l = n - r, h = r + e.collisionWidth - a - n; e.collisionWidth > a ? l > 0 && 0 >= h ? (i = t.left + l + e.collisionWidth - a - n, t.left += l - i) : t.left = h > 0 && 0 >= l ? n : l > h ? n + a - e.collisionWidth : n : l > 0 ? t.left += l : h > 0 ? t.left -= h : t.left = o(t.left - r, t.left) }, top: function (t, e) { var i, s = e.within, n = s.isWindow ? s.scrollTop : s.offset.top, a = e.within.height, r = t.top - e.collisionPosition.marginTop, l = n - r, h = r + e.collisionHeight - a - n; e.collisionHeight > a ? l > 0 && 0 >= h ? (i = t.top + l + e.collisionHeight - a - n, t.top += l - i) : t.top = h > 0 && 0 >= l ? n : l > h ? n + a - e.collisionHeight : n : l > 0 ? t.top += l : h > 0 ? t.top -= h : t.top = o(t.top - r, t.top) } }, flip: { left: function (t, e) { var i, s, n = e.within, a = n.offset.left + n.scrollLeft, o = n.width, l = n.isWindow ? n.scrollLeft : n.offset.left, h = t.left - e.collisionPosition.marginLeft, c = h - l, u = h + e.collisionWidth - o - l, d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0, p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0, f = -2 * e.offset[0]; 0 > c ? (i = t.left + d + p + f + e.collisionWidth - o - a, (0 > i || r(c) > i) && (t.left += d + p + f)) : u > 0 && (s = t.left - e.collisionPosition.marginLeft + d + p + f - l, (s > 0 || u > r(s)) && (t.left += d + p + f)) }, top: function (t, e) { var i, s, n = e.within, a = n.offset.top + n.scrollTop, o = n.height, l = n.isWindow ? n.scrollTop : n.offset.top, h = t.top - e.collisionPosition.marginTop, c = h - l, u = h + e.collisionHeight - o - l, d = "top" === e.my[1], p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0, f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0, g = -2 * e.offset[1]; 0 > c ? (s = t.top + p + f + g + e.collisionHeight - o - a, t.top + p + f + g > c && (0 > s || r(c) > s) && (t.top += p + f + g)) : u > 0 && (i = t.top - e.collisionPosition.marginTop + p + f + g - l, t.top + p + f + g > u && (i > 0 || u > r(i)) && (t.top += p + f + g)) } }, flipfit: { left: function () { t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments) }, top: function () { t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments) } } }, function () { var e, i, s, n, a, o = document.getElementsByTagName("body")[0], r = document.createElement("div"); e = document.createElement(o ? "div" : "body"), s = { visibility: "hidden", width: 0, height: 0, border: 0, margin: 0, background: "none" }, o && t.extend(s, { position: "absolute", left: "-1000px", top: "-1000px" }); for (a in s) e.style[a] = s[a]; e.appendChild(r), i = o || document.documentElement, i.insertBefore(e, i.firstChild), r.style.cssText = "position: absolute; left: 10.7432222px;", n = t(r).offset().left, t.support.offsetFractions = n > 10 && 11 > n, e.innerHTML = "", i.removeChild(e) } () })(jQuery);

// jquery hashtable

var Hashtable = function (t) { function n(t) { return typeof t == p ? t : "" + t } function e(t) { var r; return typeof t == p ? t : typeof t.hashCode == y ? (r = t.hashCode(), typeof r == p ? r : e(r)) : n(t) } function r(t, n) { for (var e in n) n.hasOwnProperty(e) && (t[e] = n[e]) } function i(t, n) { return t.equals(n) } function u(t, n) { return typeof n.equals == y ? n.equals(t) : t === n } function o(n) { return function (e) { if (null === e) throw new Error("null is not a valid " + n); if (e === t) throw new Error(n + " must not be undefined") } } function s(t, n, e, r) { this[0] = t, this.entries = [], this.addEntry(n, e), null !== r && (this.getEqualityFunction = function () { return r }) } function a(t) { return function (n) { for (var e, r = this.entries.length, i = this.getEqualityFunction(n); r--; ) if (e = this.entries[r], i(n, e[0])) switch (t) { case E: return !0; case K: return e; case q: return [r, e[1]] } return !1 } } function l(t) { return function (n) { for (var e = n.length, r = 0, i = this.entries, u = i.length; u > r; ++r) n[e + r] = i[r][t] } } function f(t, n) { for (var e, r = t.length; r--; ) if (e = t[r], n === e[0]) return r; return null } function h(t, n) { var e = t[n]; return e && e instanceof s ? e : null } function c() { var n = [], i = {}, u = { replaceDuplicateKey: !0, hashCode: e, equals: null }, o = arguments[0], a = arguments[1]; a !== t ? (u.hashCode = o, u.equals = a) : o !== t && r(u, o); var l = u.hashCode, c = u.equals; this.properties = u, this.put = function (t, e) { g(t), d(e); var r, o, a = l(t), f = null; return r = h(i, a), r ? (o = r.getEntryForKey(t), o ? (u.replaceDuplicateKey && (o[0] = t), f = o[1], o[1] = e) : r.addEntry(t, e)) : (r = new s(a, t, e, c), n.push(r), i[a] = r), f }, this.get = function (t) { g(t); var n = l(t), e = h(i, n); if (e) { var r = e.getEntryForKey(t); if (r) return r[1] } return null }, this.containsKey = function (t) { g(t); var n = l(t), e = h(i, n); return e ? e.containsKey(t) : !1 }, this.containsValue = function (t) { d(t); for (var e = n.length; e--; ) if (n[e].containsValue(t)) return !0; return !1 }, this.clear = function () { n.length = 0, i = {} }, this.isEmpty = function () { return !n.length }; var y = function (t) { return function () { for (var e = [], r = n.length; r--; ) n[r][t](e); return e } }; this.keys = y("keys"), this.values = y("values"), this.entries = y("getEntries"), this.remove = function (t) { g(t); var e, r = l(t), u = null, o = h(i, r); return o && (u = o.removeEntryForKey(t), null !== u && 0 == o.entries.length && (e = f(n, r), n.splice(e, 1), delete i[r])), u }, this.size = function () { for (var t = 0, e = n.length; e--; ) t += n[e].entries.length; return t } } var y = "function", p = "string", v = "undefined"; if (typeof encodeURIComponent == v || Array.prototype.splice === t || Object.prototype.hasOwnProperty === t) return null; var g = o("key"), d = o("value"), E = 0, K = 1, q = 2; return s.prototype = { getEqualityFunction: function (t) { return typeof t.equals == y ? i : u }, getEntryForKey: a(K), getEntryAndIndexForKey: a(q), removeEntryForKey: function (t) { var n = this.getEntryAndIndexForKey(t); return n ? (this.entries.splice(n[0], 1), n[1]) : null }, addEntry: function (t, n) { this.entries.push([t, n]) }, keys: l(0), values: l(1), getEntries: function (t) { for (var n = t.length, e = 0, r = this.entries, i = r.length; i > e; ++e) t[n + e] = r[e].slice(0) }, containsKey: a(E), containsValue: function (t) { for (var n = this.entries, e = n.length; e--; ) if (t === n[e][1]) return !0; return !1 } }, c.prototype = { each: function (t) { for (var n, e = this.entries(), r = e.length; r--; ) n = e[r], t(n[0], n[1]) }, equals: function (t) { var n, e, r, i = this.size(); if (i == t.size()) { for (n = this.keys(); i--; ) if (e = n[i], r = t.get(e), null === r || r !== this.get(e)) return !1; return !0 } return !1 }, putAll: function (t, n) { for (var e, r, i, u, o = t.entries(), s = o.length, a = typeof n == y; s--; ) e = o[s], r = e[0], i = e[1], a && (u = this.get(r)) && (i = n(r, u, i)), this.put(r, i) }, clone: function () { var t = new c(this.properties); return t.putAll(this), t } }, c.prototype.toQueryString = function () { for (var t, e = this.entries(), r = e.length, i = []; r--; ) t = e[r], i[r] = encodeURIComponent(n(t[0])) + "=" + encodeURIComponent(n(t[1])); return i.join("&") }, c } ();

//jquery format number

(function (jQuery) {
    var nfLocales = new Hashtable(); var nfLocalesLikeUS = ['ae', 'au', 'ca', 'cn', 'eg', 'gb', 'hk', 'il', 'in', 'jp', 'sk', 'th', 'tw', 'us']; var nfLocalesLikeDE = ['at', 'br', 'de', 'dk', 'es', 'gr', 'it', 'nl', 'pt', 'tr', 'vn']; var nfLocalesLikeFR = ['bg', 'cz', 'fi', 'fr', 'no', 'pl', 'ru', 'se']; var nfLocalesLikeCH = ['ch']; var nfLocaleFormatting = [[".", ","], [",", "."], [",", " "], [".", "'"]]; var nfAllLocales = [nfLocalesLikeUS, nfLocalesLikeDE, nfLocalesLikeFR, nfLocalesLikeCH]
    function FormatData(dec, group, neg) { this.dec = dec; this.group = group; this.neg = neg; }; function init() { for (var localeGroupIdx = 0; localeGroupIdx < nfAllLocales.length; localeGroupIdx++) { var localeGroup = nfAllLocales[localeGroupIdx]; for (var i = 0; i < localeGroup.length; i++) { nfLocales.put(localeGroup[i], localeGroupIdx); } } }; function formatCodes(locale, isFullLocale) {
        if (nfLocales.size() == 0)
            init(); var dec = "."; var group = ","; var neg = "-"; if (isFullLocale == false) {
            if (locale.indexOf('_') != -1)
                locale = locale.split('_')[1].toLowerCase(); else if (locale.indexOf('-') != -1)
                locale = locale.split('-')[1].toLowerCase();
        }
        var codesIndex = nfLocales.get(locale); if (codesIndex) { var codes = nfLocaleFormatting[codesIndex]; if (codes) { dec = codes[0]; group = codes[1]; } }
        return new FormatData(dec, group, neg);
    }; jQuery.fn.formatNumber = function (options, writeBack, giveReturnValue) {
        return this.each(function () {
            if (writeBack == null)
                writeBack = true; if (giveReturnValue == null)
                giveReturnValue = true; var text; if (jQuery(this).is(":input"))
                text = new String(jQuery(this).val()); else
                text = new String(jQuery(this).text()); var returnString = jQuery.formatNumber(text, options); if (writeBack) {
                if (jQuery(this).is(":input"))
                    jQuery(this).val(returnString); else
                    jQuery(this).text(returnString);
            }
            if (giveReturnValue)
                return returnString;
        });
    }; jQuery.formatNumber = function (numberString, options) {
        var options = jQuery.extend({}, jQuery.fn.formatNumber.defaults, options); var formatData = formatCodes(options.locale.toLowerCase(), options.isFullLocale); var dec = formatData.dec; var group = formatData.group; var neg = formatData.neg; var validFormat = "0#-,."; var prefix = ""; var negativeInFront = false; for (var i = 0; i < options.format.length; i++) {
            if (validFormat.indexOf(options.format.charAt(i)) == -1)
                prefix = prefix + options.format.charAt(i); else
                if (i == 0 && options.format.charAt(i) == '-') { negativeInFront = true; continue; }
                else
                    break;
        }
        var suffix = ""; for (var i = options.format.length - 1; i >= 0; i--) {
            if (validFormat.indexOf(options.format.charAt(i)) == -1)
                suffix = options.format.charAt(i) + suffix; else
                break;
        }
        options.format = options.format.substring(prefix.length); options.format = options.format.substring(0, options.format.length - suffix.length); var number = new Number(numberString); return jQuery._formatNumber(number, options, suffix, prefix, negativeInFront);
    }; jQuery._formatNumber = function (number, options, suffix, prefix, negativeInFront) {
        var options = jQuery.extend({}, jQuery.fn.formatNumber.defaults, options); var formatData = formatCodes(options.locale.toLowerCase(), options.isFullLocale); var dec = formatData.dec; var group = formatData.group; var neg = formatData.neg; if (options.overrideGroupSep != null) { group = options.overrideGroupSep; }
        if (options.overrideDecSep != null) { dec = options.overrideDecSep; }
        if (options.overrideNegSign != null) { neg = options.overrideNegSign; }
        var forcedToZero = false; if (isNaN(number)) { if (options.nanForceZero == true) { number = 0; forcedToZero = true; } else { return ''; } }
        if (options.isPercentage == true || (options.autoDetectPercentage && suffix.charAt(suffix.length - 1) == '%')) { number = number * 100; }
        var returnString = ""; if (options.format.indexOf(".") > -1) {
            var decimalPortion = dec; var decimalFormat = options.format.substring(options.format.lastIndexOf(".") + 1); if (options.round == true)
                number = new Number(number.toFixed(decimalFormat.length)); else {
                var numStr = number.toString(); if (numStr.lastIndexOf('.') > 0) { numStr = numStr.substring(0, numStr.lastIndexOf('.') + decimalFormat.length + 1); }
                number = new Number(numStr);
            }
            var decimalValue = new Number(number.toString().substring(number.toString().indexOf('.'))); decimalString = new String(decimalValue.toFixed(decimalFormat.length)); decimalString = decimalString.substring(decimalString.lastIndexOf('.') + 1); for (var i = 0; i < decimalFormat.length; i++) {
                if (decimalFormat.charAt(i) == '#' && decimalString.charAt(i) != '0') { decimalPortion += decimalString.charAt(i); continue; } else if (decimalFormat.charAt(i) == '#' && decimalString.charAt(i) == '0') {
                    var notParsed = decimalString.substring(i); if (notParsed.match('[1-9]')) { decimalPortion += decimalString.charAt(i); continue; } else
                        break;
                } else if (decimalFormat.charAt(i) == "0")
                    decimalPortion += decimalString.charAt(i);
            }
            returnString += decimalPortion
        } else
            number = Math.round(number); var ones = Math.floor(number); if (number < 0)
            ones = Math.ceil(number); var onesFormat = ""; if (options.format.indexOf(".") == -1)
            onesFormat = options.format; else
            onesFormat = options.format.substring(0, options.format.indexOf(".")); var onePortion = ""; if (!(ones == 0 && onesFormat.substr(onesFormat.length - 1) == '#') || forcedToZero) {
            var oneText = new String(Math.abs(ones)); var groupLength = 9999; if (onesFormat.lastIndexOf(",") != -1)
                groupLength = onesFormat.length - onesFormat.lastIndexOf(",") - 1; var groupCount = 0; for (var i = oneText.length - 1; i > -1; i--) { onePortion = oneText.charAt(i) + onePortion; groupCount++; if (groupCount == groupLength && i != 0) { onePortion = group + onePortion; groupCount = 0; } }
            if (onesFormat.length > onePortion.length) {
                var padStart = onesFormat.indexOf('0'); if (padStart != -1) {
                    var padLen = onesFormat.length - padStart; var pos = onesFormat.length - onePortion.length - 1; while (onePortion.length < padLen) {
                        var padChar = onesFormat.charAt(pos); if (padChar == ',')
                            padChar = group; onePortion = padChar + onePortion; pos--;
                    }
                }
            }
        }
        if (!onePortion && onesFormat.indexOf('0', onesFormat.length - 1) !== -1)
            onePortion = '0'; returnString = onePortion + returnString; if (number < 0 && negativeInFront && prefix.length > 0)
            prefix = neg + prefix; else if (number < 0)
            returnString = neg + returnString; if (!options.decimalSeparatorAlwaysShown) { if (returnString.lastIndexOf(dec) == returnString.length - 1) { returnString = returnString.substring(0, returnString.length - 1); } }
        returnString = prefix + returnString + suffix; return returnString;
    }; jQuery.fn.parseNumber = function (options, writeBack, giveReturnValue) {
        if (writeBack == null)
            writeBack = true; if (giveReturnValue == null)
            giveReturnValue = true; var text; if (jQuery(this).is(":input"))
            text = new String(jQuery(this).val()); else
            text = new String(jQuery(this).text()); var number = jQuery.parseNumber(text, options); if (number) {
            if (writeBack) {
                if (jQuery(this).is(":input"))
                    jQuery(this).val(number.toString()); else
                    jQuery(this).text(number.toString());
            }
            if (giveReturnValue)
                return number;
        }
    }; jQuery.parseNumber = function (numberString, options) {
        var options = jQuery.extend({}, jQuery.fn.parseNumber.defaults, options); var formatData = formatCodes(options.locale.toLowerCase(), options.isFullLocale); var dec = formatData.dec; var group = formatData.group; var neg = formatData.neg; if (options.overrideGroupSep != null) { group = options.overrideGroupSep; }
        if (options.overrideDecSep != null) { dec = options.overrideDecSep; }
        if (options.overrideNegSign != null) { neg = options.overrideNegSign; }
        var valid = "1234567890"; var validOnce = '.-'; var strictMode = options.strict; while (numberString.indexOf(group) > -1) { numberString = numberString.replace(group, ''); }
        numberString = numberString.replace(dec, '.').replace(neg, '-'); var validText = ''; var hasPercent = false; if (options.isPercentage == true || (options.autoDetectPercentage && numberString.charAt(numberString.length - 1) == '%')) { hasPercent = true; }
        for (var i = 0; i < numberString.length; i++) { if (valid.indexOf(numberString.charAt(i)) > -1) { validText = validText + numberString.charAt(i); } else if (validOnce.indexOf(numberString.charAt(i)) > -1) { validText = validText + numberString.charAt(i); validOnce = validOnce.replace(numberString.charAt(i), ''); } else { if (options.allowPostfix) { break; } else if (strictMode) { validText = 'NaN'; break; } } }
        var number = new Number(validText); if (hasPercent) { number = number / 100; var decimalPos = validText.indexOf('.'); if (decimalPos != -1) { var decimalPoints = validText.length - decimalPos - 1; number = number.toFixed(decimalPoints + 2); } else { number = number.toFixed(2); } }
        return number;
    }; jQuery.fn.parseNumber.defaults = { locale: "us", decimalSeparatorAlwaysShown: false, isPercentage: false, autoDetectPercentage: true, isFullLocale: false, strict: false, overrideGroupSep: null, overrideDecSep: null, overrideNegSign: null, allowPostfix: false }; jQuery.fn.formatNumber.defaults = { format: "#,###.00", locale: "us", decimalSeparatorAlwaysShown: false, nanForceZero: true, round: true, isFullLocale: false, overrideGroupSep: null, overrideDecSep: null, overrideNegSign: null, isPercentage: false, autoDetectPercentage: true }; Number.prototype.toFixed = function (precision) { return jQuery._roundNumber(this, precision); }; jQuery._roundNumber = function (number, decimalPlaces) {
        var power = Math.pow(10, decimalPlaces || 0); var value = String(Math.round(number * power) / power); if (decimalPlaces > 0) {
            var dp = value.indexOf("."); if (dp == -1) { value += '.'; dp = 0; } else { dp = value.length - (dp + 1); }
            while (dp < decimalPlaces) { value += '0'; dp++; }
        }
        return value;
    };
})(jQuery);

/*
AJAX SUBMIT FORM
*/
; !function (a) { "use strict"; "function" == typeof define && define.amd ? define(["jquery"], a) : a("undefined" != typeof jQuery ? jQuery : window.Zepto) } (function (a) { "use strict"; function b(b) { var c = b.data; b.isDefaultPrevented() || (b.preventDefault(), a(b.target).ajaxSubmit(c)) } function c(b) { var c = b.target, d = a(c); if (!d.is("[type=submit],[type=image]")) { var e = d.closest("[type=submit]"); if (0 === e.length) return; c = e[0] } var f = this; if (f.clk = c, "image" == c.type) if (void 0 !== b.offsetX) f.clk_x = b.offsetX, f.clk_y = b.offsetY; else if ("function" == typeof a.fn.offset) { var g = d.offset(); f.clk_x = b.pageX - g.left, f.clk_y = b.pageY - g.top } else f.clk_x = b.pageX - c.offsetLeft, f.clk_y = b.pageY - c.offsetTop; setTimeout(function () { f.clk = f.clk_x = f.clk_y = null }, 100) } function d() { if (a.fn.ajaxSubmit.debug) { var b = "[jquery.form] " + Array.prototype.join.call(arguments, ""); window.console && window.console.log ? window.console.log(b) : window.opera && window.opera.postError && window.opera.postError(b) } } var e = {}; e.fileapi = void 0 !== a("<input type='file'/>").get(0).files, e.formdata = void 0 !== window.FormData; var f = !!a.fn.prop; a.fn.attr2 = function () { if (!f) return this.attr.apply(this, arguments); var a = this.prop.apply(this, arguments); return a && a.jquery || "string" == typeof a ? a : this.attr.apply(this, arguments) }, a.fn.ajaxSubmit = function (b) { function c(c) { var d, e, f = a.param(c, b.traditional).split("&"), g = f.length, h = []; for (d = 0; g > d; d++) f[d] = f[d].replace(/\+/g, " "), e = f[d].split("="), h.push([decodeURIComponent(e[0]), decodeURIComponent(e[1])]); return h } function g(d) { for (var e = new FormData, f = 0; f < d.length; f++) e.append(d[f].name, d[f].value); if (b.extraData) { var g = c(b.extraData); for (f = 0; f < g.length; f++) g[f] && e.append(g[f][0], g[f][1]) } b.data = null; var h = a.extend(!0, {}, a.ajaxSettings, b, { contentType: !1, processData: !1, cache: !1, type: i || "POST" }); b.uploadProgress && (h.xhr = function () { var c = a.ajaxSettings.xhr(); return c.upload && c.upload.addEventListener("progress", function (a) { var c = 0, d = a.loaded || a.position, e = a.total; a.lengthComputable && (c = Math.ceil(d / e * 100)), b.uploadProgress(a, d, e, c) }, !1), c }), h.data = null; var j = h.beforeSend; return h.beforeSend = function (a, c) { c.data = b.formData ? b.formData : e, j && j.call(this, a, c) }, a.ajax(h) } function h(c) { function e(a) { var b = null; try { a.contentWindow && (b = a.contentWindow.document) } catch (c) { d("cannot get iframe.contentWindow document: " + c) } if (b) return b; try { b = a.contentDocument ? a.contentDocument : a.document } catch (c) { d("cannot get iframe.contentDocument: " + c), b = a.document } return b } function g() { function b() { try { var a = e(r).readyState; d("state = " + a), a && "uninitialized" == a.toLowerCase() && setTimeout(b, 50) } catch (c) { d("Server abort: ", c, " (", c.name, ")"), h(A), w && clearTimeout(w), w = void 0 } } var c = l.attr2("target"), f = l.attr2("action"), g = "multipart/form-data", j = l.attr("enctype") || l.attr("encoding") || g; x.setAttribute("target", o), (!i || /post/i.test(i)) && x.setAttribute("method", "POST"), f != m.url && x.setAttribute("action", m.url), m.skipEncodingOverride || i && !/post/i.test(i) || l.attr({ encoding: "multipart/form-data", enctype: "multipart/form-data" }), m.timeout && (w = setTimeout(function () { v = !0, h(z) }, m.timeout)); var k = []; try { if (m.extraData) for (var n in m.extraData) m.extraData.hasOwnProperty(n) && (a.isPlainObject(m.extraData[n]) && m.extraData[n].hasOwnProperty("name") && m.extraData[n].hasOwnProperty("value") ? k.push(a('<input type="hidden" name="' + m.extraData[n].name + '">').val(m.extraData[n].value).appendTo(x)[0]) : k.push(a('<input type="hidden" name="' + n + '">').val(m.extraData[n]).appendTo(x)[0])); m.iframeTarget || q.appendTo("body"), r.attachEvent ? r.attachEvent("onload", h) : r.addEventListener("load", h, !1), setTimeout(b, 15); try { x.submit() } catch (p) { var s = document.createElement("form").submit; s.apply(x) } } finally { x.setAttribute("action", f), x.setAttribute("enctype", j), c ? x.setAttribute("target", c) : l.removeAttr("target"), a(k).remove() } } function h(b) { if (!s.aborted && !F) { if (E = e(r), E || (d("cannot access response document"), b = A), b === z && s) return s.abort("timeout"), y.reject(s, "timeout"), void 0; if (b == A && s) return s.abort("server abort"), y.reject(s, "error", "server abort"), void 0; if (E && E.location.href != m.iframeSrc || v) { r.detachEvent ? r.detachEvent("onload", h) : r.removeEventListener("load", h, !1); var c, f = "success"; try { if (v) throw "timeout"; var g = "xml" == m.dataType || E.XMLDocument || a.isXMLDoc(E); if (d("isXml=" + g), !g && window.opera && (null === E.body || !E.body.innerHTML) && --G) return d("requeing onLoad callback, DOM not available"), setTimeout(h, 250), void 0; var i = E.body ? E.body : E.documentElement; s.responseText = i ? i.innerHTML : null, s.responseXML = E.XMLDocument ? E.XMLDocument : E, g && (m.dataType = "xml"), s.getResponseHeader = function (a) { var b = { "content-type": m.dataType }; return b[a.toLowerCase()] }, i && (s.status = Number(i.getAttribute("status")) || s.status, s.statusText = i.getAttribute("statusText") || s.statusText); var j = (m.dataType || "").toLowerCase(), k = /(json|script|text)/.test(j); if (k || m.textarea) { var l = E.getElementsByTagName("textarea")[0]; if (l) s.responseText = l.value, s.status = Number(l.getAttribute("status")) || s.status, s.statusText = l.getAttribute("statusText") || s.statusText; else if (k) { var o = E.getElementsByTagName("pre")[0], p = E.getElementsByTagName("body")[0]; o ? s.responseText = o.textContent ? o.textContent : o.innerText : p && (s.responseText = p.textContent ? p.textContent : p.innerText) } } else "xml" == j && !s.responseXML && s.responseText && (s.responseXML = H(s.responseText)); try { D = J(s, j, m) } catch (t) { f = "parsererror", s.error = c = t || f } } catch (t) { d("error caught: ", t), f = "error", s.error = c = t || f } s.aborted && (d("upload aborted"), f = null), s.status && (f = s.status >= 200 && s.status < 300 || 304 === s.status ? "success" : "error"), "success" === f ? (m.success && m.success.call(m.context, D, "success", s), y.resolve(s.responseText, "success", s), n && a.event.trigger("ajaxSuccess", [s, m])) : f && (void 0 === c && (c = s.statusText), m.error && m.error.call(m.context, s, f, c), y.reject(s, "error", c), n && a.event.trigger("ajaxError", [s, m, c])), n && a.event.trigger("ajaxComplete", [s, m]), n && ! --a.active && a.event.trigger("ajaxStop"), m.complete && m.complete.call(m.context, s, f), F = !0, m.timeout && clearTimeout(w), setTimeout(function () { m.iframeTarget ? q.attr("src", m.iframeSrc) : q.remove(), s.responseXML = null }, 100) } } } var j, k, m, n, o, q, r, s, t, u, v, w, x = l[0], y = a.Deferred(); if (y.abort = function (a) { s.abort(a) }, c) for (k = 0; k < p.length; k++) j = a(p[k]), f ? j.prop("disabled", !1) : j.removeAttr("disabled"); if (m = a.extend(!0, {}, a.ajaxSettings, b), m.context = m.context || m, o = "jqFormIO" + (new Date).getTime(), m.iframeTarget ? (q = a(m.iframeTarget), u = q.attr2("name"), u ? o = u : q.attr2("name", o)) : (q = a('<iframe name="' + o + '" src="' + m.iframeSrc + '" />'), q.css({ position: "absolute", top: "-1000px", left: "-1000px" })), r = q[0], s = { aborted: 0, responseText: null, responseXML: null, status: 0, statusText: "n/a", getAllResponseHeaders: function () { }, getResponseHeader: function () { }, setRequestHeader: function () { }, abort: function (b) { var c = "timeout" === b ? "timeout" : "aborted"; d("aborting upload... " + c), this.aborted = 1; try { r.contentWindow.document.execCommand && r.contentWindow.document.execCommand("Stop") } catch (e) { } q.attr("src", m.iframeSrc), s.error = c, m.error && m.error.call(m.context, s, c, b), n && a.event.trigger("ajaxError", [s, m, c]), m.complete && m.complete.call(m.context, s, c) } }, n = m.global, n && 0 === a.active++ && a.event.trigger("ajaxStart"), n && a.event.trigger("ajaxSend", [s, m]), m.beforeSend && m.beforeSend.call(m.context, s, m) === !1) return m.global && a.active--, y.reject(), y; if (s.aborted) return y.reject(), y; t = x.clk, t && (u = t.name, u && !t.disabled && (m.extraData = m.extraData || {}, m.extraData[u] = t.value, "image" == t.type && (m.extraData[u + ".x"] = x.clk_x, m.extraData[u + ".y"] = x.clk_y))); var z = 1, A = 2, B = a("meta[name=csrf-token]").attr("content"), C = a("meta[name=csrf-param]").attr("content"); C && B && (m.extraData = m.extraData || {}, m.extraData[C] = B), m.forceSync ? g() : setTimeout(g, 10); var D, E, F, G = 50, H = a.parseXML || function (a, b) { return window.ActiveXObject ? (b = new ActiveXObject("Microsoft.XMLDOM"), b.async = "false", b.loadXML(a)) : b = (new DOMParser).parseFromString(a, "text/xml"), b && b.documentElement && "parsererror" != b.documentElement.nodeName ? b : null }, I = a.parseJSON || function (a) { return window.eval("(" + a + ")") }, J = function (b, c, d) { var e = b.getResponseHeader("content-type") || "", f = "xml" === c || !c && e.indexOf("xml") >= 0, g = f ? b.responseXML : b.responseText; return f && "parsererror" === g.documentElement.nodeName && a.error && a.error("parsererror"), d && d.dataFilter && (g = d.dataFilter(g, c)), "string" == typeof g && ("json" === c || !c && e.indexOf("json") >= 0 ? g = I(g) : ("script" === c || !c && e.indexOf("javascript") >= 0) && a.globalEval(g)), g }; return y } if (!this.length) return d("ajaxSubmit: skipping submit process - no element selected"), this; var i, j, k, l = this; "function" == typeof b ? b = { success: b} : void 0 === b && (b = {}), i = b.type || this.attr2("method"), j = b.url || this.attr2("action"), k = "string" == typeof j ? a.trim(j) : "", k = k || window.location.href || "", k && (k = (k.match(/^([^#]+)/) || [])[1]), b = a.extend(!0, { url: k, success: a.ajaxSettings.success, type: i || a.ajaxSettings.type, iframeSrc: /^https/i.test(window.location.href || "") ? "javascript:false" : "about:blank" }, b); var m = {}; if (this.trigger("form-pre-serialize", [this, b, m]), m.veto) return d("ajaxSubmit: submit vetoed via form-pre-serialize trigger"), this; if (b.beforeSerialize && b.beforeSerialize(this, b) === !1) return d("ajaxSubmit: submit aborted via beforeSerialize callback"), this; var n = b.traditional; void 0 === n && (n = a.ajaxSettings.traditional); var o, p = [], q = this.formToArray(b.semantic, p); if (b.data && (b.extraData = b.data, o = a.param(b.data, n)), b.beforeSubmit && b.beforeSubmit(q, this, b) === !1) return d("ajaxSubmit: submit aborted via beforeSubmit callback"), this; if (this.trigger("form-submit-validate", [q, this, b, m]), m.veto) return d("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this; var r = a.param(q, n); o && (r = r ? r + "&" + o : o), "GET" == b.type.toUpperCase() ? (b.url += (b.url.indexOf("?") >= 0 ? "&" : "?") + r, b.data = null) : b.data = r; var s = []; if (b.resetForm && s.push(function () { l.resetForm() }), b.clearForm && s.push(function () { l.clearForm(b.includeHidden) }), !b.dataType && b.target) { var t = b.success || function () { }; s.push(function (c) { var d = b.replaceTarget ? "replaceWith" : "html"; a(b.target)[d](c).each(t, arguments) }) } else b.success && s.push(b.success); if (b.success = function (a, c, d) { for (var e = b.context || this, f = 0, g = s.length; g > f; f++) s[f].apply(e, [a, c, d || l, l]) }, b.error) { var u = b.error; b.error = function (a, c, d) { var e = b.context || this; u.apply(e, [a, c, d, l]) } } if (b.complete) { var v = b.complete; b.complete = function (a, c) { var d = b.context || this; v.apply(d, [a, c, l]) } } var w = a("input[type=file]:enabled", this).filter(function () { return "" !== a(this).val() }), x = w.length > 0, y = "multipart/form-data", z = l.attr("enctype") == y || l.attr("encoding") == y, A = e.fileapi && e.formdata; d("fileAPI :" + A); var B, C = (x || z) && !A; b.iframe !== !1 && (b.iframe || C) ? b.closeKeepAlive ? a.get(b.closeKeepAlive, function () { B = h(q) }) : B = h(q) : B = (x || z) && A ? g(q) : a.ajax(b), l.removeData("jqxhr").data("jqxhr", B); for (var D = 0; D < p.length; D++) p[D] = null; return this.trigger("form-submit-notify", [this, b]), this }, a.fn.ajaxForm = function (e) { if (e = e || {}, e.delegation = e.delegation && a.isFunction(a.fn.on), !e.delegation && 0 === this.length) { var f = { s: this.selector, c: this.context }; return !a.isReady && f.s ? (d("DOM not ready, queuing ajaxForm"), a(function () { a(f.s, f.c).ajaxForm(e) }), this) : (d("terminating; zero elements found by selector" + (a.isReady ? "" : " (DOM not ready)")), this) } return e.delegation ? (a(document).off("submit.form-plugin", this.selector, b).off("click.form-plugin", this.selector, c).on("submit.form-plugin", this.selector, e, b).on("click.form-plugin", this.selector, e, c), this) : this.ajaxFormUnbind().bind("submit.form-plugin", e, b).bind("click.form-plugin", e, c) }, a.fn.ajaxFormUnbind = function () { return this.unbind("submit.form-plugin click.form-plugin") }, a.fn.formToArray = function (b, c) { var d = []; if (0 === this.length) return d; var f, g = this[0], h = this.attr("id"), i = b ? g.getElementsByTagName("*") : g.elements; if (i && !/MSIE 8/.test(navigator.userAgent) && (i = a(i).get()), h && (f = a(":input[form=" + h + "]").get(), f.length && (i = (i || []).concat(f))), !i || !i.length) return d; var j, k, l, m, n, o, p; for (j = 0, o = i.length; o > j; j++) if (n = i[j], l = n.name, l && !n.disabled) if (b && g.clk && "image" == n.type) g.clk == n && (d.push({ name: l, value: a(n).val(), type: n.type }), d.push({ name: l + ".x", value: g.clk_x }, { name: l + ".y", value: g.clk_y })); else if (m = a.fieldValue(n, !0), m && m.constructor == Array) for (c && c.push(n), k = 0, p = m.length; p > k; k++) d.push({ name: l, value: m[k] }); else if (e.fileapi && "file" == n.type) { c && c.push(n); var q = n.files; if (q.length) for (k = 0; k < q.length; k++) d.push({ name: l, value: q[k], type: n.type }); else d.push({ name: l, value: "", type: n.type }) } else null !== m && "undefined" != typeof m && (c && c.push(n), d.push({ name: l, value: m, type: n.type, required: n.required })); if (!b && g.clk) { var r = a(g.clk), s = r[0]; l = s.name, l && !s.disabled && "image" == s.type && (d.push({ name: l, value: r.val() }), d.push({ name: l + ".x", value: g.clk_x }, { name: l + ".y", value: g.clk_y })) } return d }, a.fn.formSerialize = function (b) { return a.param(this.formToArray(b)) }, a.fn.fieldSerialize = function (b) { var c = []; return this.each(function () { var d = this.name; if (d) { var e = a.fieldValue(this, b); if (e && e.constructor == Array) for (var f = 0, g = e.length; g > f; f++) c.push({ name: d, value: e[f] }); else null !== e && "undefined" != typeof e && c.push({ name: this.name, value: e }) } }), a.param(c) }, a.fn.fieldValue = function (b) { for (var c = [], d = 0, e = this.length; e > d; d++) { var f = this[d], g = a.fieldValue(f, b); null === g || "undefined" == typeof g || g.constructor == Array && !g.length || (g.constructor == Array ? a.merge(c, g) : c.push(g)) } return c }, a.fieldValue = function (b, c) { var d = b.name, e = b.type, f = b.tagName.toLowerCase(); if (void 0 === c && (c = !0), c && (!d || b.disabled || "reset" == e || "button" == e || ("checkbox" == e || "radio" == e) && !b.checked || ("submit" == e || "image" == e) && b.form && b.form.clk != b || "select" == f && -1 == b.selectedIndex)) return null; if ("select" == f) { var g = b.selectedIndex; if (0 > g) return null; for (var h = [], i = b.options, j = "select-one" == e, k = j ? g + 1 : i.length, l = j ? g : 0; k > l; l++) { var m = i[l]; if (m.selected) { var n = m.value; if (n || (n = m.attributes && m.attributes.value && !m.attributes.value.specified ? m.text : m.value), j) return n; h.push(n) } } return h } return a(b).val() }, a.fn.clearForm = function (b) { return this.each(function () { a("input,select,textarea", this).clearFields(b) }) }, a.fn.clearFields = a.fn.clearInputs = function (b) { var c = /^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i; return this.each(function () { var d = this.type, e = this.tagName.toLowerCase(); c.test(d) || "textarea" == e ? this.value = "" : "checkbox" == d || "radio" == d ? this.checked = !1 : "select" == e ? this.selectedIndex = -1 : "file" == d ? /MSIE/.test(navigator.userAgent) ? a(this).replaceWith(a(this).clone(!0)) : a(this).val("") : b && (b === !0 && /hidden/.test(d) || "string" == typeof b && a(this).is(b)) && (this.value = "") }) }, a.fn.resetForm = function () { return this.each(function () { ("function" == typeof this.reset || "object" == typeof this.reset && !this.reset.nodeType) && this.reset() }) }, a.fn.enable = function (a) { return void 0 === a && (a = !0), this.each(function () { this.disabled = !a }) }, a.fn.selected = function (b) { return void 0 === b && (b = !0), this.each(function () { var c = this.type; if ("checkbox" == c || "radio" == c) this.checked = b; else if ("option" == this.tagName.toLowerCase()) { var d = a(this).parent("select"); b && d[0] && "select-one" == d[0].type && d.find("option").selected(!1), this.selected = b } }) }, a.fn.ajaxSubmit.debug = !1 });

/*
Utils
*/

$.ajaxSetup({
    cache: false
});

$.fn.hasScroll = function () {
    return this.get(0).scrollHeight > this.height();
}

$.fn.onEnter = function (act) {
    $(this).keypress(function (e) {
        if (e.keyCode == 13) {
            $(this).actionComponent(act);
        }
    })
}

function openPageDialog(link, title, params) {
    StartLoading();
    var idDialog = "pageDialog_" + new Date().getTime();
    var dialog = $("<div id=\"" + idDialog + "\" title=\"" + title + "\"/>").appendTo("body").load(link, function () { EndLoading(); $("#" + idDialog).dialog(params) });
}


function messageDiaLog(title, message, buttons) {
    var options = $.extend({}, buttons);
    $("<div id='alert-dialog' title='" + title + "'/>").append(message).appendTo("body").dialog(options);
}

$.fn.dialog = function (options) {
    var oSelf = $(this);
    if (oSelf.data("dialog")) {
        return oSelf.data("dialog");
    }
    var optionsDefault = {
        ok: null,
        cancel: null,
        okText: "Ok",
        cancelText: "Cancel",
        of: 'body',
        removeAfterClose: true,
        beforeClose: null
    }
    options = $.extend({}, optionsDefault, options);
    var idDialog = oSelf.attr("id") + "_dialog";
    var objDialog = $("<div id=\"" + idDialog + "\" class=\"dialog-container\"/>").appendTo(options.of);
    var objDialogMain = $("<div class='dialog-box'/>");
    var objDialogHeader = $("<div class='dialog-header'>" + oSelf.attr("title") + "</div>");
    var objDialogContent = $(" <div class=\"dialog-content\"></div>");
    var objDialogFooter = $("<div class='dialog-footer'></div>");
    function init() {
        objDialog.append(objDialogMain);
        objDialogMain.append(objDialogHeader).append(objDialogContent);
        objDialogContent.append(oSelf);
        oSelf.addClass("dialog-main");
        var height = objDialogMain.outerHeight(true) + 60;
        var windowHeight = $(window).outerHeight(true);
        if (height > windowHeight) {
            objDialogMain.css("margin-top", "0px");
        }

        var isClose = true;

        if (options.ok) {
            objDialogMain.append(objDialogFooter);
            if (options.ok) {
                objDialogFooter.append("<button class='Button ok-button'>" + options.okText + "</button>")
                isClose = false;
            }

            if (options.cancel) {
                objDialogFooter.append("<button class='Button cancel-button'>" + options.cancelText + "</button>")
                isClose = false;
            }

        }

        if (isClose) {
            objDialogHeader.append("<a class='dialog-close glyphicon glyphicon-remove'></a>")
        }

        objDialogHeader.on("click", ".dialog-close", function () {
            oSelf.close();
        });
        objDialogFooter.on("click", ".ok-button", function () {
            options.ok();
            oSelf.close();
        }).on("click", ".cancel-button", function () {
            options.cancel();
            oSelf.close();
        })
    }
    oSelf.close = function () {
        if (options.beforeClose) {
            options.beforeClose();
        }
        if (options.removeAfterClose) {
            objDialog.remove();
        } else {
            objDialog.setDisplay(false);
        }
    }
    oSelf.open = function () {
        objDialog.setDisplay(true);
        var height = objDialogMain.outerHeight(true) + 60;
        var windowHeight = $(window).outerHeight(true);
        if (height > windowHeight) {
            objDialogMain.css("margin-top", "0px");
        }
    }
    init();
    oSelf.data("dialog", oSelf);
    return oSelf;
}

function getRealPosition(el, parent) {
    el = $(el).get(0);
    pos = {
        x: 0,
        y: 0
    };
    while (el) {
        pos.x += el.offsetLeft;
        pos.y += el.offsetTop;
        el = el.offsetParent;
        if (parent) {
            if ($(el).is(parent)) {
                break;
            }
        }
    }
    return pos;
}

function AddClassSelectToLink() {
    $("a[href='" + window.location.pathname + "']").addClass("select")
}

$.fn.confirmAction = function (title, message, okFuc) {
    $(this).unbind("click");
    if (okFuc) {
        $(this).click(function () {
            messageDiaLog($(this).data("Title"), $(this).data("Message"), { ok: okFuc, cancel: function () { } });
        });
    }
};

if (typeof console == "undefined") {
    this.console = {
        log: function () {
        }
    };
}

function setCookie(a, b) {
    if (window.widget) {
        widget.setPreferenceForKey(encodeURIComponent(b), a);
    } else {
        document.cookie = a
				+ "="
				+ encodeURIComponent(b)
				+ "; expires="
				+ (new Date(new Date().getTime() + (360 * 24 * 60 * 60 * 1000)))
						.toGMTString() + "; path=/";
    }
}

function getCookie(a) {
    if (window.widget) {
        return decodeURIComponent(widget.fileupload(a)) || null;
    }
    if (new RegExp(a + "=([^;]*);", "").test(document.cookie + ";")) {
        a = decodeURIComponent(RegExp.$1);
        return a;
    }
    return null;
}

function setSession(a, b) {
    if (new RegExp(a + "=([^;]*);", "").test(window.name + ";")) {
        window.name = window.name.replace(new RegExp(a + "=([^;]*);", ""), a
				+ "=" + encodeURIComponent(b) + ";");
    } else {
        window.name += a + "=" + encodeURIComponent(b) + ";";
    }
}

function getSession(a) {
    if (new RegExp(a + "=([^;]*);", "").test(window.name + ";")) {
        a = decodeURIComponent(RegExp.$1);
        return a;
    }
    return null;
}

var scriptLoaded = [];
function addScriptTag(src, fn) {
    if (!scriptLoaded[src]) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = src;
        document.getElementsByTagName("head")[0].appendChild(script);
        $.getScript(src, function () {
            if (fn) {
                fn();
            }
            scriptLoaded[src] = true;
        });
    } else {
        if (fn) {
            fn();
        }
    }
}

function addLinkTag(src) {
    if ($("link[href='" + src + "']").size() == 0) {
        var link = document.createElement("link");
        link.rel = "stylesheet";
        link.type = "text/css";
        link.href = src;
        document.getElementsByTagName("head")[0].appendChild(link);
    }
}

String.prototype.replaceAt = function (index, character) {
    return this.substr(0, index) + character
				+ this.substr(index + character.length);
}

$.fn.setSelection = function (selectionStart, selectionEnd) {
    if (this.length == 0) {
        return this;
    }
    var input = this[0];
    if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', selectionEnd);
        range.moveStart('character', selectionStart);
        range.select();
    } else if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    }
    return this;
}

$.fn.getSelectionStart = function () {
    if (this.length == 0) {
        return -1;
    }
    var input = this[0];
    var pos = input.value.length;
    if (input.createTextRange) {
        var r = document.selection.createRange().duplicate();
        r.moveEnd('character', input.value.length);
        if (r.text == '') {
            pos = input.value.length
        } else {
            pos = input.value.lastIndexOf(r.text);
        }
    } else if (typeof (input.selectionStart) != "undefined") {
        pos = input.selectionStart;
    }
    return pos;
}

$.fn.getSelectionEnd = function () {
    if (this.length == 0) {
        return -1;
    }
    var input = this[0];
    var pos = input.value.length;
    if (input.createTextRange) {
        var r = document.selection.createRange().duplicate();
        var v = $(input).val();
        r.moveStart('character', -v.length);
        if (r.text == '') {
            pos = v.length;
        } else {
            pos = v.lastIndexOf(r.text);
        }
    } else if (typeof (input.selectionEnd) != "undefined") {
        pos = input.selectionEnd;
    }
    return pos;
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function addKeyValue(obj, key, value) {
    if (value == null || value == undefined) {
        return obj;
    }
    if (obj != "") {
        obj += ",";
    }
    obj += [key] + ":" + JSON.stringify(value);
    return obj;
}

$.fn.params = function () {
    var oSelf = $(this);
    var type = oSelf.attr("runnat");
    var obj = "";
    obj = addKeyValue(obj, "ID", oSelf.attr("id"));
    if (type == 'TimeBox') {
        obj = addKeyValue(obj, "Ticks", oSelf.getVal());
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
    } else if (type == 'TextBox') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "MemberText", oSelf.data("MemberText"));
        obj = addKeyValue(obj, "MemberValue", oSelf.data("MemberValue"));
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
    } else if (type == 'HiddenBox') {
        obj = addKeyValue(obj, "EncryptValue", oSelf.getVal());
    } else if (type == 'TextArea') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
    } else if (type == 'CheckBox') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
    } else if (type == 'RadioButton') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "MemberValue", oSelf.data("MemberValue"));
        obj = addKeyValue(obj, "MemberText", oSelf.data("MemberText"));
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
        obj = addKeyValue(obj, "SelectFirst", oSelf.data("SelectFirst"));
    } else if (type == 'SelectBox') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "MemberValue", oSelf.data("MemberValue"));
        obj = addKeyValue(obj, "MemberText", oSelf.data("MemberText"));
        obj = addKeyValue(obj, "HasDefault", oSelf.data("HasDefault"));
        obj = addKeyValue(obj, "DefaultText", oSelf.data("DefaultText"));
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
    } else if (type == 'RatingBox') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
    } else if (type == 'CkEditor') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
    } else if (type == 'IntBox') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
        obj = addKeyValue(obj, "HasValue", oSelf.data("HasValue"));
    } else if (type == 'SelectDate') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
        obj = addKeyValue(obj, "ShowTime", oSelf.data("ShowTime"));
    } else if (type == 'DecimalBox') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
        obj = addKeyValue(obj, "HasValue", oSelf.data("HasValue"));
    } else if (type == 'GridView') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "QueryEncode", oSelf.data("QueryEncode"));
        obj = addKeyValue(obj, "MemberValue", oSelf.data("MemberValue"));
        obj = addKeyValue(obj, "DisplayCount", oSelf.data("DisplayCount"));
        obj = addKeyValue(obj, "CurrentPage", oSelf.data("CurrentPage"));
        obj = addKeyValue(obj, "SelectMultiple", oSelf.data("SelectMultiple"));
        obj = addKeyValue(obj, "ListColumn", oSelf.data("ListColumn"));
        obj = addKeyValue(obj, "Height", oSelf.data("Height"));
        obj = addKeyValue(obj, "PagingParam", oSelf.data("PagingParam"));
        var useModel = oSelf.data("UseModel");
        if (useModel) {
            obj = addKeyValue(obj, "Model", oSelf.data("Model"));
        }
        obj = addKeyValue(obj, "UseModel", useModel);
    } else if (type == 'DataList') {
        obj = addKeyValue(obj, "QueryEncode", oSelf.data("QueryEncode"));
        obj = addKeyValue(obj, "Template", oSelf.data("Template"));
        obj = addKeyValue(obj, "DisplayCount", oSelf.data("DisplayCount"));
        obj = addKeyValue(obj, "CurrentPage", oSelf.data("CurrentPage"));
        obj = addKeyValue(obj, "PagingParam", oSelf.data("PagingParam"));
        var useModel = oSelf.data("UseModel");
        if (useModel) {
            obj = addKeyValue(obj, "Model", oSelf.data("Model"));
        }
        obj = addKeyValue(obj, "UseModel", useModel);
    } else if (type == 'FileUpload') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "OldValue", oSelf.data("OldValue"));
        obj = addKeyValue(obj, "FileType", oSelf.data("FileType"));
        obj = addKeyValue(obj, "MaxFile", oSelf.data("MaxFile"));
        obj = addKeyValue(obj, "FileSizeEncode", oSelf.data("FileSizeEncode"));
        obj = addKeyValue(obj, "ImageWidth", oSelf.data("ImageWidth"));
        obj = addKeyValue(obj, "ImageHeight", oSelf.data("ImageHeight"));
        obj = addKeyValue(obj, "Fix", oSelf.data("Fix"));
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
        obj = addKeyValue(obj, "FolderUpload", oSelf.data("FolderUpload"));
    } else if (type == 'CaptchaBox') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "ValidateMsg", oSelf.data("ValidateMsg"));
    } else if (type == 'ColorPicker') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
    }
    else if (type == 'Tree') {
        obj = addKeyValue(obj, "Value", oSelf.getVal());
        obj = addKeyValue(obj, "FieldParent", oSelf.data("FieldParent"));
        obj = addKeyValue(obj, "MemberValue", oSelf.data("MemberValue"));
        obj = addKeyValue(obj, "MemberText", oSelf.data("MemberText"));
        obj = addKeyValue(obj, "DefaultHref", oSelf.data("DefaultHref"));
        obj = addKeyValue(obj, "HasDefault", oSelf.data("HasDefault"));
        obj = addKeyValue(obj, "HasDefault", oSelf.data("HasDefault"));
        obj = addKeyValue(obj, "SelectMultiple", oSelf.data("SelectMultiple"));
        obj = addKeyValue(obj, "QueryEncode", oSelf.data("QueryEncode"));
        obj = addKeyValue(obj, "Template", oSelf.data("Template"));
        obj = addKeyValue(obj, "RequiredMsg", oSelf.data("RequiredMsg"));
        var useModel = oSelf.data("UseModel");
        if (useModel) {
            obj = addKeyValue(obj, "Model", oSelf.data("Model"));
        }
        obj = addKeyValue(obj, "UseModel", useModel);
    } else if (type == 'TabLanguages') {
        var model = [];
        $("#" + oSelf.attr("id") + " .Window").not("#" + oSelf.attr("id") + " .Window .Window").each(function (i, e) {
            model.push($(e).data("entity"));
        })
        obj = addKeyValue(obj, "Model", model);
        obj = addKeyValue(obj, "EntityName", oSelf.data("EntityName"));
    } else if (type == 'Validate') {
        var model = [];
        $(".Valid", oSelf).each(function (i, e) {
            model.push($(e).attr("id"));
        })
        obj = addKeyValue(obj, "Model", model);
    }
    return encodeURIComponent("{" + obj + "}");
}

$.fn.getVal = function () {
    var oSelf = $(this);
    var type = oSelf.attr("runnat");
    var val = "";
    if (type == 'TextArea' || type == 'SelectBox' || type == 'HiddenBox') {
        val = oSelf.val();
    } else if (type == 'TextBox') {
        val = oSelf.textbox().getValue();
    } else if (type == 'CheckBox') {
        val = oSelf.is(':checked');
    } else if (type == 'IntBox' || type == 'DecimalBox') {
        val = oSelf.intbox().getValue();
    } else if (type == 'RadioButton') {
        val = $("input:checked", oSelf).val();
    } else if (type == 'CkEditor') {
        oSelf.data("DoFollowAdd", 0);
        val = oSelf.data("editor").getData();
    } else if (type == 'TimeBox') {
        val = oSelf.timebox().getTime();
    } else if (type == 'GridView') {
        val = oSelf.data('selected');
    } else if (type == 'ColorPicker') {
        val = oSelf.data('value');
    } else if (type == 'RatingBox') {
        val = oSelf.rating().getValue();
    } else if (type == "Tree") {
        val = oSelf.data('selected');
    } else if (type == 'FileUpload') {
        val = "";
        $(".list-file .file", oSelf).each(function (i, e) {
            if (val != "") {
                val += ",";
            }
            val += $(e).attr("data");
        })
    } else if (type == 'SelectDate') {
        val = oSelf.selectDate().getValue();
    } else if (type == 'CaptchaBox') {
        val = $("input", oSelf).val();

    }
    return val;
}

$.fn.getParams = function () {
    var params = "";
    $.each($("*[runnat]", this), function (i, e) {
        var vparam = $(e).params();
        params += "&" + $(e).attr("id") + "=" + vparam;
    })
    return params
}

function getWindow(idWin) {
    var obj = null;
    if ($("#" + idWin).size() > 0) {
        obj = $("#" + idWin);
    } else {
        $('.Window[apply]').each(function (i, e) {
            var idCheck = $(e).attr("id").split('_')[0];
            if (idWin == idCheck) {
                obj = $(e);
            }
        })
    }
    return obj;
}



$.fn.setParam = function (key, value) {
    var oSelf = $(this);
    pr = oSelf.data("paramPage");
    if (!pr) {
        pr = "";
    }
    pr = pr.setParameter(key, JSON.stringify(value));
    oSelf.data("paramPage", pr);
}


String.prototype.setParameter = function (key, value) {
    var queryString = this;
    var queryParameters = {},
    re = /([^&=]+)=([^&]*)/g, m;

    while (m = re.exec(queryString)) {
        queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    queryParameters[key] = value;
    return $.param(queryParameters);
}

function setParamForLocation(key, value) {
    key = escape(key); value = escape(value);

    var kvp = document.location.search.substr(1).split('&');
    if (kvp == '') {
        return window.location.pathname + "?" + key + '=' + value;
    }
    else {
        var i = kvp.length; var x;
        while (i--) {
            x = kvp[i].split('=');
            if (x[0] == key) {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }
        if (i < 0) { kvp[kvp.length] = [key, value].join('='); }
        return window.location.pathname + "?" + kvp.join('&');
    }
}

$.fn.actionComponent = function (fuc, actionAfterSuccess) {
    if (fuc) {
        $(this).getApply().actionMethod(fuc, actionAfterSuccess);
    }
}

$.fn.actionMethod = function (fuc, actionAfterSuccess) {
    if (!fuc) {
        return;
    }
    StartLoading();
    var oSelf = $(this);
    var page = encodeURIComponent(oSelf.attr("apply"));
    var params = oSelf.getParams();
    if (oSelf.data("paramPage")) {
        params += "&" + oSelf.data("paramPage");
    }
    $.ajax({
        type: 'POST',
        data: 'winId=' + oSelf.attr("id") + '&apply=' + page + '&m=' + fuc + params,
        url: '/Code/Web/WebService.asmx/DoAction',
        success:
              function (responseText, textStatus, XMLHttpRequest) {
                  var data = JSON.parse($(responseText).contents().text());
                  if (data.Success) {
                      $("body").append("<div class='script-action'>" + data.Content + "</div>");
                      $(".script-action").remove();
                      if (actionAfterSuccess) {
                          actionAfterSuccess();
                      }
                  } else {
                      messageDiaLog("Error", data.Content);
                  }
                  EndLoading();
              },
        error:
              function (XMLHttpRequest, textStatus, errorThrown) {
                  messageDiaLog("Error", textStatus);
                  EndLoading();
              }
    });
}

$.fn.actionMethod1 = function (fuc, actionAfterSuccess) {
    if (!fuc) {
        return;
    }
    var oSelf = $(this);
    var page = encodeURIComponent(oSelf.attr("apply"));
    var params = oSelf.getParams();
    if (oSelf.data("paramPage")) {
        params += "&" + oSelf.data("paramPage");
    }
    $.ajax({
        type: 'POST',
        data: 'winId=' + oSelf.attr("id") + '&apply=' + page + '&m=' + fuc + params,
        url: '/Code/Web/WebService.asmx/DoAction',
        success:
              function (responseText, textStatus, XMLHttpRequest) {
                  var data = JSON.parse($(responseText).contents().text());
                  if (data.Success) {
                      $("body").append("<div class='script-action'>" + data.Content + "</div>");
                      $(".script-action").remove();
                      if ($.isFunction(actionAfterSuccess)) {
                          actionAfterSuccess();
                      }
                  }
              }
    });
}


$.fn.paging = function (type, cid, currentPage, actionAfterSuccess) {
    StartLoading();
    ScrollToElement($("#" + cid));
    var oSelf = $(this);
    var params = oSelf.getParams();

    $.ajax({
        type: 'POST',
        data: 'type=' + type + "&cid=" + cid + "&currentPage=" + currentPage + params,
        url: '/Code/Web/WebService.asmx/Paging',
        success:
              function (responseText, textStatus, XMLHttpRequest) {
                  var data = JSON.parse($(responseText).contents().text());
                  if (data.Success) {
                      $("body").append(data.Content);
                  } else {
                      messageDiaLog("Error", data.Content);
                  }
                  if ($.isFunction(actionAfterSuccess)) {
                      actionAfterSuccess();
                  }
                  EndLoading();
              },
        error:
              function (XMLHttpRequest, textStatus, errorThrown) {
                  messageDiaLog("Error", textStatus);
                  EndLoading();
              }
    });
}

function ScrollToElement(obj) {
    $('html, body').animate({
        scrollTop: $(obj).offset().top
    }, 300);
}


function respondseFileUpload(responseText, statusText, xml) {
    var objResponse = JSON.parse($(responseText).contents().text());
    if (objResponse.Success) {
        var objContent = JSON.parse(objResponse.Content);
        $("#" + objContent.cid).fileUpload().Value(objContent.fileName);
        $("#" + objContent.cid).actionComponent($("#" + objContent.cid).data("OnAfterUpload"));
    } else {
        messageDiaLog("Error", objResponse.Content);
    }
    EndLoading();
}

$.fn.fileUpload = function () {
    var oSelf = $(this);
    if ($(this).data("fileupload")) {
        return $(this).data("fileupload");
    }
    function init() {
        var inFile = $("input[type=file]", oSelf);
        oSelf.on("click", ".list-file .close", function () {
            $(this).parent().remove();
            $(".file-input").css("display", "block");
        })
        oSelf.ajaxForm({ success: respondseFileUpload });
        oSelf.on("change", "input[type=file]", function () {
            var sFileName = $(this).val();
            var _validFileExtensions = oSelf.data("FileType").split(",");
            if (sFileName.length > 0) {
                var blnValid = false;
                if (oSelf.data("FileType") == "*") {
                    blnValid = true;
                } else {
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = "." + _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                            blnValid = true;
                            break;
                        }
                    }
                }
                if (!blnValid) {
                    messageDiaLog("Error", "Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    $(this).val(null);
                    return false;
                } else {
                    oSelf.attr("action", "/Code/Web/WebService.asmx/UploadFile?cid=" + oSelf.attr("id") + "&fileSize=" + encodeURIComponent(oSelf.data("FileSizeEncode")));
                    oSelf.submit();
                    oSelf.attr("action", "");
                    StartLoading();
                }
            }
        });

        oSelf.Value = function (val) {
            if (oSelf.data("MaxFile") == 1 || oSelf.data("MaxFile") == undefined) {
                $(".list-file li", oSelf).remove();
                if (val != '') {
                    var urlImage = isUrlImage(val) ? val : '/code/web/images/file-icon.png';
                    var img = "<a target=\"_blank\" href=\"" + val + "\"><img src='" + urlImage + "'/></a>";
                    $(".list-file", oSelf).append($("<li/>").addClass("file").attr("data", val).append(img));
                    if (oSelf.data("CanDelete")) {
                        var close = $("<div class=\"close\"/>");
                        $(".list-file .file", oSelf).append(close);
                    }
                }
            } else {
                val += '';
                var arrVal = val.split(',');
                $(arrVal).each(function (i, e) {
                    if (e != '') {
                        var oldVal = oSelf.data("Value");
                        var urlImage = isUrlImage(e) ? e : '/code/web/images/file-icon.png';
                        var img = "<a target=\"_blank\" href=\"" + e + "\"><img src='" + urlImage + "'/></a>";
                        var close = $("<div class=\"close\"/>");
                        $(".list-file", oSelf).append($("<li/>").addClass("file").attr("data", e).append(img).append(close));
                        if (oSelf.data("MaxFile") == $(".list-file li", oSelf).size()) {
                            $(".file-input").css("display", "none");
                        }
                    }
                })
            }
        }
    }

    function isUrlImage(url) {
        return (url.match(/\.(jpeg|jpg|gif|png|JPEG|JPG)$/) != null);
    }

    init();
    $(this).data("fileupload", oSelf);
    return oSelf;
}


var listCkeditor = [];
var loadScriptCkeditor = false;
$.fn.ckEditor = function (type) {
    if (!loadScriptCkeditor) {
        var ck = { obj: $(this), type: type };
        listCkeditor.push(ck);
        if (listCkeditor.length == 1) {
            addScriptTag("/Code/Web/Scripts/ckeditor/ckeditor.js", function () {
                addScriptTag("/Code/Web/Scripts/ckeditor/ckfinder/ckfinder.js", function () {
                    loadScriptCkeditor = true;
                    $(listCkeditor).each(function (i, e) {
                        $(e.obj).loadCkeditor(e.type);
                    })
                    listCkeditor = [];
                })
            });
        }
    } else {
        $(this).loadCkeditor(type);
    }
}
$.fn.loadCkeditor = function (type) {
    CKEDITOR.env.isCompatible = true;
    var oSelf = $(this);
    var id = $(this).attr("id");
    var w = $(this).data("Width");
    var h = $(this).data("Height");
    var instance = CKEDITOR.instances[id];
    if (instance) {
        CKEDITOR.remove(instance);
    }
    CKEDITOR.disableAutoInline = true;
    var editor = null;
    if (type == 'Full') {
        editor = CKEDITOR.replace(id);
        CKFinder.setupCKEditor(editor, '/Code/Web/Scripts/ckeditor/ckfinder');
    } else if (type == 'Simple') {
        editor = CKEDITOR.replace(id, {
            toolbar: [
					['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'Image'],
					['FontSize', 'TextColor', 'Blockquote', 'RemoveFormat']
				],
            Width: w,
            Height: h
        });
    } else if (type = 'Medium') {
        editor = CKEDITOR.replace(id, {
            toolbar: [
	            { name: 'document', items: ['DocProps', 'Preview', 'Print', '-', 'Templates'] },
	            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
	            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'] },
	            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] }, '/',
	            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv',
	            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
	            },
	            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
	            { name: 'insert', items: ['Image', 'Table'] },
	            '/',
	            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
	            { name: 'colors', items: ['TextColor', 'BGColor'] },
	            { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
            ],
            Width: w,
            Height: h
        });
    }
    editor.on("instanceReady", function () {
        if (oSelf.data("DoFollow") != undefined) {
            editor.dataProcessor.htmlFilter.addRules(
            {
                elements:
                {
                    a: function (element) {
                        var count = parseInt(oSelf.data("DoFollow"));
                        var c = 0;
                        if (oSelf.data("DoFollowAdd")) {
                            c = parseInt(oSelf.data("DoFollowAdd"));
                        }
                        if (c >= count) {
                            oSelf.data("DoFollowAdd", c + 1);
                            if (!element.attributes.rel) {
                                element.attributes.rel = 'nofollow';
                            }
                        }
                    }
                }
            });
        }
        if (oSelf.data("Value")) {
            editor.setData($("#" + id).data("Value"));
        }
        if (oSelf.data("ReadOnly")) {
            editor.setReadOnly($("#" + id).data("ReadOnly"));
        }
        if (oSelf.data("Display")) {
            $("#cke_" + id).setDisplay($("#" + id).data("Display"))
        }
    })
    oSelf.data("editor", editor);
}

$.fn.setDisplay = function (b) {
    if (b) {
        $(this).removeClass("hide");
    } else {
        $(this).addClass("hide");
    }
}

$.fn.getApply = function () {
    return $($(this).closest('.Window[apply]'));
}

function StartLoading() {
    var loading = "<div id=\"loadingPage\" style=\"\"></div>";
    $("body").append(loading);
}

function EndLoading() {
    $("#loadingPage").remove();
}

$.fn.intbox = function () {
    var oSelf = $(this);

    if ($(this).data("intbox")) {
        return $(this).data("intbox");
    }

    function init() {
        var fchange = false;
        oSelf.change(function () {
            fchange = true;
            var v = oSelf.val();
            if (v == "" && oSelf.data("HasValue")) {
                oSelf.val(0);
            }
            oSelf.format();
        })

        oSelf.focusout(function (event) {
            var oldVal = oSelf.data("valdata");
            var newVal = oSelf.val();
            if (oldVal != newVal) {
                if (!fchange) {
                    oSelf.change();
                }
            }
            fchange = false;
        })

        oSelf.focusin(function (event) {
            oSelf.data("valdata", oSelf.val());
        })

        oSelf.keyup(function (event) {
            if (oSelf.data("FormatNumber") == undefined || oSelf.data("FormatNumber") == true) {
                var v = oSelf.val();
                if (v.length > 1) {
                    var f = "#,##0";
                    var dotIndex = v.indexOf('.');
                    if (dotIndex != -1) {
                        var temp = v.length - dotIndex - 2;
                        f += ".0";
                        for (var i = 0; i < temp; i++) {
                            f += "0";
                        }
                    }
                    if ((v.length - 1) != dotIndex) {
                        if (oSelf.val() != "") {
                            oSelf.parseNumber({ format: f });
                            oSelf.formatNumber({ format: f });
                        }
                    }
                }
            }
        })

        if (oSelf.val() == "" && oSelf.data("HasValue")) {
            oSelf.val(0);
        }
        oSelf.format();
    }

    oSelf.spinner = function () {
        var id = oSelf.attr('id');
        var idSpinner = id + "_spinner";
        oSelf.wrap("<div id='" + idSpinner + "' class='spinner-box'/>");
        var spinnerObj = $("#" + idSpinner);
        spinnerObj.append("<a class='spinner-add'>+</a>");
        spinnerObj.prepend("<a class='spinner-sub'>-</a>");
        spinnerObj.on("click", ".spinner-add", function () {
            v = oSelf.getValue();
            if (v == "") {
                v = 0;
            }
            v++;
            oSelf.val(v).change();
        }).on("click", ".spinner-sub", function () {
            v = oSelf.getValue();
            if (v == "") {
                v = 0;
            }
            v--;
            oSelf.val(v).change();
        })
    }

    oSelf.format = function () {
        if (oSelf.val() != "") {
            if (oSelf.data("FormatNumber") == undefined || oSelf.data("FormatNumber") == true) {
                oSelf.parseNumber({ format: "#,##0.##" });
                oSelf.formatNumber({ format: "#,##0.##" });
            }
        }
    }

    oSelf.getValue = function () {
        var v = oSelf.val();
        if (v == "") {
            return "";
        }
        oSelf.format();
        number = $.parseNumber(v, { format: "#,##0.##" }) + 0;
        return number;
    }

    init();
    $(this).data("intbox", oSelf);
    return oSelf;
}


$.fn.gridview = function () {
    var oSelf = $(this);

    if ($(this).data("gridview")) {
        return $(this).data("gridview");
    }

    function init() {
        oSelf.selectMultiple(false);
        oSelf.on("click", ".paging .page", function () {
            $(this).getApply().paging(oSelf.attr("runnat"), oSelf.attr("id"), $(this).attr("data"));
        })
    }

    oSelf.selectMultiple = function (f) {
        oSelf.off("click", ".row-field .field-select");
        oSelf.off("click", ".row-header .field-select");
        oSelf.off("click", ".row-field");
        oSelf.removeClass("select-multiple");
        if (f) {
            oSelf.addClass("select-multiple");
            oSelf.on("click", ".row-field .field-select", function (e) {
                var parent = $(this).parent();
                if (!parent.hasClass("selected")) {
                    parent.addClass("selected");
                } else {
                    parent.removeClass("selected");
                }

                var v = "";
                $(".row-field.selected", oSelf).each(function (i, e) {
                    if (v != "") {
                        v += ",";
                    }
                    v += $(e).attr("data");
                })
                oSelf.data("selected", v);
                oSelf.actionComponent(oSelf.data("OnSelect"));
            })
            oSelf.on("click", ".row-header .field-select", function (e) {
                if (!$(this).hasClass("checked")) {
                    $(this).addClass("checked");
                    $(".row-field", oSelf).addClass("selected");
                } else {
                    $(".row-field", oSelf).removeClass("selected");
                    $(this).removeClass("checked");
                }

                var v = "";
                $(".row-field.selected", oSelf).each(function (i, e) {
                    if (v != "") {
                        v += ",";
                    }
                    v += $(e).attr("data");
                })
                oSelf.data("selected", v);
                oSelf.actionComponent(oSelf.data("OnSelect"));
            })
        } else {
            oSelf.on("click", ".row-field", function (e) {
                $(".row-field", oSelf).removeClass("selected");
                $(this).addClass("selected");
                var v = "";
                $(".row-field.selected", oSelf).each(function (i, e) {
                    if (v != "") {
                        v += ",";
                    }
                    v += $(e).attr("data");
                })
                oSelf.data("selected", v);
                oSelf.actionComponent(oSelf.data("OnSelect"));
            })
        }
    }

    oSelf.select = function (val) {
        $(".row-field", oSelf).removeClass("selected");
        if (!val) {
            val = "";
        }
        val += "";
        var v = "";
        $(val.split(",")).each(function (i, e) {
            if (e != "") {
                var select = $(".row-field[data='" + e + "']", oSelf);
                if (select.size() >= 1) {
                    if (v != "") {
                        v += ",";
                    }
                    v += e;
                    select.addClass("selected");
                }
            }
        })
        oSelf.data("selected", v);
    }

    oSelf.itemDoubleClick = function (act) {
        oSelf.off("dblclick", ".row-field");
        if (act) {
            oSelf.on("dblclick", ".row-field", function () {
                $(this).actionComponent(act);
            })
        }
    }

    oSelf.reloadPaging = function () {
        var pageCount = parseInt(oSelf.data("PageCount"));
        var pagingParam = oSelf.data("PagingParam");
        var currentPage = parseInt(oSelf.data("CurrentPage"));
        var pagingHtml = "";
        var mod = 4;
        for (var i = currentPage - 4; i <= currentPage; i++) {
            if (i > 0) {
                var cls = "page";
                if (currentPage == i) {
                    cls = "page selected";
                }
                var href = "";
                if (pagingParam) {
                    href = "href='" + setParamForLocation(pagingParam, i) + "'";
                }
                pagingHtml += "<a " + href + " class=\"" + cls + "\" data=\"" + i + "\">" + i + "</a>";
                mod--;
            }
        }
        for (var i = currentPage + 1; i <= currentPage + 6 + mod; i++) {
            if (i <= pageCount) {
                var cls = "page";
                if (currentPage == i) {
                    cls = "page selected";
                }
                var href = "";
                if (pagingParam) {
                    href = "href='" + setParamForLocation(pagingParam, i) + "'";
                }
                pagingHtml += "<a " + href + " class=\"" + cls + "\" data=\"" + i + "\">" + i + "</a>";
            }
        }

        $(".paging", oSelf).html(pagingHtml);
        if (pageCount <= 1 || isNaN(pageCount)) {
            oSelf.showPaging(false);
        } else {
            oSelf.showPaging(true);
        }
        if (oSelf.data("OnAfterPaging")) {
            oSelf.actionComponent(oSelf.data("OnAfterPaging"));
        }

        var listHide = $(".hide");
        listHide.removeClass("hide");
        setTimeout(function(){
            var wBody = $(".grid-content>table", oSelf).outerWidth(true);
            $(".grid-header", oSelf).css("width", wBody);
        },1000);
        listHide.addClass("hide");
        if (oSelf.data("Disabled") != undefined) {
            oSelf.disable(oSelf.data("Disabled"));
        }
    }

    oSelf.showPaging = function (v) {
        $(".paging", oSelf).setDisplay(v);
    }

    oSelf.disable = function (v) {
        oSelf.data("Disabled", v);
        if (v) {
            var disableContainer = $("<div class='disable-container'/>");
            var disableContainer1 = $("<div class='disable-container'/>");
            $(".grid-content", oSelf).append(disableContainer);
            $(".grid-header", oSelf).append(disableContainer1);
            var h = $(".grid-content table", oSelf).outerHeight(true);
            var h1 = $(".grid-header table", oSelf).outerHeight(true);
            disableContainer.css("height", h);
            disableContainer1.css("height", h1);
        } else {
            $(".disable-container", oSelf).remove();
        }
    }

    init();
    $(this).data("gridview", oSelf);
    return oSelf;
}

$.fn.datalist = function () {
    var oSelf = $(this);
    if ($(this).data("datalist")) {
        return $(this).data("datalist");
    }
    function init() {
        oSelf.on("click", ".paging .page", function () {
            $(this).getApply().paging(oSelf.attr("runnat"), oSelf.attr("id"), $(this).attr("data"));
        })
    }

    oSelf.reloadPaging = function () {
        var pageCount = parseInt(oSelf.data("PageCount"));
        var pagingParam = oSelf.data("PagingParam");
        var currentPage = parseInt(oSelf.data("CurrentPage"));
        var pagingHtml = "";
        var mod = 4;
        for (var i = currentPage - 4; i <= currentPage; i++) {
            if (i > 0) {
                var cls = "page";
                if (currentPage == i) {
                    cls = "page selected";
                }
                var href = "";
                if (pagingParam) {
                    href = "href='" + setParamForLocation(pagingParam, i) + "'";
                }
                pagingHtml += "<a " + href + " class=\"" + cls + "\" data=\"" + i + "\">" + i + "</a>";
                mod--;
            }
        }

        for (var i = currentPage + 1; i <= currentPage + 6 + mod; i++) {
            if (i <= pageCount) {
                var cls = "page";
                if (currentPage == i) {
                    cls = "page selected";
                } var href = "";
                if (pagingParam) {
                    href = "href='" + setParamForLocation(pagingParam, i) + "'";
                }
                pagingHtml += "<a " + href + " class=\"" + cls + "\" data=\"" + i + "\">" + i + "</a>";
            }
        }

        $(".paging", oSelf).html(pagingHtml);
        if (pageCount <= 1 || isNaN(pageCount)) {
            oSelf.showPaging(false);
        } else {
            oSelf.showPaging(true);
        }

        oSelf.actionComponent(oSelf.data("OnAfterPaging"));

    }

    oSelf.showPaging = function (v) {
        $(".paging", oSelf).setDisplay(v);
    }

    init();
    $(this).data("datalist", oSelf);
    return oSelf;
}

$.fn.tabLanguages = function (options) {
    var oSelf = $(this);
    if ($(this).data("tabLanguages")) {
        return $(this).data("tabLanguages");
    }

    var optionsDefault = {
        allowDelete: false
    }
    options = $.extend({}, optionsDefault, options);
    var idSelectLang = oSelf.attr("id") + "_selectLang";
    function init() {
        oSelf.tabbox({ allowDelete: options.allowDelete, actionAfterDelete: function () {
            var optionSelect = "";
            $(options.listLanguage).each(function (i, e) {
                if ($(".TabContent[editlang='" + e.LanguageId + "']", oSelf).size() == 0) {
                    optionSelect += "<option value=\"" + e.LanguageId + "\">" + e.Name + "</option>";
                }
            })
            $("#" + idSelectLang).html(optionSelect);
            if (optionSelect == "") {
                $("#" + idSelectLang, oSelf).parent().setDisplay(false);
            } else {
                $("#" + idSelectLang, oSelf).parent().setDisplay(true);
            }
        }
        });
        $("#" + oSelf.attr("id") + ">.tabbox-name").append("<li class=\"tab-add-lang\"><select id=\"" + idSelectLang + "\" class=\"cboLang\"></select><span class=\"glyphicon glyphicon-plus\"></span></li>");
        $("#" + oSelf.attr("id") + ">.tabbox-name").on("click", ".tab-add-lang span", function () {
            oSelf.appendTab($("#" + idSelectLang).val());
        });
    }

    oSelf.SaveData = function (act) {
        var listTab = $("#" + oSelf.attr("id") + ">.TabContent .Window").not("#" + oSelf.attr("id") + ">.TabContent .Window .Window");
        var valid = true;
        var validCount = 0;
        var saveCount = 0;
        listTab.each(function (i, e) {
            $(e).actionMethod("DoValidate", function () {
                if ($(e).data("validate") == false) {
                    valid = false;
                }
                validCount++;
                if (validCount == listTab.size()) {
                    oSelf.actionComponent("DoValidate", function () {
                        if (oSelf.data("validate") == false) {
                            valid = false;
                        }
                        if (valid) {
                            listTab.each(function (k, o) {
                                $(o).actionMethod("DoSave", function () {
                                    saveCount++;
                                    if (saveCount == listTab.size()) {
                                        if ($.isFunction(act)) {
                                            setTimeout(act(), 100);
                                        }
                                    }
                                })
                            })
                        }
                    });
                }
            })
        })
    }

    oSelf.appendTab = function (langId) {
        var optionSelect = "";
        $(options.listLanguage).each(function (i, e) {
            if (e.LanguageId == langId) {
                oSelf.tabbox().appendTab(e.Name, "<div id=\"tab_append" + langId + "\" editlang=\"" + langId + "\"></div>");
                $("#tab_append" + langId, oSelf).load(e.Url);
            }
        })
        $("#" + idSelectLang, oSelf).parent().remove();
        $("#" + oSelf.attr("id") + ">.tabbox-name").append("<li class=\"tab-add-lang\"><select id=\"" + idSelectLang + "\" class=\"cboLang\"></select><span class=\"glyphicon glyphicon-plus\"></span></li>");
        $(options.listLanguage).each(function (i, e) {
            if ($(".TabContent[editlang='" + e.LanguageId + "']", oSelf).size() == 0) {
                optionSelect += "<option value=\"" + e.LanguageId + "\">" + e.Name + "</option>";
            }
        })

        $("#" + idSelectLang, oSelf).html(optionSelect);
        if (optionSelect == "") {
            $("#" + idSelectLang, oSelf).parent().setDisplay(false);
        } else {
            $("#" + idSelectLang, oSelf).parent().setDisplay(true);
        }
    }

    init();
    $(this).data("tabLanguages", oSelf);
    return oSelf;
}

$.fn.tree = function () {
    var oSelf = $(this);
    if ($(this).data("tree")) {
        return $(this).data("tree");
    }
    function init() {
        oSelf.on("click", ".tree-item", function () {
            var parent = $(this).parent();
            if (!oSelf.attr("SelectMultiple")) {
                $("li", oSelf).removeClass("selected");
                parent.addClass("selected");
                oSelf.data("selected", parent.attr("data"));
            }
            oSelf.actionComponent(oSelf.data("OnSelect"));
        })

        oSelf.on("click", ".tree-icon", function () {
            var parent = $(this).parent();
            if (parent.hasClass("open")) {
                parent.removeClass("open");
            } else {
                parent.addClass("open");
            }
        });

        oSelf.on("change", ".tree-check", function () {
            var parent = $(this).parent();
            if ($(this).is(':checked')) {
                $(".tree-check", parent).prop('checked', true);
                var listParent = parent.parents("li", oSelf);
                listParent.each(function (i, e) {
                    var id = $(e).attr("id");
                    $("#" + id + ">.tree-check").prop('checked', true);
                })
            } else {
                $(".tree-check", parent).prop('checked', false);
            }

            var v = '';
            $(".tree-check:checked", oSelf).each(function (i, e) {
                var p = $(e).parent();
                if (v != '') {
                    v += ',';
                }
                v += p.attr("data");
            })
            oSelf.data("selected", v);
            oSelf.actionComponent(oSelf.data("OnSelect"));
        })
        oSelf.reload();
    }

    oSelf.select = function (val) {
        if (!val) {
            val = '';
        }
        if (!oSelf.attr("SelectMultiple")) {
            var parent = $("li[data='" + val + "']", oSelf);
            $("li", oSelf).removeClass("selected");
            parent.addClass("selected");
            $("li", oSelf).removeClass("open");
            parent.addClass("open");
            $("li", oSelf).each(function (i, e) {
                if ($("li[data='" + val + "']", e).size() > 0) {
                    $(e).addClass("open");
                }
            })
            oSelf.data("selected", val);
        } else {
            $("li", oSelf).removeClass("open");
            $(".tree-check", oSelf).prop('checked', false);
            $(val.split(',')).each(function (i, e) {
                $("li[data='" + e + "']", oSelf).addClass("open");
                $("li[data='']", oSelf).addClass("open");
                $("li[data='" + e + "']>.tree-check", oSelf).prop('checked', true);
            })
            $("li", oSelf).each(function (i, e) {
                if ($("li.open", e).size() > 0) {
                    $(e).addClass("open");
                }
            })

            var v = '';
            $(".tree-check:checked", oSelf).each(function (i, e) {
                var p = $(e).parent();
                if (v != '') {
                    v += ',';
                }
                v += p.attr("data");
            })
            oSelf.data("selected", v);
        }
    }

    oSelf.reload = function () {
        var idSelf = oSelf.attr("id");
        $("li", oSelf).each(function (i, e) {
            if ($("li", e).size() == 0) {
                $(e).addClass("end");
                $("ul", e).remove();
            }
            $(e).attr("id", idSelf + "_" + i);
        })
    }

    oSelf.OnDoubleClick = function (ev) {
        oSelf.off("dblclick", ".tree-item");
        if (ev) {
            oSelf.on("dblclick", ".tree-item", function () {
                oSelf.actionComponent(ev);
            })
        }
    }

    init();
    $(this).data("tree", oSelf);
    return oSelf;
}

$.fn.selectDate = function (options) {
    var oSelf = $(this);
    if (oSelf.data("selectDate")) {
        return oSelf.data("selectDate");
    }

    var dateCurrent = new Date();
    var optionsDefault = {
        defaultTextDay: '',
        defaultTextMonth: '',
        defaultTextYear: '',
        days: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octorber', 'November', 'December'],
        fromYear: dateCurrent.getFullYear() - 100,
        toYear: dateCurrent.getFullYear() + 100,
        disableDate: []
    }
    var options = $.extend({}, optionsDefault, options);
    var idCalendarContainer = oSelf.attr("id") + "_cal_container";
    var idCalendar = oSelf.attr("id") + "_cal";
    var idTimeContainer = oSelf.attr("id") + "_time_container";
    var idTime = oSelf.attr("id") + "_time";
    function init() {
        oSelf.html("<div class='t-group1'><input class='t-day'/> / <input class='t-month'/> / <input class='t-year'/> <div class='s-cal glyphicon glyphicon-calendar'></div></div><div class='t-group2 hide'><input class='t-hour'/> : <input class='t-minute'/> <span class=\"s-time glyphicon glyphicon-time\"></span></div>");
        $(".t-hour", oSelf).formatNumber({ format: "00" });
        $(".t-minute", oSelf).formatNumber({ format: "00" });
        oSelf.on("change", ".t-month", function () {
            $(this).formatNumber({ format: "#" });
            var v = $(this).val();
            if (v != "") {
                v = parseInt(v);
                if (v > 12) {
                    v = 12;
                } else if (v < 1) {
                    v = 1;
                }
                $(this).val(v);
                validateDay();
            }
        }).on("change", ".t-day", function () {
            $(this).formatNumber({ format: "#" });
            validateDay();
        }).on("change", ".t-year", function () {
            $(this).formatNumber({ format: "#" });
            var v = $(this).val();
            if (v != "") {
                v = parseInt(v);
                if (v > options.toYear) {
                    v = options.toYear;
                } else if (v < options.fromYear) {
                    v = options.fromYear;
                }
                $(this).val(v);
                validateDay();
            }
        }).on("change", ".t-hour", function () {
            $(this).formatNumber({ format: "00" });
            var v = $(this).val();
            v = parseInt(v);
            if (v > 23) {
                v = 23;
            } else if (v < 0) {
                v = 0;
            }
            $(this).val(v);
            $(this).formatNumber({ format: "00" });
            oSelf.onChange();
        }).on("change", ".t-minute", function () {
            $(this).formatNumber({ format: "00" });
            var v = $(this).val();
            v = parseInt(v);
            if (v > 59) {
                v = 59;
            } else if (v < 0) {
                v = 0;
            }
            $(this).val(v);
            $(this).formatNumber({ format: "00" });
            oSelf.onChange();
        }).on("click", "input", function () {
            $(this).select();
        });

        addEventShowCalendar();
        addEventShowSelectTime();
    }
    function addEventShowCalendar() {
        oSelf.on("click", ".s-cal", function () {
            if (!$(this).hasClass("open")) {
                $(this).addClass("open");
                var calObj = $("<div id=\"" + idCalendar + "\"/>");
                var containerObj = $("<div id=\"" + idCalendarContainer + "\" class='container-out-size'/>");
                containerObj.appendTo("body").click(function () {
                    containerObj.remove();
                    calObj.remove();
                    $(".s-cal", oSelf).removeClass("open");
                });
                calObj.addClass("select-date-calendar").appendTo("body").calendar({ disableDate: options.disableDate, onSelectDate: function (v) {
                    $(".t-day", oSelf).val(v.date);
                    $(".t-month", oSelf).val(v.month + 1);
                    $(".t-year", oSelf).val(v.year);
                    containerObj.remove();
                    calObj.remove();
                    $(".s-cal", oSelf).removeClass("open");
                    oSelf.onChange();
                }, fromYear: options.fromYear,
                    toYear: options.toYear
                });
                calObj.position({ of: oSelf, my: 'right bottom', at: 'right top' });
            }
            if (oSelf.getValue() == null) {
                var d = new Date();
                d.setHours(0, 0, 0, 0);
                oSelf.setValue(d);
            }
            var year = $(".t-year", oSelf).val();
            var day = $(".t-day", oSelf).val();
            var month = $(".t-month", oSelf).val();
            $("#" + idCalendar).calendar().setValue(year, month - 1, day);
        })
    }
    function addEventShowSelectTime() {
        oSelf.on("click", ".s-time", function () {
            if (!$(this).hasClass("open")) {
                $(this).addClass("open");
                var calObj = $("<div id=\"" + idTime + "\"/>");
                var containerObj = $("<div id=\"" + idTimeContainer + "\" class='container-out-size'/>");
                containerObj.appendTo("body").click(function () {
                    containerObj.remove();
                    calObj.remove();
                    $(".s-time", oSelf).removeClass("open");
                });
                calObj.addClass("select-date-time").appendTo("body").timeselect({ onSelectMinute: function (h, m) {
                    $(".t-minute", oSelf).val(m);
                    $(".t-hour", oSelf).val(h);
                    containerObj.remove();
                    calObj.remove();
                    $(".s-time", oSelf).removeClass("open");
                    oSelf.onChange();
                }
                });
                calObj.position({ of: oSelf, my: 'right bottom', at: 'right top' });
            }

            $(".t-hour", oSelf).formatNumber({ format: "00" });
            $(".t-minute", oSelf).formatNumber({ format: "00" });
            var timeSelect = $("#" + idTime).timeselect();
            timeSelect.setValue($(".t-hour", oSelf).val(), $(".t-minute", oSelf).val());
        })
    }
    function validateDay() {
        if ($(".t-day", oSelf).val() != "") {
            var day = parseInt($(".t-day", oSelf).val());
            var month = parseInt($(".t-month", oSelf).val());
            var year = parseInt($(".t-year", oSelf).val());
            if (day > 31) {
                day = 31;
            }
            var count = new Date(year, month, 0).getDate();
            if (day > count) {
                day = count
            } else if (day < 1) {
                day = 1;
            }
            $(".t-day", oSelf).val(day);
            oSelf.onChange();
        }
    }

    oSelf.onChange = function () {
        var year = $(".t-year", oSelf).val();
        var day = $(".t-day", oSelf).val();
        var month = $(".t-month", oSelf).val();
        $(".t-hour", oSelf).formatNumber({ format: "00" });
        $(".t-minute", oSelf).formatNumber({ format: "00" });
        if (year != "" && day != "" && month != "") {
            if (oSelf.data("OnChange")) {
                oSelf.actionComponent(oSelf.data("OnChange"));
            }
        }
    }

    oSelf.setDisable = function (v) {
        if (v) {
            oSelf.addClass("disabled");
            $("input", oSelf).attr("disabled", "disabled");
            oSelf.off("click", ".s-cal");
            oSelf.off("click", ".s-time");
        } else {
            oSelf.removeClass("disabled");
            $("input", oSelf).removeAttr("disabled");
            addEventShowCalendar();
            addEventShowSelectTime();
        }
    }

    oSelf.setDisableDate = function (v) {
        if (v) {
            $("input", oSelf).attr("disabled", "disabled");
        } else {
            $("input", oSelf).removeAttr("disabled");
        }
        options.disableDate = v;
    }

    oSelf.getValue = function () {
        var year = $(".t-year", oSelf).val();
        var day = $(".t-day", oSelf).val();
        var month = $(".t-month", oSelf).val();
        if (year == "" || day == "" || month == "") {
            return null;
        }
        var h = $(".t-hour", oSelf).val();
        var m = $(".t-minute", oSelf).val();

        if (h == "") {
            h = 0;
        } else {
            h = parseInt(h);
        }

        if (m == "") {
            m = 0;
        } else {
            m = parseInt(m);
        }

        return new Date(year, month - 1, day, h, m, 0);
    }

    oSelf.showTime = function (v) {
        $(".t-group2", oSelf).setDisplay(v);
        $(".t-hour", oSelf).val("");
        $(".t-minute", oSelf).val("");
    }

    oSelf.setValue = function (date) {
        if (date) {
            var year = date.getFullYear();
            var day = date.getDate();
            var hour = date.getHours();
            var minute = date.getMinutes();
            var month = date.getMonth() + 1;
            $(".t-day", oSelf).val(day);
            $(".t-month", oSelf).val(month);
            $(".t-year", oSelf).val(year);
            $(".t-hour", oSelf).val(hour).formatNumber({ format: "00" });
            $(".t-minute", oSelf).val(minute).formatNumber({ format: "00" });
        } else {
            $(".t-day", oSelf).val("");
            $(".t-month", oSelf).val("");
            $(".t-year", oSelf).val("");
            $(".t-hour", oSelf).val("");
            $(".t-minute", oSelf).val("");
        }
    }

    init();
    oSelf.data("selectDate", oSelf);
    return oSelf;
}

$.fn.timeselect = function (options) {
    var oSelf = $(this);
    if (oSelf.data("time")) {
        return oSelf.data("time");
    }
    var optionsDefault = {
        onSelectMinute: null
    }
    options = $.extend({}, optionsDefault, options);
    function init() {
        oSelf.hour = 0;
        oSelf.minute = 0;
        oSelf.level = 1;
        oSelf.startHour = 0;
        oSelf.addClass("time-select-box");
        oSelf.html("<div class='title-time-select'><a class='prev-hour'>AM</a><span class='title-value'></span><a class='next-hour'>PM</a></div><div class='time-option'></div><div class='clear'></div>");
        oSelf.showHour();
        oSelf.on("click", ".h-item", function () {
            oSelf.hour = $(this).attr("data");
            $(".h-item", oSelf).removeClass("select");
            $(this).addClass("select");
            oSelf.increaseLevel();
        }).on("click", ".m-item", function () {
            oSelf.minute = $(this).attr("data");
            $(".m-item", oSelf).removeClass("select");
            $(this).addClass("select");
            if (options.onSelectMinute) {
                options.onSelectMinute(oSelf.hour, oSelf.minute);
            }
        }).on("click", ".title-value", function () {
            oSelf.decreaseLevel();
        }).on("click", ".prev-hour", function () {
            $(".title-time-select a", oSelf).removeClass("select");
            $(this).addClass("select");
            oSelf.startHour = 0;
            oSelf.showHour();
        }).on("click", ".next-hour", function () {
            $(".title-time-select a", oSelf).removeClass("select");
            $(this).addClass("select");
            oSelf.startHour = 12;
            oSelf.showHour();
        })
    }

    oSelf.increaseLevel = function () {
        if (oSelf.level < 2) {
            oSelf.level++;
        }
        if (oSelf.level == 2) {
            oSelf.showMinute(oSelf.hour);
        } if (oSelf.level == 1) {
            oSelf.showHour();
        }
    }

    oSelf.decreaseLevel = function () {
        if (oSelf.level > 1) {
            oSelf.level--;
        }
        if (oSelf.level == 2) {
            oSelf.showMinute(oSelf.hour);
        } if (oSelf.level == 1) {
            oSelf.showHour();
        }
    }

    oSelf.showHour = function (startHour) {
        var startHour = oSelf.startHour;
        $(".prev-hour").show(200);
        $(".next-hour").show(200);
        if (!startHour) {
            startHour = 0;
        }
        var count = 12 + startHour;
        var text = startHour + " - " + (startHour + 11);
        $(".time-option", oSelf).html("");
        for (var i = startHour; i < count; i++) {
            var cls = 'h-item';
            if (oSelf.hour == i) {
                cls += " select";
            }
            var dObj = $("<a class='" + cls + "' data='" + i + "'>" + i + "</a>");
            $(".time-option", oSelf).append(dObj);
        }
        $(".time-option", oSelf).append(dObj);
        $(".title-value", oSelf).text(text);
    }

    oSelf.showMinute = function (h) {
        $(".prev-hour").hide(200);
        $(".next-hour").hide(200);
        oSelf.hour = h;
        var count = 55;
        $(".time-option", oSelf).html("");
        for (var i = 0; i <= count; i += 5) {
            var cls = 'm-item';
            if (oSelf.minute == i) {
                cls += " select";
            }
            var dObj = $("<a class='" + cls + "' data='" + i + "'>" + i + "</a>");
            $(".time-option", oSelf).append(dObj);
        }
        $(".title-value", oSelf).text(h);
    }


    oSelf.setValue = function (h, m) {
        if (h != undefined) {
            oSelf.hour = h;
        } else {
            oSelf.hour = 0;
        }

        if (m != undefined) {
            oSelf.minute = m;
        } else {
            oSelf.minute = 0;
        }

        if (oSelf.hour >= 12) {
            $(".next-hour", oSelf).click();
        } else {
            $(".prev-hour", oSelf).click();
        }
    }

    oSelf.getValue = function () {
        return { hour: oSelf.hour, minute: oSelf.minute };
    }

    init();
    oSelf.data("time", oSelf);
    return oSelf;
}

$.fn.calendar = function (options) {
    var oSelf = $(this);
    if (oSelf.data("calendar")) {
        return oSelf.data("calendar");
    }
    var currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);
    var optionsDefault = {
        days: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        fullMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octorber', 'November', 'December'],
        fromYear: currentDate.getFullYear() - 100,
        toYear: currentDate.getFullYear() + 100,
        onSelectDate: null,
        onSelectMonth: null,
        onSelectYear: null,
        disableDate: []
    }
    options = $.extend({}, optionsDefault, options);
    function init() {
        oSelf.setDisableDate(options.disableDate);
        oSelf.year = currentDate.getFullYear();
        oSelf.month = currentDate.getMonth();
        oSelf.date = currentDate.getDate();
        oSelf.cYear = oSelf.year;
        oSelf.cMonth = oSelf.month;
        oSelf.cDate = oSelf.cDate;
        oSelf.startYear = Math.floor(oSelf.year / 10) * 10;

        oSelf.level = 1;
        oSelf.addClass("calendar-box");
        oSelf.html("<div class='title-calendar'><a class='prev-month glyphicon glyphicon-chevron-left'></a><span class='month-value'></span><a class='next-month glyphicon glyphicon-chevron-right'></a></div><div class='d-in-week'></div><div class='d-in-month'></div><div class='clear'></div>");
        $(options.days).each(function (i, e) {
            var dObj = $("<span>" + e + "</span>");
            $(".d-in-week", oSelf).append(dObj);
        })

        oSelf.showDay(oSelf.cYear, oSelf.cMonth);
        oSelf.on("click", ".prev-month", function () {
            if (oSelf.level == 1) {
                oSelf.cMonth = parseInt(oSelf.cMonth) - 1;
                var d = new Date(oSelf.cYear, oSelf.cMonth, 1);
                oSelf.cYear = d.getFullYear();
                oSelf.cMonth = d.getMonth();
                oSelf.showDay(oSelf.cYear, oSelf.cMonth);
            } else if (oSelf.level == 2) {
                oSelf.cYear = parseInt(oSelf.cYear) - 1;
                oSelf.showMonth(oSelf.cYear);
            } else if (oSelf.level == 3) {
                oSelf.startYear = parseInt(oSelf.startYear) - 10;
                oSelf.showYear();
            }
        }).on("click", ".next-month", function () {
            if (oSelf.level == 1) {
                oSelf.cMonth = parseInt(oSelf.cMonth) + 1;
                var d = new Date(oSelf.cYear, oSelf.cMonth, 1);
                oSelf.cYear = d.getFullYear();
                oSelf.cMonth = d.getMonth();
                oSelf.showDay(oSelf.cYear, oSelf.cMonth);
            } else if (oSelf.level == 2) {
                oSelf.cYear = parseInt(oSelf.cYear) + 1;
                oSelf.showMonth(oSelf.cYear);
            } else if (oSelf.level == 3) {
                oSelf.startYear = parseInt(oSelf.startYear) + 10;
                oSelf.showYear();
            }
        }).on("click", ".d-in-month .d-item", function () {
            if (!$(this).hasClass("disable")) {
                oSelf.cDate = $(this).attr("data");
                oSelf.date = oSelf.cDate;
                oSelf.month = oSelf.cMonth;
                oSelf.year = oSelf.cYear;
                if (options.onSelectDate) {
                    options.onSelectDate(oSelf.getValue());
                }
            }
        }).on("click", ".d-in-month .m-item", function () {
            oSelf.cMonth = $(this).attr("data");
            oSelf.decreaseLevel();
            if (options.onSelectMonth) {
                options.onSelectMonth(oSelf.cMonth);
            }
        }).on("click", ".d-in-month .y-item", function () {
            oSelf.cYear = $(this).attr("data");
            oSelf.decreaseLevel();
            if (options.onSelectYear) {
                options.onSelectYear(oSelf.cYear);
            }
        }).on("click", ".month-value", function () {
            oSelf.increaseLevel();
        })
    }

    oSelf.increaseLevel = function () {
        if (oSelf.level < 3) {
            oSelf.level++;
        }
        if (oSelf.level == 1) {
            $(".d-in-week").setDisplay(true);
            oSelf.showDay(oSelf.cYear, oSelf.cMonth);
        } if (oSelf.level == 2) {
            $(".d-in-week").setDisplay(false);
            oSelf.showMonth(oSelf.cYear);
        } else if (oSelf.level == 3) {
            $(".d-in-week").setDisplay(false);
            oSelf.showYear();
        }
    }

    oSelf.decreaseLevel = function () {
        if (oSelf.level > 1) {
            oSelf.level--;
        }
        if (oSelf.level == 1) {
            $(".d-in-week").setDisplay(true);
            oSelf.showDay(oSelf.cYear, oSelf.cMonth);
        } else if (oSelf.level == 2) {
            $(".d-in-week").setDisplay(false);
            oSelf.showMonth(oSelf.cYear);
        } else if (oSelf.level == 3) {
            $(".d-in-week").setDisplay(false);
            oSelf.showYear();
        }
    }

    oSelf.showDay = function (y, m) {
        var count = new Date(y, m + 1, 0).getDate();
        var text = options.fullMonths[m] + " " + y;
        $(".d-in-month", oSelf).html("");
        var dValue = new Date(oSelf.year, oSelf.month, oSelf.date).getTime();
        for (var i = 1; i <= count; i++) {
            var cls = 'd-item';
            var dFor = new Date(y, m, i).getTime();
            if (currentDate.getTime() == dFor) {
                cls += ' current';
            }
            if (dValue == dFor) {
                cls += ' select';
            }

            var dObj = $("<a class='" + cls + "' data='" + i + "'>" + i + "</a>");
            if (options.disableDate != null && options.disableDate.length > 0) {
                var flag = false;
                for (var z = 0; z < options.disableDate.length; z++) {
                    if (dFor == options.disableDate[z].getTime()) {
                        flag = true;
                        break;
                    }
                }
                if (!flag) {
                    dObj = $("<a class='" + cls + " disable' data='" + i + "'>" + i + "</a>");
                }
            }
            $(".d-in-month", oSelf).append(dObj);
        }
        var dayNumber = new Date(y, m, 1).getDay();
        var w = $(".d-in-month>a:first-child", oSelf).outerWidth(true);
        $(".d-in-month>a:first-child", oSelf).css("margin-left", dayNumber * w);
        $(".month-value", oSelf).text(text);
    }

    oSelf.showMonth = function (y) {
        $(".d-in-month", oSelf).animate({ left: -300 }, 100, function () {
            $(".d-in-month", oSelf).css("left", 400);
            var count = 12;
            var text = y;
            $(".d-in-month", oSelf).html("");
            for (var i = 1; i <= count; i++) {
                var cls = 'm-item';
                if (oSelf.year == y && (oSelf.month + 1) == i) {
                    cls += ' select';
                }
                var dObj = $("<a class='" + cls + "' data='" + (i - 1) + "'>" + options.months[i - 1] + "</a>");
                $(".d-in-month", oSelf).append(dObj);
            }
            $(".month-value", oSelf).text(text);
            $(".d-in-month", oSelf).animate({ left: 0 }, 200);
        })
    }

    oSelf.showYear = function () {
        $(".d-in-month", oSelf).animate({ left: -300 }, 100, function () {
            $(".d-in-month", oSelf).css("left", 400);
            var startYear = oSelf.startYear;
            var count = startYear + 10;
            var text = oSelf.startYear + " - " + (oSelf.startYear + 9);
            $(".d-in-month", oSelf).html("");
            for (var i = startYear - 1; i <= count; i++) {
                var cls = 'y-item';
                if (oSelf.year == i) {
                    cls += ' select';
                }
                var dObj = $("<a class='" + cls + "' data='" + i + "'>" + i + "</a>");
                $(".d-in-month", oSelf).append(dObj);
            }
            $(".month-value", oSelf).text(text);
            $(".d-in-month", oSelf).animate({ left: 0 }, 200);
        })
    }

    oSelf.setValue = function (year, month, date) {
        var nowDate = new Date();
        if (year != undefined) {
            oSelf.year = year;
        } else {
            oSelf.year = nowDate.getFullYear();
        }

        if (month != undefined) {
            oSelf.month = month;
        } else {
            oSelf.month = nowDate.getMonth();
        }

        if (date != undefined) {
            oSelf.date = date;
        } else {
            oSelf.date = nowDate.getDate();
        }
        oSelf.cMonth = oSelf.month;
        oSelf.cYear = oSelf.year;
        oSelf.cDate = oSelf.date;
        oSelf.startYear = Math.floor(oSelf.year / 10) * 10;
        oSelf.showDay(oSelf.cYear, oSelf.cMonth);
    }

    oSelf.setDisableDate = function (objListDate) {
        if (objListDate != null) {
            for (var i = 0; i < objListDate.length; i++) {
                objListDate[i].setHours(0, 0, 0, 0);
            }
        }
        options.disableDate = objListDate;
    }

    oSelf.getValue = function () {
        return { year: parseInt(oSelf.year), month: parseInt(oSelf.month), date: parseInt(oSelf.date) };
    }

    init();
    oSelf.data("calendar", oSelf);
    return oSelf;
}



$.fn.captcha = function () {
    var oSelf = $(this);
    if (oSelf.data("captcha")) {
        return oSelf.data("captcha");
    }
    function init() {
        oSelf.on("click", ".refresh", function () {
            d = new Date();
            $("img", oSelf).attr("src", "/Code/Web/WebService.asmx/Captcha?d=" + d.getTime());
        });
    }
    init();
    oSelf.data("captcha", oSelf);
    return oSelf;
}

$.fn.tabbox = function (options) {
    var oSelf = $(this);
    if (oSelf.data("tabbox")) {
        return oSelf.data("tabbox");
    }

    var optionsDefault = {
        allowDelete: false,
        actionAfterDelete: null
    }
    options = $.extend({}, optionsDefault, options);
    var idSelf = oSelf.attr("id");
    function init() {

        var ul = $("<ul/>").addClass("tabbox-name");
        oSelf.append(ul);
        $("#" + idSelf + "> .TabName").each(function (i, e) {
            var li = $("<li/>");
            ul.append(li);
            $(e).appendTo(li);
            if (options.allowDelete) {
                li.append("<a class=\"glyphicon glyphicon-remove close-tab\"></a>");
            }
        })

        $("#" + idSelf + "> .TabContent").css("display", "none").each(function (i, e) {
            if ($(e).hasClass("load-content") && $(e).data("loadSource")) {
                $(e).load($(e).data("loadSource"));
            }
            oSelf.append(e);
        })
        $("#" + idSelf + ">.tabbox-name").on("click", ".TabName", function () {
            $("#" + idSelf + ">.tabbox-name .TabName").removeClass("tab-active");
            $(this).addClass("tab-active");
            var index = $("#" + idSelf + ">.tabbox-name .TabName").index(this);
            $("#" + idSelf + "> .TabContent").css("display", "none");
            var thisTabContent = $($("#" + idSelf + "> .TabContent").get(index));
            thisTabContent.css("display", "block");
            if (thisTabContent.data("loadSource")) {
                StartLoading();
                thisTabContent.load(thisTabContent.data("loadSource"), function () {
                    EndLoading();
                });
                thisTabContent.removeData("loadSource");
            }
        })
        $("#" + idSelf + ">.tabbox-name").on("click", ".close-tab", function () {
            var index = $("#" + idSelf + ">.tabbox-name .close-tab").index(this);
            $($("#" + idSelf + "> .TabContent").get(index)).remove();
            $(this).parent().remove();
            if (options.actionAfterDelete) {
                options.actionAfterDelete();
            }
        });
        $($("#" + idSelf + ">.tabbox-name .TabName").get(0)).click();
    }

    oSelf.appendTab = function (name, obj) {
        if (options.allowDelete) {
            $("#" + idSelf + "> .tabbox-name").append("<li><a class=\"TabName\">" + name + "</a><a class=\"glyphicon glyphicon-remove close-tab\"></a></li>");
        } else {
            $("#" + idSelf + "> .tabbox-name").append("<li><a class=\"TabName\">" + name + "</a></li>");
        }
        var obj = $(obj);
        $("#" + idSelf).append(obj);
        $(obj).addClass("TabContent");
        $(obj).css("display", "none");
        if ($("#" + idSelf + ">.tabbox-name .tab-active").size() == 0) {
            $($("#" + idSelf + ">.tabbox-name .TabName").get(0)).click();
        }
    }

    init();
    oSelf.data("tabbox", oSelf);
    return oSelf;

}



$.fn.ColorBox = function () {
    var oSelf = $(this);
    oSelf.ColorPicker({
        color: '#ffffff',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            if ($(oSelf).data("OnChange")) {
                $(oSelf).data("OnChange")();
            }
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            $('div', oSelf).css('backgroundColor', '#' + hex);
            oSelf.data("value", hex);
        }
    });
}

$.fn.insertError = function (msg) {
    var obj = this;
    var objId = $(obj).attr("id");
    if ($("#" + $(obj).attr("id") + "_spinner").size() > 0) {
        objId = $(obj).attr("id") + "_spinner";
        obj = $("#" + objId);
    }
    var iderror = objId + "_error";
    $("#" + iderror).removeClass("hide");
    if ($("#" + iderror).size() > 0) {
        $("#" + iderror).text(msg);
    } else {
        var span = "<span id='" + iderror + "' class='error'>" + msg + "</span>";
        $(span).insertAfter($(obj));
    }
}
$.fn.clearError = function () {
    var obj = this;
    var iderror = $(obj).attr("id") + "_error";
    $("#" + iderror).addClass("hide");
}
$.fn.rating = function (options) {
    var oSelf = $(this);
    if (oSelf.data("rating")) {
        return oSelf.data("rating");
    }
    var optionsDefault = {
        ratingCount: 5,
        imgSelect: "/Code/Web/Images/star-icon-select.png",
        img: "/Code/Web/Images/star-icon.png",
        width: 20,
        height: 20,
        value: 0,
        disable: false,
        OnSelect: null
    }
    var options = $.extend({}, optionsDefault, options);
    var dvValue = $("<div class=\"status-rating\"/>");
    oSelf.append(dvValue);
    function init() {
        oSelf.css({ "width": options.ratingCount * options.width, "height": options.height, "background-image": "url(" + options.img + ")" });
        dvValue.css({ "background": "url(" + options.imgSelect + ")", "width": options.value, "height": options.height });
        oSelf.disable(options.disable);
        oSelf.setValue(options.value);
    }

    oSelf.disable = function (v) {
        oSelf.unbind("click");
        oSelf.unbind('mouseenter mouseleave');
        if (!v) {
            oSelf.hover(function () {
                var pos = getRealPosition(oSelf.get(0));
                $(document).mousemove(function (event) {
                    var rating = Math.ceil((event.pageX - pos.x) / options.width);
                    dvValue.css("width", rating * options.width);
                });
            }, function () {
                $(document).unbind("mousemove");
                dvValue.css("width", options.value * options.width);
            })

            oSelf.click(function (event) {
                var rating = Math.ceil((event.pageX - pos.x) / options.width);
                options.value = rating;
                if (options.OnSelect) {
                    options.OnSelect();
                }
            })
        }
    }

    oSelf.setValue = function (v) {
        options.value = Math.round(v * 100) / 100;
        dvValue.css("width", options.value * options.width);
    }

    oSelf.getValue = function () {
        return options.value;
    }

    init();
    oSelf.data("rating", oSelf);
    return oSelf;
}

$.fn.timebox = function () {
    var oSelf = $(this);
    if (oSelf.data("timebox")) {
        return oSelf.data("timebox");
    }
    var idTimeContainer = oSelf.attr("id") + "_time_container";
    var idTime = oSelf.attr("id") + "_time";
    function init() {
        oSelf.html("<input class='tb-hour'/> : <input class='tb-minute'/> <span class=\"s-time glyphicon glyphicon-time\"></span>");
        $(".tb-hour", oSelf).change(function () {
            $(this).formatNumber({ format: "00" });
            var v = $(this).val();
            v = parseInt(v);
            if (v > 23) {
                v = 23;
            }
            $(this).val(v);
            oSelf.onChange();
        }).click(function () {
            $(this).select();
        });
        $(".tb-minute", oSelf).change(function () {
            $(this).formatNumber({ format: "00" });
            var v = $(this).val();
            v = parseInt(v);
            if (v > 59) {
                v = 59;
            }
            $(this).val(v);
            oSelf.onChange();
        }).click(function () {
            $(this).select();
        });
        addEventShowSelectTime();
    }

    oSelf.onChange = function () {
        $(".tb-hour", oSelf).formatNumber({ format: "00" });
        $(".tb-minute", oSelf).formatNumber({ format: "00" });
        if (oSelf.data("OnChange")) {
            oSelf.actionComponent(oSelf.data("OnChange"));
        }
    }

    function addEventShowSelectTime() {
        oSelf.on("click", ".s-time", function () {
            if (!$(this).hasClass("open")) {
                $(this).addClass("open");
                var calObj = $("<div id=\"" + idTime + "\"/>");
                var containerObj = $("<div id=\"" + idTimeContainer + "\" class='container-out-size'/>");
                containerObj.appendTo("body").click(function () {
                    containerObj.remove();
                    calObj.remove();
                    $(".s-time", oSelf).removeClass("open");
                });
                calObj.addClass("select-date-time").appendTo("body").timeselect({ onSelectMinute: function (h, m) {
                    $(".tb-hour", oSelf).val(h);
                    $(".tb-minute", oSelf).val(m);
                    containerObj.remove();
                    calObj.remove();
                    $(".s-time", oSelf).removeClass("open");
                    oSelf.onChange();
                }
                });
                calObj.position({ of: oSelf, my: 'right bottom', at: 'right top' });
            }

            $(".tb-hour", oSelf).formatNumber({ format: "00" });
            $(".tb-minute", oSelf).formatNumber({ format: "00" });
            var timeSelect = $("#" + idTime).timeselect();
            timeSelect.setValue($(".tb-hour", oSelf).val(), $(".tb-minute", oSelf).val());
            timeSelect.showHour();
        })
    }

    oSelf.setTime = function (v) {
        if (v) {
            if (v instanceof Date) {
                var h = v.getHours();
                var m = v.getMinutes();
                var s = v.getSeconds();
                v = (h * 3600000) + (m * 60000) + (s * 1000);
            }
            v = v / (1000 * 60);
            var minutes = Math.floor(v % 60);
            v = v / 60;
            var hours = Math.floor(v % 24);
            $(".tb-hour", oSelf).val(hours);
            $(".tb-minute", oSelf).val(minutes);
        } else {
            $(".tb-hour", oSelf).val("");
            $(".tb-minute", oSelf).val("");
        }
        $(".tb-hour", oSelf).formatNumber({ format: "00" });
        $(".tb-minute", oSelf).formatNumber({ format: "00" });
    }

    oSelf.getTime = function () {
        $(".tb-hour", oSelf).formatNumber({ format: "00" });
        $(".tb-minute", oSelf).formatNumber({ format: "00" });
        var h = parseInt($(".tb-hour", oSelf).val());
        var m = parseInt($(".tb-minute", oSelf).val());
        var v = (h * 60 * 60 * 1000) + (m * 60 * 1000);
        return v;
    }
    oSelf.setDisable = function (v) {
        if (v) {
            oSelf.addClass("disabled");
            $("input", oSelf).attr("disabled", "disabled");
            oSelf.off("click", ".s-time");
        } else {
            oSelf.removeClass("disabled");
            $("input", oSelf).removeAttr("disabled");
            addEventShowSelectTime();
        }
    }
    init();
    oSelf.data("timebox", oSelf);
    return oSelf;
}


/*Color picker*/

var ColorPicker = function () {
    var 
			ids = {},
			inAction,
			charMin = 65,
			visible,
			tpl = '<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',
			defaults = {
			    eventName: 'click',
			    onShow: function () { },
			    onBeforeShow: function () { },
			    onHide: function () { },
			    onChange: function () { },
			    onSubmit: function () { },
			    color: 'ff0000',
			    livePreview: true,
			    flat: false
			},
			fillRGBFields = function (hsb, cal) {
			    var rgb = HSBToRGB(hsb);
			    $(cal).data('colorpicker').fields
					.eq(1).val(rgb.r).end()
					.eq(2).val(rgb.g).end()
					.eq(3).val(rgb.b).end();
			},
			fillHSBFields = function (hsb, cal) {
			    $(cal).data('colorpicker').fields
					.eq(4).val(hsb.h).end()
					.eq(5).val(hsb.s).end()
					.eq(6).val(hsb.b).end();
			},
			fillHexFields = function (hsb, cal) {
			    $(cal).data('colorpicker').fields
					.eq(0).val(HSBToHex(hsb)).end();
			},
			setSelector = function (hsb, cal) {
			    $(cal).data('colorpicker').selector.css('backgroundColor', '#' + HSBToHex({ h: hsb.h, s: 100, b: 100 }));
			    $(cal).data('colorpicker').selectorIndic.css({
			        left: parseInt(150 * hsb.s / 100, 10),
			        top: parseInt(150 * (100 - hsb.b) / 100, 10)
			    });
			},
			setHue = function (hsb, cal) {
			    $(cal).data('colorpicker').hue.css('top', parseInt(150 - 150 * hsb.h / 360, 10));
			},
			setCurrentColor = function (hsb, cal) {
			    $(cal).data('colorpicker').currentColor.css('backgroundColor', '#' + HSBToHex(hsb));
			},
			setNewColor = function (hsb, cal) {
			    $(cal).data('colorpicker').newColor.css('backgroundColor', '#' + HSBToHex(hsb));
			},
			keyDown = function (ev) {
			    var pressedKey = ev.charCode || ev.keyCode || -1;
			    if ((pressedKey > charMin && pressedKey <= 90) || pressedKey == 32) {
			        return false;
			    }
			    var cal = $(this).parent().parent();
			    if (cal.data('colorpicker').livePreview === true) {
			        change.apply(this);
			    }
			},
			change = function (ev) {
			    var cal = $(this).parent().parent(), col;
			    if (this.parentNode.className.indexOf('_hex') > 0) {
			        cal.data('colorpicker').color = col = HexToHSB(fixHex(this.value));
			    } else if (this.parentNode.className.indexOf('_hsb') > 0) {
			        cal.data('colorpicker').color = col = fixHSB({
			            h: parseInt(cal.data('colorpicker').fields.eq(4).val(), 10),
			            s: parseInt(cal.data('colorpicker').fields.eq(5).val(), 10),
			            b: parseInt(cal.data('colorpicker').fields.eq(6).val(), 10)
			        });
			    } else {
			        cal.data('colorpicker').color = col = RGBToHSB(fixRGB({
			            r: parseInt(cal.data('colorpicker').fields.eq(1).val(), 10),
			            g: parseInt(cal.data('colorpicker').fields.eq(2).val(), 10),
			            b: parseInt(cal.data('colorpicker').fields.eq(3).val(), 10)
			        }));
			    }
			    if (ev) {
			        fillRGBFields(col, cal.get(0));
			        fillHexFields(col, cal.get(0));
			        fillHSBFields(col, cal.get(0));
			    }
			    setSelector(col, cal.get(0));
			    setHue(col, cal.get(0));
			    setNewColor(col, cal.get(0));
			    cal.data('colorpicker').onChange.apply(cal, [col, HSBToHex(col), HSBToRGB(col)]);
			},
			blur = function (ev) {
			    var cal = $(this).parent().parent();
			    cal.data('colorpicker').fields.parent().removeClass('colorpicker_focus');
			},
			focus = function () {
			    charMin = this.parentNode.className.indexOf('_hex') > 0 ? 70 : 65;
			    $(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');
			    $(this).parent().addClass('colorpicker_focus');
			},
			downIncrement = function (ev) {
			    var field = $(this).parent().find('input').focus();
			    var current = {
			        el: $(this).parent().addClass('colorpicker_slider'),
			        max: this.parentNode.className.indexOf('_hsb_h') > 0 ? 360 : (this.parentNode.className.indexOf('_hsb') > 0 ? 100 : 255),
			        y: ev.pageY,
			        field: field,
			        val: parseInt(field.val(), 10),
			        preview: $(this).parent().parent().data('colorpicker').livePreview
			    };
			    $(document).bind('mouseup', current, upIncrement);
			    $(document).bind('mousemove', current, moveIncrement);
			},
			moveIncrement = function (ev) {
			    ev.data.field.val(Math.max(0, Math.min(ev.data.max, parseInt(ev.data.val + ev.pageY - ev.data.y, 10))));
			    if (ev.data.preview) {
			        change.apply(ev.data.field.get(0), [true]);
			    }
			    return false;
			},
			upIncrement = function (ev) {
			    change.apply(ev.data.field.get(0), [true]);
			    ev.data.el.removeClass('colorpicker_slider').find('input').focus();
			    $(document).unbind('mouseup', upIncrement);
			    $(document).unbind('mousemove', moveIncrement);
			    return false;
			},
			downHue = function (ev) {
			    var current = {
			        cal: $(this).parent(),
			        y: $(this).offset().top
			    };
			    current.preview = current.cal.data('colorpicker').livePreview;
			    $(document).bind('mouseup', current, upHue);
			    $(document).bind('mousemove', current, moveHue);
			},
			moveHue = function (ev) {
			    change.apply(
					ev.data.cal.data('colorpicker')
						.fields
						.eq(4)
						.val(parseInt(360 * (150 - Math.max(0, Math.min(150, (ev.pageY - ev.data.y)))) / 150, 10))
						.get(0),
					[ev.data.preview]
				);
			    return false;
			},
			upHue = function (ev) {
			    fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
			    fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
			    $(document).unbind('mouseup', upHue);
			    $(document).unbind('mousemove', moveHue);
			    return false;
			},
			downSelector = function (ev) {
			    var current = {
			        cal: $(this).parent(),
			        pos: $(this).offset()
			    };
			    current.preview = current.cal.data('colorpicker').livePreview;
			    $(document).bind('mouseup', current, upSelector);
			    $(document).bind('mousemove', current, moveSelector);
			},
			moveSelector = function (ev) {
			    change.apply(
					ev.data.cal.data('colorpicker')
						.fields
						.eq(6)
						.val(parseInt(100 * (150 - Math.max(0, Math.min(150, (ev.pageY - ev.data.pos.top)))) / 150, 10))
						.end()
						.eq(5)
						.val(parseInt(100 * (Math.max(0, Math.min(150, (ev.pageX - ev.data.pos.left)))) / 150, 10))
						.get(0),
					[ev.data.preview]
				);
			    return false;
			},
			upSelector = function (ev) {
			    fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
			    fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
			    $(document).unbind('mouseup', upSelector);
			    $(document).unbind('mousemove', moveSelector);
			    return false;
			},
			enterSubmit = function (ev) {
			    $(this).addClass('colorpicker_focus');
			},
			leaveSubmit = function (ev) {
			    $(this).removeClass('colorpicker_focus');
			},
			clickSubmit = function (ev) {
			    var cal = $(this).parent();
			    var col = cal.data('colorpicker').color;
			    cal.data('colorpicker').origColor = col;
			    setCurrentColor(col, cal.get(0));
			    cal.data('colorpicker').onSubmit(col, HSBToHex(col), HSBToRGB(col), cal.data('colorpicker').el);
			},
			show = function (ev) {
			    var cal = $('#' + $(this).data('colorpickerId'));
			    cal.data('colorpicker').onBeforeShow.apply(this, [cal.get(0)]);
			    var pos = $(this).offset();
			    var viewPort = getViewport();
			    var top = pos.top + this.offsetHeight;
			    var left = pos.left;
			    if (top + 176 > viewPort.t + viewPort.h) {
			        top -= this.offsetHeight + 176;
			    }
			    if (left + 356 > viewPort.l + viewPort.w) {
			        left -= 356;
			    }
			    cal.css({ left: left + 'px', top: top + 'px' });
			    if (cal.data('colorpicker').onShow.apply(this, [cal.get(0)]) != false) {
			        cal.show();
			    }
			    $(document).bind('mousedown', { cal: cal }, hide);
			    return false;
			},
			hide = function (ev) {
			    if (!isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {
			        if (ev.data.cal.data('colorpicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {
			            ev.data.cal.hide();
			        }
			        $(document).unbind('mousedown', hide);
			    }
			},
			isChildOf = function (parentEl, el, container) {
			    if (parentEl == el) {
			        return true;
			    }
			    if (parentEl.contains) {
			        return parentEl.contains(el);
			    }
			    if (parentEl.compareDocumentPosition) {
			        return !!(parentEl.compareDocumentPosition(el) & 16);
			    }
			    var prEl = el.parentNode;
			    while (prEl && prEl != container) {
			        if (prEl == parentEl)
			            return true;
			        prEl = prEl.parentNode;
			    }
			    return false;
			},
			getViewport = function () {
			    var m = document.compatMode == 'CSS1Compat';
			    return {
			        l: window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
			        t: window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
			        w: window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
			        h: window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
			    };
			},
			fixHSB = function (hsb) {
			    return {
			        h: Math.min(360, Math.max(0, hsb.h)),
			        s: Math.min(100, Math.max(0, hsb.s)),
			        b: Math.min(100, Math.max(0, hsb.b))
			    };
			},
			fixRGB = function (rgb) {
			    return {
			        r: Math.min(255, Math.max(0, rgb.r)),
			        g: Math.min(255, Math.max(0, rgb.g)),
			        b: Math.min(255, Math.max(0, rgb.b))
			    };
			},
			fixHex = function (hex) {
			    var len = 6 - hex.length;
			    if (len > 0) {
			        var o = [];
			        for (var i = 0; i < len; i++) {
			            o.push('0');
			        }
			        o.push(hex);
			        hex = o.join('');
			    }
			    return hex;
			},
			HexToRGB = function (hex) {
			    var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
			    return { r: hex >> 16, g: (hex & 0x00FF00) >> 8, b: (hex & 0x0000FF) };
			},
			HexToHSB = function (hex) {
			    return RGBToHSB(HexToRGB(hex));
			},
			RGBToHSB = function (rgb) {
			    var hsb = {
			        h: 0,
			        s: 0,
			        b: 0
			    };
			    var min = Math.min(rgb.r, rgb.g, rgb.b);
			    var max = Math.max(rgb.r, rgb.g, rgb.b);
			    var delta = max - min;
			    hsb.b = max;
			    if (max != 0) {

			    }
			    hsb.s = max != 0 ? 255 * delta / max : 0;
			    if (hsb.s != 0) {
			        if (rgb.r == max) {
			            hsb.h = (rgb.g - rgb.b) / delta;
			        } else if (rgb.g == max) {
			            hsb.h = 2 + (rgb.b - rgb.r) / delta;
			        } else {
			            hsb.h = 4 + (rgb.r - rgb.g) / delta;
			        }
			    } else {
			        hsb.h = -1;
			    }
			    hsb.h *= 60;
			    if (hsb.h < 0) {
			        hsb.h += 360;
			    }
			    hsb.s *= 100 / 255;
			    hsb.b *= 100 / 255;
			    return hsb;
			},
			HSBToRGB = function (hsb) {
			    var rgb = {};
			    var h = Math.round(hsb.h);
			    var s = Math.round(hsb.s * 255 / 100);
			    var v = Math.round(hsb.b * 255 / 100);
			    if (s == 0) {
			        rgb.r = rgb.g = rgb.b = v;
			    } else {
			        var t1 = v;
			        var t2 = (255 - s) * v / 255;
			        var t3 = (t1 - t2) * (h % 60) / 60;
			        if (h == 360) h = 0;
			        if (h < 60) { rgb.r = t1; rgb.b = t2; rgb.g = t2 + t3 }
			        else if (h < 120) { rgb.g = t1; rgb.b = t2; rgb.r = t1 - t3 }
			        else if (h < 180) { rgb.g = t1; rgb.r = t2; rgb.b = t2 + t3 }
			        else if (h < 240) { rgb.b = t1; rgb.r = t2; rgb.g = t1 - t3 }
			        else if (h < 300) { rgb.b = t1; rgb.g = t2; rgb.r = t2 + t3 }
			        else if (h < 360) { rgb.r = t1; rgb.g = t2; rgb.b = t1 - t3 }
			        else { rgb.r = 0; rgb.g = 0; rgb.b = 0 }
			    }
			    return { r: Math.round(rgb.r), g: Math.round(rgb.g), b: Math.round(rgb.b) };
			},
			RGBToHex = function (rgb) {
			    var hex = [
					rgb.r.toString(16),
					rgb.g.toString(16),
					rgb.b.toString(16)
				];
			    $.each(hex, function (nr, val) {
			        if (val.length == 1) {
			            hex[nr] = '0' + val;
			        }
			    });
			    return hex.join('');
			},
			HSBToHex = function (hsb) {
			    return RGBToHex(HSBToRGB(hsb));
			},
			restoreOriginal = function () {
			    var cal = $(this).parent();
			    var col = cal.data('colorpicker').origColor;
			    cal.data('colorpicker').color = col;
			    fillRGBFields(col, cal.get(0));
			    fillHexFields(col, cal.get(0));
			    fillHSBFields(col, cal.get(0));
			    setSelector(col, cal.get(0));
			    setHue(col, cal.get(0));
			    setNewColor(col, cal.get(0));
			};
    return {
        init: function (opt) {
            opt = $.extend({}, defaults, opt || {});
            if (typeof opt.color == 'string') {
                opt.color = HexToHSB(opt.color);
            } else if (opt.color.r != undefined && opt.color.g != undefined && opt.color.b != undefined) {
                opt.color = RGBToHSB(opt.color);
            } else if (opt.color.h != undefined && opt.color.s != undefined && opt.color.b != undefined) {
                opt.color = fixHSB(opt.color);
            } else {
                return this;
            }
            return this.each(function () {
                if (!$(this).data('colorpickerId')) {
                    var options = $.extend({}, opt);
                    options.origColor = opt.color;
                    var id = 'collorpicker_' + parseInt(Math.random() * 1000);
                    $(this).data('colorpickerId', id);
                    var cal = $(tpl).attr('id', id);
                    if (options.flat) {
                        cal.appendTo(this).show();
                    } else {
                        cal.appendTo(document.body);
                    }
                    options.fields = cal
											.find('input')
												.bind('keyup', keyDown)
												.bind('change', change)
												.bind('blur', blur)
												.bind('focus', focus);
                    cal
							.find('span').bind('mousedown', downIncrement).end()
							.find('>div.colorpicker_current_color').bind('click', restoreOriginal);
                    options.selector = cal.find('div.colorpicker_color').bind('mousedown', downSelector);
                    options.selectorIndic = options.selector.find('div div');
                    options.el = this;
                    options.hue = cal.find('div.colorpicker_hue div');
                    cal.find('div.colorpicker_hue').bind('mousedown', downHue);
                    options.newColor = cal.find('div.colorpicker_new_color');
                    options.currentColor = cal.find('div.colorpicker_current_color');
                    cal.data('colorpicker', options);
                    cal.find('div.colorpicker_submit')
							.bind('mouseenter', enterSubmit)
							.bind('mouseleave', leaveSubmit)
							.bind('click', clickSubmit);
                    fillRGBFields(options.color, cal.get(0));
                    fillHSBFields(options.color, cal.get(0));
                    fillHexFields(options.color, cal.get(0));
                    setHue(options.color, cal.get(0));
                    setSelector(options.color, cal.get(0));
                    setCurrentColor(options.color, cal.get(0));
                    setNewColor(options.color, cal.get(0));
                    if (options.flat) {
                        cal.css({
                            position: 'relative',
                            display: 'block'
                        });
                    } else {
                        $(this).bind(options.eventName, show);
                    }
                }
            });
        },
        showPicker: function () {
            return this.each(function () {
                if ($(this).data('colorpickerId')) {
                    show.apply(this);
                }
            });
        },
        hidePicker: function () {
            return this.each(function () {
                if ($(this).data('colorpickerId')) {
                    $('#' + $(this).data('colorpickerId')).hide();
                }
            });
        },
        setColor: function (col) {
            if (typeof col == 'string') {
                col = HexToHSB(col);
            } else if (col.r != undefined && col.g != undefined && col.b != undefined) {
                col = RGBToHSB(col);
            } else if (col.h != undefined && col.s != undefined && col.b != undefined) {
                col = fixHSB(col);
            } else {
                return this;
            }
            $(this).data("value", HSBToHex(col));
            $('div', this).css('backgroundColor', '#' + HSBToHex(col));
            return this.each(function () {
                if ($(this).data('colorpickerId')) {
                    var cal = $('#' + $(this).data('colorpickerId'));
                    cal.data('colorpicker').color = col;
                    cal.data('colorpicker').origColor = col;
                    fillRGBFields(col, cal.get(0));
                    fillHSBFields(col, cal.get(0));
                    fillHexFields(col, cal.get(0));
                    setHue(col, cal.get(0));
                    setSelector(col, cal.get(0));
                    setCurrentColor(col, cal.get(0));
                    setNewColor(col, cal.get(0));
                }
            });
        }
    };
} ();
$.fn.extend({
    ColorPicker: ColorPicker.init,
    ColorPickerHide: ColorPicker.hidePicker,
    ColorPickerShow: ColorPicker.showPicker,
    ColorPickerSetColor: ColorPicker.setColor
});

$.fn.textbox = function () {
    var oSelf = $(this);
    if (oSelf.data("textbox")) {
        return oSelf.data("textbox");
    }

    function init() {

    }

    oSelf.model = function (sourceModel) {
        if (!oSelf.data("sourceModel")) {
            oSelf.boxComplete = $("<ul id='autocomplete_" + oSelf.attr("id") + "' class='autocomplete-box'/>");
            oSelf.boxComplete.appendTo("body");
            var timeoutHoldkey, intervalHolkey;
            oSelf.keyup(function (e) {
                if ((e.keyCode != 38 && e.keyCode != 40) || oSelf.boxComplete.css("display") == "none") {
                    if (e.keyCode != 13 && e.keyCode != 9) {
                        oSelf.search(oSelf.val());
                    }
                }
                clearInterval(intervalHolkey);
                clearTimeout(timeoutHoldkey);
            }).keydown(function (e) {
                if ((e.keyCode == 38 || e.keyCode == 40) && oSelf.boxComplete.css("display") != "none") {
                    var listResult = oSelf.listResult;
                    if (listResult.size() > 0) {
                        var index = listResult.index($(".select", oSelf.boxComplete));
                        if (e.keyCode == 40) {
                            index = index + 1 >= listResult.size() ? 0 : index + 1;
                        } else {
                            index = index - 1 < 0 ? listResult.size() - 1 : index - 1;
                        }
                        oSelf.next(index);
                        clearInterval(intervalHolkey);
                        clearTimeout(timeoutHoldkey);
                        timeoutHoldkey = setTimeout(function () {
                            intervalHolkey = setInterval(function () {
                                var index = listResult.index($(".select", oSelf.boxComplete));
                                if (e.keyCode == 40) {
                                    index = index + 1 >= listResult.size() ? 0 : index + 1;
                                } else {
                                    index = index - 1 < 0 ? listResult.size() - 1 : index - 1;
                                }
                                oSelf.next(index);
                            }, 500);
                        }, 1000);
                    }
                } else if (e.keyCode == 13) {
                    var select = $(".select", oSelf.boxComplete);
                    if (select.size() > 0) {
                        oSelf.val(select.text());
                        oSelf.change();
                    }
                    setTimeout(function () { $("#autocomplete_" + oSelf.attr("id")).slideUp(200); }, 200);
                }
            }).focusout(function () {
                var sourceModel = oSelf.data("sourceModel");
                if (sourceModel) {
                    if (oSelf.data("Match")) {
                        var val = null;
                        $(sourceModel).each(function (i, e) {
                            if (e.Label == oSelf.val()) {
                                val = e;
                            }
                        })
                        if (val) {
                            oSelf.val(val.Label);
                        } else {
                            oSelf.val("");
                        }
                    }
                }
                setTimeout(function () { $("#autocomplete_" + oSelf.attr("id")).slideUp(200); }, 200);
            });

            oSelf.boxComplete.on("click", "li", function () {
                oSelf.val($(this).text());
                oSelf.change();
            })
            oSelf.boxComplete.on("mouseover", "li", function () {
                $("li", oSelf.boxComplete).removeClass("select");
                $(this).addClass("select");
            })
        }
        oSelf.data("sourceModel", sourceModel);
    }

    oSelf.next = function (index) {
        var listResult = oSelf.listResult;
        listResult.removeClass("select");
        var liSelect = $(listResult.get(index));
        liSelect.addClass("select");
        oSelf.val(liSelect.text());
        oSelf.change();
        var h = oSelf.boxComplete.outerHeight(false);
        var maxY = h + oSelf.boxComplete.scrollTop();
        var minY = maxY - h;
        var pos = getRealPosition(liSelect, oSelf.boxComplete);
        var topSelect = liSelect.offset().top;
        if (pos.y > maxY) {
            oSelf.boxComplete.scrollTop(pos.y);
        } else if (pos.y < minY) {
            oSelf.boxComplete.scrollTop(pos.y - h);
        }
    }

    oSelf.search = function (keyword) {
        var sourceModel = oSelf.data("sourceModel");
        if (sourceModel) {
            keyword = keyword.toLowerCase();
            var boxAutocomplete = oSelf.boxComplete;
            boxAutocomplete.html("");
            var hasValue = false;
            $(sourceModel).each(function (i, e) {
                if (e.NameSearch.indexOf(keyword) != -1) {
                    boxAutocomplete.append("<li value='" + e.Value + "'>" + e.Label + "</li>");
                    hasValue = true;
                }
            })
            if (hasValue) {
                if (boxAutocomplete.css("display") == "none") {
                    oSelf.boxComplete.removeAttr("style").position({ of: oSelf,
                        my: 'left top',
                        at: 'left bottom'
                    });
                    boxAutocomplete.slideDown(200);
                }
            }
        }
        oSelf.listResult = $("li", oSelf.boxComplete);
        if (oSelf.listResult.size() > 0) {
            $(oSelf.listResult.get(0)).addClass("select");
        }
    }

    oSelf.getValue = function () {
        var sourceModel = oSelf.data("sourceModel");
        if (sourceModel) {
            var val = "";
            $(sourceModel).each(function (i, e) {
                if (e.Label == oSelf.val()) {
                    val = e.Value;
                }
            })
            if (val != "") {
                return val;
            }
            if (oSelf.data("Match")) {
                return "";
            } else {
                return oSelf.val().trim();
            }
        } else {
            return oSelf.val().trim();
        }
    }

    init();
    oSelf.data("textbox", oSelf);
    return oSelf;
}

$.fn.menu = function (options) {
    var oSelf = $(this);
    if (oSelf.data("menu")) {
        return oSelf.data("menu");
    }
    var optionsDefault = {
        axis: 'x',
        eventBinding: 'click',
        removeHrefParent: true
    }
    var options = $.extend({}, optionsDefault, options);

    function init() {
        var cls = options.axis == 'x' ? 'menu-list' : "menu-list menu-list-vertical";
        oSelf.addClass(cls);
        var idMenu = oSelf.attr("id");
        var inputFocus = $("<input id=\"focus_" + idMenu + "\" type=\"checkbox\" class='hidden-input'/>").appendTo("body");
        var timeOutClose;
        $("ul", oSelf).each(function (i, e) {
            $(e).attr("id", idMenu + "_child_" + i);
            if ($("li", e).size() > 0) {
                var p = $(e).parent();
                p.addClass("has-child");

            }
        })
        if (options.removeHrefParent) {
            $(".has-child>a", oSelf).removeAttr("href");
        }
        oSelf.on(options.eventBinding, "li", function (e) {
            var idParent = $(this).parent().attr("id");
            $("#" + idParent + " li").removeClass("select");
            $(this).addClass("select");
            inputFocus.focus();
            clearTimeout(timeOutClose);
            e.stopPropagation();
        })

        inputFocus.focusout(function () {
            timeOutClose = setTimeout(function () { $("li", oSelf).removeClass("select"); }, 500);
        })
    }
    init();
    oSelf.data("menu", oSelf);
    return oSelf;
}
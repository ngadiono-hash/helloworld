var layoutkeyword = window.innerWidth <= 750 ? "rows" : "columns";
layoutkeyword = -1 != location.search.indexOf("layout=rows") ? "rows" : layoutkeyword;
var jkresizemodule = function () {
    function e(e) {
        layoutkeyword = e, a.removeAttribute("style"), l.removeAttribute("style"), c = "columns" == layoutkeyword ? a.offsetWidth + l.offsetWidth : a.offsetHeight + l.offsetHeight, s = 50, "rows" == e ? document.documentElement.className = "rowslayout" : document.documentElement.className = ""
    }
    var t, o = document.getElementById("jkcodecontainer"),
        n = document.getElementById("jkoverlay"),
        d = document.getElementById("jkdragbar"),
        s = 50,
        r = !1,
        i = 50,
        a = document.getElementById("jkcodeinput"),
        l = document.getElementById("jkcodeoutput"),
        c = "columns" == layoutkeyword ? a.offsetWidth + l.offsetWidth : a.offsetHeight + l.offsetHeight,
        u = !loadricheditor,
        m = screen.height;
    e(layoutkeyword);
    var u = !loadricheditor;
    return d.addEventListener(u ? "touchstart" : "mousedown", function (e) {
        var d = u ? e.changedTouches[0] : e;
        r = !0, t = "columns" == layoutkeyword ? d.clientX : d.clientY, o.className = "isresizing", n.style.display = "block", d.preventDefault()
    }, !1), document.addEventListener(u ? "touchmove" : "mousemove", function (e) {
        var o = u ? e.changedTouches[0] : e;
        if (r) {
            var n = ("columns" == layoutkeyword ? o.clientX : o.clientY) - t,
                d = Math.round(n / c * 100);
            i = s + d, "columns" == layoutkeyword ? (a.style.width = i + "%", l.style.width = 100 - i + "%") : (a.style.height = i + "%", l.style.height = 100 - i + "%")
        }
        o.preventDefault()
    }, !1), document.addEventListener(u ? "touchend" : "mouseup", function (e) {
        var t = u ? e.changedTouches[0] : e;
        s = i, r = !1, o.className = "", n.style.display = "none", "jkenabled" != jkcodeeditor.richeditor.className && jkcodeeditor.richeditor.resize(), t.preventDefault()
    }, !1), window.addEventListener("resize", function (t) {
        layoutkeyword = window.innerWidth <= 750 || classie.has(document.getElementById("rowslayoutbutton"), "selectedtool") ? "rows" : "columns", c = "columns" == layoutkeyword ? a.offsetWidth + l.offsetWidth : a.offsetHeight + l.offsetHeight, s = 50, e(layoutkeyword), u && 1024 >= m && (m - parent.innerHeight > 200 ? classie.has(o, "movetotop") || classie.add(o, "movetotop") : classie.has(o, "movetotop") && classie.remove(o, "movetotop"))
    }, !1), {
        editorlayouttoggle: e
    }
}(),
    jkglobals = function () {
        function e() {
            return c
        }
        function t(e) {
            // important
            var zzz = document.getElementById('cats');
            var yyy = new RegExp(zzz);
            if (yyy.test(location.href)) {
                e && (classie.add(a, "selectedtool"), d = setTimeout(function () {
                    classie.remove(a, "selectedtool")
                }, 300));
                var t = u.contentWindow ? u.contentWindow : u.contentDocument.document ? u.contentDocument.document : u.contentDocument;
                t.document.open(), t.document.write(jkcodeeditor.richeditor.getValue()), t.document.close()
            }
        }
        function o(e, t, n) {
            if (n.length > 0) {
                var d = n.shift();
                e.addEventListener ? e.addEventListener(d, t, !1) : e.attachEvent && e.attachEvent("on" + d, function () {
                    return t.call(e, window.event)
                }), o(e, t, n)
            }
        }
        function n() {
            window.sessionStorage && (sessionStorage.jksourceCode = jkcodeeditor.richeditor.getValue())
        }
        var d, s = document.getElementById("jktoolbar"),
            r = s.getElementsByTagName("a"),
            i = r[0],
            a = r[4],
            l = s.getElementsByTagName("select")[0],
            c = l.options[l.selectedIndex].value,
            u = document.getElementById("jktargetCode");
        return o(s, function (e) {
            var o = window.event ? event.srcElement : e.target;
            if ("A" == o.tagName) {
                if (-1 != o.href.indexOf("rowslayout")) classie.toggle(o, "selectedtool"), layoutkeyword = classie.has(o, "selectedtool") ? "rows" : "columns", jkresizemodule.editorlayouttoggle(layoutkeyword), "jkenabled" != jkcodeeditor.richeditor.className && jkcodeeditor.richeditor.resize();
                else if (-1 != o.href.indexOf("wrap")) classie.toggle(o, "selectedtool"), jkcodeeditor.richeditorsession.setUseWrapMode(classie.has(o, "selectedtool"));
                else if (-1 != o.href.indexOf("shownumbers")) classie.toggle(o, "selectedtool"), jkcodeeditor.richeditor.renderer.setShowGutter(classie.has(o, "selectedtool"));
                else if (-1 != o.href.indexOf("runcode")) t();
                else if (-1 != o.href.indexOf("copycode")) jkcodeeditor.copytoclipboard(e);
                else if (-1 != o.href.indexOf("newtab=1")) return n(), !0;
                e.preventDefault()
            }
        }, ["click"]), o(l, function (e) {
            c = this.options[this.selectedIndex].value, t()
        }, ["change"]), o(window, function (e) {
            var t = document.documentElement,
                o = window.innerWidth,
                n = t.className,
                d = 360 >= o ? "360orbelow" : 480 >= o ? "480orbelow" : 750 >= o ? "750orbelow" : "751orabove";
            "751orabove" == d ? -1 != n.indexOf("orbelow") && (t.className = n.replace(/\d+orbelow/, "")) : parseInt(d) != parseInt(n) && (-1 == n.indexOf("orbelow") ? classie.add(t, d) : t.className = n.replace(/\d+orbelow/, d))
        }, ["resize", "DOMContentLoaded", "load"]), "rows" == layoutkeyword && classie.add(i, "selectedtool"), loadricheditor || (r[1].style.display = r[2].style.display = "none", classie.add(document.documentElement, "ismobile")), {
            getautorunval: e,
            addEvent: o,
            jkruncode: t
        }
    }(),
    jkcodeeditor = function () {
        function e(e) {
            "ace" == e ? (ace.require("ace/ext/language_tools"), n = ace.edit(i), n.setOptions({
                enableBasicAutocompletion: !0,
                enableSnippets: !1,
                enableLiveAutocompletion: !0
            }), d = n.getSession(), d.setMode("ace/mode/html"), n.renderer.setShowGutter(!1), n.setShowPrintMargin(!1), n.setValue(a.value, - 1), s = i) : (i.style.display = "none", n = a, n.className = "jkenabled", n.getValue = function () {
                return this.value
            }, n.setValue = function (e) {
                this.value = e
            }, s = n)
        }
        function t(e) {
            a.value = n.getValue();
            var t = d ? i : a;
            fieldtoclipboard.copyfield(e, t)
        }
        function o(e) {
            function t(e) {
                return 10 > e ? "0" + e : e
            }
            return t(e.getHours()) + ":" + t(e.getMinutes())
        }
        var n, d, s, r, i = document.getElementById("jksourceCode"),
            a = document.getElementById("jkregulartextarea"),
            l = (document.getElementById("jktargetCode"), /newtab=1/i.test(location.search));
        return e(loadricheditor ? "ace" : "textarea"), jkglobals.addEvent(s, function (e) {
            var t = jkglobals.getautorunval();
            if (t > 0) {
                if ("keyup" == e.type && /13|17|16|18/.test(e.keyCode)) return;
                clearTimeout(r), r = setTimeout(function () {
                    jkglobals.jkruncode(!0)
                }, 1e3 * t)
            }
        }, ["change", "keyup", "paste", "cut"]), l && window.sessionStorage && sessionStorage.jksourceCode && (document.title = "" + o(new Date) + " JavaScript Kit", n.setValue(sessionStorage.jksourceCode, 1)), n.renderer && "rows" == layoutkeyword && (jkresizemodule.editorlayouttoggle(layoutkeyword), n.resize()), {
            richeditor: n,
            richeditorsession: d,
            copytoclipboard: t
        }
    }();
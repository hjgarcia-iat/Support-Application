!(function(e, t) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = t())
        : "function" == typeof define && define.amd
        ? define(t)
        : ((e = e || self).Alpine = t());
})(this, function() {
    "use strict";
    function e(e) {
        for (var t = e.concat(), i = 0; i < t.length; ++i)
            for (var n = i + 1; n < t.length; ++n)
                t[i] === t[n] && t.splice(n--, 1);
        return t;
    }
    function t() {
        return (
            navigator.userAgent.includes("Node.js") ||
            navigator.userAgent.includes("jsdom")
        );
    }
    function i(e, t, n = !0) {
        if (e.hasAttribute("x-data") && !n) return;
        t(e);
        let s = e.firstElementChild;
        for (; s; ) i(s, t, !1), (s = s.nextElementSibling);
    }
    function n(e, t, i = {}) {
        return new Function(
            ["$data", ...Object.keys(i)],
            `var result; with($data) { result = ${e} }; return result`
        )(t, ...Object.values(i));
    }
    function s(e, t, i = {}) {
        return new Function(
            ["dataContext", ...Object.keys(i)],
            `with(dataContext) { ${e} }`
        )(t, ...Object.values(i));
    }
    function a(e) {
        const t = o(e.name);
        return /x-(on|bind|data|text|html|model|if|show|cloak|transition|ref)/.test(
            t
        );
    }
    function r(e, t) {
        return Array.from(e.attributes)
            .filter(a)
            .map((e) => {
                const t = o(e.name),
                    i = t.match(
                        /x-(on|bind|data|text|html|model|if|show|cloak|transition|ref)/
                    ),
                    n = t.match(/:([a-zA-Z\-:]+)/),
                    s = t.match(/\.[^.\]]+(?=[^\]]*$)/g) || [];
                return {
                    type: i ? i[1] : null,
                    value: n ? n[1] : null,
                    modifiers: s.map((e) => e.replace(".", "")),
                    expression: e.value,
                };
            })
            .filter((e) => !t || e.type === t);
    }
    function o(e) {
        return e.startsWith("@")
            ? e.replace("@", "x-on:")
            : e.startsWith(":")
            ? e.replace(":", "x-bind:")
            : e;
    }
    function l(e, t, i = !1) {
        i && t();
        const n = r(e, "transition");
        n.length < 1 && t(),
            u(
                e,
                (
                    n.find((e) => "enter" === e.value) || { expression: "" }
                ).expression
                    .split(" ")
                    .filter((e) => "" !== e),
                (
                    n.find((e) => "enter-start" === e.value) || {
                        expression: "",
                    }
                ).expression
                    .split(" ")
                    .filter((e) => "" !== e),
                (
                    n.find((e) => "enter-end" === e.value) || { expression: "" }
                ).expression
                    .split(" ")
                    .filter((e) => "" !== e),
                t,
                () => {}
            );
    }
    function c(e, t, i = !1) {
        i && t();
        const n = r(e, "transition");
        n.length < 1 && t(),
            u(
                e,
                (
                    n.find((e) => "leave" === e.value) || { expression: "" }
                ).expression
                    .split(" ")
                    .filter((e) => "" !== e),
                (
                    n.find((e) => "leave-start" === e.value) || {
                        expression: "",
                    }
                ).expression
                    .split(" ")
                    .filter((e) => "" !== e),
                (
                    n.find((e) => "leave-end" === e.value) || { expression: "" }
                ).expression
                    .split(" ")
                    .filter((e) => "" !== e),
                () => {},
                t
            );
    }
    function u(e, t, i, n, s, a) {
        e.classList.add(...i),
            e.classList.add(...t),
            requestAnimationFrame(() => {
                const r =
                    1e3 *
                    Number(
                        getComputedStyle(e).transitionDuration.replace("s", "")
                    );
                s(),
                    requestAnimationFrame(() => {
                        e.classList.remove(...i),
                            e.classList.add(...n),
                            setTimeout(() => {
                                a(),
                                    e.isConnected &&
                                        (e.classList.remove(...t),
                                        e.classList.remove(...n));
                            }, r);
                    });
            });
    }
    class d {
        constructor(e) {
            this.$el = e;
            const t = this.$el.getAttribute("x-data"),
                i = "" === t ? "{}" : t,
                a = this.$el.getAttribute("x-init"),
                r = this.$el.getAttribute("x-created"),
                o = this.$el.getAttribute("x-mounted"),
                l = n(i, {});
            var c;
            (this.$data = this.wrapDataInObservable(l)),
                (l.$el = this.$el),
                (l.$refs = this.getRefsProxy()),
                (this.nextTickStack = []),
                (l.$nextTick = (e) => {
                    this.nextTickStack.push(e);
                }),
                a &&
                    ((this.pauseReactivity = !0),
                    (c = n(this.$el.getAttribute("x-init"), this.$data)),
                    (this.pauseReactivity = !1)),
                r &&
                    (console.warn(
                        'AlpineJS Warning: "x-created" is deprecated and will be removed in the next major version. Use "x-init" instead.'
                    ),
                    (this.pauseReactivity = !0),
                    s(this.$el.getAttribute("x-created"), this.$data),
                    (this.pauseReactivity = !1)),
                this.initializeElements(),
                this.listenForNewElementsToInitialize(),
                "function" == typeof c && c.call(this.$data),
                o &&
                    (console.warn(
                        'AlpineJS Warning: "x-mounted" is deprecated and will be removed in the next major version. Use "x-init" (with a callback return) for the same behavior.'
                    ),
                    s(o, this.$data));
        }
        wrapDataInObservable(e) {
            var t = this;
            const i = {
                set(e, i, n) {
                    const s = Reflect.set(e, i, n);
                    var a, r, o;
                    if (!t.pauseReactivity)
                        return (
                            ((a = () => {
                                for (t.refresh(); t.nextTickStack.length > 0; )
                                    t.nextTickStack.shift()();
                            }),
                            (r = 0),
                            function() {
                                var e = this,
                                    t = arguments,
                                    i = function() {
                                        (o = null), a.apply(e, t);
                                    };
                                clearTimeout(o), (o = setTimeout(i, r));
                            })(),
                            s
                        );
                },
                get: (e, t) =>
                    e[t] && e[t].isRefsProxy
                        ? e[t]
                        : e[t] && e[t] instanceof Node
                        ? e[t]
                        : "object" == typeof e[t] && null !== e[t]
                        ? new Proxy(e[t], i)
                        : e[t],
            };
            return new Proxy(e, i);
        }
        initializeElements() {
            i(this.$el, (e) => {
                this.initializeElement(e);
            });
        }
        initializeElement(e) {
            e.hasAttribute("class") &&
                r(e).length > 0 &&
                (e.__originalClasses = e.getAttribute("class").split(" ")),
                this.registerListeners(e),
                this.resolveBoundAttributes(e, !0);
        }
        registerListeners(e) {
            r(e).forEach(
                ({ type: t, value: i, modifiers: n, expression: s }) => {
                    switch (t) {
                        case "on":
                            var a = i;
                            this.registerListener(e, a, n, s);
                            break;
                        case "model":
                            a =
                                "select" === e.tagName.toLowerCase() ||
                                ["checkbox", "radio"].includes(e.type) ||
                                n.includes("lazy")
                                    ? "change"
                                    : "input";
                            const t = this.generateExpressionForXModelListener(
                                e,
                                n,
                                s
                            );
                            this.registerListener(e, a, n, t);
                    }
                }
            );
        }
        resolveBoundAttributes(e, t = !1) {
            r(e).forEach(
                ({ type: i, value: n, modifiers: s, expression: a }) => {
                    switch (i) {
                        case "model":
                            var r = "value",
                                o = this.evaluateReturnExpression(a);
                            this.updateAttributeValue(e, r, o);
                            break;
                        case "bind":
                            (r = n), (o = this.evaluateReturnExpression(a));
                            this.updateAttributeValue(e, r, o);
                            break;
                        case "text":
                            o = this.evaluateReturnExpression(a);
                            this.updateTextValue(e, o);
                            break;
                        case "html":
                            o = this.evaluateReturnExpression(a);
                            this.updateHtmlValue(e, o);
                            break;
                        case "show":
                            o = this.evaluateReturnExpression(a);
                            this.updateVisibility(e, o, t);
                            break;
                        case "if":
                            o = this.evaluateReturnExpression(a);
                            this.updatePresence(e, o);
                            break;
                        case "cloak":
                            e.removeAttribute("x-cloak");
                    }
                }
            );
        }
        listenForNewElementsToInitialize() {
            const e = this.$el;
            new MutationObserver((e) => {
                for (let t = 0; t < e.length; t++) {
                    if (!e[t].target.closest("[x-data]").isSameNode(this.$el))
                        return;
                    if (
                        "attributes" === e[t].type &&
                        "x-data" === e[t].attributeName
                    ) {
                        const i = n(e[t].target.getAttribute("x-data"), {});
                        Object.keys(i).forEach((e) => {
                            this.$data[e] !== i[e] && (this.$data[e] = i[e]);
                        });
                    }
                    e[t].addedNodes.length > 0 &&
                        e[t].addedNodes.forEach((e) => {
                            1 === e.nodeType &&
                                (e.matches("[x-data]") ||
                                    (r(e).length > 0 &&
                                        this.initializeElement(e)));
                        });
                }
            }).observe(e, { childList: !0, attributes: !0, subtree: !0 });
        }
        refresh() {
            i(this.$el, (e) => {
                this.resolveBoundAttributes(e);
            });
        }
        generateExpressionForXModelListener(e, t, i) {
            var n = "";
            return (
                (n =
                    "checkbox" === e.type
                        ? Array.isArray(this.$data[i])
                            ? `$event.target.checked ? ${i}.concat([$event.target.value]) : ${i}.filter(i => i !== $event.target.value)`
                            : "$event.target.checked"
                        : "select" === e.tagName.toLowerCase() && e.multiple
                        ? t.includes("number")
                            ? "Array.from($event.target.selectedOptions).map(option => { return parseFloat(option.value || option.text) })"
                            : "Array.from($event.target.selectedOptions).map(option => { return option.value || option.text })"
                        : t.includes("number")
                        ? "parseFloat($event.target.value)"
                        : t.includes("trim")
                        ? "$event.target.value.trim()"
                        : "$event.target.value"),
                "radio" === e.type &&
                    (e.hasAttribute("name") || e.setAttribute("name", i)),
                `${i} = ${n}`
            );
        }
        registerListener(e, t, i, n) {
            if (i.includes("away")) {
                const s = (a) => {
                    e.contains(a.target) ||
                        (e.offsetWidth < 1 && e.offsetHeight < 1) ||
                        (this.runListenerHandler(n, a),
                        i.includes("once") &&
                            document.removeEventListener(t, s));
                };
                document.addEventListener(t, s);
            } else {
                const s = i.includes("window")
                        ? window
                        : i.includes("document")
                        ? document
                        : e,
                    a = (e) => {
                        const r = i
                            .filter((e) => "window" !== e)
                            .filter((e) => "document" !== e);
                        ("keydown" === t &&
                            r.length > 0 &&
                            !r.includes(
                                (function(e) {
                                    switch (e) {
                                        case " ":
                                        case "Spacebar":
                                            return "space";
                                        default:
                                            return e
                                                .replace(
                                                    /([a-z])([A-Z])/g,
                                                    "$1-$2"
                                                )
                                                .replace(/[_\s]/, "-")
                                                .toLowerCase();
                                    }
                                })(e.key)
                            )) ||
                            (i.includes("prevent") && e.preventDefault(),
                            i.includes("stop") && e.stopPropagation(),
                            this.runListenerHandler(n, e),
                            i.includes("once") && s.removeEventListener(t, a));
                    };
                s.addEventListener(t, a);
            }
        }
        runListenerHandler(e, t) {
            this.evaluateCommandExpression(e, { $event: t });
        }
        evaluateReturnExpression(e) {
            return n(e, this.$data);
        }
        evaluateCommandExpression(e, t) {
            s(e, this.$data, t);
        }
        updateTextValue(e, t) {
            e.innerText = t;
        }
        updateHtmlValue(e, t) {
            e.innerHTML = t;
        }
        updateVisibility(e, t, i = !1) {
            t
                ? l(
                      e,
                      () => {
                          1 === e.style.length && "" !== e.style.display
                              ? e.removeAttribute("style")
                              : e.style.removeProperty("display");
                      },
                      i
                  )
                : c(
                      e,
                      () => {
                          e.style.display = "none";
                      },
                      i
                  );
        }
        updatePresence(e, t) {
            "template" !== e.nodeName.toLowerCase() &&
                console.warn(
                    "Alpine: [x-if] directive should only be added to <template> tags."
                );
            const i =
                e.nextElementSibling &&
                !0 === e.nextElementSibling.__x_inserted_me;
            if (t && !i) {
                const t = document.importNode(e.content, !0);
                e.parentElement.insertBefore(t, e.nextElementSibling),
                    (e.nextElementSibling.__x_inserted_me = !0),
                    l(e.nextElementSibling, () => {});
            } else
                !t &&
                    i &&
                    c(e.nextElementSibling, () => {
                        e.nextElementSibling.remove();
                    });
        }
        updateAttributeValue(t, i, n) {
            if ("value" === i)
                if ("radio" === t.type) t.checked = t.value == n;
                else if ("checkbox" === t.type)
                    if (Array.isArray(n)) {
                        let e = !1;
                        n.forEach((i) => {
                            i == t.value && (e = !0);
                        }),
                            (t.checked = e);
                    } else t.checked = !!n;
                else
                    "SELECT" === t.tagName
                        ? this.updateSelect(t, n)
                        : (t.value = n);
            else if ("class" === i)
                if (Array.isArray(n)) {
                    const i = t.__originalClasses || [];
                    t.setAttribute("class", e(i.concat(n)).join(" "));
                } else if ("object" == typeof n)
                    Object.keys(n).forEach((e) => {
                        n[e]
                            ? e.split(" ").forEach((e) => t.classList.add(e))
                            : e
                                  .split(" ")
                                  .forEach((e) => t.classList.remove(e));
                    });
                else {
                    const i = t.__originalClasses || [],
                        s = n.split(" ");
                    t.setAttribute("class", e(i.concat(s)).join(" "));
                }
            else
                [
                    "disabled",
                    "readonly",
                    "required",
                    "checked",
                    "hidden",
                ].includes(i)
                    ? n
                        ? t.setAttribute(i, "")
                        : t.removeAttribute(i)
                    : t.setAttribute(i, n);
        }
        updateSelect(e, t) {
            const i = [].concat(t).map((e) => e + "");
            Array.from(e.options).forEach((e) => {
                e.selected = i.includes(e.value || e.text);
            });
        }
        getRefsProxy() {
            var e = this;
            return new Proxy(
                {},
                {
                    get(t, n) {
                        return (
                            "isRefsProxy" === n ||
                            (i(e.$el, (e) => {
                                e.hasAttribute("x-ref") &&
                                    e.getAttribute("x-ref") === n &&
                                    (s = e);
                            }),
                            s)
                        );
                        var s;
                    },
                }
            );
        }
    }
    const h = {
        start: async function() {
            t() ||
                (await new Promise((e) => {
                    "loading" == document.readyState
                        ? document.addEventListener("DOMContentLoaded", e)
                        : e();
                })),
                this.discoverComponents((e) => {
                    this.initializeComponent(e);
                }),
                document.addEventListener("turbolinks:load", () => {
                    this.discoverUninitializedComponents((e) => {
                        this.initializeComponent(e);
                    });
                }),
                this.listenForNewUninitializedComponentsAtRunTime((e) => {
                    this.initializeComponent(e);
                });
        },
        discoverComponents: function(e) {
            document.querySelectorAll("[x-data]").forEach((t) => {
                e(t);
            });
        },
        discoverUninitializedComponents: function(e) {
            const t = document.querySelectorAll("[x-data]");
            Array.from(t)
                .filter((e) => void 0 === e.__x)
                .forEach((t) => {
                    e(t);
                });
        },
        listenForNewUninitializedComponentsAtRunTime: function(e) {
            const t = document.querySelector("body");
            new MutationObserver((t) => {
                for (let i = 0; i < t.length; i++)
                    t[i].addedNodes.length > 0 &&
                        t[i].addedNodes.forEach((t) => {
                            1 === t.nodeType && t.matches("[x-data]") && e(t);
                        });
            }).observe(t, { childList: !0, attributes: !0, subtree: !0 });
        },
        initializeComponent: function(e) {
            e.__x = new d(e);
        },
    };
    return t() || ((window.Alpine = h), window.Alpine.start()), h;
});
//# sourceMappingURL=alpine.js.map

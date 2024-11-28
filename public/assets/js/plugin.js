!(function () {
    "use strict";

    // local
    // var baseUrl = "http://127.0.0.1:8080/";

    // production
    var baseUrl = "https://cms.maxy.academy/";

    if (window.sessionStorage) {
        var t = sessionStorage.getItem("is_visited");
        if (t) {
            switch (t) {
                case "light-mode-switch":
                    document.documentElement.removeAttribute("dir");
                    updateStylesheet(
                        "bootstrap-style",
                        baseUrl + "jago-digital/assets/css/bootstrap.min.css"
                    );
                    updateStylesheet(
                        "app-style",
                        baseUrl + "jago-digital/assets/css/app.min.css"
                    );
                    document.documentElement.setAttribute(
                        "data-bs-theme",
                        "light"
                    );
                    break;
                case "dark-mode-switch":
                    document.documentElement.removeAttribute("dir");
                    updateStylesheet(
                        "bootstrap-style",
                        baseUrl + "jago-digital/assets/css/bootstrap.min.css"
                    );
                    updateStylesheet(
                        "app-style",
                        baseUrl + "jago-digital/assets/css/app.min.css"
                    );
                    document.documentElement.setAttribute(
                        "data-bs-theme",
                        "dark"
                    );
                    break;
                default:
                    console.log("Something wrong with the layout mode.");
            }
        }
    }

    function updateStylesheet(elementId, newHref) {
        var element = document.getElementById(elementId);
        if (element && element.getAttribute("href") !== newHref) {
            element.setAttribute("href", newHref);
        }
    }
})(window.jQuery);

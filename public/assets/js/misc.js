var ChartColor = [
    "#5D62B4",
    "#54C3BE",
    "#EF726F",
    "#F9C446",
    "rgb(93.0, 98.0, 180.0)",
    "#21B7EC",
    "#04BCCC",
];
var primaryColor = getComputedStyle(document.body).getPropertyValue(
    "--primary"
);
var secondaryColor = getComputedStyle(document.body).getPropertyValue(
    "--secondary"
);
var successColor = getComputedStyle(document.body).getPropertyValue(
    "--success"
);
var warningColor = getComputedStyle(document.body).getPropertyValue(
    "--warning"
);
var dangerColor = getComputedStyle(document.body).getPropertyValue("--danger");
var infoColor = getComputedStyle(document.body).getPropertyValue("--info");
var darkColor = getComputedStyle(document.body).getPropertyValue("--dark");
var lightColor = getComputedStyle(document.body).getPropertyValue("--light");

(function ($) {
    "use strict";
    $(function () {
        var body = $("body");
        var contentWrapper = $(".content-wrapper");
        var scroller = $(".container-scroller");
        var footer = $(".footer");
        var sidebar = $(".sidebar");

        //Add active class to nav-link based on url dynamically
        //Active class can be hard coded directly in html file also as required

        // Extract the current path from the URL and clean it up
        var current = location.pathname
            .split("/")
            .filter(function (e) {
                return e.length > 0;
            })
            .pop();

        // Function to add the "active" class
        function addActiveClass(element) {
            var href = element.attr("href");
            if (current === "") {
                // For root URL or home page
                if (href === "/") {
                    element.parents(".nav-item").last().addClass("active");
                    if (element.parents(".sub-menu").length) {
                        element.closest(".collapse").addClass("show");
                        element.addClass("active");
                    }
                }
            } else {
                // For other URLs
                if (
                    href.indexOf(current) !== -1 &&
                    (href === current || href.endsWith("/" + current))
                ) {
                    element.parents(".nav-item").last().addClass("active");
                    if (element.parents(".sub-menu").length) {
                        element.closest(".collapse").addClass("show");
                        element.addClass("active");
                    }
                    if (element.parents(".submenu-item").length) {
                        element.addClass("active");
                    }
                }
            }
        }

        // Loop through the sidebar menu and apply active class
        $(".nav li a", sidebar).each(function () {
            var $this = $(this);
            addActiveClass($this);
        });

        // Loop through the horizontal menu and apply active class
        $(".horizontal-menu .nav li a").each(function () {
            var $this = $(this);
            addActiveClass($this);
        });

        //Close other submenu in sidebar on opening any

        sidebar.on("show.bs.collapse", ".collapse", function () {
            sidebar.find(".collapse.show").collapse("hide");
        });

        //Change sidebar and content-wrapper height
        applyStyles();

        function applyStyles() {
            //Applying perfect scrollbar
            if (!body.hasClass("rtl")) {
                if (
                    $(".settings-panel .tab-content .tab-pane.scroll-wrapper")
                        .length
                ) {
                    const settingsPanelScroll = new PerfectScrollbar(
                        ".settings-panel .tab-content .tab-pane.scroll-wrapper"
                    );
                }
                if ($(".chats").length) {
                    const chatsScroll = new PerfectScrollbar(".chats");
                }
                if (body.hasClass("sidebar-fixed")) {
                    var fixedSidebarScroll = new PerfectScrollbar(
                        "#sidebar .nav"
                    );
                }
            }
        }

        $('[data-toggle="minimize"]').on("click", function () {
            if (
                body.hasClass("sidebar-toggle-display") ||
                body.hasClass("sidebar-absolute")
            ) {
                body.toggleClass("sidebar-hidden");
            } else {
                body.toggleClass("sidebar-icon-only");
            }
        });

        //checkbox and radios
        $(".form-check label,.form-radio label").append(
            '<i class="input-helper"></i>'
        );

        //fullscreen
        $("#fullscreen-button").on("click", function toggleFullScreen() {
            if (
                (document.fullScreenElement !== undefined &&
                    document.fullScreenElement === null) ||
                (document.msFullscreenElement !== undefined &&
                    document.msFullscreenElement === null) ||
                (document.mozFullScreen !== undefined &&
                    !document.mozFullScreen) ||
                (document.webkitIsFullScreen !== undefined &&
                    !document.webkitIsFullScreen)
            ) {
                if (document.documentElement.requestFullScreen) {
                    document.documentElement.requestFullScreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullScreen) {
                    document.documentElement.webkitRequestFullScreen(
                        Element.ALLOW_KEYBOARD_INPUT
                    );
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen();
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }
        });
    });
})(jQuery);

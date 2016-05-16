$.fn.slideable = function (options) {
    var data = $(this).data("slideable");
    if (data == undefined) {
        var optionsDefault = {
            axis: 'x',
            size: 1,
            speed: 300,
            nextSize: 1,
            tabNumber: true,
            margin:0
        }
        var options = $.extend({}, optionsDefault, options);
        data = new newSlideable($(this), options);
        $(this).data("slideable", data);
        return data;
    } else {
        return data;
    }
};
function newSlideable(root, options) {
    var oSelf = $(this);
    var oWrapContent = root;
    var oContent = $("<div class='content' />");
    var idRoot = root.attr('id');
    root.append(oContent.append($(root).children()));
    var oTab = $('.tab_' + idRoot);

    var listTab = $('a', oTab);

    var oNext = $('.next_' + idRoot);

    var oPrev = $('.prev_' + idRoot);

    var oItems = null;

    var sAxis = options.axis == 'x', sDirection = sAxis ? 'left' : 'top', sSize = sAxis ? 'Width'
			: 'Height';
    var nextSize = options.nextSize;
    var itemSize = 0;

    var indexItem = 0

    oWrapContent.css({
        'overflow': 'hidden',
        'position': 'relative'
    }); ;
    function initialize() {
        update();
        setEvent();
        return oSelf;
    }
    function update() {
        oItems = $('.item', oContent).not($('.item .item', oContent));
        var ow = oWrapContent.width();
        var oh = oWrapContent.height();
        var mr = options.margin * 2;
        if (sDirection == 'left') {
            itemSize = $(oItems[0]).outerWidth(true);
            oItems.css({ float: 'left', margin: options.margin + 'px', height: oh - mr, width: (ow / options.size) - mr });
        } else {
            itemSize = $(oItems[0]).outerHeight(true);
            oItems.css({ display: 'block', margin: options.margin + 'px', height: (oh / options.size) - mr, width: ow - mr });
        }

        if (sDirection == 'left') {
            itemSize = $(oItems[0]).outerWidth(true);

        } else {
            itemSize = $(oItems[0]).outerHeight(true);
        }


        if (oItems.size() <= options.size) {
            oNext.css('visibility', 'hidden');
            oPrev.css('visibility', 'hidden');
        } else {
            oNext.css('visibility', 'visible');
            oPrev.css('visibility', 'visible');
        }


        if (oContent[0] != null) {
            oContent.css(sDirection, 0);
            var sSizeWrapContent = itemSize * options.size;
            oItems.page = Math.ceil(oItems.size() / nextSize);
            oItems.page = oItems.page - Math.floor(options.size / nextSize);
            var css = {
                'position': 'absolute'
            };
            var sSizeContent = itemSize * oItems.size();
            css[sSize.toLowerCase()] = itemSize * oItems.size() + 'px';
            if (sSize.toLowerCase() == 'width') {
                css['height'] = $(oItems[0]).outerHeight(true) + 'px';

            } else {
                css['width'] = $(oItems[0]).outerWidth(true) + 'px';
            }
            oContent.css(css);
            oContent.nextmax = sSizeContent - sSizeWrapContent;
            oContent.next = 0;

            if ($(oTab).size() > 0) {
                $(oTab).html("");
                if (oItems.size() > 1) {
                    var s = oItems.page + 1;
                    for (var i = 0; i < s; i++) {
                        var temp = "";
                        if (options.tabNumber) {
                            temp = (i + 1) + "";
                        }
                        oTab.append("<a class='tabItem'>" + temp + "</a>");
                    }
                    listTab = $('a', oTab);
                    if (listTab.size() > 0) {
                        $(listTab.get(0)).addClass("tabItemSelect");
                    }
                }
            }
        }
    }

    oSelf.updateSlideable = function () {
        update();
        oSelf.run(indexItem);
    }

    function setEvent() {
        if ($(oTab).size() > 0) {
            oTab.on("click", "a", function () {
                indexItem = listTab.index(this);
                oSelf.run(indexItem);
            })
        } else {
            listTab.unbind("click");
        }
        if (options.size < oItems.size()) {
            oNext.click(function () {
                indexItem++;
                if (indexItem > oItems.page
						|| oContent.nextmax == oContent.next)
                    indexItem = 0
                oSelf.run(indexItem);
            });
            oPrev.click(function () {
                indexItem--;
                if (indexItem < 0 || oContent.next == 0)
                    indexItem = oItems.page;
                oSelf.run(indexItem);
            });
        }
    }

    oSelf.run = function (index) {

        if ($(oTab).size() > 0) {
            listTab.removeClass("tabItemSelect");
            $(listTab.get(index)).addClass("tabItemSelect");
        }
        oContent.next = Math.min(oContent.nextmax, (itemSize * nextSize)
					* (index));
        if (sDirection == 'left') {
            oContent.stop().animate({
                left: -oContent.next + 'px'
            }, options.speed);
        } else {
            oContent.stop().animate({
                top: -oContent.next + 'px'
            }, options.speed);
        }

    }

    return initialize();
}

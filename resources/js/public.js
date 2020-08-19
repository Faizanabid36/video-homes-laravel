try {
    window.axios = require('axios');
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('jquery-ui');

    require('bootstrap');
    require('bootstrap-select');
    require('mediaelement');

    $('#findaprobtn').click(function (e) {
        let form = $(this).parents('form');
        form.attr("action", form.attr("action") + "/" + form.find("option:selected").val()).submit();
        e.preventDefault();
    });
    $(".copylink").click(function (e) {
        document.querySelector("input.copylink").select();
        document.querySelector("input.copylink").setSelectionRange(0, 99999);
        document.execCommand("copy");
    });
    $(".copyembed").click(function (e) {
        document.querySelector("textarea.copyembed").select();
        document.querySelector("textarea.copyembed").setSelectionRange(0, 99999);
        document.execCommand("copy");
    });
    $("video").one("play", function (e) {
        axios.put(window.VIDEO_APP.video_url).then(({data}) => {
            console.log(data);
        })
    });
    $(".btn-share").click(function () {
        $(".btn-share").each(function (key, val) {
            $("." + $(val).attr("id")).addClass("d-none");
        });
        $("." + $(this).attr("id")).removeClass("d-none");
    });
    if ($('video').length) {
        let options = {
            autoplay: false,
            loop: false,
            startVolume: 1,
            alwaysShowControls: true,
            pluginPath: 'https://cdnjs.com/libraries/mediaelement-plugins/',
            shimScriptAccess: 'always',
            features: ['playpause', 'current', 'progress', 'duration', 'speed', 'skipback', 'jumpforward', 'tracks', 'markers', 'volume', 'chromecast', 'contextmenu', 'flash', 'fullscreen', 'quality'],
            vastAdTagUrl: '',
            vastAdsType: '',
            setDimensions: true,
            enableAutosize: true,
            jumpForwardInterval: 5,
            adsPrerollMediaUrl: [''],
            adsPrerollAdUrl: [''],
            adsPrerollAdEnableSkip: false,
            adsPrerollAdSkipSeconds: 0,
            success: function (media) {
                media.addEventListener('ended', function (e) {
                    if ($('#related_video').length && $('#related_video').find('a').attr('href')) {
                        window.location.href = $('#related_video').find('a').attr('href');
                    }
                }, false);
                media.addEventListener('loadedmetadata', function () {
                    $(".mejs__controls").before(`<img class='position-absolute watermark_logo' src='${window.VIDEO_APP.base_url}/img/cropped-VideoHomes-3.png'/>`)
                }, false);
            },
        };
        if (window.frameElement) {
            options.autoplay = !!window.frameElement.getAttribute('autoplay');
            options.loop = !!window.frameElement.getAttribute('loop');
            if (!!window.frameElement.getAttribute('mute')) {
                options.startVolume = 0;
            }
            if (options.autoplay && options.loop) {
                options.alwaysShowControls = false;
            }
        }
        $('video').mediaelementplayer(options);
    }
    $(".share-social").click(function (e) {
        openShareWindow($(this).data('url'));
    });

    function openShareWindow(url, w = 600, h = 600) {

        var screenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
        var screenTop = window.screenTop !== undefined ? window.screenTop : screen.top;
        var width = window.innerWidth ? window.innerWidth : doc.documentElement.clientWidth ? doc.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : doc.documentElement.clientHeight ? doc.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + screenLeft;
        var top = ((height / 2) - (h / 2)) + screenTop;

        var newWin = window.open(url, "", "scrollbars=no,width=" + w + ",height=" + h + ",top=" + top + ",left=" + left);

        if (newWin) {
            newWin.focus();
        }
    }

    if ($('.tinymce').length) {
        tinymce.init({
            selector: '.tinymce',
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
        });
    }
    let stars = $("#review .fa-star");
    if(stars.length){
        stars.removeClass("text-warning").eq($("input[name=rating]").val()).prevAll().addClass("text-warning")
        stars.mouseenter(function(e){
            stars.removeClass("text-warning");
            $(this).addClass("text-warning").prevAll().addClass("text-warning");
        }).mouseleave(function() {
            stars.removeClass("text-warning").eq($("input[name=rating]").val()).prevAll().addClass("text-warning")
        }).click(function(e){
            $("input[name=rating]").val($(this).data('value'));
        });
    }
} catch (e) {
}

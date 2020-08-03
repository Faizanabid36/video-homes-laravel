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
        })
        $("." + $(this).attr("id")).removeClass("d-none");
    });
    if($('#my-video_html5').length){
        $('#my-video_html5').mediaelementplayer({
            pluginPath: 'https://cdnjs.com/libraries/mediaelement-plugins/',
            shimScriptAccess: 'always',
            autoplay: true,
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
                    if ($('#related_video').length) {
                        var url = $('#related_video').find('a').attr('href');
                        if (url) {
                            window.location.href = url;
                        }
                    } else {
                        /* pass */
                    }
                }, false);


            },
        });
    }

} catch (e) {
}

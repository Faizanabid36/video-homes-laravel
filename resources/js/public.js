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
    })
} catch (e) {
}

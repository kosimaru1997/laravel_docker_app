$(function() {
    $('#preview').on('click',function() {
        var text = $('#md-textarea').val()
        $.ajax({
            url: '/api/preview',
            type: 'GET',
            data: {'text': text}
        }).then(
        function (data) {
            html = data.html;
            $("#preview-area").html(`<div class="min-height border bg-white p-3">${html}</div>`);
            $("#preview-area").removeClass('d-none');
            $("#md-textarea").addClass('d-none');
            $('#preview').addClass('bg-white events-none');
            $('#preview').removeClass('events-auto');
            $('#markdown').removeClass('bg-white events-none');
            $('#markdown').addClass('bg-light-grey events-auto');
        });
    });
});

$(function() {
    $('#markdown').on('click',function() {
        $("#preview-area").addClass('d-none');
        $("#md-textarea").removeClass('d-none');
        $('#preview').addClass('events-auto');
        $('#preview').removeClass('bg-white');
        $('#markdown').addClass('bg-white events-none');
        $('#markdown').removeClass('events-auto');
    });
});

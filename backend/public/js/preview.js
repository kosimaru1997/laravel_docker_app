$(function() {
    $('#preview').on('click',function() {
      var text = $('#md-textarea').val()
      $.ajax({
        url: '/api/preview',
        type: 'GET',
        dataType: 'script',
        data: { body: text }
      });
    });
  });

  $(function() {
    $('#markdown').on('click',function() {
      $("#preview-area").addClass('d-none');
      $("#md-textarea").removeClass('d-none');
      $('#preview').addClass('bg-light-grey events-auto');
      $('#preview').removeClass('bg-white');
      $('#markdown').addClass('bg-white events-none');
      $('#markdown').removeClass('events-auto');
    });
  });

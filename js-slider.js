$('#time_slider_min').change(function() {
    var min = $(this).val();
    var max = $('#time_slider_max').val();
    
    if(min > max) {
      $('#time_slider_max').val(min); 
    }
});

$('#time_slider_max').change(function() {
    var min = $('#time_slider_min').val();
    var max = $(this).val();
    
    if(min > max) {
      $('#time_slider_min').val(max);  
    }
});


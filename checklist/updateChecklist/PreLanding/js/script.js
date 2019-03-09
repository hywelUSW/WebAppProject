$('#getLandingTime').click(function(){
    var time = moment().format('YYYY-MM-DDThh:mm');
    $("input[type='datetime-local']").val(time); 
});
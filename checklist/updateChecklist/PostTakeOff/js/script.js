$('#getTakeOffTime').click(function(){
    var time = moment().format('YYYY-MM-DDThh:mm:ss');
    $("input[type='datetime-local']").val(time);  
})
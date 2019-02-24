$('#getTakeOffTime').click(function(){
    //var currentDate = new Date();
    //var preparedDate = currentDate.getFullYear()+"-"+0+currentDate.getUTCMonth()+"-"+currentDate.getDate()+"T"+currentDate.getUTCHours()+":"+currentDate.getMinutes()+":"+currentDate.getSeconds();
   // var DateFormat = "yyyyMMdHHmmss";
    //var date = Date.Now.ToString(DateFormat);
    
    alert($.datepicker.formatDate('dd M yy', new Date()));
   $('input').val(preparedDate);
   //alert("test");
})
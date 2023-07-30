function show() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('btn1').classList.toggle('active');
  }
  $("#sidebar").height($("#content").height());
  $('#area').change(()=>
  {
    if($('#area').val().length>=50)
    {
      $('#p0').text("Character limit is Exhausted");
      $('#p0').css('color','red');
      $('$area').css(' pointer-events','none');
    }
    else if ($('#area').val().length<50)
    {
      $('#p0').text(`You can still add ${100-$('#area').val().length} number of Characters`);
      $('#p0').css('color','green');
    }
  })
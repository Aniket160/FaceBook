//  if(document.cookie!='')
//  {
//   console.log(document.cookie);
//      var info=document.cookie.split('%20');
//      var info1=info[0].split('=')[1];
//      info.shift();
//     var last=info[info.length-1].split(';')[0]
//     info.pop();
//      console.log(info);
//      var str=info1+" ";
//      info.forEach((ele)=>
//      {
//       str+=ele+" ";
//      }
//      )
//      str+=last;
//     $('#p13').text(str);
//     var name='logout';
//     document.cookie = `${name}=; Path=/; Expires=${new Date(0).toUTCString}`;
//  }
$('#user').blur(()=>
{
  if($('#user').val()=='')
     {
      $('#p1').removeClass("no");
      $('#user').removeClass('success');
      $('#p1').text("Please enter the Username");
      $('#p1').css('color','red');
      $('#user').addClass('Error');
    }
    else
    {
      $('#p1').addClass("no");
      $('#user').removeClass('Error');
      $('#user').addClass('success');
    }
})

$('#password').blur(()=>
{
  if($('#password').val()=='')
     {
      $('#p2').removeClass("no");
      $('#password').removeClass('success');
      $('#p2').text("Please enter the Username");
      $('#p2').css('color','red');
      $('#password').addClass('Error');
    }
    else
    {
      $('#p2').addClass("no");
      $('#password').removeClass('Error');
      $('#password').addClass('success');
    }
})

var response;

function valid()
{

  var user=document.getElementById("user").value;
var password=document.getElementById("password").value;
  var istrue=false;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                  if(this.responseText.length!=0){
                    // console.log(this.responseText);
                    var element=JSON.parse(this.responseText);
                    if(element.length==1 && element[0]=='admin')
                    {
                        window.location.href = "http://localhost/facebook/template/admin.php";
                    }
                    else if(element!='')
                   {
                  document.getElementById("p0").innerHTML =element;
                  document.getElementById("p0").style.color = "red"; 
                  istrue=false;
                   }
                   else
                   {
                      istrue=true;
                    // window.location.href = "http://localhost/10 feb/template/validate.php";
                   }      
                  }
                  else
                  {
                               istrue=true;
                  }
                }
         }; 
        //  xhttp.open("GET", "http://localhost/facebookwork1/validate.php", true); 
         xhttp.open("POST", "http://localhost/facebook/template/validate.php", false);
         xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xhttp.send(`username=${user}&password=${password}`);  
        //   xhttp.send(); 
        return istrue;
        } 

// $('#form1').submit(()=>
// {

//   $.ajax({
//       type:"POST",
//       url:'http://localhost/10 feb/validate.php',
//       data:
//           {
//           'username' : $('#user').val(),
//             'password': $('#password').val()
//           } ,
//           async:false,
//         success:function(result)
//         {
//          response=result;
//         }
//       });

//       alert(response);
//       if(response.length==0)
//        {
//         // event.preventDefault();
//         return ;
//        }
//        else
//        {
//         $('#p0').removeClass("no");
//         $('#p0').text(response);
//         $('#p0').css('color','red');
//         // event.preventDefault();
//         return ;

//        }
// })
    //  window.location.href="http://localhost/10 feb/profile.php"


//     if($('#password').val()=='')
//    {
//     istrue=false;
//       $('#p2').text("Please enter the Password");
//       $('#p2').css('color','red');
//     $('#password').addClass('Error');
//      } 
//    if($('#user').val()!='')
//    {
//         $('#user').addClass('success');
//         $('#p1').addClass("no");
//    }
//    if($('#password').val()!='')
//    {
//         $('#password').addClass('success');
//         $('#p2').addClass("no");
//    }
//    $.ajax({
//     type:"POST",
//     url:'http://localhost/10 feb/validate.php',
//     data:
//    {
//          'username' : $('#user').val(),
//           'password': $('#password').val()
//     },
//      success:function(result)
//     {
//       console.log(result);
//       $('#p0').text(result);
//       $('#p0').css('color','red');
//       istrue=false;
//     },
//     async:false
//   });
//   if(istrue)
//   {
//     return ;
//   }
//   else
//   {
//     event.preventDefault();
//   }

//   });
// })

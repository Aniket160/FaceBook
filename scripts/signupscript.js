var istrue1=true;
var istrue2=true;
var istrue3=true;
var istrue4=true;
var istrue5=true;
var istrue6=true;
var istrue7=true;
var istrue8=false;
var istrue9=false;
var istrue10=false;
var arr=[];
//     $('#firstname').blur(()=>
//     {
//       if($('#firstname').val()=='')
//          {
//           istrue1=false;
//           $('#p1').removeClass("no");
//           $('#firstname').addClass("error");
//           $('#p1').text("Please Enter your First Name");
//           $('#p1').css("color","red");
//         }
//         else if((/\D*/).exec($('#firstname').val())==$('#firstname').val())
//         {
//           istrue1=true;
//           $('#firstname').addClass("success");
//           $('#p1').addClass("no");
//         }
//         else
//         {
//           istrue1=false;
//           $('#p1').removeClass("no");
//           $('#firstname').removeClass("success");
//           $('#firstname').addClass("error");
//           $('#p1').text("Invalid First Name");
//           $('#p1').css("color","red");
//         }
//     })
//     $('#lastname').blur(()=>
//     {
//         if($('#lastname').val()=='')
//         {
//           istrue2=false;
//           $('#p2').removeClass("no");
//           $('#lastname').addClass("error");
//           $('#p2').text("Please Enter Last Name");
//           $('#p2').css("color","red");
//         }
//         else if((/\D*/).exec($('#lastname').val())==$('#lastname').val())
//         {
//           istrue2=true;
//           $('#lastname').addClass("success");
//           $('#p2').addClass("no");
//         }
//         else
//         {
//           istrue2=false;
//           $('#p2').removeClass("no");
//           $('#lastname').removeClass("success");
//           $('#lastname').addClass("error");
//           $('#p2').text("Invalid Last Name");
//           $('#p2').css("color","red");
//         }
//     })

//     $('#age').blur(()=>
//     {
//         if($('#age').val()=='')
//         {
//           istrue3=false;
//           $('#p3').removeClass("no");
//           $('#age').addClass("error");
//           $('#p3').text("Please Enter your Age");
//           $('#p3').css("color","red");
//         }
//         else if((/[0-9]?[0-9]/).exec($('#age').val())==$('#age').val())
//         {
//           istrue3=true;
//             $('#age').addClass("success");
//             $('#p3').addClass("no");
//         }
//         else
//         {
//           istrue3=false;
//           $('#p3').removeClass("no");
//           $('#age').removeClass("success");
//           $('#age').addClass("error");
//           $('#p3').text("Invalid Age");
//           $('#p3').css("color","red");
//         }
//       })
//       $("input[type='radio'][name='gender']").blur(()=>
//       {
//         if($("input[type='radio'][name='gender']:checked").length<=0)
//         {
//             istrue4=false;
//             $('#p4').text("Please select your Gender");
//             $('#p4').css("color","red");
//         }
//         else
//         {
//           istrue4=true;
//           $('#p4').addClass("no");
//         }
//       })
//       $('#email').blur(()=>
//       {
//         if($('#email').val()=='')
//         {
//           istrue4=false;
//           $('#p5').removeClass("no");
//           $('#email').addClass("error");
//           $('#p5').text("Please Enter your Email");
//           $('#p5').css("color","red");
//         }
//         else if ((/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i).test($('#email').val())) 
//         {
//           istrue5=true;
//           $('#email').addClass("success");
//           $('#p5').addClass("no");
//         }
//         else
//         {
//           istrue5=false;
//           $('#p5').removeClass("no");
//           $('#email').removeClass("success");
//           $('#email').addClass("error");
//           $('#p5').text("Invalid Email");
//           $('#p5').css("color","red");
//         }
//       })

//       $('#mobile').blur(()=>
//       {
//         if($('#mobile').val()=='')
//         {
//           istrue6=false;
//           $('#p6').removeClass("no");
//           $('#mobile').addClass("error");
//           $('#p6').text("Please Enter your Mobile");
//           $('#p6').css("color","red");
//         }
//         else if(new RegExp(/^([+]\d{2})?\d{10}$/i).test($('#mobile').val()))
//         {
//           istrue6=true;
//           $('#mobile').addClass("success");
//           $('#p6').addClass("no");
//         }
//         else
//         {
//           istrue6=false;
//           $('#p6').removeClass("no");
//           $('#mobile').removeClass("success");
//           $('#mobile').addClass("error");
//           $('#p6').text("Invalid Mobile");
//           $('#p6').css("color","red");
//         }
//       })  
       
//       $('#user').blur(()=>
//       {
//         if($('#user').val()=='')
//         {
//           istrue7=false;
//           $('#p7').removeClass("no");
//           $('#user').addClass("error");
//           $('#p7').text("Please Enter your Username");
//           $('#p7').css("color","red");
//         }
//         else
//         {
//            $.ajax({
//              type:"POST",
//              url:'http://localhost/10 feb/username.php',
//              data:
//                 {    
//                   'username':$('#user').val(),
//                 },
//              success:function(result)
//              {
//               console.log(result);
//               if(result.length>0)
//               {
//                 istrue7=false;
//                 $('#p7').removeClass('no');
//                 $('#user').removeClass("success");
//                 $('#user').addClass("error");
//                 $('#p7').text(result);
//                 $('#p7').css('color','red');
//               }
//               else
//               {
//                 istrue7=true;
//                 $('#user').removeClass("error");
//                 $('#user').addClass("success");
//                 $('#p7').addClass('no');
//               } 
//             },
//             async:false
//              });
//         }
//       })
        
      $('#pincode').blur(()=>
      {
        if($('#pincode').val()=='')
        {
          istrue8=false;
          $('#p8').removeClass("no");
          $('#pincode').addClass("error");
          $('#p8').text("Please Enter your Pincode");
          $('#p8').css("color","red");
        }
        else if((/[0-9][0-9][0-9][0-9][0-9][0-9]$/i).test($('#pincode').val()))
        {
          istrue8=true;
          $('#pincode').addClass("success");
          $('#p8').addClass("no");
        }
        else
        {
          istrue8=false;
          $('#p8').removeClass("no");
          $('#pincode').removeClass("success");
          $('#pincode').addClass("error");
          $('#p8').text("Invalid Pincode");
          $('#p8').css("color","red");
        }
      })

      var P1=1;
      var p2=1;
      $('#password').blur(()=>
      {
        if($('#password').val()=='')
        {
          istrue9=false;
          P1=1;
          $('#p9').removeClass("no");
          $('#password').addClass("error");
          $('#p9').text("Please Enter your Password");
          $('#p9').css("color","red");
        }
        else
        {
          P1=2;
          istrue9=true;
          $('#password').addClass("success");
          $('#p9').addClass("no");
        }
      })

      $('#rpassword').blur(()=>
      {
        if($('#rpassword').val()=='')
        {
          P2=1;
          istrue10=false;
          $('#p10').removeClass("no");
          $('#rpassword').addClass("error");
          $('#p10').text("Please Enter Repeat Password");
          $('#p10').css("color","red");
        }
        else
        {
          P2=2;
          istrue10=true;
          $('#rpassword').addClass("success");
          $('#p10').addClass("no");
        }
      })
      

      $('#rpassword').blur(()=>
     {
      if(P1==2 && P2==2)
      {
        if($('#password').val()!='' && $('#rpassword').val()!='' && $('#password').val()!== $('#rpassword').val() )
         {
           istrue9=false;
           istrue10=false;
           $('#p10').removeClass("no");
           $('#p9').removeClass("no");
           $('#password').removeClass("success");
           $('#rpassword').removeClass("success");
           $('#password').addClass("error");
           $('#rpassword').addClass("error");
           $('#p10').text("Password and Repeat Password are not Matching");
           $('#p9').text("Password and Repeat Password are not Matching");
           $('#p10').css("color","red");
           $('#p9').css("color","red");
         }
       else if($('#password').val()!='' && $('#rpassword').val()!='' && $('#password').val()=== $('#rpassword').val() )
         {
           $('#p10').addClass("no");
           $('#p9').addClass("no");
           $('#password').addClass("success");
           $('#rpassword').addClass("success");
         }
      }
    })

    $('#password').blur(()=>
     {
      if(P1==2 && P2==2)
      {
        if($('#password').val()!='' && $('#rpassword').val()!='' && $('#password').val()!== $('#rpassword').val() )
         {
           istrue9=false;
           istrue10=false;
           $('#p10').removeClass("no");
           $('#p9').removeClass("no");
           $('#password').removeClass("success");
           $('#rpassword').removeClass("success");
           $('#password').addClass("error");
           $('#rpassword').addClass("error");
           $('#p10').text("Password and Repeat Password are not Matching");
           $('#p9').text("Password and Repeat Password are not Matching");
           $('#p10').css("color","red");
           $('#p9').css("color","red");
         }
       else if($('#password').val()!='' && $('#rpassword').val()!='' && $('#password').val()=== $('#rpassword').val() )
         {
           $('#p10').addClass("no");
           $('#p9').addClass("no");
           $('#password').addClass("success");
           $('#rpassword').addClass("success");
         }
      }
    })

    $('#form1').submit(()=>
    {
      $('#p0').addClass("no");
      var istrue=false;
      if(istrue1 &&istrue2 &&istrue3 &&istrue4 &&istrue5 &&istrue6 &&istrue7 &&istrue8 &&istrue9 &&istrue10)
      {
        $.ajax({
    type:"POST",
    url:'http://localhost/facebook/template/insert.php',
    data:
   {
         'firstname' : $('#firstname').val(),
          'lastname': $('#lastname').val(),
          'age': $('#age').val(),
          'gender':$("input[type='radio'][name='gender']:checked").val(),
          'email':$('#email').val(),
          'mobile':$('#mobile').val(),
          'username':$('#user').val(),
          'pincode':$('#pincode').val(),
          'password':$('#password').val(),
          'rpassword':$('#rpassword').val()

    },
     success:function(result)
    {
      console.log(result);
      if(result.length==0)
      {
        istrue=true;
        $('#p0').text("Successfully Added");
        $('#p0').removeClass("no");
        $('#p0').css('color','green');
        $('#link').removeClass('hide');
      }
      else
      {
        istrue=false;
        alert("Here");
        $('#p0').removeClass("no");
        $('#p0').text(result);
        $('#p0').css('color','red');
      }
    },
    async:false
      });
      }
      else
      {
       
          $('#p0').removeClass("no");
          $('#p0').text("Please Enter the valid Credentials");
        $('#p0').css('color','red');
        event.preventDefault();
      }
      // if(istrue)
      // {
      //   $('#firstname').val()='';
      //     $('#lastname').val()='';
      //     $('#age').val()='';
      //     $("input[type='radio'][name='gender']:checked").val()='';
      //     $('#email').val()='';
      //     $('#mobile').val()='';
      //     $('#user').val()='';
      //     $('#pincode').val()='',
      //     $('#password').val()='';
      //     $('#rpassword').val()='';
      // }
        if(istrue==true){
          event.preventDefault();
          
        }
        else
        {
        //   $('#p0').removeClass("no");
        //   $('#p0').text("Please Enter the valid Credentials");
        // $('#p0').css('color','red');
          event.preventDefault();
        }
      })
    
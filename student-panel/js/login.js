document.getElementById('loginForm').addEventListener('submit', logIn);
const btnLogIn = document.getElementById('btnLogin');// Button for login
btnLogIn.addEventListener('click', logIn);// when clicked
const alertPrompt = document.getElementById('alertLogin');// alert error
const btnChangeToLoadingS = document.getElementById('btnChangeToLoading');//loading button
const alertMSG = document.getElementById('alertMessage');

// HTTP REQUEST
function logIn(e){
    const studentid = document.getElementById('yourStudentid').value;
    const password = document.getElementById('yourPassword').value;
    
    e.preventDefault();

    let params = 
    "studentid="+studentid+
    "&password="+password;
    const xhr = new XMLHttpRequest();

    xhr.open('POST', '../controller/controller-login.php', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    console.log(params)

    //send
    xhr.send(params);

    xhr.onprogress = function (){
      alertPrompt.style.display = 'none';
      btnChangeToLoadingS.removeAttribute("hidden");
      btnLogIn.style.display = 'none';
    }//progress
    
   
xhr.onload = function (){//once loaded
  let getResult = JSON.parse(this.responseText);
      
setTimeout(delayedFunc, 1000);//Timer for loading
function delayedFunc(){   
      if(getResult.statusCode === 200){
            btnChangeToLoadingS.setAttribute("hidden", "hidden");
            location.reload();
      }else{          
          alertPrompt.style.display = 'inline-block';
          alertMSG.innerHTML = 'Wrong Student ID or Password';
          btnChangeToLoadingS.setAttribute("hidden", "hidden");
          btnLogIn.style.display = 'inline-block';
          console.log("Wrong credentials!");
      
     }//end of if status 200 
    
    }//end of delayedFunc
  } // end of onload 


}//end of login


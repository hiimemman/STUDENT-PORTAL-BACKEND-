window.onload = function(){
    getAllArchiveUser();
    getAllArchiveStudent();
}//Onload page


//get all archived user accounts
const getAllArchiveUser = async () =>{

try{
const getUserArchives = await fetch('../controller/user-archived-table.php');

const response = await getUserArchives.json();

totalUserArchives = response.length;

let output = '';

output += ``+response.length+``;

document.querySelector('#totalUserArchives').innerHTML = output;// print the 
}catch(error){
console.log(error)
    }
}


//get all archived students accounts
const getAllArchiveStudent = async () =>{

    try{
    const getUserArchives = await fetch('../controller/student-archived-table.php');
    
    const response = await getUserArchives.json();
    
    totalUserArchives = response.length;
    
    let output = '';
    
    output += ``+response.length+``;
    
    document.querySelector('#totalStudentArchives').innerHTML = output;// print the 
    }catch(error){
    console.log(error)
        }
    }
    
    


//GLOBAL VARIABLES USER = GVC
//Current number of rows
var GVCdefaultRow = 0;
//CurrentIndexPage global
var GVCIndexPage = 0;

//Get the total length of table
var GVCAccLength = 0;

//JSON global results variable
var GVCResults = {};

//JSON global result sorted variable
var GVCResultsSorted = {};

//Check if already sorted
var GVCIsSorted = false;
//Default number of row global
var GVCNumRows = 0;

//If the default row is less than 10
var GVCLessThanRow = 0;

//Get desired number of row per page
var GVCRowPerPage = 0;

//NextPage Call
const nextpageCall = function nextPageCall(){

    if(((GVCAccLength - GVCdefaultRow) < 10) && GVCLessThanRow === 0){
      console.log("LOL")
        GVCLessThanRow = GVCAccLength - GVCdefaultRow;
        GVCdefaultRow += GVCLessThanRow;
        bindAllDataIntoTable();
    }
    console.log("LMAo")
    console.log("next page GVCdefaultRow: "+GVCdefaultRow +" GVCAccLength:"+GVCAccLength+" GVCIndexPage:" +GVCIndexPage +" <= GVCRowPerPage:"+GVCRowPerPage);
    if(GVCdefaultRow < GVCAccLength ){
       
        GVCdefaultRow += GVCRowPerPage;
        console.log("next page GVCdefaultRow:"+GVCdefaultRow)
        GVCIndexPage +=GVCRowPerPage;
        bindAllDataIntoTable();
    }
}



//PrevPage Call
const prevpageCall = function nextPageCall(){
  
    // console.log('Less than row'+GVCLessThanRow);
    if(GVCLessThanRow !== 0){
    
        GVCdefaultRow = GVCdefaultRow - GVCLessThanRow;
        GVCLessThanRow = 0;
    }
    if(GVCIndexPage >= GVCRowPerPage){
        GVCdefaultRow -= GVCRowPerPage;
        GVCIndexPage -=GVCRowPerPage;
        bindAllDataIntoTable();
    }
   
}


//Pagination buttons
nextPage = document.getElementById('nextPage');
prevPage = document.getElementById('prevPage');
page1 = document.getElementById('page1');
page2 = document.getElementById('page2');
page3 = document.getElementById('page3');
showNumberOfPage = document.getElementById('showNumberOfPage');

//Select option
selectPage = document.getElementById('selectPage');

//Eventlistener for paginatio Buttons
nextPage.addEventListener('click', nextpageCall);
prevPage.addEventListener('click', prevpageCall);
// page1.addEventListener('click', getAllData());
// page2.addEventListener('click', getAllData());
// page3.addEventListener('click', getAllData());

//Search bar
userSearchBar = document.getElementById('userSearchBar');


//JavaScript create account admin
const btnCreateUsers = document.getElementById('btnCreateUsers');
const frmCreateUsers = document.getElementById('frmCreateUsers');//form create account
const btnIsLoading = document.getElementById('btnIsLoading');//LoadingButton
const alertShowError = document.getElementById('alertError');//AlertError
const alertShowSuccess = document.getElementById('alertSuccess');//Alert Success
const btnError = document.getElementById('btnError');//Error button disabled
const btnSuccess = document.getElementById('btnSuccess');//Succes button

//Javascript edit account admin
const btnEditError = document.getElementById('btnEditError');//Error button disabled
const btnEditSuccess = document.getElementById('btnEditSuccess');//Succes button
const btnIsUpdating = document.getElementById('btnIsUpdating');//updating button


window.onload = function(){
    getAllDataAPI();
    selectNumPage();
}//Onload page

//getAllData Function
function getAllDataAPI(){
    //get user accounts
    fetch('../controller/admin-subject.php').then((res) => res.json())
    .then(response => {

        GVCResults = response;//Store the responseJSON into GVCResults global var
       
        GVCAccLength = response.length;//getThe totalLength
        GVCNumRows = 5;//Set Number of rows default
        
        let selectHolder = '';
        if(GVCAccLength >= 500){
           
            selectHolder += `
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="ALL">All</option>`;
        }else if (GVCAccLength >= 300){
           
            selectHolder += `
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="ALL">All</option>`;
        }else if(GVCAccLength >= 25){
            
            selectHolder += `
            <option value="5" selected>5</option>
            <option value="10" selected>10</option>
            <option value="ALL">All</option>`;
        }else{
            selectHolder += `
            <option value="5" selected>5</option>
            <option value="ALL">All</option>`;
        }
        document.querySelector('#selectPage').innerHTML = selectHolder;// set the rows per page

        if(selectPage.value === '5'){
            GVCNumRows = 5;
            GVCRowPerPage = 5;
            GVCdefaultRow = 5;
        }else if (selectPage.value === '10'){
            GVCNumRows = 10;
            GVCRowPerPage = 10
            GVCdefaultRow = 10;
        }else if (selectPage.value === '25'){
            GVCNumRows = 25;
            GVCRowPerPage = 25;
            GVCdefaultRow = 25;
        }else{
            GVCNumRows = GVCAccLength;
            GVCRowPerPage = GVCAccLength;
            GVCdefaultRow = GVCAccLength;
        }// rows condition

        bindAllDataIntoTable();//Bind the data into table once fetch successfull
    }).catch(error => console.log(error));//end of get user accounts
}//end of function getAllDataAPI

const editProfilePic = async () =>{
    let value = document.getElementById('changePicUserID').value
    let fileupload = document.getElementById('editUserPic');// fileupload


    // Picking up files from the input .  .  .
    let files = fileupload.files;
   
    // Uploading only one file; multiple uploads are not allowed.
     let imageFile = files[0]; 
   
      // Create a FormData object.
     formData = new FormData();
   
     // Add the file to the request.
     formData.append('profileEdit', imageFile, imageFile.name);
     formData.append('userId', value);
   try{
   
   const fetchResponse = await fetch("../controller/move-only-image.php",{
       method: "POST",
       body:formData,
   });
   
   const receivedStatus = await fetchResponse.json();
   
   

   console.log(receivedStatus.statusCode)
   if(receivedStatus.statusCode === 200){
    let output = ''; 
    output += `<img src="../../uploads/${receivedStatus.image}" alt="Profile"style ="max-width:350px; max-height:350px;"/>
    `;
    document.querySelector('#changePicModalBody').innerHTML = output;
    
    let showBtn = '';
    showBtn += `<button type="button" id ="btnChangePic" class="btn btn-primary" onclick="saveChanges('`+value+`', '${receivedStatus.image}')">Save changes</button>
    <script>
    
    </script>
    `;
   document.querySelector('#showSave').innerHTML = showBtn;
   }
    

  
 
   
   }catch (e){
   console.log(e)
   }
  
}

const saveChanges = async (...params) =>{
    let btnChangePic = document.getElementById('btnChangePic');
        // Create a FormData object.
    imageformData = new FormData();
   
    imageformData.append('userId', params[0]);
    imageformData.append('Image_Url', params[1]);
    try{
       const fetchResponse = await fetch("../controller/user-edit-pic.php",{
           method: "POST",
           body:imageformData,
       });
       const receivedStatus = await fetchResponse.json();
       console.log(receivedStatus)
       if(receivedStatus.statusCode === 200){
         alertShowSuccess.removeAttribute("hidden");
         btnChangePic.setAttribute("disabled", "disabled");
          alertShowSuccess.classList.add('show');
        delayedRemoveAlert = () =>{   
            alertShowSuccess.classList.remove('show');  
            alertShowSuccess.setAttribute("hidden", "hidden");
        }
        setTimeout(delayedRemoveAlert, 3000);
      }
    }catch(e){
       console.log(e);
    }
  }

//Change Profile Picture Modal
const changePicModal =  (id) =>{
    let changePicUserID = document.getElementById('changePicUserID').value = id;
    console.log(id)
    let output = '';
    for(let i =0 ; i< GVCdefaultRow;i++ ){
        if(GVCResults[i].id == id){
            console.log("true")
            output += `<img src = "../../uploads/${GVCResults[i].profile_url} " alt="Profile" style="max-width:350px; max-height:350px;" "/>
            `;
            
            break;
        }
    }
    document.querySelector('#changePicModalBody').innerHTML = output;
}


const bindAllDataIntoTable = function (){   
    let output ='';

for(let i = GVCIndexPage; i<GVCdefaultRow; i++){
 console.log("GVCIndexPage: "+GVCIndexPage+"< GVCDefaultRow:" +GVCdefaultRow)
    output += `<tr>
    <td>${GVCResults[i].id}</td>
    <td><a href="#" onclick= "changePicModal(${GVCResults[i].id});return false;" data-bs-toggle="modal" data-bs-target="#changeProfileModal"><img src = "../../uploads/${GVCResults[i].profile_url}" alt="Profile" height = "100px" width = "100px"/></a></td>
    <td>${GVCResults[i].username}</td>
    <td>${GVCResults[i].firstname}</td>
    <td>${GVCResults[i].middlename}</td>
    <td>${GVCResults[i].lastname}</td>
    <td>${GVCResults[i].email}</td>
    <td>${GVCResults[i].birthday}</td>
    <td>${GVCResults[i].sex}</td>
    <td>${GVCResults[i].password}</td>
    <td>${GVCResults[i].position}</td>
    <td>${GVCResults[i].address}</td>
    <td>${GVCResults[i].contact}</td>
    <td>${GVCResults[i].about}</td>
    <td>${GVCResults[i].twitterprofile}</td>
    <td>${GVCResults[i].facebookprofile}</td>
    <td>${GVCResults[i].instagramprofile}</td>
    <td>${GVCResults[i].linkedinprofile}</td>
    <td>${GVCResults[i].added_at}</td>
    <th scope="col" class="table-info">
    <div class = "pt-2">
    <a href="#" class ="btn btn-primary btn-sm" title = "View" data-bs-toggle="modal" data-bs-target="#editusermodal" onclick ="editUserNotSorted(${GVCResults[i].id});return false;" ><i class="bi bi-eye"></i></a>

    <a href="#" class ="btn btn-danger btn-sm" title = "Archived"><i class="bi bi-trash"></i></a>
    
    </div>
    </th>
    </tr>`;
    
}

let numberOfPages = '';
numberOfPages += `<h8>Showing `+GVCdefaultRow+` out of `+GVCAccLength+` results</h8>`;
document.querySelector('#tbody-user-accounts').innerHTML = output;//print the data into the tbody
document.querySelector('#showNumberOfPage').innerHTML = numberOfPages;
}






//Sort the table
const sortCurrentTable = (headerTitle) =>{


    for(let i = 0; i<GVCNumRows; i++){
        GVCResultsSorted[i] = GVCResults[GVCIndexPage+i];
    }//Fill the GVCResultsSorted with GVCResults only needed

if(GVCIsSorted){
 
    for(let i = 0; i<GVCNumRows-1; i++){
        for(let j = 0; j<GVCNumRows-1; j++){
         if(GVCResultsSorted[j][headerTitle]> GVCResultsSorted[j+1][headerTitle]){
             // console.log("a = "+GVCResultsSorted[j].id+" > "+" b = "+GVCResultsSorted[j+1].id);
             let temp = GVCResultsSorted[j];
             GVCResultsSorted[j] = GVCResultsSorted[j+1];
             GVCResultsSorted[j+1] = temp;
      }
     }
   }
   GVCIsSorted = false;//after sorted then reverse sort
}else{
  
    for(let i = 0; i<GVCNumRows-1; i++){
        for(let j = 0; j<GVCNumRows-1; j++){
         if(GVCResultsSorted[j][headerTitle] < GVCResultsSorted[j+1][headerTitle]){
             // console.log("a = "+GVCResultsSorted[j].id+" > "+" b = "+GVCResultsSorted[j+1].id);
             let temp = GVCResultsSorted[j];
             GVCResultsSorted[j] = GVCResultsSorted[j+1];
             GVCResultsSorted[j+1] = temp;
      }
     }
   }
   GVCIsSorted = true;//after sorted then reverse sort
}
   

  
    bindAllDataIntoTableSorted();
}//Sort by id





//Bind the sorted table
const bindAllDataIntoTableSorted = function (){
    
    let output ='';
    
    for(let i = 0; i<GVCNumRows; i++){
        output += `<tr>
        <td>${GVCResultsSorted[i].id}</td>
        <td><a href =""><img src = "../../uploads/${GVCResultsSorted[i].profile_url} " alt="Profile" height = "100px" width = "100px"/></a></td>
        <td>${GVCResultsSorted[i].username}</td>
        <td>${GVCResultsSorted[i].firstname}</td>
        <td>${GVCResultsSorted[i].middlename}</td>
        <td>${GVCResultsSorted[i].lastname}</td>
        <td>${GVCResultsSorted[i].email}</td>
        <td>${GVCResultsSorted[i].birthday}</td>
        <td>${GVCResultsSorted[i].sex}</td>
        <td>${GVCResultsSorted[i].password}</td>
        <td>${GVCResultsSorted[i].position}</td>
        <td>${GVCResultsSorted[i].address}</td>
        <td>${GVCResultsSorted[i].contact}</td>
        <td>${GVCResultsSorted[i].about}</td>
        <td>${GVCResultsSorted[i].twitterprofile}</td>
        <td>${GVCResultsSorted[i].facebookprofile}</td>
        <td>${GVCResultsSorted[i].instagramprofile}</td>
        <td>${GVCResultsSorted[i].linkedinprofile}</td>
        <td>${GVCResultsSorted[i].added_at}</td>
        <th scope="col" class="table-info">
        <div class = "pt-2">
    <a href="#" class ="btn btn-primary btn-sm" title = "View" data-bs-toggle="modal" data-bs-target="#editusermodal" onclick ="editUserSorted(${GVCResultsSorted[i].id});return false;"><i class="bi bi-eye"></i></a>

    <a href="#" class ="btn btn-danger btn-sm" title = "Archived"><i class="bi bi-trash"></i></a>
    
    </div>
        </th>
        </tr>`;
    }
   
    let numberOfPages = '';
    numberOfPages += `<h8>Showing `+GVCdefaultRow+` out of `+GVCAccLength+` results</h8>`;
    document.querySelector('#tbody-user-accounts').innerHTML = output;//print the data into the tbody
    document.querySelector('#showNumberOfPage').innerHTML = numberOfPages;
}//Sorted Bind Table





//Select bind data

const selectNumPage = function(){
    GVCIsSorted = false;//Default the not sorted
    if(selectPage.value === '5'){
        GVCIndexPage = 0;
        GVCNumRows = 5;
        GVCRowPerPage = 5;
        GVCdefaultRow = 5;
    }else if(selectPage.value === '10'){
        console.log("10")
        GVCNumRows = 10;
        GVCIndexPage = 0;
        GVCRowPerPage = 10;
        GVCdefaultRow = 10;
    }else if(selectPage.value === '25'){
        console.log("25")
        GVCNumRows = 25;
        GVCIndexPage = 0;
        GVCRowPerPage = 25;
        GVCdefaultRow = 25;
    }else{

        GVCIndexPage = 0;
        GVCNumRows = GVCAccLength;
        GVCRowPerPage = GVCAccLength;
        GVCdefaultRow = GVCAccLength;
    }
    bindAllDataIntoTable();
}

//Search bar function
const userSearchKey = () =>{
let userSearch = userSearchBar.value;
console.log(userSearch !== "");
if(userSearch !== ""){
    let results = [];//Temporary JSON

    for(let i = 0; i<GVCResults.length;i++){
        for( key in GVCResults[i]){
            if(GVCResults[i][key].indexOf(userSearch) != -1){
                results.push(GVCResults[i]);
                break;
            }
        }
    }//Put all match results in results obj
    
    GVCNumRows = results.length;//set the value of numrows
    GVCResultsSorted = results;
    bindAllDataIntoTableSorted();
}else{
    bindAllDataIntoTable();
}

}




const btnEditUsers = document.getElementById('btnEditUsers');

const resetFields = () =>{
    let Fname = document.getElementById('newFname').value = "";

    let Mname = document.getElementById('newMname').value = "";
   
    let Lname = document.getElementById('newLname').value = "";

    let Email = document.getElementById('newEmail').value = "";
 
    let Username = document.getElementById('newUsername').value = "";

    let Password = document.getElementById('newPassword').value = "";
    
    let Job = document.getElementById('newJob').value = "";

    let Birthday = document.getElementById('newBirthday').value = "";

    let SexMale = document.getElementById('maleCheck').checked = false;

    let SexFemale = document.getElementById('femaleCheck').checked = false;
 
    let Contact = document.getElementById('newContact').value = "";

    let Address = document.getElementById('newAddress').value = "";
 
    let About = document.getElementById('newAbout').value = "";

    let Twitter = document.getElementById('newtwitterprofileURL').value = "";

    let Facebook = document.getElementById('newfacebookprofileURL').value = "";
 
    let Instagram = document.getElementById('newinstagramprofileURL').value = "";

    let Linkedin = document.getElementById('newlinkedinprofileURL').value = "";
    btnSuccess.setAttribute("hidden", "hidden");//Is loading true
    btnCreateUsers.removeAttribute("hidden");
}//Reset all the fields

//Call it to refresh the table
 refreshTable = () =>{
     GVCIndexPage = 0;
    resetFields();
    getAllDataAPI();
}


//Check all of the fields
const checkAllFields = () =>{
    let Fname = document.getElementById('newFname').value;

    let Mname = document.getElementById('newMname').value;
   
    let Lname = document.getElementById('newLname').value;

    let Email = document.getElementById('newEmail').value;
 
    let Username = document.getElementById('newUsername').value;

    let Password = document.getElementById('newPassword').value;
    
    let Job = document.getElementById('newJob').value;

    let Birthday = document.getElementById('newBirthday').value;
    
    let Sex ="";

    
    if(document.getElementById('maleCheck').checked === true){
        Sex = "Male";
    }
    if(document.getElementById('femaleCheck').checked === true){
        Sex = "Female";
    }

    

    let Contact = document.getElementById('newContact').value;

    let Address = document.getElementById('newAddress').value;
 
    let About = document.getElementById('newAbout').value;

    let Twitter = document.getElementById('newtwitterprofileURL').value;

    let Facebook = document.getElementById('newfacebookprofileURL').value;
 
    let Instagram = document.getElementById('newinstagramprofileURL').value;

    let Linkedin = document.getElementById('newlinkedinprofileURL').value;

    if(Fname !== "" && Mname !=="" && Lname !== "" && Email !== "" && Username !== "" && Password !== "" && Job !== "..." && Contact !== "" && Address !== "" && About !== "" && Twitter !== "" && Facebook !== "" && Instagram !== "" && Linkedin !== ""){
        createUserAccount();
    }else{
        alertShowError.classList.add('show');
        alertShowError.removeAttribute("hidden");
        btnError.removeAttribute("hidden");
        btnCreateUsers.style.display = "none";
        delayedAlert = () =>{
            alertShowError.classList.remove('show');
            alertShowError.setAttribute("hidden", "hidden");
            btnError.setAttribute("hidden", "hidden");//Is loading true
            btnCreateUsers.style.display = "inline-block";
        }
        setTimeout(delayedAlert, 3000);
    }
}



//Loading function for button
const IsLoadingTrue =(formStatus) =>{
    if(formStatus === true){
        IsLoadingTrue(false)//Start the loading button
    btnIsLoading.removeAttribute("hidden");//Is loading true
    btnIsUpdating.removeAttribute("hidden");//Is Updating true
    btnCreateUsers.style.display = "none";
    btnEditUsers.style.display = "none";
    }else{
    delayedStopLoading =() =>{
    btnIsLoading.setAttribute("hidden", "hidden");
    btnIsUpdating.setAttribute("hidden", "hidden");
    btnCreateUsers.style.display = "inline-block";
    btnEditUsers.style.display = "inline-block";
    }
    setTimeout(delayedStopLoading, 3000);
    }
   
}




//Create User
const createUserAccount = (e) =>{
    
    IsLoadingTrue(true)//Start the loading button
   
    let Fname = document.getElementById('newFname').value;

    let Mname = document.getElementById('newMname').value;
   
    let Lname = document.getElementById('newLname').value;

    let Email = document.getElementById('newEmail').value;
 
    let Username = document.getElementById('newUsername').value;

    let Password = document.getElementById('newPassword').value;
    
    let Job = document.getElementById('newJob').value;

    let Birthday = document.getElementById('newBirthday').value;

    let Sex ="";
    
    if(document.getElementById('maleCheck').checked === true){
        Sex = "Male";
    }
    if(document.getElementById('femaleCheck').checked === true){
        Sex = "Female";
    }

    let Contact = document.getElementById('newContact').value;

    let Address = document.getElementById('newAddress').value;
 
    let About = document.getElementById('newAbout').value;

    let Twitter = document.getElementById('newtwitterprofileURL').value;

    let Facebook = document.getElementById('newfacebookprofileURL').value;
 
    let Instagram = document.getElementById('newinstagramprofileURL').value;

    let Linkedin = document.getElementById('newlinkedinprofileURL').value;

    Twitter = "https://twitter.com/" + Twitter;
    Facebook = "https://Facebook.com/" + Facebook;
    Instagram = "https://Instagram.com/" + Instagram;
    Linkedin = "https://Linked.com/" + Linkedin;
formData = new FormData();
formData.append('Fname', Fname);
formData.append('Mname', Mname);
formData.append('Lname', Lname);
formData.append('Email', Email);
formData.append('Username', Username);
formData.append('Password', Password);
formData.append('Job', Job);
formData.append('Birthday', Birthday);
formData.append('Sex', Sex);
formData.append('Contact', Contact);
formData.append('Address', Address);
formData.append('About', About);
formData.append('Twitter', Twitter);
formData.append('Facebook', Facebook);
formData.append('Instagram', Instagram);
formData.append('Linkedin', Linkedin);
for (var pair of formData.entries()) {
    console.log(pair[0]+ ' - ' + pair[1]); 
 }


    fetch("../controller/user-create-account.php",{
        method: "POST",
        body:formData,
    })
    
    .then((res) => res.json())
        .then(response =>{
            console.log(response.statusCode)
          if(response.statusCode === 200){
            delayedShowAlert = () =>{
                btnCreateUsers.setAttribute("hidden", "hidden");
                alertShowSuccess.removeAttribute("hidden");
                alertShowSuccess.classList.add('show');
                btnSuccess.removeAttribute("hidden");
            }
            setTimeout(delayedShowAlert, 3000)
            delayedRemoveAlert = () =>{   
                
                alertShowSuccess.classList.remove('show');  
                alertShowSuccess.setAttribute("hidden", "hidden");
            }
            setTimeout(delayedRemoveAlert, 6000);
          }
            
        })
    .catch(err => console.log(err))

}

//Show picture
const showPicture = () =>{
let Image_Url = document.getElementById('editImage_Url').value;
let Photo = document.getElementById('currentPhoto').src = Image_Url;
}


//Edit User Data Not sorted
const editUserNotSorted = (a) =>{
    for(let i =0 ; i< GVCResults.length;i++ ){
        if(GVCResults[i].id == a){
           
         let UserId = document.getElementById('editId').value =  GVCResults[i].id;    

         let Fname = document.getElementById('editFname').value =  GVCResults[i].firstname;
        
         let Mname = document.getElementById('editMname').value =  GVCResults[i].middlename;
        
         let Lname = document.getElementById('editLname').value =  GVCResults[i].lastname;
     
         let Email = document.getElementById('editEmail').value=   GVCResults[i].email ;
      
         let Username = document.getElementById('editUsername').value =  GVCResults[i].username;
     
         let Password = document.getElementById('editPassword').value =  GVCResults[i].password;
         
         let Job = document.getElementById('editJob').value =    GVCResults[i].position;
     
         let Birthday = document.getElementById('editBirthday').value =  GVCResults[i].birthday;
         
         let Sex = GVCResults[i].sex;
      
         if(Sex === "Male"){
             document.getElementById('editmaleCheck').checked = true;
         }
         if(Sex === "Female"){
             document.getElementById('editfemaleCheck').checked = true;
         }
         let Contact = document.getElementById('editContact').value =    GVCResults[i].contact;
     
         let Address = document.getElementById('editAddress').value =    GVCResults[i].address;
      
         let About = document.getElementById('editAbout').value =    GVCResults[i].about;
      
         let Twitter = document.getElementById('edittwitterprofileURL').value =  GVCResults[i].twitterprofile;
     
         let Facebook = document.getElementById('editfacebookprofileURL').value =    GVCResults[i].facebookprofile;
      
         let Instagram = document.getElementById('editinstagramprofileURL').value =  GVCResults[i].instagramprofile;
     
         let Linkedin = document.getElementById('editlinkedinprofileURL').value =    GVCResults[i].linkedinprofile;
         break;
     }
    }
 }
 



//Edit User Data sorted

const editUserSorted = (a) =>{
    
    for(let i =0 ; i< GVCNumRows;i++ ){
        if(GVCResultsSorted[i].id == a){

         let UserId = document.getElementById('editId').value =  GVCResultsSorted[i].id;   
     
         let Fname = document.getElementById('editFname').value =  GVCResultsSorted[i].firstname;
 
         let Mname = document.getElementById('editMname').value =  GVCResultsSorted[i].middlename;
        
         let Lname = document.getElementById('editLname').value =  GVCResultsSorted[i].lastname;
     
         let Email = document.getElementById('editEmail').value =   GVCResultsSorted[i].email ;
      
         let Username = document.getElementById('editUsername').value =  GVCResultsSorted[i].username;
     
         let Password = document.getElementById('editPassword').value =  GVCResultsSorted[i].password;
         
         let Job = document.getElementById('editJob').value =    GVCResultsSorted[i].position;
     
         let Birthday = document.getElementById('editBirthday').value =  GVCResultsSorted[i].birthday;
         
         let Sex = GVCResultsSorted[i].sex;
         
         if(Sex === "Male"){
             document.getElementById('editmaleCheck').checked = true;
         }
         if(Sex === "Female"){
             document.getElementById('editfemaleCheck').checked = true;
         }
     
         let Contact = document.getElementById('editContact').value =    GVCResultsSorted[i].contact;
     
         let Address = document.getElementById('editAddress').value =    GVCResultsSorted[i].address;
      
         let About = document.getElementById('editAbout').value =    GVCResultsSorted[i].about;
      
         let Twitter = document.getElementById('edittwitterprofileURL').value =  GVCResultsSorted[i].twitterprofile;
     
         let Facebook = document.getElementById('editfacebookprofileURL').value =    GVCResultsSorted[i].facebookprofile;
      
         let Instagram = document.getElementById('editinstagramprofileURL').value =  GVCResultsSorted[i].instagramprofile;
     
         let Linkedin = document.getElementById('editlinkedinprofileURL').value =    GVCResultsSorted[i].linkedinprofile;
         break;
     }
    }
 }
 
 const checkEditFields = () =>{
     
    let UserId = document.getElementById('editId').value; 

    let Fname = document.getElementById('editFname').value  
 
    let Mname = document.getElementById('editMname').value  
   
    let Lname = document.getElementById('editLname').value  

    let Email = document.getElementById('editEmail').value  
 
    let Username = document.getElementById('editUsername').value    

    let Password = document.getElementById('editPassword').value    
    
    let Job = document.getElementById('editJob').value  

    let Birthday = document.getElementById('editBirthday').value    

    let Sex ="";

    if(document.getElementById('editmaleCheck').checked === true){
        Sex = "Male";
    }
    if(document.getElementById('editfemaleCheck').checked === true){
        Sex = "Female";
    }

    let Contact = document.getElementById('editContact').value

    let Address = document.getElementById('editAddress').value
 
    let About = document.getElementById('editAbout').value 

    let Twitter = document.getElementById('edittwitterprofileURL').value 

    let Facebook = document.getElementById('editfacebookprofileURL').value 
 
    let Instagram = document.getElementById('editinstagramprofileURL').value

    let Linkedin = document.getElementById('editlinkedinprofileURL').value 

    if(UserId !=="" && Fname !==  "" && Mname !==  "" && Lname !==  "" && Email !==  "" && Username !==  "" && Password !==  "" && Job !==  "" && Birthday !==  "" && Sex !==  "" && Contact !==  "" && Address !==  "" && About !==  "" && Twitter !==  "" && Facebook !==  "" && Instagram !==  "" &&Linkedin !==  "" ){
       
        updateUser();

    }else{
        alertShowError.classList.add('show');
        alertShowError.removeAttribute("hidden");
        btnEditError.removeAttribute("hidden");
        btnEditUsers.style.display = "none";
        delayedAlert = () =>{
            alertShowError.classList.remove('show');
            alertShowError.setAttribute("hidden", "hidden");
            btnEditError.setAttribute("hidden", "hidden");//Is loading true
            btnEditUsers.style.display = "inline-block";
        }
        setTimeout(delayedAlert, 3000);
    }
    
 }


const updateUser = async () =>{

    IsLoadingTrue(true)//Start the loading button

    let UserId = document.getElementById('editId').value;

    let Fname = document.getElementById('editFname').value  
 
    let Mname = document.getElementById('editMname').value  
   
    let Lname = document.getElementById('editLname').value  

    let Email = document.getElementById('editEmail').value  
 
    let Username = document.getElementById('editUsername').value    

    let Password = document.getElementById('editPassword').value    
    
    let Job = document.getElementById('editJob').value  

    let Birthday = document.getElementById('editBirthday').value    

    let Sex ="";

    if(document.getElementById('editmaleCheck').checked === true){
        Sex = "Male";
    }
    if(document.getElementById('editfemaleCheck').checked === true){
        Sex = "Female";
    }

    let Contact = document.getElementById('editContact').value

    let Address = document.getElementById('editAddress').value
 
    let About = document.getElementById('editAbout').value 

    let Twitter = document.getElementById('edittwitterprofileURL').value 

    let Facebook = document.getElementById('editfacebookprofileURL').value 
 
    let Instagram = document.getElementById('editinstagramprofileURL').value

    let Linkedin = document.getElementById('editlinkedinprofileURL').value 


    formData = new FormData();
formData.append('UserId', UserId);   
formData.append('Fname', Fname);
formData.append('Mname', Mname);
formData.append('Lname', Lname);
formData.append('Email', Email);
formData.append('Username', Username);
formData.append('Password', Password);
formData.append('Job', Job);
formData.append('Birthday', Birthday);
formData.append('Sex', Sex);
formData.append('Contact', Contact);
formData.append('Address', Address);
formData.append('About', About);
formData.append('Twitter', Twitter);
formData.append('Facebook', Facebook);
formData.append('Instagram', Instagram);
formData.append('Linkedin', Linkedin);
for (var pair of formData.entries()) {
    console.log(pair[0]+ ' - ' + pair[1]); 
 }

try{
  const fetchEdit = await fetch("../controller/user-edit.php",{
        method: "POST",
        body: formData,
    });


    //Javascript edit account admin
// const btnEditError = document.getElementById('btnEditError');//Error button disabled
// const btnEditSuccess = document.getElementById('btnEditSuccess');//Succes button
// const btnIsUpdating = document.getElementById('btnIsUpdating');//updating button
    const fetchResponse = await fetchEdit.json();
    
    const showAnimation = await function(){

        if(fetchResponse.statusCode === 200){
            console.log(fetchResponse)
            delayedShowAlert = () =>{
        
                alertShowSuccess.removeAttribute("hidden");
                alertShowSuccess.classList.add('show');
                
            }
            setTimeout(delayedShowAlert, 3000)
            delayedRemoveAlert = () =>{   
                alertShowSuccess.classList.remove('show');  
                alertShowSuccess.setAttribute("hidden", "hidden");
            }
            setTimeout(delayedRemoveAlert, 6000);
          }
        }
    
        showAnimation();
     
}catch (e){
    console.log(e)
}

}
//-------------------------------------REGISTRATION------------------------------------
// validate name
function ValidateName()
{
    inputText = document.getElementById("fname").value;
    var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
    if(inputText.match(regex))
    {
        document.getElementById("nameerr").innerHTML="";
        document.getElementById("subtn").disabled = false;
    }
    else
    {
        document.getElementById("nameerr").innerHTML="Invalid Name";
        document.getElementById("subtn").disabled = true;
    }
}

//validate age
function CalculateAge(){
    var bdate =new Date(document.getElementById("dob").value);
    var today = new Date();
    var timeDiff = Math.abs(today.getTime() - bdate.getTime());  //getTime() - millisec
    var age1 = Math.ceil(timeDiff / (1000 * 3600 * 24)) / 365;
    var age = Math.floor(age1);
    document.getElementById("age").value=age;
    if(age>13){
        document.getElementById("ageerr").innerHTML="";
        document.getElementById("subtn").disabled = false;
    }
    else{
        document.getElementById("ageerr").innerHTML="Minimum age required is 13";
        document.getElementById("subtn").disabled = true;
    }
}

// validate email
function ValidateEmail()
{
    inputText = document.getElementById("email").value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.match(mailformat))
    {
        document.getElementById("emailerr").innerHTML="";
        document.getElementById("subtn").disabled = false;
    }
    else
    {
        document.getElementById("emailerr").innerHTML="Invalid email address";
        document.getElementById("subtn").disabled = true;
    }
}


// to validate password
function check(){
    var reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&])[A-Za-z0-9!@$%*#?&]{6,16}$/; //(?=.*[]) - atleast one
    var pwd = document.getElementById("pass").value;
    if(pwd.match(reg)){
        document.getElementById("perr").innerHTML="";
        document.getElementById("subtn").disabled = false;
    }
    else{
        if(pwd.length<6 || pwd.length>16){
            document.getElementById("perr").innerHTML="Password should be between 6-16 characters";
            document.getElementById("subtn").disabled = true;
        }
        else{
        document.getElementById("perr").innerHTML="Password should have atleast one captial letter, small letter, number and special character";
        document.getElementById("subtn").disabled = true;
        }
    }

}

// to confirm password
function checkup(){
    var pwd = document.getElementById("pass").value;
    var copass = document.getElementById("conpass").value;
    if(pwd==copass){
        document.getElementById("subtn").disabled = false;
        document.getElementById("errmsg").innerHTML="";
    }
    else{
        document.getElementById("errmsg").innerHTML="Passwords not matching";
        document.getElementById("subtn").disabled = true;
    }
}

//-------------------------------------ADD BOOK ------------------------------------
function fileValidation(){
    var _validFileExtensions = [".jpg", ".jpeg", ".png"];  
    var fileInput = document.getElementById('cp');
    var filePath = fileInput.value;
    // var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (filePath.length > 0) {
        var flValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
            var sCurExtension = _validFileExtensions[j];
            if (filePath.substr(filePath.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                flValid = true;
                document.getElementById("errcp").innerHTML="";
                break;
            }
        
        }
        if(!flValid){
            document.getElementById("errcp").innerHTML='Please upload file having extensions .jpeg/.jpg/.png only.';
            fileInput.value = '';
            document.getElementById("addbook").disabled = true;
        }
    }
}
// validate Title
function ValidateTitle()
{
    inputText = document.getElementById("title").value;
    var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
    if(inputText.match(regex))
    {
        document.getElementById("titleerr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("titleerr").innerHTML="Invalid Name";
        document.getElementById("addbook").disabled = true;
    }
}

// validate Author
function ValidateAuthor()
{
    inputText = document.getElementById("author").value;
    var regex =/^[^-\s][a-zA-Z ]{2,30}$/;
    if(inputText.match(regex))
    {
        document.getElementById("autherr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("autherr").innerHTML="Invalid Name";
        document.getElementById("addbook").disabled = true;
    }
}
// validate Genre
function ValidateGenre()
{
    inputText = document.getElementById("genre").value;
    var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
    if(inputText.match(regex))
    {
        document.getElementById("generr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("generr").innerHTML="Invalid Name";
        document.getElementById("addbook").disabled = true;
    }
}
// validate Publisher
function ValidatePub()
{
    inputText = document.getElementById("publisher").value;
    var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
    if(inputText.match(regex))
    {
        document.getElementById("puberr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("puberr").innerHTML="Invalid Name";
        document.getElementById("addbook").disabled = true;
    }
}
//validate Language
function ValidateLang()
{
    inputText = document.getElementById("lang").value;
    var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
    if(inputText.match(regex))
    {
        document.getElementById("errlang").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("errlang").innerHTML="Enter correct language";
        document.getElementById("addbook").disabled = true;
    }
}

//validate ISBN
function ValidateISBN()
{
    inputText = document.getElementById("ISBN").value;
    var regex = /^[^-\s][1-9][0-9]{11}/;
    if(inputText.match(regex))
    {
        document.getElementById("isbnerr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("isbnerr").innerHTML="Invalid ISBN Number";
        document.getElementById("addbook").disabled = true;
    }
}

function ValidateHardcover(){
    inputText = document.getElementById("Hardcover").value;
    var regex = /^[(0-9)+.?(0-9)*]{1,4}$/
    if(inputText.match(regex))
    {
        document.getElementById("harderr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("harderr").innerHTML="Invalid Price";
        document.getElementById("addbook").disabled = true;
    }
}

function ValidatePaperback(){
    inputText = document.getElementById("Paperback").value;
    var regex = /^[(0-9)+.?(0-9)*]{1,4}$/
    if(inputText.match(regex))
    {
        document.getElementById("paperr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("paperr").innerHTML="Invalid Price";
        document.getElementById("addbook").disabled = true;
    }
}

function ValidateEbook(){
    inputText = document.getElementById("Ebook").value;
    var regex = /^[(0-9)+.?(0-9)*]{1,4}$/
    if(inputText.match(regex))
    {
        document.getElementById("ebookerr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("ebookerr").innerHTML="Invalid Price";
        document.getElementById("addbook").disabled = true;
    }
}

function ValidateDiscountHardcover(){
    inputText = document.getElementById("DiscountHardcover").value;
    var regex = /^[(0-9)+.?(0-9)*]{1,2}$/
    if(inputText.match(regex))
    {
        document.getElementById("disharderr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("disharderr").innerHTML="Invalid Price";
        document.getElementById("addbook").disabled = true;
    }
}

function ValidateDiscountPaperback(){
    inputText = document.getElementById("DiscountPaperback").value;
    var regex = /^[(0-9)+.?(0-9)*]{1,2}$/
    if(inputText.match(regex))
    {
        document.getElementById("dispaperr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("dispaperr").innerHTML="Invalid Price";
        document.getElementById("addbook").disabled = true;
    }
}

function ValidateDiscountEbook(){
    inputText = document.getElementById("DiscountEbook").value;
    var regex = /^[(0-9)+.?(0-9)*]{1,2}$/
    if(inputText.match(regex))
    {
        document.getElementById("disebookerr").innerHTML="";
        document.getElementById("addbook").disabled = false;
    }
    else
    {
        document.getElementById("disebookerr").innerHTML="Invalid Price";
        document.getElementById("addbook").disabled = true;
    }
}
/*Get the classes of an Element*/
function getClasses(elem) {
    var className = elem.className.split(" ");
	var arrayNames = new Array();
	for (var i = 0; i < className.length; i++) {
		arrayNames[i] = "\""+className[i]+"\"";
	}
	//For testing
    //alert("["+arrayNames+"]");
	return arrayNames;
}


function addClass(elem, className) {
    /*If element has the class attribute, else add it along with the value*/
    if (elem.hasAttribute("class")) {
		elem.className += " "+className;
        //For testing
        //var foo = elem.className.split(" ");
        //alert("["+foo+"]");
    }
    else { //IF class attribute doesn't exist
        elem.setAttribute("class",className);
        //For testing
        //var foo = elem.className.split(" ");
       //alert("["+foo+"]");
    }
    
}

function validateForm()
{
	//BOOLEAN VARIABLES IF ERRORS EXIST//
    var myBoolean = false; //initially false for no Errors
    var userBoolean = false; 
    var emailBoolean = false;
    var passBoolean = false;
    var confirmBoolean = false;
    /*FOR USER NAME*/
    var userName=document.forms["myForm"]["name"].value;
    /*FOR USER EMAIL*/
    var userEmail=document.forms["myForm"]["email"].value;
    var atpos=userEmail.indexOf("@");
    var dotpos=userEmail.lastIndexOf(".");
    /*FOR PASSWORD*/
    var userPassword=document.forms["myForm"]["password"].value;
    var confirmPassword=document.forms["myForm"]["confirm"].value;
    
    /*Check For ERRORS*/
	//Checks if userName has ERRORS
    if (userName==null || userName=="") {
      document.forms["myForm"]["name"].style.background = "red";
      myBoolean = true;
      userBoolean = true; //set true if value is null or empty
    }
	else { //Sets the input field back to white
		document.forms["myForm"]["name"].style.background = "white";
	}
	//Checks if Email is valid, must be in the form of *@*.*
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=userEmail.length) {
      document.forms["myForm"]["email"].style.background = "red";
     myBoolean = true;
     emailBoolean = true;
    }
	else { //Sets the input field back to white
		document.forms["myForm"]["email"].style.background = "white";
	}
    //Checks if Password has ERRORS
    if (userPassword==null || userPassword=="") {
      document.forms["myForm"]["password"].style.background = "red";
      myBoolean = true;
      passBoolean = true;
    }
	else { //Sets the input field back to white
		document.forms["myForm"]["password"].style.background = "white";
	}
	//Checks if Confirmation Passwords has ERRORS
    if (userPassword !== confirmPassword || confirmPassword==null || confirmPassword=="") {
      document.forms["myForm"]["confirm"].style.background = "red";
      myBoolean = true;
      confirmBoolean = true;
    }
	else { //Sets the input field back to white
		document.forms["myForm"]["confirm"].style.background = "white";
	}
    
    /*If there are errors print them*/
    if (myBoolean) {
		//Resets if error already exist
		var check = document.getElementById("div1");
		if (check != null) {
			check.parentNode.removeChild(check);
		}
		//End of Reset
		var div=document.createElement("div");
		div.setAttribute("id","div1");
		var para=document.createElement("h1");
        var node=document.createTextNode("Error:");
        para.appendChild(node);
		div.appendChild(para);
        

		//Print error for user name
        if (userBoolean) {

            var para=document.createElement("p");
            var node=document.createTextNode("User Name Must Be Filled Out!");
            para.appendChild(node);
			div.appendChild(para);
        }
		//Print error for email
        if (emailBoolean) {
            var para=document.createElement("p");
            var node=document.createTextNode("Not A Valid Email!");
            para.appendChild(node);
			div.appendChild(para);
        }
		//Print error for password
        if (passBoolean) {
            var para=document.createElement("p");
            var node=document.createTextNode("Please Enter A Password!");
            para.appendChild(node);
			div.appendChild(para);
        }
		//Print error for confrim password
        if (confirmBoolean) {
            var para=document.createElement("p");
            var node=document.createTextNode("Password Does Not Match!");
            para.appendChild(node);
			div.appendChild(para);
        }
		var element=document.getElementsByTagName("form")[0];
        element.parentNode.insertBefore(div,element);
        
		return false;
    }
}


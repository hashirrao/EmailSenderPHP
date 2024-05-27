
document.getElementById("form").onsubmit = function (e){
    var x = document.getElementById("test").value;
    var y = x.split("\\");
    if(document.getElementById("attachmentsinput").value == ""){
        document.getElementById("attachmentsinput").value = y[y.length-1];
    }
    else{
        document.getElementById("attachmentsinput").value = document.getElementById("attachmentsinput").value + "," + y[y.length-1];
    }
}

function addemail(){
    var reciepentemail = document.getElementById("reciepentemail").value;
    var useremail = document.getElementById("emaillabel").innerHTML;
    var httpr = new XMLHttpRequest();
    httpr.open("POST","./src/php/addemail.php",true);
    httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    httpr.onreadystatechange=function(){
        if(httpr.readyState == 4 && httpr.status == 200){
            //alert(httpr.responseText);
        }
    }
    httpr.send("reciepentemail="+reciepentemail + "&useremail="+useremail);
    setTimeout(fetchemail,1000);
}

function fetchemail(){
    var searchemail = document.getElementById("searchemail").value;
    var useremail = document.getElementById("emaillabel").innerHTML;
    var httpr = new XMLHttpRequest();
    httpr.open("POST","./src/php/fetchemails.php",true);
    httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    httpr.onreadystatechange=function(){
        if(httpr.readyState == 4 && httpr.status == 200){
            document.getElementById("reciepentstable").innerHTML = httpr.responseText;
        }
    }
    httpr.send("searchemail="+searchemail + "&useremail="+useremail);
}

fetchemail();

function checkall(){
    if(document.getElementById("checkall").checked){
        var table = document.getElementById("reciepentstable");
        document.getElementById("uncheckall").checked = false;
        for(var i=0; i<table.rows.length; i++){
            document.getElementById("checkbox"+i).checked = true;
        }
    }
}

function uncheckall(){
    if(document.getElementById("uncheckall").checked){
        var table = document.getElementById("reciepentstable");
        document.getElementById("checkall").checked = false;
        for(var i=0; i<table.rows.length; i++){
            document.getElementById("checkbox"+i).checked = false;
        }
    }
}

function tablecheckboxesclick(){
    document.getElementById("checkall").checked = false;
    document.getElementById("uncheckall").checked = false;
}

function deleteemails(){
    var reciepentemails = new Array();
    var useremail = document.getElementById("emaillabel").innerHTML;
    var j = 0;
    var table = document.getElementById("reciepentstable");
    for(var i=0; i<table.rows.length; i++){
        if(document.getElementById("checkbox"+i).checked){
            reciepentemails[j] = table.rows[i].cells[0].innerHTML;
            j++;
        }
    }
    var httpr = new XMLHttpRequest();
    httpr.open("POST","./src/php/deleteemail.php",true);
    httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    httpr.onreadystatechange=function(){
        if(httpr.readyState == 4 && httpr.status == 200){
            //alert(httpr.responseText);
            fetchemail();
        }
    }
    httpr.send("reciepentemails="+reciepentemails + "&useremail="+useremail);
}

function sendemails(){
    var senderemail = document.getElementById("senderemail").value;
    var senderpassword = document.getElementById("senderpassword").value;
    var subject = document.getElementById("subject").value;
    var maintext = document.getElementById("maintext").value;
    var attachmentaddress = document.getElementById("attachmentsinput").value;
    if(senderemail != "" && senderpassword != "" && subject != "" && maintext != ""){
        var reciepentemails = new Array();
        var reciepentemail;
        var j = 0;
        var percentage = 0;
        var table = document.getElementById("reciepentstable");
        document.getElementById("messagelabel").innerHTML = "";
        for(var i=0; i<table.rows.length; i++){
            if(document.getElementById("checkbox"+i).checked){
                reciepentemail = table.rows[i].cells[0].innerHTML;
                
                document.getElementById("blockdiv").style.visibility = "visible";
                //document.getElementById("process").style.width = percentage+"%";
                //document.getElementById("messagelabel").innerHTML = document.getElementById("messagelabel").innerHTML+"<tr>"+reciepentemail+"<tr>";
                
                var httpr = new XMLHttpRequest();
                httpr.open("POST","./src/php/send.php",true);
                httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                httpr.onreadystatechange=function(){
                    if(httpr.readyState == 4 && httpr.status == 200){
                        document.getElementById("blockdiv").style.visibility = "hidden";
                    }
                }
                httpr.send("senderemail="+senderemail+"&senderpassword="+senderpassword+"&subject="+subject+"&maintext="+maintext+"&reciepentemail="+reciepentemail+"&attachmentaddress="+attachmentaddress);
                j++;
            }
        }
    }
    else{
        alert("Fill out all feilds and then try again..\nAnd at least one email checked..");
    }
}

function loading(i){
    document.getElementById("blockdiv").style.visibility = "visible";
    document.getElementById("process").style.width = i+"%";
}

function loadingbutton(){
    document.getElementById("blockdiv").style.visibility = "hidden";
}

var x=0;

setInterval(()=>{
    document.getElementById("processlabel").innerHTML += " .";
    x++
    if(x>=5){
        x=0;
        document.getElementById("processlabel").innerHTML = ".";
    }
}, 500);

setTimeout(checkall, 500);
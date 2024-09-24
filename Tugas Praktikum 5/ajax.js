function getXMLHTTPrequest(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function get_server_time() {
    var xmlhttp = getXMLHTTPrequest();
    var page = 'get_server_time.php';
    xmlhttp.open("GET", page, true);
    xmlhttp.onreadystatechange = function() {
        document.getElementById('show_time').innerHTML = xmlhttp.responseText;
    }
    xmlhttp.send(null);
}

function add_customer_get(){
    var xmlhttp = getXMLHTTPrequest();
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    if (name != "" && address != "" && city != ""){
        var url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" + city;
        var inner = "add_response";
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function() {
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
                return false;
        }
        xmlhttp.send(null);
    }else{
        alert("Please fill all the fields");
    }
}

function add_customer_post(){
    var xmlhttp = getXMLHTTPrequest();
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    if (name != "" && address != "" && city != ""){
        var url = "add_customer_post.php"; alert(url);
        var inner = "add_response";
        var params = "name=" + name + "&address=" + address + "&city=" + city;
        xmlhttp.open('POST', url, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange = function() {
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
                return false;
        }
        xmlhttp.send(params);
    }else{
        alert("Please fill all the fields");
    }
}

function callAjax(url, inner){
    var xmlhttp = getXMLHTTPrequest();
    xmlhttp.open('GET', url, true);
    xmlhttp.onreadystatechange = function(){
        document.getElementById(inner).innerHTML = xmlhttp.responseText;
        return false
    }
    xmlhttp.send(null);
}

function showCustomer(customerid){
    var inner= 'detail_customer';
    var url = 'get_customer.php?id=' + customerid;
    if(customerid ==''){
        document.getElementById(inner).innerHTML='';
    }else{
        callAjax(url,inner);
    }
}

function searchBook() {
    var xmlhttp = getXMLHTTPrequest();
    var title = encodeURI(document.getElementById('title').value);

    if (title != "") {
        var url = "get_books.php?title=" + title;
        var inner = "detail_buku";
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 1) {
                document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png"/>';
            }
            if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    } else {
        alert("Please fill all the fields");
    }
}
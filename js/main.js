function approve() {
    if(document.getElementById("approve").checked) {
        document.getElementsById("submituser").disabled = false;
    } else {
        document.getElementsById("submituser").disabled = true;
    }

}



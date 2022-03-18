let approve = document.getElementById('approve');
let submituser = document.getElementById('submituser');
approve.onchange = function() {
  submituser.disabled = !this.checked;
};

// bara köra den här på Register-sidan för att undvika felmeddelande. Om JS inte är installerad syns "noscript"




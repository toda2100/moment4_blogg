let approve = document.getElementById('approve');
let submituser = document.getElementById('submituser');
approve.onchange = function() {
  submituser.disabled = !this.checked;
};
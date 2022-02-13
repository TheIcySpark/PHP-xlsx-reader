const form = {
    inputFile: document.getElementById('inputFile'),
    submit: document.getElementById('submitButton')
};

form.submit.addEventListener('click', () =>{
    console.log('form submited');
    const http = new XMLHttpRequest();

    http.onreadystatechange = function(){
        if(this.status == 200){
            document.getElementById("messageSpace").innerHTML = this.responseText;
        }
    }
    const formData = new FormData();
    formData.append('file', form.inputFile.files[0]);

    http.open("POST", 'uploadFile.php');
    http.send(formData);

});
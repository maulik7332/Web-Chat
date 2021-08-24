const form = document.querySelector(".typing-area"),
inputField = document.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
BackBtn = document.querySelector('.fa-arrow-left');


BackBtn.onclick = ()=>{
    // alert("it's working..");
    // prompt("yes");
    document.getElementById('wrapper2').style.display = 'none';
    document.getElementById('wrapper3').style.display = 'flex'; 
}
form.addEventListener("submit",(e)=>{
    e.preventDefault()
    console.log("click");
    inputField.value = "";
})
form.onsubmit = (e) => {
    e.preventDefault();
}

sendBtn.onclick = ()=> {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/InsertChat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
                
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/GetChat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
},500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}
const registerButton = document.querySelector(".register");
const registerForm = document.querySelector("#register-form");
const nameStatusContainer = document.querySelector(".name-status-container")
const emailStatusContainer = document.querySelector(".email-status-container")
const passwordStatusContainer = document.querySelector(".password-status-container")

$("input:checkbox").click(function() { return false; }) // makes all checkbox unclickable

const required = function(e) {
    if (e === 'name') {
        // console.log("Name");
        if (registerForm.name.value.length >= 5) {
            nameStatusContainer.children[0].checked = true
            nameStatusContainer.children[1].classList.add("green");
        } else if (registerForm.name.value.length <= 4) {
            nameStatusContainer.children[0].checked = false
            nameStatusContainer.children[1].classList.remove("green");
        }
    } else if (e === 'email') {
        // console.log("Username");
        if (registerForm.email.value.length >= 3) {
            emailStatusContainer.children[0].checked = true
            emailStatusContainer.children[1].classList.add("green");
        } else if (registerForm.email.value.length <= 2) {
            emailStatusContainer.children[0].checked = false
            emailStatusContainer.children[1].classList.remove("green");
        }
    } else if (e === 'password') {
        // console.log("Password");
        if (registerForm.password.value.length >= 5) {
            passwordStatusContainer.children[0].checked = true
            passwordStatusContainer.children[1].classList.add("green");
        } else if (registerForm.password.value.length <= 4) {
            passwordStatusContainer.children[0].checked = false
            passwordStatusContainer.children[1].classList.remove("green");
        }
    }
}

registerForm.name.addEventListener('keyup', () => required("name"));
registerForm.email.addEventListener('keyup', () => required("email"));
registerForm.password.addEventListener('keyup', () => required("password"));

const submitForm = () => {
    if (registerForm.name.value.length <= 4 || registerForm.email.value.length <= 2 || registerForm.password.value.length <= 4) {
        alert("All requirements must be met!");
        return false;
    } else {
        $.ajax({
            url:'../router/router.php?action=register',
            data:$("#register-form").serialize(),
            type:'POST',
            beforeSend:function() {
                
            },
            success:function(e) {
                if (e === 'Registration Success') {
                    window.location.href = "../../../../index.php";
                } else {
                    alert("Email Does Exist in the Database! Please Create a New One");
                }
            }
        })
    }
}

registerButton.addEventListener('click', submitForm);

required("name");
required("email");
required("password");
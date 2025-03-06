
var form = document.getElementById("crudForm");

form.querySelectorAll("input").forEach(input => {
    input.addEventListener("input", () => {
        input.setCustomValidity("")
    })
})
form.querySelectorAll("#phoneNumber, #userID").forEach(input => {
    input.addEventListener("input", () => {
        input.value = input.value.replace(/\D/g, "")
    })

    input.addEventListener("keydown", (event) => {
        if (!event.key.match(/[0-9]/) && event.key !== "Backspace" && event.key !== "Delete" && event.key !== "Tab") {
            event.preventDefault()
        }
    })
})
form.addEventListener("submit", (event) => {
    let isValid = true
    var crudSelection = sessionStorage.getItem('crudSelection')
    if(crudSelection == 2){
        form.querySelectorAll("input").forEach(input => {
            var field = input.getAttribute('id')
            // console.log(field)
            input.setCustomValidity("")
    
            if (!Validations.isValidLength(input.value.trim(), 15)) {
                input.setCustomValidity("field must have max of 15 characters.")
                isValid = false
            }
            if (field === 'email' && !Validations.isEmail(input.value.trim())) {
                if (input.validationMessage) { 
                    input.setCustomValidity(input.validationMessage + " Also, the email format is incorrect..")
                } else {
                    input.setCustomValidity("invalid email.")
                }
                isValid = false;
            }
            input.reportValidity()
        });   
    }

    if (!isValid) {
        event.preventDefault()
    }else{
        event.preventDefault()
        submitHandler( form )
    }
});

var submitHandler = ( form ) => {
    let formData = {}
    var crudSelection = sessionStorage.getItem('crudSelection') 
    var typeQuery = sessionStorage.getItem('typeQuery') 
    if(crudSelection == '1'){
        var id = form.querySelector('#userID')
        formData['userID'] = id.value
        // formData['action'] = 'RD'
    }else{
        form.querySelectorAll("input, textarea").forEach(input => {
            formData[input.id] = input.value.trim()
            // formData['action'] = 'CU'
        });
    }
    formData['typeQuery'] = typeQuery 


    const body = JSON.stringify(formData)
    // console.log(body)
    submit(body)
}

var submit = async ( body ) => {
    try {
        const response = await fetch("src/controller/php/service.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: body,
        })
        const result = await response.json()
        if (response.ok) {
            console.log("Successfull Transaction.")
            typeQuery = sessionStorage.getItem('typeQuery')
            if(typeQuery == 'SEARCH'){
                fillFields( result )
            }else if(typeQuery == 'INSERT'){
                sweetAlert('success', 'Insertion Done', "User ID: "+result['userID']+"")
            }else{
                sweetAlert('success', 'Done', 'Transaction success')
            }
        } else {
            throw new Error(result.message || "Error.")
        }
    } catch{
        sweetAlert('error', 'Something did wrong...', 'Data not foun. Verify your fields')
    }
}

var sweetAlert = (type, title, message) => {
    Swal.fire({
        title: title,
        text: message,
        icon: type
    });
}

var fillFields = ( data ) => {
    
    const fieldMapping = {
        ID: "userID",
        NAME: "name",
        LAST_NAME: "lastName",
        PHONE_NUMBER: "phoneNumber",
        EMAIL: "email",
        USER_DATA: "additionalData"
    };

    Object.keys(fieldMapping).forEach(key => {
        const inputId = fieldMapping[key];
        const inputElement = document.getElementById(inputId);

        if (inputElement) {
            inputElement.value = data[key] || "";
        }
    });
}
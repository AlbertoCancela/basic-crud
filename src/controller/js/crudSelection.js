var setFieldsReadonly = (fields, condition, required) => {
    fields.forEach(field => {
        field.disabled = condition
        if (required) {
            field.setAttribute("required", "true")
        } else {
            field.removeAttribute("required")
        }
        if (!condition) {
            field.classList.add("fake-focus");
        } else {
            field.classList.remove("fake-focus");
        }
    });
}

var clearFields = (fields)  => {
    fields.forEach(field => {
        field.value= ''
    })
}

var crudSelection = (selection, value) => {
    var state = document.getElementById('crudState')
    state .innerHTML = selection;

    sessionStorage.setItem('crudSelection', value)
    sessionStorage.setItem('typeQuery', selection)
    
    const CUD = document.querySelectorAll('.CUD')
    const R = document.querySelectorAll('.R')

    if (value == 1) {
        setFieldsReadonly(CUD, true, false)
        if(selection == "SEARCH"){
            clearFields(CUD)
        }
        setFieldsReadonly(R, false, true)
    } else {
        setFieldsReadonly(CUD, false, true)
        if(selection == "INSERT"){
            clearFields(R)
        }
        setFieldsReadonly(R, true, false);
    }
}

crudSelection('SEARCH', 1)

const departmentItems = document.querySelectorAll('.department-item')
const statusItem = document.querySelectorAll('.status-item')
const departmentButton = document.querySelector('#department-add')
const statusButton = document.querySelector('#status-add')
const departmentInput = document.querySelector('#department-input')
const statusInput = document.querySelector('#status-input')

const departmentList = []
const statusList = []

departmentItems.forEach(function (item) {
    departmentList.push(item.value)
})

statusItem.forEach(function (item) {
    statusList.push(item.value)
})

departmentInput.onchange = function () {
    console.log("hello")
    if (departmentList.includes(departmentInput.value)) {
        departmentButton.disabled = true
        departmentButton.style.backgroundColor = "red"
    }
    else {
        departmentButton.disabled = false
        departmentButton.style.backgroundColor = "#55afc69b"
    }
}

statusInput.onchange = function () {
    if (statusList.includes(statusInput.value)) {
        statusButton.disabled = true
        statusButton.style.backgroundColor = "red"
    }
    else {
        statusButton.disabled = false
        statusButton.style.backgroundColor = "#55afc69b"
    }
}

const userBoxes = document.querySelectorAll('.user-box')

userBoxes.forEach((element) => {
    const userDepartments = element.querySelector('.user-departments')
    if (userDepartments == null) return
    const departmentSelect = element.querySelector('.department-select')
    const toggleButton = element.querySelector('.toggle-button')
    const aid = element.querySelector('.uid')

    toggleButton.addEventListener('click', async function() {
        const department = departmentSelect.value 
        const response = await fetch('../api/api_toggle_department.php?aid=' + aid.textContent + '&department=' + department)
        const departments = response.json()
        console.log(departments)
    })
})
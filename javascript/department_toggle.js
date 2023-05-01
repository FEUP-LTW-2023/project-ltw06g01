const agentBoxes = document.querySelectorAll('.user-box')

agentBoxes.forEach((element) => {
    const userDepartments = element.querySelector('.user-departments')
    if (userDepartments == null) return
    const departmentSelect = element.querySelector('.department-select')
    const toggleButton = element.querySelector('.toggle-button')
    const aid = element.querySelector('.uid')

    toggleButton.addEventListener('click', async function() {
        const department = departmentSelect.value 
        if (department === '') return
        const response = await fetch('../api/api_toggle_department.php?aid=' + aid.getAttribute('value') + '&department=' + department)
        const departments = await response.json()
        console.log(departments)
    })
})
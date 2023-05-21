const assignBoxes = document.querySelectorAll('.assign-box')

assignBoxes.forEach((element) => {
    const tID = element.querySelector('.assign-id').value
    const agentSelect = element.querySelector('select')
    const csrf = element.querySelector('.csrf').value
    const assignButton = element.querySelector('.assign-confirm')

    assignButton.addEventListener('click', async function () {
        const response = await fetch('../api/api_assign_agent.php?aid=' + agentSelect.value + '&id=' + tID + '&csrf=' + csrf)
        const json = await response.json()
        
        if (json != agentSelect.value) {
            assignButton.style.backgroundColor = "green" 
        }
        else {
            assignButton.style.backgroundColor = "red"
        }

        setTimeout(() => {
            assignButton.style.backgroundColor = "#bed9e041"
        }, 2000)
    })
})